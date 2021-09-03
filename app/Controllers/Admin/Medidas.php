<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Medida;
class Medidas extends BaseController
{

	private $medidaModel;

	public function __construct(){
		$this->medidaModel =new \App\Models\MedidaModel();
	}
	public function index(){
		$data = [

			'titulo'=> 'Listando as medidas de produtos ',
			'medidas' => $this->medidaModel->withDeleted(true)
			->paginate(10),
			'pager' => $this->medidaModel->pager,
				];

				return view('Admin/Medidas/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}
		$medidas = $this->medidaModel->procurar($this->request->getGet('term'));
		 $retorno = [];
		 foreach ($medidas as $medida) {
			$data['id'] = $medida->id;
			$data['value'] = $medida->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}

	//Métodos show
	public function show($id = null){
		 $medida = $this->buscaMedidaOu404($id);

		 $data = [

			 'titulo' => "Detalhando os medida $medida->nome",
			 'medida' => $medida,

				 ];
			return view('Admin/Medidas/show',$data);
			// dd($medida);

			 }

       //edição do arquivos
			 public function editar($id = null){

				 $medida = $this->buscaMedidaOu404($id);

				 if($medida->deletado_em != null){
					 return redirect()->back()->with('info', "Medida <b> $medida->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
				 }

				 $data = [
					 'titulo' => "Detalhando os medida $medida->nome",
					 'medida' => $medida,

				 ];
					return view('Admin/Medidas/editar',$data);
					// dd($medida);

			 }

			 public function atualizar($id = null){

				 if ($this->request->getMethod() === 'post'){

					 $medida = $this->buscaMedidaOu404($id);

					 if($medida->deletado_em != null){
						 return redirect()->back()->with('info', "A medida<b> $medida->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
					 }

						 $medida->fill($this->request->getPost());
						 if(!$medida->hasChanged()){
							 return redirect()->back()->with('info','Não tem dados para atualizar');
						 }

						 if($this->medidaModel->save($medida)){
							 return redirect()->to(site_url("admin/medidas/index/$medida->id"))
							 ->with('sucesso',"Medida $medida->nome atualizado com sucesso!");
							 }else{
							 return redirect()->back()
							 ->with('errors_model', $this->medidaModel->errors())
							 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							 ->withInput();
						}

				 }else{
					 // não e ppostar
					 return redirect()->back();

				 }

		 }

		 public function criar(){

 	 		$medida = new Medida();

 	 		$data = [

 	 			'titulo' => "Adicionando medida",
 	 			'medida' => $medida,

 	 		];
 	 		 return view('Admin/Medidas/criar',$data);
 	 		 // dd($medida);

 	 			}

				//Cria novo cadastro de medida
			 			public function cadastrar(){

			 				if ($this->request->getMethod() === 'post'){

			 					$medida = new Medida($this->request->getPost());


			 						if($this->medidaModel->protect(false)->save($medida)){
			 							return redirect()->to(site_url("admin/medidas/index/" . $this->medidaModel->getInsertID()))
			 							->with('sucesso',"Medidas $medida->nome Cadastrado com sucesso!");

			 							}else{
			 							return redirect()->back()
			 							->with('errors_model', $this->medidaModel->errors())
			 							->with('Atencâo', 'Por favor verifique, os erros a baixo!')
			 							->withInput();
			 					 }

			 				}else{
			 					// não e ppostar
			 					return redirect()->back();

			 				}

			 		}

					//excluir novo cadastro de medida
		 		 public function excluir($id = null){

		 		 	$medida = $this->buscaMedidaOu404($id);

		 		 	if($medida->deletado_em != null){
		 		 		return redirect()->back()->with('info', "A medida<b> $medida->nome</b> já encontra-se excluido.");
		 		 	}

		 		 	if($medida->is_admin){
		 		 		return redirect()->back()->with('info','Não é Possível excluir um medida <b>Administrador</b>');
		 		 	}

		 		 	if($this->request->getMethod() === 'post'){
		 		 		 $this->medidaModel->delete($id);
		 		 		 return redirect()->to(site_url('admin/medidas'))->with('sucesso', "Extra $medida->nome excluido ccom sucesso!");
		 		 	}

		 		 	$data = [

		 		 		'titulo' => "Excluindo a medida $medida->nome",
		 		 		'medida' => $medida,

		 		 	];


		 		 	 return view('Admin/Medidas/excluir',$data);


		 		 		}
						public function desfazerExclusao($id = null){

							$medida = $this->buscaMedidaOu404($id);
								if($medida->deletado_em == null){
									return redirect()->back()->with('info','Apenas medida excluidos podem ser recuperados!')	;
								}
								 if($this->medidaModel->desfazerExclusao($id)){
									 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
								 }else{
									 return redirect()->back()
												 ->with('errors_model', $this->medidaModel->errors())
												 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
												 ->withInput();
						 }

					}



			 // return objeto Medidas //
			 public function buscaMedidaOu404($id = null) {
				 if (!$id || !$medida = $this->medidaModel->withDeleted(true)->where('id', $id)->first()) {

						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos medida $id");				}
					return $medida;

				}
}
