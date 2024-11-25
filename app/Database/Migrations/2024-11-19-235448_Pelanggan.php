<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id_pelanggan' => [
            'type' => 'int',
            'constraint' => '11',
            'unsigned' => 'true',
            'autoincrement' => 'true',
        ],
        'nama_pelanggan' => [
            'type' => 'varchar',
            'constraint' => '255',
        ],
        'alamat' => [
            'type' => 'text',
            'constraint' => '200',
        ],
        'telepon' => [
            'type' => 'int',
            'constraint' => '11',
        ],
        'deleted_at' => [
            'type' => 'DATETIME'
        ],
        'created_at' => [
            'type' => 'DATETIME',
        ],
        'updated_at' => [
            'type' => 'DATETIME',
        ]
    ]);
    $this->forge->addKey('id_pelanggan', TRUE);
    $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
     $this->forge->dropTable('tb_pelanggan');
    }
}
