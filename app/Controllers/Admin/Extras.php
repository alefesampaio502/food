<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Extra;

class Extras extends BaseController{
	private $extraModel;

	public function __construct() {
		$this->extraModel = new \App\Models\ExtraModel();
	}
	public function index()
	{
		$data = [

			'titulo'=> 'Listando os extras de produtos',
			'extras' => $this->extraModel->withDeleted(true)
			->paginate(10),
			'pager' => $this->extraModel->pager,
				];

				return view('Admin/Extras/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}
		$extras = $this->extraModel->procurar($this->request->getGet('term'));
		 $retorno = [];
		 foreach ($extras as $extra) {
			$data['id'] = $extra->id;
			$data['value'] = $extra->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}
 //Métodos show
 public function show($id = null){
		$extra = $this->buscaExtraOu404($id);

		$data = [

			'titulo' => "Detalhando os extras $extra->nome",
			'extra' => $extra,

				];
		 return view('Admin/Extras/show',$data);
		 // dd($extra);

			}

		//Editar
		public function editar($id = null){

			$extra = $this->buscaExtraOu404($id);

			if($extra->deletado_em != null){
				return redirect()->back()->with('info', "O extra<b> $extra->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
			}

			$data = [

				'titulo' => "Detalhando os extra $extra->nome",
				'extra' => $extra,

			];
			 return view('Admin/Extras/editar',$data);
			 // dd($extra);

		}

		public function atualizar($id = null){

			if ($this->request->getMethod() === 'post'){

				$extra = $this->buscaExtraOu404($id);

				if($extra->deletado_em != null){
					return redirect()->back()->with('info', "A extra<b> $extra->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
				}

					$extra->fill($this->request->getPost());
					if(!$extra->hasChanged()){
						return redirect()->back()->with('info','Não tem dados para atualizar');
					}

					if($this->extraModel->save($extra)){
						return redirect()->to(site_url("admin/extras/index/$extra->id"))
						->with('sucesso',"Extra $extra->nome atualizado com sucesso!");
						}else{
						return redirect()->back()
						->with('errors_model', $this->extraModel->errors())
						->with('Atencâo', 'Por favor verifique, os erros a baixo!')
						->withInput();
				 }

			}else{
				// não e ppostar
				return redirect()->back();

			}

	}

	public function criar(){

		$extra = new Extra();

		$data = [

			'titulo' => "Adicionando extra",
			'extra' => $extra,

		];
		 return view('Admin/Extras/criar',$data);
		 // dd($extra);

			}
 //Cria novo cadastro de extra
			public function cadastrar(){

				if ($this->request->getMethod() === 'post'){

					$extra = new Extra($this->request->getPost());


						if($this->extraModel->protect(false)->save($extra)){
							return redirect()->to(site_url("admin/extras/index/" . $this->extraModel->getInsertID()))
							->with('sucesso',"Extras $extra->nome Cadastrado com sucesso!");

							}else{
							return redirect()->back()
							->with('errors_model', $this->extraModel->errors())
							->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							->withInput();
					 }

				}else{
					// não e ppostar
					return redirect()->back();

				}

		}

//excluir novo cadastro de extra
public function excluir($id = null){

	$extra = $this->buscaExtraOu404($id);

	if($extra->deletado_em != null){
		return redirect()->back()->with('info', "A extra<b> $extra->nome</b> já encontra-se excluido.");
	}

	if($extra->is_admin){
		return redirect()->back()->with('info','Não é Possível excluir um extra <b>Administrador</b>');
	}

	if($this->request->getMethod() === 'post'){
		 $this->extraModel->delete($id);
		 return redirect()->to(site_url('admin/extras'))->with('sucesso', "Extra $extra->nome; excluido ccom sucesso!");
	}

	$data = [

		'titulo' => "Excluindo a extra $extra->nome",
		'extra' => $extra,

	];


	 return view('Admin/Extras/excluir',$data);


		}

		public function desfazerExclusao($id = null){

			$extra = $this->buscaExtraOu404($id);
				if($extra->deletado_em == null){
					return redirect()->back()->with('info','Apenas extra excluidos podem ser recuperados!')	;
				}
				 if($this->extraModel->desfazerExclusao($id)){
					 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
				 }else{
					 return redirect()->back()
								 ->with('errors_model', $this->extraModel->errors())
								 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
								 ->withInput();
		 }

	}

	// return objeto Extras //
	public function buscaExtraOu404($id = null) {
		if (!$id || !$extra = $this->extraModel->withDeleted(true)->where('id', $id)->first()) {

			 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos extra $id");				}
		 return $extra;

	 }

}
