<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_product'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'name'					=> ['type' => 'varchar', 'constraint' => 100],
            'description'             => ['type' => 'text',  'null' => true],
        	'short_description'			=> ['type' => 'text', 'null' => true],
            'SKU'			=> ['type' => 'varchar', 'constraint' => 100],
            'price'			=> ['type' => 'DECIMAL','constraint' => '10,2'],
            'state'			=> ['type' => 'varchar', 'constraint' => 100],
            'suggested_price'			=> ['type' => 'DECIMAL','constraint' => '10,2'],
            'buying_price'			=> ['type' => 'DECIMAL','constraint' => '10,2'],
        	'image'					=> ['type' => 'varchar', 'constraint' => 200],
            'id_categorie'			=> ['type' => 'int', 'constraint' => 11],
            'id_inventory'			=> ['type' => 'int', 'constraint' => 11],
            'id_discount'			=> ['type' => 'int', 'constraint' => 11],
            'id_images'			=> ['type' => 'int', 'constraint' => 11],

            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_product', true);
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products');

    }
}
