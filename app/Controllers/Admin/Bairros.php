<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Bairro;
class Bairros extends BaseController
{
	private $bairroModel;
	public function __construct(){
		$this->bairroModel = new \App\Models\BairroModel();
	}
	public function index(){
		$data = [
				'titulo' => 'Listandos Bairros atendido',
				'bairros' => $this->bairroModel->withDeleted(true)
													->orderBy('nome','ASC')
													->paginate(10),
				'pager' => $this->bairroModel->pager
			];

			return view('Admin/Bairros/index', $data);
	}
	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}

		$bairros = $this->bairroModel->procurar($this->request->getGet('term'));
		 $retorno = [];

		 foreach ($bairros as $bairro) {

			$data['id'] = $bairro->id;
			$data['value'] = $bairro->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}

//Metod criar
	public function criar(){

		$bairro = new Bairro();

		$data = [

			'titulo' => "Adicionando novo Bairro",
			'bairro' => $bairro,

		];
		 return view('Admin/Bairros/criar',$data);
		 // dd($bairro);

			}

			public function cadastrar(){

				if ($this->request->getMethod() === 'post'){


						$bairro = new Bairro($this->request->getPost());

						$bairro->valor_entrega = str_replace(",","", $bairro->valor_entrega);

						if($this->bairroModel->save($bairro)){
							return redirect()->to(site_url("admin/bairros/index/".$this->bairroModel->getInsertID))
							->with('sucesso',"bairro $bairro->nome cadastrado com sucesso!");
							}else{
							return redirect()->back()
							->with('errors_model', $this->bairroModel->errors())
							->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							->withInput();
					 }

				}else{
					// não e ppostar
					return redirect()->back();

				}

		}



	public function show($id = null){

		$bairro = $this->buscaBairroOu404($id);


		$data = [

			'titulo' => "Detalhando o bairro $bairro->nome",
			'bairro' => $bairro,

		];
		 return view('Admin/Bairros/show',$data);
		 // dd($bairro);

			}

			//Editar
			public function editar($id = null){

				$bairro = $this->buscaBairroOu404($id);

				if($bairro->deletado_em != null){
					return redirect()->back()->with('info', "O bairro<b> $bairro->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
				}

				$data = [

					'titulo' => "Detalhando o bairro $bairro->nome",
					'bairro' => $bairro,

				];

				 // dd($bairro);
				 return view('Admin/Bairros/editar',$data);
			}

			public function atualizar($id = null){

				if ($this->request->getMethod() === 'post'){

					$bairro = $this->buscaBairroOu404($id);

					if($bairro->deletado_em != null){
						return redirect()->back()->with('info', "O bairro<b> $bairro->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
					}

						$bairro->fill($this->request->getPost());

						$bairro->valor_entrega = str_replace(",","", $bairro->valor_entrega);


						if(!$bairro->hasChanged()){
							return redirect()->back()->with('info','Não tem dados para atualizar');
						}

						if($this->bairroModel->save($bairro)){
							return redirect()->to(site_url("admin/bairros/index/$bairro->id"))
							->with('sucesso',"bairro $bairro->nome atualizado com sucesso!");
							}else{
							return redirect()->back()
							->with('errors_model', $this->bairroModel->errors())
							->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							->withInput();
					 }

				}else{
					// não e ppostar
					return redirect()->back();

				}

		}

		public function excluir($id = null) {
			 $bairro = $this->buscaBairroOu404($id);

			 if ($bairro->deletado_em != null) {
					 return redirect()->back()->with('info', "O bairro $bairro->nome Já encontra-se excluído");
			 }



			 if ($this->request->getMethod() === 'post') {
					 $this->bairroModel->delete($id);

					 return redirect()->to(site_url('admin/bairros'))->with('sucesso', "Bairro $bairro->nome excluído com sucesso!");
			 }

			 $data = [
					 'titulo' => "Excluindo o bairro $bairro->nome",
					 'bairro' => $bairro,
			 ];
			 return view('Admin/Bairros/excluir', $data);
	 }

	 public function desfazerExclusao($id = null) {
			 $bairro = $this->buscaBairroOu404($id);

			 if ($bairro->deletado_em == null) {
					 return redirect()->back()->with('info', 'Apenas bairros excluídos podem ser recuperadas');
			 }

			 if ($this->bairroModel->desfazerExclusao($id)) {
					 return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
			 } else {
					 return redirect()->back()->with('errors_model', $this->bairroModel->errors())
													 ->with('atencao', 'Por favor verifiqie os erros abaixo')->withInput();
			 }
	 }


		public function consultaCep(){

			if(!$this->request->isAJAX()){
				return redirect()->to(site_url());

			}

			$validacao = service('validation');

			$validacao->setRule('cep','CEP','required|exact_length[9]');


        $retorno = [];

			  if (!$validacao->withRequest($this->request)->run()){

					$retorno['erro'] = '<span class="text-danger small">' . $validacao->getError() . '</span>';

					return $this->response->setJSON($retorno);

				}

        //CEP FORMATADO ///
				$cep = str_replace('-', '', $this->request->getGet('cep'));

			 helper('consulta_cep');

			 $consulta = consultaCep($cep);

			 if(isset($consulta->erro) && !isset($consulta->cep)){

            $retorno['erro'] = '<span class="text-danger small">CEP inválido</span>';
            return $this->response->setJSON($retorno);

        		}
						$retorno['endereco'] = $consulta;

		 				return $this->response->setJSON($retorno);


			echo '<pre>';
			print_r($consulta);
       die;
		}

			// return objeto Bairro //
			public function buscaBairroOu404($id = null) {
				if (!$id || !$bairro = $this->bairroModel->withDeleted(true)->where('id', $id)->first()) {

					 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o bairro $id");				}
				 return $bairro;

			 }

}
