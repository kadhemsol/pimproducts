<?php

namespace Smartimpact\Pimproducts\Controllers;

use CodeIgniter\Controller;

use Smartimpact\Pimproducts\Models\ProductsModel;
use Smartimpact\Pimproducts\Models\Product;
use Smartimpact\Pimproducts\Database\Migrations;

use Irsyadulibad\DataTables\DataTables;






class Products extends \App\Controllers\BaseController
{

    //--------------------------------------------------------------------

	public function __construct()
	{
		
	}

    //--------------------------------------------------------------------

	/**

	 */


public function json()
    {



       /* $data = (new Product)->getProducts();

return $this->response->setJSON($data); 
*/
      

        return DataTables::use('products')->make();


       
    }

    
	public function productslist()
	{


       return view('Smartimpact\Pimproducts\Views\products\list');
        /*
        $data = (new Product)->ajax_list_product([],0,3);

		//$data = (new Product)->getProducts();
        return view ('Smartimpact\Pimproducts\Views\products\list', ['products' => $data]);  

*/
	
	}






		public function newproducts()
	{

	
        return view ('Smartimpact\Pimproducts\Views\products\AddProducts');  


	
	}


    function product($product_id = NULL) {
        if ($product_id) {
          
            $producttModel = new ProductsModel;
            $products = $productModel->findAll();
            return $this->response->setJSON([
                'error' => false,
                'message' => $product
            ]);
        
           
         }else{

            $file = $this->request->getFile('image');
            $fileName = $file->getRandomName();
    
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'short_description' => $this->request->getPost('short_description'),
                'SKU' => $this->request->getPost('SKU'),
                'price' => $this->request->getPost('price'),
                'state' => $this->request->getPost('state'),
                'suggested_price' => $this->request->getPost('suggested_price'),
                'buying_price' => $this->request->getPost('buying_price'),
                'image' => $fileName,
                'id_categorie' => $this->request->getPost('categorie'),
                'id_inventory' => $this->request->getPost('inventory'),
                'id_discount' => $this->request->getPost('discount'),
                'id_images' => $this->request->getPost('images'),
                'created_at' => date('Y-m-d H:i:s')
            ];
    
           
    
            $validation = ConfigServices::validation();
            $validation->setRules([
                'image' => 'uploaded[file]|max_size[file,1024]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
            ]);
            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => $validation->getErrors()
                ]);
            } else {
                $file->move('uploads/products', $fileName);
                $producttModel = new ProductsModel;
                $productModel->save($data);
                return $this->response->setJSON([
                    'error' => false,
                    'message' => 'Produit ajoutée avec succès !'
                ]);
            }
            
        }
    
       
    }




    public function add() {
        
    }





    public function edit($id = null) {
        $producttModel = new ProductsModel;
        $products = $productModel->findAll();
        return $this->response->setJSON([
            'error' => false,
            'message' => $product
        ]);
    }

    public function update() {
        $id = $this->request->getPost('id');
        $file = $this->request->getFile('file');
        $fileName = $file->getFilename();

        if ($fileName != '') {
            $fileName = $file->getRandomName();
            $file->move('uploads/products', $fileName);
            if ($this->request->getPost('old_image') != '') {
                unlink('uploads/products/' . $this->request->getPost('old_image'));
            }
        } else {
            $fileName = $this->request->getPost('old_image');
        }

        $data = [
          
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'short_description' => $this->request->getPost('short_description'),
            'SKU' => $this->request->getPost('SKU'),
            'price' => $this->request->getPost('price'),
            'state' => $this->request->getPost('state'),
            'suggested_price' => $this->request->getPost('suggested_price'),
            'buying_price' => $this->request->getPost('buying_price'),
            'image' => $fileName,
            'id_categorie' => $this->request->getPost('id_categorie'),
            'id_inventory' => $this->request->getPost('id_inventory'),
            'id_discount' => $this->request->getPost('id_discount'),
            'id_images' => $this->request->getPost('id_images'),
            'updated_at' => date('Y-m-d H:i:s')



        ];

        $producttModel = new ProductsModel;
        $products->update($id, $data);

        return $this->response->setJSON([
            'error' => false,
            'message' => 'Produit  à jour  !
            '
        ]);
    }

    public function delete($id = null) {

        $productModel = new ProductsModel;
        $products = $productModel->find($id);

      
        $productModel->delete($id);
        /*unlink('uploads/product/' . $products['image']);*/
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Produit supprimé avec succès !'
        ]);
    }

    public function detail($id = null) {
        $producttModel = new ProductsModel;
        $products = $productModel->find($id);
        return $this->response->setJSON([
            'error' => false,
            'message' => $products
        ]);
    }


}