<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaSistema extends Migration{
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
													'constraint' => '150',
									],
									'cnpj'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'imagem'       => [
													'type'       => 'VARCHAR',
													'constraint' => '255',
													'null' => true,

									],

									'telefone'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'email'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],

									'cep'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'endereco'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'numero'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'cidade'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
									],
									'estado'       => [
													'type'       => 'VARCHAR',
													'constraint' => '150',
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
					$this->forge->addPrimaryKey('id');
					//$this->forge->addPrimaryKey('email')->addUniqueKey('email');
					$this->forge->createTable('sistemas');
	}

	public function down()
	{
					$this->forge->dropTable('sistemas');
	}
}
