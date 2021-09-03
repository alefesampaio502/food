<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Usuario;
class Usuarios extends BaseController	{
		private $usuarioModel;
		public function __construct(){
			$this->usuarioModel = new \App\Models\UsuarioModel();
		}

			public function index()
			{
				$usuario = service('autenticacao');

				$data = [

					'titulo' => 'Lista de usuários',
					//'usuarios' => $this->usuarioModel->withDeleted(true)->findAll(),
					'usuarios' => $this->usuarioModel->withDeleted(true)->paginate(12),
					'pager' => $this->usuarioModel->pager,
				];
				return view ('Admin/Usuarios/index',$data);
		;
			}

			public function procurar(){
				if (!$this->request->isAJAX()){

					exit('Página não encontrada');

				}

				$usuarios = $this->usuarioModel->procurar($this->request->getGet('term'));
				 $retorno = [];

				 foreach ($usuarios as $usuario) {

				 	$data['id'] = $usuario->id;
				 	$data['value'] = $usuario->nome;
					$retorno[] = $data;
				 }
				return  $this->response->setJSON($retorno);
			}

	public function editar($id = null){

		$usuario = $this->buscaUsuarioOu404($id);

		if($usuario->deletado_em != null){
			return redirect()->back()->with('info', "O usuário<b> $usuario->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
		}

		$data = [

			'titulo' => "Detalhando os usuário $usuario->nome",
			'usuario' => $usuario,

		];
		 return view('Admin/Usuarios/editar',$data);
		 // dd($usuario);

			}

			public function criar(){

				$usuario = new Usuario();


				$data = [

					'titulo' => "Criando novo usuário",
					'usuario' => $usuario,

				];
				 return view('Admin/Usuarios/criar',$data);
				 // dd($usuario);

					}

					public function cadastrar(){

						if ($this->request->getMethod() === 'post'){

							$usuario = new Usuario($this->request->getPost());


								if($this->usuarioModel->protect(false)->save($usuario)){
									return redirect()->to(site_url("admin/usuarios/index/" . $this->usuarioModel->getInsertID()))
									->with('sucesso',"Usuarios $usuario->nome Cadastrado com sucesso!");

									}else{
									return redirect()->back()
									->with('errors_model', $this->usuarioModel->errors())
									->with('Atencâo', 'Por favor verifique, os erros a baixo!')
									->withInput();
				       }

						}else{
							// não e ppostar
							return redirect()->back();

						}

				}

			public function show($id = null){

				$usuario = $this->buscaUsuarioOu404($id);


				$data = [

					'titulo' => "Detalhando os usuário $usuario->nome",
					'usuario' => $usuario,

				];
				 return view('Admin/Usuarios/show',$data);
				 // dd($usuario);

					}

	public function atualizar($id = null){

		if ($this->request->getMethod() === 'post'){

			$usuario = $this->buscaUsuarioOu404($id);

			if($usuario->deletado_em != null){
				return redirect()->back()->with('info', "O usuário<b> $usuario->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
			}
				$post = $this->request->getPost();

				if(empty($post['password'])){
					$this->usuarioModel->desabilitaValidacaoSenha();
					unset($post['password']);
					unset($post['password_confirmation']);

				}

				$usuario->fill($post);

				if(!$usuario->hasChanged()){
					return redirect()->back()->with('info','Não tem dados para atualizar');
				}

				if($this->usuarioModel->protect(false)->save($usuario)){
					return redirect()->to(site_url("admin/usuarios/index/$usuario->id"))
					->with('sucesso',"Usuarios $usuario->nome atualizado com sucesso!");

					}else{
					return redirect()->back()
					->with('errors_model', $this->usuarioModel->errors())
					->with('Atencâo', 'Por favor verifique, os erros a baixo!')
					->withInput();
       }

		}else{
			// não e ppostar
			return redirect()->back();

		}

}

public function excluir($id = null){

	$usuario = $this->buscaUsuarioOu404($id);

	if($usuario->deletado_em != null){
		return redirect()->back()->with('info', "O usuário<b> $usuario->nome</b> já encontra-se excluido.");
	}

	if($usuario->is_admin){
		return redirect()->back()->with('info','Não é Possível excluir um usuário <b>Administrador</b>');
	}

	if($this->request->getMethod() === 'post'){
		 $this->usuarioModel->delete($id);
		 return redirect()->to(site_url('admin/usuarios'))->with('sucesso', "Usuário $usuario->nome; eexcluido ccom sucesso!");
	}


	$data = [

		'titulo' => "Excluindo o usuário $usuario->nome",
		'usuario' => $usuario,

	];
	 return view('Admin/Usuarios/excluir',$data);
	 // dd($usuario);

		}

		public function desfazerExclusao($id = null){

			$usuario = $this->buscaUsuarioOu404($id);
				if($usuario->deletado_em == null){
         	return redirect()->back()->with('info','Apenas usuário excluidos podem ser recuperados!')	;
				}
         if($this->usuarioModel->desfazerExclusao($id)){
					 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
				 }else{
					 return redirect()->back()
								 ->with('errors_model', $this->usuarioModel->errors())
								 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
								 ->withInput();
				 }

				}

     // return objeto Usuarios //
		 public function buscaUsuarioOu404($id = null) {
			 if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->where('id', $id)->first()) {

					throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");				}
				return $usuario;

			}
		}
