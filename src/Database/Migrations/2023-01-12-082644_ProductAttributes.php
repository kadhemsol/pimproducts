<?php

namespace Smartimpact\Pimproducts\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductAttributes extends Migration
{
    public function up()
    {
 $this->forge->addField([
        	'id_attribute'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'att_label'					=> ['type' => 'varchar', 'constraint' => 300],
        	'att_type'					=> ['type' => 'varchar', 'constraint' => 300],
        	'att_required'					=> ['type' => 'int'],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_attribute', true);
        $this->forge->createTable('product_attribute', true);
		}

    public function down()
    {
        //
    }
}
