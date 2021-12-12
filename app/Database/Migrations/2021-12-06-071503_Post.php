<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug'             => [
                'type' => 'TEXT',
            ],
            'title'            => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'body'             => [
                'type' => 'TEXT',
                'constraint'=> '300'
            ],
            'image'             => [
                'type' => 'TEXT',
                'constraint'=> '300',
                'null'      => TRUE
            ],
            'created_at' => [
                'type'      => 'DATETIME',
                'null'      => TRUE
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
                'null'      => TRUE
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
