<?php

namespace Smartimpact\Pimproducts\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductDiscount extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_discount'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'name'					=> ['type' => 'varchar', 'constraint' => 100],
            'description'             => ['type' => 'text',  'null' => true],
            'discount_percent'			=> ['type' => 'int','constraint' => 10],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_discount', true);
        $this->forge->createTable('product_discount', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_discount');
    }
}
