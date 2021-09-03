<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController {
	public function novo(){
		$data = [
							'titulo' => 'Entrar com login',
						];
		return view('Login/novo', $data);
	}
	public function criar(){
		if($this->request->getMethod() === 'post'){
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			  $autenticacao = service('autenticacao');
         if($autenticacao->login($email, $password)){
					 $usuario = $autenticacao->pegaUsuarioLogado();
					   return redirect()->to(site_url('admin/home'))->with('sucesso',"Olá $usuario->nome, que bom está de volta");
				}else{
					  return redirect()
						->back()
						->with('atencao','Não encontramos suas credenciais de acesso');
				 		}

			 	}else{
       return redirect()->back();

		}
	}
	/*************************************************************************************************************************
	 Para que possamos exibir a mensagem de 'Sua são sessão expirou ou que você achar melmelhor ,
	 Após o Logout, devemos fazer uma rrequisição para uma url, nesse casso a 'mostraMensagemLogout'.'
	 ou seja , as mensagem nunca serão exibida.
	 Portanto, para conseguimos exibí-la, basta criamos o método 'mostraMensagemLogout'. que fará o redredirect para homhome.'
	 Com mensagem desejada. E como se trata de um redirect para a mensagem só será exibida uma vez.
	***************************************************************************************************************************/


	public function logout(){
			service('autenticacao')->logout();
			return redirect()->to(site_url('login/mostraMensagemLogout'));
		}
	public function mostraMensagemLogout(){
		return redirect()->to(site_url('login'))->with('info','Esperamos ver você novamente');
	}
}
