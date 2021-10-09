<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Password extends BaseController{

	private $usuarioModel;
	private $sistemaModel;
	public function __construct(){

			$this->usuarioModel = new \App\Models\UsuarioModel();
			$this->sistemaModel = new \App\Models\SistemaModel();
}
public function esqueci(){

	 $data = [
		 'titulo' => 'Esqueci a minha senhe',
		 	'sistemas' => $this->sistemaModel->where('ativo', true)->findAll(),
	 ];
	 	return view('Password/esqueci', $data);
	}
	public function processaEsqueci(){
		if($this->request->getMethod() === 'post'){
			$usuario = $this->usuarioModel->buscaUsuarioPorEmail($this->request->getPost('email'));

			if($usuario === null || !$usuario->ativo){
				return redirect()->to(site_url('password/esqueci'))
												->with('atencao', 'Não encontramos uma conta válida com esse Email')
												->withInput();
			}

			$usuario->iniciaPasswordReset();

		   $this->usuarioModel->save($usuario);

     //dd($usuario);
     $this->enviaEmailRedefinicaoSenha($usuario);



		 return redirect()->to(site_url('login'))->with('sucesso', 'E-mail de redefinição de senha enviado para sua caixa de enentradas');


 	 }else {
		return redirect()->back();
	   }
  }
public function reset($token = null){
   if($token === null){

		 return redirect()->to(site_url('password/esqueci'))
		 ->with('atencao', 'Link invalido ou expirado');
   }



	 $usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);

	   if ($usuario != null) {

	   	$data = [

				'titulo' => 'Redefina a sua senha',
				'token' => $token,
			];
			return view('Password/reset', $data);
		}else {
			return redirect()->to(site_url('password/esqueci'))
 		 ->with('atencao', 'Link invalido ou expirado');
		}
}

public function processaReset($token = null){

	  if($token === null){

		return redirect()->to(site_url('password/esqueci'))
		->with('atencao', 'Link invalido ou expirado');
	}

	$usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);
		if ($usuario != null) {
		   $usuario->fill($this->request->getPost());
			  // Mando usuario com nova senha para o banco de dados
			 	if ($this->usuarioModel->save($usuario)) {

					  //setamos as colunas reset_hash e reset_expira_em
						// com null ao invocar o método abaixo.
						// Envalidamos o link antigo que foi definido para e-mail do usuário.
					  $usuario->completaPasswordReset();
						$this->usuarioModel->save($usuario);

						//Atualizamos as colunas novamente comm os valores acima.
					return redirect()->to(site_url('login'))
				 ->with('sucesso', 'Nova senha cadastrada com sucesso!');
			 	}
      else{
				return redirect()->to(site_url("password/reset/$token"))
				->with('errors_model', $this->usuarioModel->errors())
				->with('Atencâo', 'Por favor verifique, os erros a baixo!')
				->withInput();
			}
	 }else {
		 return redirect()->to(site_url('password/esqueci'))
		->with('atencao', 'Link invalido ou expirado');
	 }
}

 private function enviaEmailRedefinicaoSenha(object $usuario){
	 $email = service('email');
			 $email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
			 $email->setTo($usuario->email);

			 $email->setSubject('Redefinição de senha');

      $mensagem = view('Password/reset_email', ['token' => $usuario->reset_token]);


		 $email->setMessage($mensagem);
      $email->send();
  }
}
