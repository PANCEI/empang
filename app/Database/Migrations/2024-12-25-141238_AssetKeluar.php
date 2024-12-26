<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssetKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kodeaset' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'keterangan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('asset_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('asset_keluar');
    }
}