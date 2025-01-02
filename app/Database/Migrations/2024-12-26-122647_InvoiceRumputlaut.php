<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InvoiceRumputlaut extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'namapemanen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'jumlah_upah' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'delete_mark' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('kode_invoice', true);
        $this->forge->createTable('invoice_rumputlaut');
    }

    public function down()
    {
        $this->forge->dropTable('invoice_rumputlaut');
    }
}
