<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Entities\Categoria;
class Sistemas extends BaseController{
	private $sistemaModel;
	public function __construct(){
		$this->sistemaModel = new \App\Models\SistemaModel();
	}
	public function index(){
		$data = [
				'titulo' => 'Configuração do sistema',
				'sistemas' => $this->sistemaModel->withDeleted(true)
				->paginate(10),
				'pager' => $this->sistemaModel->pager
			];

			return view('Admin/Sistemas/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}

		$sistemas = $this->sistemaModel->procurar($this->request->getGet('term'));
		 $retorno = [];

		 foreach ($sistemas as $sistema) {

			$data['id'] = $sistema->id;
			$data['value'] = $sistema->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}



		public function editar($id = null){

			$sistema = $this->buscaCategoriaOu404($id);

			if($sistema->deletado_em != null){
				return redirect()->back()->with('info', "A sistema<b> $sistema->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
			}

			$data = [

				'titulo' => "Detalhando os sistema $sistema->nome",
				'sistema' => $sistema,

			];
			 return view('Admin/Sistemas/editar',$data);
			 // dd($sistema);

				}

		
			public function show($id = null){

				$sistema = $this->buscaCategoriaOu404($id);


				$data = [

					'titulo' => "Detalhando os sistema $sistema->nome",
					'sistema' => $sistema,

				];
				 return view('Admin/Sistemas/show',$data);
				 // dd($sistema);

					}

					public function atualizar($id = null){

						if ($this->request->getMethod() === 'post'){

							$sistema = $this->buscaCategoriaOu404($id);

							if($sistema->deletado_em != null){
								return redirect()->back()->with('info', "A sistema<b> $sistema->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
							}

								$sistema->fill($this->request->getPost());
								if(!$sistema->hasChanged()){
									return redirect()->back()->with('info','Não tem dados para atualizar');
								}

								if($this->sistemaModel->save($sistema)){
									return redirect()->to(site_url("admin/sistemas/index/$sistema->id"))
									->with('sucesso',"Categoria $sistema->nome atualizado com sucesso!");
									}else{
									return redirect()->back()
									->with('errors_model', $this->sistemaModel->errors())
									->with('Atencâo', 'Por favor verifique, os erros a baixo!')
									->withInput();
				       }

						}else{
							// não e ppostar
							return redirect()->back();

						}

				}
				public function excluir($id = null){

					$sistema = $this->buscaCategoriaOu404($id);

					if($sistema->deletado_em != null){
						return redirect()->back()->with('info', "A sistema<b> $sistema->nome</b> já encontra-se excluido.");
					}

					if($sistema->is_admin){
						return redirect()->back()->with('info','Não é Possível excluir um sistema <b>Administrador</b>');
					}

					if($this->request->getMethod() === 'post'){
						 $this->sistemaModel->delete($id);
						 return redirect()->to(site_url('admin/sistemas'))->with('sucesso', "Categoria $sistema->nome; eexcluido ccom sucesso!");
					}

					$data = [

						'titulo' => "Excluindo a sistema $sistema->nome",
						'sistema' => $sistema,

					];


					 return view('Admin/Sistemas/excluir',$data);


						}

						public function desfazerExclusao($id = null){

							$sistema = $this->buscaCategoriaOu404($id);
								if($sistema->deletado_em == null){
									return redirect()->back()->with('info','Apenas sistema excluidos podem ser recuperados!')	;
								}
								 if($this->sistemaModel->desfazerExclusao($id)){
									 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
								 }else{
									 return redirect()->back()
												 ->with('errors_model', $this->sistemaModel->errors())
												 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
												 ->withInput();
						 }

					}


			// return objeto Categoria //
			public function buscaSistemaOu404($id = null) {
				if (!$id || !$sistema = $this->sistemaModel->withDeleted(true)->where('id', $id)->first()) {

					 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o sistema $id");				}
				 return $sistema;

			 }

}
