<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsCategoriesAlter extends Migration
{
    public function up()
    {
		
		
		$this->forge->addColumn('products_categories', [
            'child_count' => [ 'type' => 'INT' ,'default' => 0],
			]);
		}

    public function down()
    {
        //
    }
}
