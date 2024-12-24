<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tambahasset extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'kodeaset' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_date' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true); // Set primary key
        $this->forge->createTable('tambah_asset'); // Create the table
    }

    public function down()
    {
        $this->forge->dropTable('tambah_asset'); // Drop the table if it exists
    }
}
