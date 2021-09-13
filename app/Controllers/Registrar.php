<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Registrar extends BaseController
{

private $usuarioModel;

public function __construct(){
	$this->usuarioModel = new \App\Models\UsuarioModel();
}
	public function novo()
	{
		$data  = [

				'titulo' => 'Criar nova conta',
		];

		return view('Registrar/novo', $data);
	}
	public function criar(){

		if($this->request->getMethod() === 'post'){

			$usuario = new 	\App\Entities\Usuario($this->request->getPost());

			$this->usuarioModel->desabilitaValidacaoTelefone();

			$usuario->iniciaAtivacao();


			  if($this->usuarioModel->insert($usuario)){

					$this->enviaEmailParaAtivarConta($usuario);

				   return redirect()->to(site_url("registrar/ativacaoenviado"));
				}else{
							return redirect()->back()
							->with('errors_model', $this->usuarioModel->errors())
							->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							->withInput();
				}

		}else{
			return $this->redirect()->back();
		}
	}

public function ativacaoEnviado(){

	$data  = [

			'titulo' => 'E-mail de ativação da conta enviada para sua caixa de entrada',
	];

	return view('Registrar/ativacao_enviado', $data);

   }

public function ativar(string	$token = null){

	if($token == null){

			return redirect()->to(site_url("login"));
	}

	$this->usuarioModel->ativaContaPeloToken($token);

	 return redirect()->to(site_url('login'))->with('sucesso','Conta ativada com Sucesso');


}

	 private function enviaEmailParaAtivarConta(object $usuario){
	 	$email = service('email');
	 			$email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
	 			$email->setTo($usuario->email);

	 			$email->setSubject('Ativação de conta');

	 		 $mensagem = view('Registrar/ativacao_email', ['usuario' => $usuario]);


	 		$email->setMessage($mensagem);
	 		 $email->send();
	  }


}
