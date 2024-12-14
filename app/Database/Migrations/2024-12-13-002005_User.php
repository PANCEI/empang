<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'unique' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '128'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'telpon' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'aktif' => [
                'type'       => 'INT',
                'constraint' => 1,
            ],
            'user_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
