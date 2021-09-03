<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Produto;
class Produtos extends BaseController{

	private $produtoModel;
	private $categoriaModel;
	private $extraModel;
	private $produtoExtraModel;
	private $medidaModel;
	private $produtoEspecificacaoModel;

	public function __construct() {

		$this->produtoModel = new \App\Models\ProdutoModel();
		$this->categoriaModel = new \App\Models\CategoriaModel();
		$this->extraModel = new \App\Models\ExtraModel();
		$this->produtoExtraModel = new \App\Models\ProdutoExtraModel();
		$this->medidaModel = new \App\Models\MedidaModel();
		$this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();

	}
	public function index()
	{
		$data = [
				'titulo' => 'Listagem de Produtos',
				'produtos' => $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
				                                ->join('categorias', 'categorias.id = produtos.categoria_id')
																				->withDeleted(true)
																				->paginate(10),
				'especificacoes' =>$this->produtoEspecificacaoModel->join('medidas','medidas.id = produtos_especificacoes.medida_id')->findAll(),
				'pager' => $this->produtoModel->pager,
		];
    		//dd($produtos);
		return view('Admin/Produtos/index', $data);
	}


		public function procurar(){
			if (!$this->request->isAJAX()){

				exit('Página não encontrada');

			}
			$produtos = $this->produtoModel->procurar($this->request->getGet('term'));
			 $retorno = [];
			 foreach ($produtos as $produto) {
				$data['id'] = $produto->id;
				$data['value'] = $produto->nome;
				$retorno[] = $data;
			 }
			return  $this->response->setJSON($retorno);
		}

		//Métodos show
	  public function criar(){
	 		$produto = new Produto();

	 		$data = [

	 			'titulo' => "Criando novo produto",
	 			'produto' => $produto,
				'categorias' => $this->categoriaModel->where('ativo', true)->findAll()

	 				];

					///dd($produto);
	 		 return view('Admin/Produtos/criar',$data);


	 			}
				//Métodos show
				public function show($id = null){
					$produto = $this->buscaProdutoOu404($id);

					$data = [

						'titulo' => "Detalhando os produtos $produto->nome",
						'produto' => $produto,

							];

							///dd($produto);
					 return view('Admin/Produtos/show',$data);


						}

				//Métodos editar
				public function editar($id = null){
					$produto = $this->buscaProdutoOu404($id);

					$data = [

						'titulo' => "Editando o produto $produto->nome",
						'produto' => $produto,
						'categorias' => $this->categoriaModel->where('ativo', true)->findAll()

							];
							///dd($produto);
					 return view('Admin/Produtos/editar',$data);
						}

			public function atualizar($id = null){

							if ($this->request->getMethod() === 'post'){

								$produto = $this->buscaProdutoOu404($id);

								if($produto->deletado_em != null){
									return redirect()->back()->with('info', "A produto<b> $produto->nome</b> encontra-se excluido. Portanto não tem como fazer a atualização!");
								}

									$produto->fill($this->request->getPost());
									if(!$produto->hasChanged()){
										return redirect()->back()->with('info','Não tem dados para atualizar');
									}

									if($this->produtoModel->save($produto)){
										return redirect()->to(site_url("admin/produtos/index/$produto->id"))
										->with('sucesso',"Produto $produto->nome atualizado com sucesso!");
										}else{
										return redirect()->back()
										->with('errors_model', $this->produtoModel->errors())
										->with('Atencâo', 'Por favor verifique, os erros a baixo!')
										->withInput();
								 }

							}else{
								// não e ppostar
								return redirect()->back();

							}

					}

					//Imagem do Produto
					public function  editarimagem($id = null){
             $produto = $this->buscaProdutoOu404($id);

						 if($produto->deletado_em != null){
								return redirect()->back()->with('info', "Não é possível editar a imagem de um produto excluido!");
							}

						 $data = [

							 'titulo' => "Editando a imagem do produto $produto->nome",
							 'produto' => $produto,

								 ];

								 return view('Admin/Produtos/editar_imagem', $data);

					}

