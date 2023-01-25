<?php

namespace Smartimpact\Pimproducts\Controllers;

use CodeIgniter\Controller;

use Smartimpact\Pimproducts\Models\AttributeModel;
use Smartimpact\Pimproducts\Models\ProductsModel;

use Smartimpact\Pimproducts\Database\Migrations;


use Smartimpact\Pimproducts\Models\References;


class AttributeProduct extends \App\Controllers\BaseController
{

    public function index(){

        $attributetModel = new AttributeModel();
        $data['product_attribute'] = $attributetModel->findAll();
		$data['References'] = (new References)->findAll();
        return view('Smartimpact\Pimproducts\Views\products\attribute_product', $data);
    }
    // add user form
    public function create(){
        if ($this->request->getMethod() == "post") {

            $rules = [
                "att_name" => "required|min_length[1]|max_length[40]",
                "att_label" => "required|min_length[1]|max_length[40]"
    
            ];

            if (!$this->validate($rules)) {

                return view('Smartimpact\Pimproducts\Views\products\new_attribute', [
                    "validation" => $this->validator,
                ]);
            } 
			else 
			{
                $attributetModel = new AttributeModel();

                $data = [
                    'att_name' => $this->request->getVar("att_name"),
                    'att_label' => $this->request->getVar("att_label"),
                    'att_required' => $this->request->getVar("att_required"),
                    'att_type' => $this->request->getVar("att_type")
                ];
if($this->request->getVar("att_type") =='select' )
	$data['att_ref']= (int)$this->request->getVar("att_reference");

                $attributetModel->save($data);

                $session = session();
                $session->setFlashdata("successMsg", "New Attribute created successfully");

                $producttModel = new ProductsModel;
                $forge = \Config\Database::forge();

               $name_att =  $data['att_name'];
               $type_att =  $data['att_type'];

               if ($type_att == 'text'){

                $fields = [
                    $name_att  => ['type' => 'TEXT'], ];
                    
              
                
               } elseif ($type_att == 'varchar') {

                $fields = [
                    $name_att  => ['type' => 'varchar'  , 'constraint' => 300] ,  ];
               }elseif ($type_att == 'select') {
                $fields = [
                    $name_att  => ['type' => 'INT'  ,'default' => null]  ];
               }elseif ($type_att == 'assets') {
                $fields = [
                    $name_att  => ['type' => 'varchar'   , 'constraint' => 300, 'default' => null]  ];
			   }
               $forge->addColumn('products', $fields);
            

               
                
                return redirect()->to(base_url('products/attribute'));
            }
        }

        return view('Smartimpact\Pimproducts\Views\products\attribute_add');

    }
 

 
    public function editAttribute($id = null)
    {
        $attributetModel = new AttributeModel();
        $producttModel = new ProductsModel;
        $forge = \Config\Database::forge();


        $attr = $attributetModel->where("id_attribute", $id)->first();

        $old =  $attr['att_name'];

        if ($this->request->getMethod() == "post") {

            $rules = [
                "att_name" => "required|min_length[1]|max_length[40]",
                "att_label" => "required|min_length[1]|max_length[40]"
             
            ];
         
            if (!$this->validate($rules)) {

                return view('Smartimpact\Pimproducts\Views\products\attribute_edit', [
                    "validation" => $this->validator,
                    "attr" => $attr,
                ]);
            } else {

                $data = [
                    'att_name' => $this->request->getVar("att_name"),
                    'att_label' => $this->request->getVar("att_label"),
                    'att_required' => $this->request->getVar("att_required"),
                    'att_type' => $this->request->getVar("att_type")
                ];

                $attributetModel->update($id, $data);
                $newname =  $data['att_name'];

                $fields = [
                    $old => [
                        'name' => $newname,
                        'type' => 'TEXT',
                    ],
                ];
                $forge->modifyColumn('products', $fields);

                $session = session();


                $session->setFlashdata("successMsg", "Attribute updated successfully");
                return redirect()->to(base_url('products/attribute'));
            }
        }

        return view('Smartimpact\Pimproducts\Views\products\attribute_edit', [
"attr" => $attr,
        ]);
    }




    public function deleteAttribute($id = null)
    {
        $attributetModel = new AttributeModel();
        $producttModel = new ProductsModel;

        $attrr = $attributetModel->where("id_attribute", $id)->first();
        $name =  $attrr['att_name'];
        $forge = \Config\Database::forge();
       $forge->dropColumn('products', $name);
        $attr = $attributetModel->delete($id);
        $session = session();
        $session->setFlashdata("successMsg", "attribute  deleted successfully");

      //  return redirect()->to(base_url('/products/attribute-list'));
    }

}