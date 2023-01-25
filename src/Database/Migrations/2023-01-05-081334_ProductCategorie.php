<?php

namespace Smartimpact\Pimproducts\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCategorie extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_cat'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'name'					=> ['type' => 'varchar', 'constraint' => 100],
            'description'             => ['type' => 'text',  'null' => true],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_cat', true);
        $this->forge->createTable('product_categorie', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_categorie');

    }
}
