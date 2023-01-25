<?php
namespace Smartimpact\PimProducts\Models;

use CodeIgniter\Model;

use Smartimpact\Pimproducts\Models\AttributeModel;
use Smartimpact\Pimproducts\Models\Assets;

class Product extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'products';
  protected $primaryKey       = 'id_product';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['categories'];

  // Dates
  protected $useTimestamps = false;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = ['updateCategories'];
  protected $afterInsert    = [];
  protected $beforeUpdate   = ['updateCategories'];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];
  
  protected $categories=[];
  protected $PorviderIdentifier=[];
  protected $PorviderParent=[];

    protected $db;
    public function __construct()
    {
		$db = \Config\Database::connect();
		$this->db = $db;

		$product_attribute = (new AttributeModel())->findAll();
		foreach($product_attribute as $att)	
		$this->allowedFields[]=$att['att_name'];
		parent::__construct();
    }


public function getProducts(){
	$products=$this->findAll();
	//find col assets
		$product_attribute = (new AttributeModel())->findAll();
			foreach($product_attribute as $att)
				if($att['att_type']=="assets")
				{
				$Allassets=[];
				$assets=[];
				foreach($products as $key => $product)
				{
					$products[$key]['assets']=[];
				if($product[$att['att_name']])
				{
					$ass=explode(',',$product[$att['att_name']] );
					foreach($ass as $i)
					{
						$assets[$product['id_product']][]=$i;
						$Allassets[$i]=$i;
					}					
					}
				}

					if(count($Allassets)>0){
	
							$Assets= (new Assets)->select('asset_id,local_url')->whereIn('asset_id',$Allassets)->findAll();



						foreach($products as $key => $product)
						{
							if(isset($assets[$product['id_product']])){
								foreach($assets[$product['id_product']] as $ida)
								{
									foreach($Assets as $Assitem)
									{
										if($Assitem['asset_id'] == $ida)
											$products[$key]['assets'][]=$Assitem['local_url'];
									}
									
								}
							}
						}
					}
				
				}
				return $products;
				 
}


	public function updateProviderIdentifier($providerId,$providerIdentifier)
	{
		$this->PorviderIdentifier[$providerId]=$providerIdentifier;
		$this->allowedFields[]='provider_identifier_'.$providerId;
    }
	public function updatePorviderParent($providerId,$providerParent)
	{
		$this->PorviderParent[$providerId]=$providerParent;
		$this->allowedFields[]='provider_parent_'.$providerId;
    }
	
	
  
  public function addCategory($category_id){
	  $this->categories[$category_id]=$category_id;
  }
  
  public function updateCategories($data){
	$data['data']['categories']=implode(',',$this->categories);
	if($this->PorviderIdentifier)
		foreach($this->PorviderIdentifier as $pid => $pIdentifier)
			$data['data']["provider_identifier_$pid"]=$pIdentifier;
	if($this->PorviderParent)
		foreach($this->PorviderParent as $pid => $pParent)
			$data['data']["provider_parent_$pid"]=$pParent;
		return $data;
  }

  /***
   * 
   * function search product
   * @param params : array 
   * @param $offset : index to start search
   * @param $limit : limit result
   * 
   * @return array : search result 
    * author: kadham
   * **/

  function ajax_list_product($params,$offset,$limit){

  	$result = array();

		if(count($params) > 0){

		}
		else{
			$result = $this->limit($limit,$offset)->findAll();
		}
		return $result;

  }



  



}
