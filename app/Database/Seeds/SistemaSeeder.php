<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SistemaSeeder extends Seeder
{
	public function run()
	{
						$sistemaModel = new \App\Models\SistemaModel;

						$sistema = [
								'nome' => 'MasteItz',
								'email' => 'masteitz@masteitz.com',
								'cnpj' => '80.190.665/0001-44',
								'telefone' => '(99) 99999 - 9966',
								'cep' => '65900',
								'endereco' => 'Rua são josé',
								'numero' => '45',
								'cidade' => 'Imperatriz',
								'estado' => 'Maranhão',
								'ativo' => true,
						];
						$sistemaModel->skipValidation(true)->protect(false)->insert($sistema);


	}
}
