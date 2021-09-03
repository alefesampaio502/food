<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
	public function run()
	{
            $usuarioModel = new \App\Models\UsuarioModel;
            $usuario = [
                'nome' => 'Admin',
                'email' => 'admin@admin.com',
                'cpf' => '808.398.050-12',
                'telefone' => '(63) 99999 - 9966',
            ];
            $usuarioModel->protect(false)->insert($usuario);
            
            dd($usuarioModel->errors());
	}
}
