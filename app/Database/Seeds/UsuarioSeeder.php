<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
	public function run()
	{
            $usuarioModel = new \App\Models\UsuarioModel;

            $usuario = [
                'nome' => 'Raimundo Nonato Sampaio',
                'email' => 'alefesampaio@gmail.com',
								'password' => '123456',
                'cpf' => '808.398.050-12',
                'telefone' => '(63) 99999 - 9966',
								'is_admin' => true,
								'ativo' => true,
            ];
            $usuarioModel->skipValidation(true)->protect(false)->insert($usuario);


	}
}
