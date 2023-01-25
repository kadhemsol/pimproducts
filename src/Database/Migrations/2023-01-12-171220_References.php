<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsReferences extends Migration
{
    public function up()
    {

        $this->forge->addField([
        	'reference_id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'label'							=> ['type' => 'varchar' , 'constraint' => 255],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime'
        ]);
        $this->forge->addKey('reference_id', true);
        $this->forge->createTable('references', true);

        $this->forge->addField([
        	'references_options_id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'reference_id'					=> ['type' => 'INT'],
        	'label'							=> ['type' => 'varchar' , 'constraint' => 255],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime'
        ]);
        $this->forge->addKey('references_options_id', true);
        $this->forge->createTable('references_options', true);
		
		$this->forge->addColumn('product_attribute', [
            'att_ref' => [ 'type' => 'INT' ,'default' => 0],
			]);
		
		
		}
		

    public function down()
    {
        //
    }
}
