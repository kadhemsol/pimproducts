<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_category'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'name'					=> ['type' => 'varchar' , 'constraint' => 255],
        	'parent'					=> ['type' => 'INT'],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime'
        ]);
        $this->forge->addKey('id_category', true);
        $this->forge->createTable('products_categories', true);
		}

    public function down()
    {
        //
    }
}
