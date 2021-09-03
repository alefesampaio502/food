<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Entregador;
class Entregadores extends BaseController
{

	private $entregadorModel;
	public function __construct(){
		$this->entregadorModel = new \App\Models\EntregadorModel();
	}
	public function index()
	{
		$data = [
				'titulo' => 'Listando entregadores',
				'entregadores' => $this->entregadorModel->withDeleted(true)
				->paginate(10),
				'pager' => $this->entregadorModel->pager
			];

			return view('Admin/Entregadores/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}

		$entregadores = $this->entregadorModel->procurar($this->request->getGet('term'));
		 $retorno = [];

		 foreach ($entregadores as $entregador) {

			$data['id'] = $entregador->id;
			$data['value'] = $entregador->nome;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}

	public function criar(){

		$entregador = new Entregador();


		$data = [

			'titulo' => "Criando um novo entregador",
			'entregador' => $entregador,

		];
		 return view('Admin/Entregadores/criar',$data);
		 // dd($categoria);

			}

	public function show($id = null){

		$entregador = $this->buscaEntregadorOu404($id);


		$data = [

			'titulo' => "Entregador | $entregador->nome",
			'entregador' => $entregador,

		];
		//dd($entregador);
		 return view('Admin/Entregadores/show', $data);


			}

			public function editar($id = null){

				$entregador = $this->buscaEntregadorOu404($id);


				$data = [

					'titulo' => "Editando entregador | $entregador->nome",
					'entregador' => $entregador,

				];
				//dd($entregador);
				 return view('Admin/Entregadores/editar', $data);


					}
    ///Atualizar
					public function atualizar($id = null){

						if ($this->request->getMethod() === 'post'){

							$entregador = $this->buscaEntregadorOu404($id);

							if($entregador->deletado_em != null){
								return redirect()->back()->with('info', "O entregador<b> $entregador->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
							}

								$entregador->fill($this->request->getPost());

								if(!$entregador->hasChanged()){
									return redirect()->back()->with('info','Não tem dados para atualizar');
								}

								if($this->entregadorModel->save($entregador)){
									return redirect()->to(site_url("admin/entregadores/index/$entregador->id"))
									->with('sucesso',"Entregador $entregador->nome atualizado com sucesso!");
									}else{
									return redirect()->back()
									->with('errors_model', $this->entregadorModel->errors())
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

								 $entregador = new Entregador($this->request->getPost());


									 if($this->entregadorModel->save($entregador)){
										 return redirect()->to(site_url("admin/entregadores/index/" . $this->entregadorModel->getInsertID()))
										 ->with('sucesso',"Entregador $entregador->nome Cadastrado com sucesso!");

										 }else{
										 return redirect()->back()
										 ->with('errors_model', $this->entregadorModel->errors())
										 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
										 ->withInput();
									}

							 }else{
								 // não e ppostar
								 return redirect()->back();

							 }

					 }

					 //Imagem do entregador
					 public function  editarimagem($id = null){
							 $entregador = $this->buscaEntregadorOu404($id);

							if($entregador->deletado_em != null){
								 return redirect()->back()->with('info', "Não é possível editar a imagem de um entregador excluido!");
							 }

							$data = [

								'titulo' => "Editando a imagem do entregador $entregador->nome",
								'entregador' => $entregador,

									];

									return view('Admin/Entregadores/editar_imagem', $data);

					 }

					 public function upload($id = null){
						 $entregador = $this->buscaentregadorOu404($id);

						 $imagem = $this->request->getFile('foto_entregador');

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

									 if ($lagura < "400" || $altura < "400") {
										 return redirect()->back()->with('atencao','A imagem não pode ser menor do que 400 x 400 pixels.');
										}

									 //------------------------A parti deste ponto fazemos o store da imagem--------------------------------//

										//-----------------------Fazendo o store da imagem e recuperado o store da mesma-----------------------//
										 $imagemCaminho = $imagem->store('entregadores');

										 $imagemCaminho = WRITEPATH.'uploads/'. $imagemCaminho;
									 //	$imagemCaminho = $imagemCaminho(WRITEPATH.'uploads');


										 //--Fazendo o resize da mesma imagem--//

										 service('image')
														 ->withFile($imagemCaminho)
														 ->fit(400, 400, 'center')
														 ->save($imagemCaminho);

										 // Recuperado a imagem antiga para excluir//
											$imagemAntiga = $entregador->imagem;


										 // Atribuindo a nova imagem do entregador//
										 $entregador->imagem = $imagem->getName();


											// Atualizando a imagem do entregador//
										 $this->entregadorModel->save($entregador);


							 // Definindo o caminho da imagem antiga//
							 $caminhoImagem = WRITEPATH . 'uploads/entregadores/' . $imagemAntiga;

									 if(is_file($caminhoImagem)) {

											 unlink($caminhoImagem);
									 }

									 return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))
									 ->with('sucesso','Imagem alterada com sucess');

								 }

				 //Métodos para iamgens //
				 public function imagem(string $imagem = null){

					 if ($imagem) {

						 $caminhoImagem = WRITEPATH . 'uploads/entregadores/' .$imagem;


						 $infoImagem = new \finfo(FILEINFO_MIME);

						 $tipoImagem = $infoImagem->file($caminhoImagem);
						 header("Content-Type: $tipoImagem");

						 header("Content-Length: " . filesize($caminhoImagem));

						 readfile($caminhoImagem);

						 exit;
					 }

			 }


			 //excluir novo cadastro de entregador
			 public function excluir($id = null){

				 $entregador = $this->buscaentregadorOu404($id);

					 if($this->request->getMethod() === 'post'){

						 $this->entregadorModel->delete($id);
							 if($entregador->imagem){

								 $caminhoImagem = WRITEPATH . 'uploads/entregadores/' . $entregador->imagem;

									 if(is_file($caminhoImagem)){

										 unlink($caminhoImagem);

							 }

					 }
					 $entregador->imagem = null;
					 	/* para não gerar pproblemas casso não ter imimagem */
						 if($entregador->hasChanged()){
						 $this->entregadorModel->save($entregador);
					 }

						return redirect()->to(site_url('admin/entregadores'))->with('sucesso', "entregador excluido ccom sucesso!");
			 }
			 $data = [

				 'titulo' => "Excluindo a entregador $entregador->nome",
				 'entregador' => $entregador,

			 ];

				 return view('Admin/Entregadores/excluir',$data);
		 }


		 public function desfazerExclusao($id = null){

				$entregador = $this->buscaentregadorOu404($id);
					if($entregador->deletado_em == null){
						return redirect()->back()->with('info','Apenas entregador excluidos podem ser recuperados!')	;
					}
					 if($this->entregadorModel->desfazerExclusao($id)){
						 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
					 }else{
						 return redirect()->back()
									 ->with('errors_model', $this->entregadorModel->errors())
									 ->with('atencao', 'Por favor verifique, os erros a baixo!')
									 ->withInput();
			 }

		}


	     // return objeto Entregador //
			 public function buscaEntregadorOu404($id = null) {
				 if (!$id || !$entregador = $this->entregadorModel->withDeleted(true)->where('id', $id)->first()) {

						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o EEntregadores $id");				}
					return $entregador;

				}
}
