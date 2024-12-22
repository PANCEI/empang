<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Asset extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kodeasset' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'delete_mark' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('kodeasset', true); // Primary key
        $this->forge->createTable('assets');
    }

    public function down()
    {
        $this->forge->dropTable('assets');
    }
}
