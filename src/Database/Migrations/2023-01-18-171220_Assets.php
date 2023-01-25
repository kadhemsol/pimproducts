<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Assets extends Migration
{
    public function up()
    {

        $this->forge->addField([
        	'asset_id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        	'local_url'							=> ['type' => 'varchar' , 'constraint' => 255],
        	'source_url'							=> ['type' => 'varchar' , 'constraint' => 255,  'null' => true],
        	'source_id'							=> ['type' => 'varchar' , 'constraint' => 255 ,  'null' => true ],
            'created_at datetime default current_timestamp', 
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime'
        ]);
        $this->forge->addKey('asset_id', true);
        $this->forge->createTable('assets', true);
 
		}
		

    public function down()
    {
        //
    }
}
