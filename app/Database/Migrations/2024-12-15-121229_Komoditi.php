<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komoditi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komoditi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_komoditi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_komoditi', true); // Primary key
        $this->forge->createTable('komoditi');
    }

    public function down()
    {
        $this->forge->dropTable('komoditi');
    }
}
