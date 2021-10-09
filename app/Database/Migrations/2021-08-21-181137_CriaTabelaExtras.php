<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaExtras extends Migration{
	public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'nome'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '255',
                        ],

												'slug'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '255',
                        ],
												'preco'       => [
																'type'       => 'DECIMAL',
																'constraint' => '10,2',
												],

												'descricao'       => [
																'type'       => 'TEXT',

												],
												'ativo' => [
													'type'       => 'BOOLEAN',
													'null' => false,
													'default' => true,
												],

												'criado_em' => [
													'type'       => 'DATETIME',
													'null' => true,
													'default' => null,
												],

												'atualizado_em' => [
													'type'       => 'DATETIME',
													'null' => true,
													'default' => null,
												],

												'deletado_em' => [
													'type'       => 'DATETIME',
													'null' => true,
													'default' => null,
												],
                ]);
                $this->forge->addPrimaryKey('id')->addUniqueKey('nome');
								//$this->forge->addPrimaryKey('email')->addUniqueKey('email');
                $this->forge->createTable('extras');
        }

        public function down()
        {
                $this->forge->dropTable('extras');
        }
}
