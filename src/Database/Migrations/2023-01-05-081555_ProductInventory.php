<?php

namespace Smartimpact\Pimproducts\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductInventory extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_inventory'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'quantity'					=> ['type' => 'int', 'constraint' => 11],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_inventory', true);
        $this->forge->createTable('product_inventory', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_inventory');
    }
}
