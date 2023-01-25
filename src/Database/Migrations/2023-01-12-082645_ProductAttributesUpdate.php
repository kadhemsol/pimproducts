<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductAttributesUpdate extends Migration
{
    public function up()
    {

		$this->forge->addColumn('product_attribute', [
            'att_name' => [ 'type'       => 'VARCHAR', 'constraint' => '255', ],
 

        ]);

 		}

    public function down()
    {
        //
    }
}