					public function upload($id = null){
						$produto = $this->buscaProdutoOu404($id);

						$imagem = $this->request->getFile('foto_produto');

						  if(!$imagem->isValid()){

								$codigoErro = $imagem->getError();

								  if($codigoErro == UPLOAD_ERR_NO_FILE){

										return redirect()->back()->with('atencao','Nenhum arquivo foi selecionado');
									}

							}

							$tamanhoImagem = $imagem->getSizeByUnit('mb');

									if($tamanhoImagem > 12){
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
									  $imagemCaminho = $imagem->store('produtos');

										$imagemCaminho = WRITEPATH.'uploads/'. $imagemCaminho;
									//	$imagemCaminho = $imagemCaminho(WRITEPATH.'uploads');


										//--Fazendo o resize da mesma imagem--//

										service('image')
										        ->withFile($imagemCaminho)
										        ->fit(400, 400, 'center')
										        ->save($imagemCaminho);

										// Recuperado a imagem antiga para excluir//
										 $imagemAntiga = $produto->imagem;


										// Atribuindo a nova imagem do produto//
										$produto->imagem = $imagem->getName();


                    // Atualizando a imagem do produto//
										$this->produtoModel->save($produto);


							// Definindo o caminho da imagem antiga//
							$caminhoImagem = WRITEPATH . 'uploads/produtos/' . $imagemAntiga;

									if(is_file($caminhoImagem)) {

											unlink($caminhoImagem);
									}

									return redirect()->to(site_url("admin/produtos/show/$produto->id"))
									->with('sucesso','Imagem alterada com sucess');

								}

				//Métodos para iamgens //
				public function imagem(string $imagem = null){

					if ($imagem) {

						$caminhoImagem = WRITEPATH . 'uploads/produtos/' .$imagem;


						$infoImagem = new \finfo(FILEINFO_MIME);

						$tipoImagem = $infoImagem->file($caminhoImagem);
						header("Content-Type: $tipoImagem");

						header("Content-Length: " . filesize($caminhoImagem));

						readfile($caminhoImagem);

						exit;
					}

     }
		 //Métodos show
		 public function extras($id = null){
			 $produto = $this->buscaProdutoOu404($id);

			 $data = [

				 'titulo' => "Gerencia  os extras dos produtos $produto->nome",
				 'produto' => $produto,
				 'extras' => $this->extraModel->where('ativo', true)->findAll(),
				 'produtoExtras' => $this->produtoExtraModel->buscarExtrasDoProduto($produto->id, 10),
				 'pager' => $this->produtoExtraModel->pager,
				];

					 ///dd($produto);
					 	return view('Admin/Produtos/extras',$data);

				 }

		public function cadastrarextras($id = null){

			if ($this->request->getMethod() === 'post') {

				 $produto = $this->buscaProdutoOu404($id);



				 $extraProduto['extra_id'] = $this->request->getPost('extra_id');

				 $extraProduto['produto_id'] = $produto->id;


				 $extraExistente = $this->produtoExtraModel
				 ->where('produto_id', $produto->id)
				 ->where('extra_id',  $extraProduto['extra_id'])
				 ->first();

				 if ($extraExistente) {
					 return redirect()->back()
 					->with('atencao',"Esse Extra já existe para esse pproduto!");
				 }

				 if($this->produtoExtraModel->save($extraProduto)){
						return redirect()->back()
						->with('sucesso',"Extra cadastrado com sucesso!");
						}else{
						return redirect()->back()
						->with('errors_model', $this->produtoExtraModel->errors())
						->with('Atencâo', 'Por favor verifique, os erros a baixo!')
						->withInput();
				 }


			}else{
				//Não post

				return redirect()->back();
			}


		}

					//Cria novo cadastro de produto
			 				public function cadastrar(){

			 					if ($this->request->getMethod() === 'post'){

			 						$produto = new Produto($this->request->getPost());


			 							if($this->produtoModel->protect(false)->save($produto)){
			 								return redirect()->to(site_url("admin/produtos/index/" . $this->produtoModel->getInsertID()))
			 								->with('sucesso',"Produtos $produto->nome Cadastrado com sucesso!");

			 								}else{
			 								return redirect()->back()
			 								->with('errors_model', $this->produtoModel->errors())
			 								->with('Atencâo', 'Por favor verifique, os erros a baixo!')
			 								->withInput();
			 						 }

			 					}else{
			 						// não e ppostar
			 						return redirect()->back();

			 					}

			 			}

						//excluir novo cadastro de produto
						public function excluir($id = null){

							$produto = $this->buscaProdutoOu404($id);

								if($this->request->getMethod() === 'post'){

									$this->produtoModel->delete($id);
										if($produto->imagem){

											$caminhoImagem = WRITEPATH . 'uploads/produtos/' . $produto->imagem;

											  if(is_file($caminhoImagem)){

													unlink($caminhoImagem);

										}

								}
								$produto->imagem = null;

									$this->produtoModel->save($produto);


								 return redirect()->to(site_url('admin/produtos'))->with('sucesso', "Produto excluido ccom sucesso!");
						}


						$data = [

							'titulo' => "Excluindo a produto $produto->nome",
							'produto' => $produto,

						];

						  return view('Admin/Produtos/excluir',$data);
		     	}

							// if($produto->deletado_em != null){
							// 	return redirect()->back()->with('info', "A produto<b> $produto->nome</b> já encontra-se excluido.");
							// }
							//
							// if($produto->is_admin){
							// 	return redirect()->back()->with('info','Não é Possível excluir um produto <b>Administrador</b>');
							// }
							//
							// if($this->request->getMethod() === 'post'){
							//
							//
							//
							//
							// 	 $this->produtoModel->delete($id);
							// 	 return redirect()->to(site_url('admin/produtos'))->with('sucesso', "Produto $produto->nome; excluido ccom sucesso!");
							// }
							//
							// $data = [
							//
							// 	'titulo' => "Excluindo a produto $produto->nome",
							// 	'produto' => $produto,
							//
							// ];
							//
							//
							//  return view('Admin/Produtos/excluir',$data);
							//
							//
							// 	}

								public function desfazerExclusao($id = null){

									$produto = $this->buscaProdutoOu404($id);
										if($produto->deletado_em == null){
											return redirect()->back()->with('info','Apenas produto excluidos podem ser recuperados!')	;
										}
										 if($this->produtoModel->desfazerExclusao($id)){
											 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
										 }else{
											 return redirect()->back()
														 ->with('errors_model', $this->produtoModel->errors())
														 ->with('atencao', 'Por favor verifique, os erros a baixo!')
														 ->withInput();
								 }

							}

		public function excluirExtra($id_principal = null, $id = null){

			//Verificar se a solicitação vem atráves do post
				if ($this->request->getMethod() === 'post'){

					$produto = $this->buscaProdutoOu404($id);

				$produtoExtra = $this->produtoExtraModel
								->where('id', $id_principal)
								->where('produto_id', $produto->id)
								->first();


				if(!$produtoExtra){

		         	return redirect()->back()->with('atencao', 'Não encontramos o registro principal!');
				}

			$this->produtoExtraModel->delete($id_principal);
				    	return redirect()->back()->with('sucesso', 'Extra excluído com sucesso!');



			}else{
        /* Não e post    */
				return redirect()->back();
			}

		}

		//Métodos especificaçẽos
		public function especificacoes($id = null){
			$produto = $this->buscaProdutoOu404($id);

			$data = [

				'titulo' => "Gerencia  os especificações dos produtos $produto->nome",
				'produto' => $produto,
				'medidas' => $this->medidaModel->where('ativo', true)->findAll(),
				'produtoEspecificacoes' => $this->produtoEspecificacaoModel->buscarEspecificacoesDoProduto($produto->id, 10),
				'pager' => $this->produtoEspecificacaoModel->pager,
			 ];


					 return view('Admin/Produtos/especificacoes',$data);

				}

      public function cadastrarespecificacoes($id = null){

				if ($this->request->getMethod() === 'post'){
				$produto = $this->buscaProdutoOu404($id);

				     $especificacao = $this->request->getPost();

				     $especificacao['produto_id'] = $produto->id;
						 $especificacao['preco'] =  str_replace(",","", $especificacao['preco']);
          //  dd($especificacao);
				      $especificacaoExistente = $this->produtoEspecificacaoModel
																						 ->where('produto_id', $produto->id)
																						 ->where('medida_id',  $especificacao['medida_id'])
																						 ->first();
							//Nega cadastro de espe casso já exista no produto///
							if($especificacaoExistente){
									return redirect()->back()->with('atencao', 'Essa especificacão já existe para esse produto!')->withInput();
							}
							/// Cadastra especificacão para o pproduto
							if($this->produtoEspecificacaoModel->save($especificacao)){
								 return redirect()->back()
								 ->with('sucesso',"Especificacão cadastrada com sucesso!");
								 }else{
								 return redirect()->back()
								 ->with('errors_model', $this->produtoEspecificacaoModel->errors())
								 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
								 ->withInput();
							}

				}else{
					return redirect()->back();
				}

			}

	public function excluirEspecificacao($especificacao_id = null, $produto_id = null){

			// Busco nome do produto vindo com solicitação
			$produto = $this->buscaProdutoOu404($produto_id);

			 $especificacao = $this->produtoEspecificacaoModel
			 											 ->where('id', $especificacao_id)
			 											 ->where('produto_id',$produto_id)
														 ->first();

				if(!$especificacao){
					return redirect()->back()->with('atencao', 'Não encontramos a eespecificacão');
				}

				if($this->request->getMethod() === 'post'){

					$this->produtoEspecificacaoModel->delete($especificacao_id);

							return redirect()->to(site_url("admin/produtos/especificacoes/$produto->id"))->with('sucesso', 'Especificacão excluida com ssucesso');
				}




      $data = [
				'titulo' => 'Exclusão de especificacão do prproduto',
				'especificacao' => $especificacao,
			];
				return view('Admin/Produtos/excluirespecificacao', $data);

	}

		// return objeto Produto //
		public function buscaProdutoOu404($id = null) {
			if (!$id || !$produto = $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
																			->join('categorias', 'categorias.id = produtos.categoria_id')
																			->where('produtos.id', $id)
																			->withDeleted(true)
																			->first()) {

				 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos produto $id");				}
			 return $produto;

		 }
}
