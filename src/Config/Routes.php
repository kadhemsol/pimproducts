<?php

$routes->group('', ['namespace' => 'Smartimpact\Pimproducts\Controllers'], function($routes) {
 $routes->get('products', 'Products::productslist');
$routes->get('products/new', 'Products::newproducts');
$routes->post('products/new_product', 'Products::add');
$routes->get('products/edit/(:num)', 'Products::edit/$1');
$routes->get('products/delete/(:num)', 'Products::delete/$1');
$routes->get('products/detail/(:num)', 'Products::detail/$1');
$routes->post('post/update', 'Products::update');


 $routes->get('products/json', 'Products::json');





// CRUD Attribute
$routes->get('products/attribute', 'AttributeProduct::index');
$routes->match(["get", "post"], "products/new_attribute", "AttributeProduct::create"); // insert new records
$routes->match(["get", "post"], "products/edit-attribute/(:num)", "AttributeProduct::editAttribute/$1"); // update existing record
$routes->get("products/delete-attribute/(:num)", "AttributeProduct::deleteAttribute/$1"); // delete existing record







 


});


helper('PimHelper');
PimHelper::addMenu(
	[
		[
			'label' => 'Products',
			'name' => 'products_menu',
			'order' => 2,
			'permission' => ['admin',''],
			'submenu' => 
			[
				'List' => '/products',
				'Ajout' => '/products/edit',
				'Exportation' => '/products/export',
				'Attribut' => '/products/attribute'
			]
		]
]		
);
 