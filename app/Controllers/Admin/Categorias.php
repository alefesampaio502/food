<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Categoria;
class Categorias extends BaseController{
	private $categoriaModel;
	public function __construct(){
		$this->categoriaModel = new \App\Models\CategoriaModel();
	}
	public function index(){
		$data = [
				'titulo' => 'Listandos as categorias',
				'categorias' => $this->categoriaModel->withDeleted(true)
				->paginate(10),
				'pager' => $this->categoriaModel->pager
			];

			return view('Admin/Categorias/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}

		$categorias = $this->categoriaModel->procurar($this->request->getGet('term'));
		 $retorno = [];

		 foreach ($categorias as $categoria) {

			$data['id'] = $categoria->id;
			$data['value'] = $categoria->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}



		public function editar($id = null){

			$categoria = $this->buscaCategoriaOu404($id);

			if($categoria->deletado_em != null){
				return redirect()->back()->with('info', "A categoria<b> $categoria->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
			}

			$data = [

				'titulo' => "Detalhando os categoria $categoria->nome",
				'categoria' => $categoria,

			];
			 return view('Admin/Categorias/editar',$data);
			 // dd($categoria);

				}

				public function criar(){

					$categoria = new Categoria();


					$data = [

						'titulo' => "Criando nova categoria",
						'categoria' => $categoria,

					];
					 return view('Admin/Categorias/criar',$data);
					 // dd($categoria);

						}

						public function cadastrar(){

							if ($this->request->getMethod() === 'post'){

								$categoria = new Categoria($this->request->getPost());


									if($this->categoriaModel->protect(false)->save($categoria)){
										return redirect()->to(site_url("admin/Categorias/index/" . $this->categoriaModel->getInsertID()))
										->with('sucesso',"Categorias $categoria->nome Cadastrado com sucesso!");

										}else{
										return redirect()->back()
										->with('errors_model', $this->categoriaModel->errors())
										->with('Atencâo', 'Por favor verifique, os erros a baixo!')
										->withInput();
					       }

							}else{
								// não e ppostar
								return redirect()->back();

							}

					}

			public function show($id = null){

				$categoria = $this->buscaCategoriaOu404($id);


				$data = [

					'titulo' => "Detalhando os categoria $categoria->nome",
					'categoria' => $categoria,

				];
				 return view('Admin/Categorias/show',$data);
				 // dd($categoria);

					}

					public function atualizar($id = null){

						if ($this->request->getMethod() === 'post'){

							$categoria = $this->buscaCategoriaOu404($id);

							if($categoria->deletado_em != null){
								return redirect()->back()->with('info', "A categoria<b> $categoria->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
							}

								$categoria->fill($this->request->getPost());
								if(!$categoria->hasChanged()){
									return redirect()->back()->with('info','Não tem dados para atualizar');
								}

								if($this->categoriaModel->save($categoria)){
									return redirect()->to(site_url("admin/categorias/index/$categoria->id"))
									->with('sucesso',"Categoria $categoria->nome atualizado com sucesso!");
									}else{
									return redirect()->back()
									->with('errors_model', $this->categoriaModel->errors())
									->with('Atencâo', 'Por favor verifique, os erros a baixo!')
									->withInput();
				       }

						}else{
							// não e ppostar
							return redirect()->back();

						}

				}
				public function excluir($id = null){

					$categoria = $this->buscaCategoriaOu404($id);

					if($categoria->deletado_em != null){
						return redirect()->back()->with('info', "A categoria<b> $categoria->nome</b> já encontra-se excluido.");
					}

					if($categoria->is_admin){
						return redirect()->back()->with('info','Não é Possível excluir um categoria <b>Administrador</b>');
					}

					if($this->request->getMethod() === 'post'){
						 $this->categoriaModel->delete($id);
						 return redirect()->to(site_url('admin/categorias'))->with('sucesso', "Categoria $categoria->nome; eexcluido ccom sucesso!");
					}

					$data = [

						'titulo' => "Excluindo a categoria $categoria->nome",
						'categoria' => $categoria,

					];


					 return view('Admin/Categorias/excluir',$data);


						}

						public function desfazerExclusao($id = null){

							$categoria = $this->buscaCategoriaOu404($id);
								if($categoria->deletado_em == null){
									return redirect()->back()->with('info','Apenas categoria excluidos podem ser recuperados!')	;
								}
								 if($this->categoriaModel->desfazerExclusao($id)){
									 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
								 }else{
									 return redirect()->back()
												 ->with('errors_model', $this->categoriaModel->errors())
												 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
												 ->withInput();
						 }

					}

		
			// return objeto Categoria //
			public function buscaCategoriaOu404($id = null) {
				if (!$id || !$categoria = $this->categoriaModel->withDeleted(true)->where('id', $id)->first()) {

					 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o categoria $id");				}
				 return $categoria;

			 }

}
