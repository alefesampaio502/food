<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Sistema;
class Sistemas extends BaseController
{

	private $sistemaModel;
	public function __construct(){
		$this->sistemaModel = new \App\Models\SistemaModel();
	}
	public function index()
	{
		$data = [
				'titulo' => 'Listando sistemas',
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

	public function criar(){

		$sistema = new Sistema();


		$data = [

			'titulo' => "Criando um novo sistema",
			'sistema' => $sistema,

		];
		 return view('Admin/Sistemas/criar',$data);
		 // dd($categoria);

			}

	public function show($id = null){

		$sistema = $this->buscaSistemaOu404($id);


		$data = [

			'titulo' => "Sistema | $sistema->nome",
			'sistema' => $sistema,

		];
		//dd($sistema);
		 return view('Admin/Sistemas/show', $data);


			}

			public function editar($id = null){

				$sistema = $this->buscaSistemaOu404($id);


				$data = [

					'titulo' => "Editando sistema | $sistema->nome",
					'sistema' => $sistema,

				];
				//dd($sistema);
				 return view('Admin/Sistemas/editar', $data);


					}
    ///Atualizar
					public function atualizar($id = null){

						if ($this->request->getMethod() === 'post'){

							$sistema = $this->buscaSistemaOu404($id);

							if($sistema->deletado_em != null){
								return redirect()->back()->with('info', "O sistema<b> $sistema->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
							}

								$sistema->fill($this->request->getPost());

								if(!$sistema->hasChanged()){
									return redirect()->back()->with('info','Não tem dados para atualizar');
								}

								if($this->sistemaModel->save($sistema)){
									return redirect()->to(site_url("admin/sistemas/index/$sistema->id"))
									->with('sucesso',"Sistema $sistema->nome atualizado com sucesso!");
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

				//Cria novo cadastro de extra
						 public function cadastrar(){

							 if ($this->request->getMethod() === 'post'){

								 $sistema = new Sistema($this->request->getPost());


									 if($this->sistemaModel->save($sistema)){
										 return redirect()->to(site_url("admin/sistemas/index/" . $this->sistemaModel->getInsertID()))
										 ->with('sucesso',"Sistema $sistema->nome Cadastrado com sucesso!");

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

					 //Imagem do sistema
					 public function  editarimagem($id = null){
							 $sistema = $this->buscaSistemaOu404($id);

							if($sistema->deletado_em != null){
								 return redirect()->back()->with('info', "Não é possível editar a imagem de um sistema excluido!");
							 }

							$data = [

								'titulo' => "Editando a imagem do sistema $sistema->nome",
								'sistema' => $sistema,

									];

									return view('Admin/Sistemas/editar_imagem', $data);

					 }

					 public function upload($id = null){
						 $sistema = $this->buscasistemaOu404($id);

						 $imagem = $this->request->getFile('foto_sistema');

							 if(!$imagem->isValid()){

								 $codigoErro = $imagem->getError();

									 if($codigoErro == UPLOAD_ERR_NO_FILE){

										 return redirect()->back()->with('atencao','Nenhum arquivo foi selecionado');
									 }

							 }

							 $tamanhoImagem = $imagem->getSizeByUnit('mb');

									 if($tamanhoImagem > 2){
										 return redirect()->back()->with('atencao','Arquivo selecionado é muito grande. Máximo permitido é: 2mb');
									 }
									 $tipoImagem = $imagem->getMimeType();

									 $tipoImagemLimpo = explode('/', $tipoImagem);

									 $tiposPermitidos = [
										 'jpeg','png','webp','jpg',

									 ];
									 if(!in_array($tipoImagemLimpo[1], $tiposPermitidos)) {
										 return redirect()->back()->with('atencao','O arquivo selecionado não tem formato permitido. Apenas: '. implode(', ', $tiposPermitidos));
									 }

									 list($lagura, $altura) = getimagesize($imagem->getPathName());

									 if ($lagura < "20" || $altura < "20") {
										 return redirect()->back()->with('atencao','A imagem não pode ser menor do que 400 x 400 pixels.');
										}

									 //------------------------A parti deste ponto fazemos o store da imagem--------------------------------//

										//-----------------------Fazendo o store da imagem e recuperado o store da mesma-----------------------//
										 $imagemCaminho = $imagem->store('sistemas');

										 $imagemCaminho = WRITEPATH.'uploads/'. $imagemCaminho;
									 //	$imagemCaminho = $imagemCaminho(WRITEPATH.'uploads');


										 //--Fazendo o resize da mesma imagem--//

										 service('image')
														 ->withFile($imagemCaminho)
														 ->fit(400, 400, 'center')
														 ->save($imagemCaminho);

										 // Recuperado a imagem antiga para excluir//
											$imagemAntiga = $sistema->imagem;


										 // Atribuindo a nova imagem do sistema//
										 $sistema->imagem = $imagem->getName();


											// Atualizando a imagem do sistema//
										 $this->sistemaModel->save($sistema);


							 // Definindo o caminho da imagem antiga//
							 $caminhoImagem = WRITEPATH . 'uploads/sistemas/' . $imagemAntiga;

									 if(is_file($caminhoImagem)) {

											 unlink($caminhoImagem);
									 }

									 return redirect()->to(site_url("admin/sistemas/show/$sistema->id"))
									 ->with('sucesso','Imagem alterada com sucess');

								 }

				 //Métodos para iamgens //
				 public function imagem(string $imagem = null){

					 if ($imagem) {

						 $caminhoImagem = WRITEPATH . 'uploads/sistemas/' .$imagem;


						 $infoImagem = new \finfo(FILEINFO_MIME);

						 $tipoImagem = $infoImagem->file($caminhoImagem);
						 header("Content-Type: $tipoImagem");

						 header("Content-Length: " . filesize($caminhoImagem));

						 readfile($caminhoImagem);

						 exit;
					 }

			 }


			 //excluir novo cadastro de sistema
			 public function excluir($id = null){

				 $sistema = $this->buscasistemaOu404($id);

					 if($this->request->getMethod() === 'post'){

						 $this->sistemaModel->delete($id);
							 if($sistema->imagem){

								 $caminhoImagem = WRITEPATH . 'uploads/sistemas/' . $sistema->imagem;

									 if(is_file($caminhoImagem)){

										 unlink($caminhoImagem);

							 }

					 }
					 $sistema->imagem = null;
					 	/* para não gerar pproblemas casso não ter imimagem */
						 if($sistema->hasChanged()){
						 $this->sistemaModel->save($sistema);
					 }

						return redirect()->to(site_url('admin/sistemas'))->with('sucesso', "sistema excluido ccom sucesso!");
			 }
			 $data = [

				 'titulo' => "Excluindo a sistema $sistema->nome",
				 'sistema' => $sistema,

			 ];

				 return view('Admin/Sistemas/excluir',$data);
		 }


		 public function desfazerExclusao($id = null){

				$sistema = $this->buscasistemaOu404($id);
					if($sistema->deletado_em == null){
						return redirect()->back()->with('info','Apenas sistema excluidos podem ser recuperados!')	;
					}
					 if($this->sistemaModel->desfazerExclusao($id)){
						 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
					 }else{
						 return redirect()->back()
									 ->with('errors_model', $this->sistemaModel->errors())
									 ->with('atencao', 'Por favor verifique, os erros a baixo!')
									 ->withInput();
			 }

		}


	     // return objeto Sistema //
			 public function buscaSistemaOu404($id = null) {
				 if (!$id || !$sistema = $this->sistemaModel->withDeleted(true)->where('id', $id)->first()) {

						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o ESistemas $id");				}
					return $sistema;

				}
}
