<?php

namespace Smartimpact\Pimproducts\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
        	'id_image'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'image_url'					=> ['type' => 'varchar', 'constraint' => 300],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id_image', true);
        $this->forge->createTable('product_images', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_images');
    }
}
