<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invoice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'id_komoditi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'delete_mark' => [
                'type' => 'BOOLEAN',
                'default' => false
            ]
        ]);

        $this->forge->addKey('kode_invoice', true); // Primary key
        $this->forge->createTable('invoice');
    }

    public function down()
    {
        $this->forge->dropTable('invoice');
    }
}
