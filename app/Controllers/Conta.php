<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Conta extends BaseController
{

	private $usuario;
	private $usuarioModel;
	private $pedidoModel;
	private $produtoModel;
	private $sistemaModel;

	public function __construct() {
		$this->usuario = service('autenticacao')->pegaUsuarioLogado();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->produtoModel = new \App\Models\ProdutoModel();
		$this->sistemaModel = new \App\Models\SistemaModel();
	}
	public function index(){

		$data = [

			'titulo' => 'Meus pedidos',
			'produtos' => $this->produtoModel->buscaProdutosWebHome(),
			'sistemas' => $this->sistemaModel->where('ativo', true)->findAll(),
		];

		$pedidos = $this->pedidoModel->orderBy('criado_em', 'DESC')->where('usuario_id', $this->usuario->id)->findAll();

		 if($pedidos != null){
			 $data['pedidos'] = $pedidos;
		 }


		return view('Conta/index', $data);

	}

public function show(){

		$data = [

			'titulo' => 'Meus dados',
				'usuario' => $this->usuario,
		];

		return view('Conta/show', $data);

	}
public function editar(){
   if(!session()->has('pode_editar_ate')){
		 return redirect()->to(site_url('conta/autenticar'));
	 }

	 if(session()->get('pode_editar_ate') < time()){
		return redirect()->to(site_url('conta/autenticar'));
	}

		$data = [

			'titulo' => 'Editar meus dados',
				'usuario' => $this->usuario,
				'produtos' => $this->produtoModel->buscaProdutosWebHome(),
		];

		return view('Conta/editar', $data);

	}

public function autenticar(){

		$data = [
			  'titulo' => 'Autenticar',
				'usuario' => $this->usuario,
		];

		return view('Conta/autenticar', $data);

	}

public function processaAutenticacao(){

    if($this->request->getMethod() === 'post'){

			if($this->usuario->verificaPassword($this->request->getPost('password'))){

				session()->set('pode_editar_ate', time() + 300); // 300 = 5 minulto
				return redirect()->to(site_url('conta/editar'));

				}else{

					return redirect()->back()->with('atencao','Senha inválidade');
				  }

				}else{
					return redirect()->back();
		}

	}

public function atualizar(){
   if($this->request->getMethod() === 'post'){
    $this->usuario->fill($this->request->getPost());

		if(!$this->usuario->hasChanged()){
			return redirect()->back()->with('info','Não ha dados para atualizar');
		}
			if($this->usuarioModel->save($this->usuario)){
				 return redirect()->to(site_url("conta/show"))
				 ->with('sucesso',"Seus dados foram atualizado com sucesso!");

				 }else{
				 return redirect()->back()
				 ->with('errors_model', $this->usuarioModel->errors())
				 ->with('atencao', 'Por favor verifique, os erros a baixo!')
				 ->withInput();
		}
	 	}else{
		 return redirect()->back();
	 }

	}
	public function editarSenha(){

			$data = [
				  'titulo' => 'Alterar Senha de acesso',
					'usuario' => $this->usuario,
					'produtos' => $this->produtoModel->buscaProdutosWebHome(),
			];

			return view('Conta/editar_senha', $data);

		}

		public function atualizarSenha(){

		   if($this->request->getMethod() === 'post'){

		if(!$this->usuario->verificaPassword($this->request->getPost('current_password'))){
					 	return redirect()->back()->with('atencao','Senha atual inválida');
				 }

				 $this->usuario->fill($this->request->getPost());

				 if($this->usuarioModel->save($this->usuario)){
						return redirect()->to(site_url("conta/show"))
						->with('sucesso',"Senha atualizada com sucesso!");

						}else{
						return redirect()->back()
						->with('errors_model', $this->usuarioModel->errors())
						->with('atencao', 'Por favor verifique, os erros a baixo!')
						->withInput();
			 }

			 }else{
				 return redirect()->back();

			 }


		}
}
