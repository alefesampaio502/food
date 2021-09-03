<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaExpediente extends Migration
{
	public function up()
        {
                $this->forge->addField([
									'id'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
                        'dia'       => [
                                'type'       => 'INT',
                                  'constraint'   => 5,
                        ],

												'dia_descricao'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '50',
                        ],

												'abertura'       => [
																'type'       => 'TIME',
																'null' => true,
																'default' => null,
												],


												'fechamento'       => [
																'type'       => 'TIME',
																'null' => true,
																'default' => null,
												],

												'situacao' => [//exeplo 0 (fechado) 1(aberto)
													'type'       => 'BOOLEAN',
													'null' => false,

												],
                ]);
                $this->forge->addPrimaryKey('id');
								//$this->forge->addPrimaryKey('email')->addUniqueKey('email');
                $this->forge->createTable('expediente');
        }

        public function down()
        {
                $this->forge->dropTable('expediente');
        }
}
