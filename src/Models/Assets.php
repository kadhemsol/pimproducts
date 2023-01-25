<?php
namespace Smartimpact\PimProducts\Models;

use CodeIgniter\Model;

use Smartimpact\Pimproducts\Models\AttributeModel;

class Assets extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'assets';
  protected $primaryKey       = 'asset_id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['local_url','source_url','source_id'];

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
  protected $beforeInsert   = [];
  protected $afterInsert    = [];
  protected $beforeUpdate   = [];
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
        parent::__construct();
    }

public function contentUpload($content,$filename,$source_id=''){
	$res=$this->where('source_url',$filename)->findAll();
foreach($res as $row)
	return $row['asset_id'];

	helper('filesystem');

			$exfilename=explode('.',trim($filename) );
			$ext=trim( strtolower(end($exfilename)));
 
			$newfilename= (int)$this->getNextId(). '.' .$ext;
			$newPath='upload/' . $ext . '/';


			if (!is_dir(FCPATH . 'upload/')) {
			// dir doesn't exist, make it
				mkdir(FCPATH . 'upload/');
			}

			if (!is_dir(FCPATH . $newPath)) {
				mkdir(FCPATH . $newPath);
			}
			
 			$fullpath= FCPATH . $newPath . $newfilename;
 
		if (write_file($fullpath, $content)) {


				$res=$this->insert(
					[
						'local_url' => $newPath . $newfilename ,
						'source_url' =>  $filename,
						'source_id' => $source_id
					]
				);

				return $this->db->insertID();
				

		}




}

	public function getNextId(){

	$query=$this->db->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '".$this->table."' AND table_schema = '".$this->db->database."';");
		foreach ($query->getResult() as $row)	
			return $row->AUTO_INCREMENT;
	}
 
  
}