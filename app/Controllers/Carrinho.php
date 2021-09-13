<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController
{

	private $validacao;
	private $produtoEspecificaoModel;
	private $extraModel;
	private $produtoModel;
	private $medidaModel;
	private $bairroModel;
	private $acao;



	public function __construct(){
		//$validation =  \Config\Services::validation();

		$this->validacao = service('validation');
		$this->produtoEspecificaoModel = new \App\Models\ProdutoEspecificacaoModel();
		$this->extraModel = new \App\Models\ExtraModel();
		$this->produtoModel = new \App\Models\ProdutoModel();
		$this->medidaModel = new \App\Models\MedidaModel();
		$this->bairroModel = new \App\Models\BairroModel();

		$this->acao = service('router')->methodName();

	}
	public function index(){
		$data = [

			'titulo' => 'Meu carrinho de compras'
		];

		if(session()->has('carrinho') && count(session()->get('carrinho')) > 0){

		$data['carrinho'] = json_decode(json_encode(session()->get('carrinho')), false);

		}

    // echo '<pre>';
	 	// 	print_r($data['carrinho']);
	  // exit;

	// dd($data['carrinho']);

		return view('Carrinho/index', $data);
	}

	public function adicionar(){
		 if($this->request->getMethod() === 'post'){

	    $produtoPost = $this->request->getPost('produto');

			$this->validacao->setRules([
			    'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
			    'produto.especificacao_id' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
			    'produto.preco' => ['label' => 'Valor do Produto', 'rules' => 'required|greater_than[0]'],
			    'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],

		]);

			if(!$this->validacao->withRequest($this->request)->run()){

				return redirect()->back()
				->with('errors_model', $this->validacao->getErrors())
				->with('atencao', 'Por favor verifique, os erros a baixo e tente nnovamente')
				->withInput();

			}

			//Validamos a existencia da especificacao_id /

			$especificacaoProduto = $this->produtoEspecificaoModel
												->join('medidas','medidas.id = produtos_especificacoes.medida_id')
			                  ->where('produtos_especificacoes.id', $produtoPost['especificacao_id'])
												->first();

			if($especificacaoProduto == null){

				return redirect()->back()
         //Quando ouver fraude no forms
				->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-PROD-501</strong>');

			}

			if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

				$extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

				if($extra == null){

					return redirect()->back()
					 //Quando ouver fraude no forms extras
					->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-PROD-505</strong>');

				}

			}
				//Buscamos o produto como objetos //
				$produto = $this->produtoModel->select(['id','nome','slug','ativo'])->where('slug', $produtoPost['slug'])->first();

				if($produto == null || $produto->ativo == false){

					return redirect()->back()
					 //Quando ouver fraude no  forms chave slugs
					->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-PROD-30003</strong>');

				}

			// Convertendo o objeto para array//
				$produto  = $produto->toArray();

       ///Criamos o slugs para indenfificamos a existencia do carrinho na hora de adicionar
				$produto['slug'] = mb_url_title($produto['slug']. '-'. $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra-'. $extra->nome : ''), '-', true);


      ///Criamos o nome do produto aparti da expeficicação do extras
		   $produto['nome'] = $produto['nome'].  ' '. $especificacaoProduto->nome. ' '. (isset($extra) ? 'Com extra '. $extra->nome : '');

			 //Definimos o preço, Quantidade e tamanho do pproduto
				$preco = $especificacaoProduto->preco + (isset($extra) ? $extra->preco : 0);

					$produto['preco'] = number_format($preco, 2);
					$produto['quantidade'] = (int) $produtoPost['quantidade'];
					$produto['tamanho'] = $especificacaoProduto->nome;

					//Removendo ativo do carrinho porque não tem utilidade///
					unset($produto['ativo']);

					//Iniciamos a inserçao do  pproduto para o carrinho
					if(session()->has('carrinho')){
						// Existem inserção no carrinho na sessão//

							// Recupera os intem do carrinho na sessão//
							$produtos = session()->get('carrinho');

								// Recupera os apenas os slug dos prdutos do carrinho//
								$produtosSlugs = array_column($produtos, 'slug');

								if(in_array($produto['slug'], $produtosSlugs)) {

								// Já existe o produto no carrinho... incliementamos a quantidade//

								// chamamos a função inclementea a quantidadede de produto incliementamos a quantidade no carrinho//
                 $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

								 // SSobre escrevemos asessão carrinho com o array com arra  $produtos que foi iincliementado (alterado) //
								session()->set('carrinho', $produto);

								}else{

									/* Não existe o produto no carrinho... pode  a aadicionar//
									 aadicionarmos no carrinho $produto Notem que  o push adiciona na sessão  'carrinho' um array [$produto]*/
									session()->push('carrinho', [$produto]);

								}

					}else{
						// Não existem inserção no carrinho na sessão//

						$produtos[] = $produto;
						session()->set('carrinho', $produtos);

					}

		  return redirect()->to(site_url('carrinho'))->with('sucesso','Produto adicionado com sucesso!');
			}else{
						return redirect()->back();
		}
	}

public function especial(){

	if($this->request->getMethod() === 'post'){

		$produtoPost = $this->request->getPost();

		$this->validacao->setRules([
				'primeira_metade' => ['label' => 'Primeiro produto', 'rules' => 'required|greater_than[0]'],
				'segunda_metade' => ['label' => 'Segundo produto', 'rules' => 'required|greater_than[0]'],
				'tamanho' => ['label' => 'Tamanho do  produto', 'rules' => 'required|greater_than[0]'],

	]);

		if(!$this->validacao->withRequest($this->request)->run()){

			return redirect()->back()
			->with('errors_model', $this->validacao->getErrors())
			->with('atencao', 'Por favor verifique, os erros a baixo e tente nnovamente')
			->withInput();
		  }



		$primeiroProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
										->where('id', $produtoPost['primeira_metade'])
										->first();

				if($primeiroProduto == null){

					return redirect()->back()
					 //Quando ouver fraude no  forms chave slugs
					->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-CUSTOM-10001</strong>');


				}

				$segundoProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
												->where('id', $produtoPost['segunda_metade'])
												->first();

						if($segundoProduto == null){

							return redirect()->back()
							 //Quando ouver fraude no  forms chave slugs
							->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-CUSTOM-20002</strong>');//Fraude no form .. Chave $produto['primeira metade']

						}
							// Converyendo os objetos para  array//
						$primeiroProduto = $primeiroProduto->toArray();
						$segundoProduto = $segundoProduto->toArray();

					//	$produtoPost['extra_id'] = 499;

						if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

							$extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

							if($extra == null){

								return redirect()->back()
								 //Quando ouver fraude no forms extras
								->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-CUSTOM-303</strong>');//Fraude no form .. Chave $produto['segunda metade']

							}

						}
							/*
							/ Recuperamos o valor do produto de acordo com o tamanho escolhido/
							*/

					    // $produtoPost['tamanho'] = 999;
							 $medida = $this->medidaModel->exibeValor($produtoPost['tamanho']);

							//dd($valorProduto);
							 if($medida->preco == null){

								 return redirect()->back()
									//Quando ouver fraude no forms extras
								 ->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-CUSTOM-404</strong>');//Fraude no form .. Chave $produto['tamanho']

							 }

							 ///Criamos o slugs para indenfificamos a existencia do carrinho na hora de adicionar
							 $produto['slug'] = mb_url_title($medida->nome .'-metade-'. $primeiroProduto['slug']. '-metade-'. $segundoProduto['slug'] . '-' . (isset($extra) ? 'com extra-'. $extra->nome : ''), '-', true);


							 							//Criamos o nome do produto aparti da expeficicação do extras
							 $produto['nome'] = $medida->nome .' metade '. $primeiroProduto['nome']. ' metade '. $segundoProduto['nome'] . ' ' . (isset($extra) ? 'com extra '. $extra->nome : '');

							 //Definimos o preço, Quantidade e tamanho do pproduto
								$preco = $medida->preco + (isset($extra) ? $extra->preco : 0);

									$produto['preco'] = number_format($preco, 2);
									$produto['quantidade'] = 1;//Sempre será um
									$produto['tamanho'] = $medida->nome;


									//Iniciamos a inserçao do  pproduto para o carrinho
									if(session()->has('carrinho')){
										// Existem inserção no carrinho na sessão//

											// Recupera os intem do carrinho na sessão//
											$produtos = session()->get('carrinho');

												// Recupera os apenas os slug dos prdutos do carrinho//
												$produtosSlugs = array_column($produtos, 'slug');

												if(in_array($produto['slug'], $produtosSlugs)) {

												// Já existe o produto no carrinho... incliementamos a quantidade//

												// chamamos a função inclementea a quantidadede de produto incliementamos a quantidade no carrinho//
				                 $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

												 // SSobre escrevemos asessão carrinho com o array com arra  $produtos que foi iincliementado (alterado) //
												session()->set('carrinho', $produto);

												}else{

													/* Não existe o produto no carrinho... pode  a aadicionar//
													 aadicionarmos no carrinho $produto Notem que  o push adiciona na sessão  'carrinho' um array [$produto]*/
													session()->push('carrinho', [$produto]);

												}

									}else{
										// Não existem inserção no carrinho na sessão//

										$produtos[] = $produto;
										session()->set('carrinho', $produtos);

									}

						  return redirect()->to(site_url('carrinho'))->with('sucesso','Produto adicionado com sucesso!');

    	}else{
		return redirect()->back();
	}

}

public function atualizar(){
	if($this->request->getMethod() === 'post'){
		$produtoPost = $this->request->getPost('produto');

		$this->validacao->setRules([
			'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],
				'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],

	]);

		if(!$this->validacao->withRequest($this->request)->run()){
			return redirect()->back()
			->with('errors_model', $this->validacao->getErrors())
			->with('atencao', 'Por favor verifique, os erros a baixo e tente nnovamente')
			->withInput();

		}

		// Recupera os intem do carrinho na sessão//
		$produtos = session()->get('carrinho');

			// Recupera os apenas os slug dos prdutos do carrinho//
			$produtosSlugs = array_column($produtos, 'slug');

			if(!in_array($produtoPost['slug'], $produtosSlugs)) {
					return redirect()->back()
					 //Quando ouver fraude no  forms chave slugs
													->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-ATUA-7007</strong>');//Fraude no form .. Chave $produto['primeira metade']
		    }else{

					// Produto validado ... atualizams a quantidade//
					// chamamos a função inclementea a quantidadede de produto incliementamos a quantidade no carrinho//
					 $produtos = $this->atualizaProduto($this->acao, $produtoPost['slug'], $produtoPost['quantidade'], $produtos);
					 // Sobre escrevemos asessão carrinho com o array $produtos que foi incliementado ou decrementado //
					session()->set('carrinho', $produtos);
					return redirect()->back()->with('sucesso', 'Quantidade atualizada com sucesso');

				}


	}else{

	}

}


public function remover(){

		if($this->request->getMethod() === 'post'){
			$produtoPost = $this->request->getPost('produto');

			$this->validacao->setRules([
					'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],

		]);

			if(!$this->validacao->withRequest($this->request)->run()){

				return redirect()->back()
				->with('errors_model', $this->validacao->getErrors())
				->with('atencao', 'Por favor verifique, os erros a baixo e tente nnovamente')
				->withInput();

			}

			// Recupera os intem do carrinho na sessão//
			$produtos = session()->get('carrinho');

				// Recupera os apenas os slug dos prdutos do carrinho//
				$produtosSlugs = array_column($produtos, 'slug');

				if(!in_array($produtoPost['slug'], $produtosSlugs)) {
						return redirect()->back()
						 //Quando ouver fraude no  forms chave slugs
														->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-ATUA-7007</strong>');//Fraude no form .. Chave $produto['primeira metade']
			    }else{

						//Removemos do carrinho  o produto na sessão  //
  					$produtos = $this->removeProduto($produtos, $produtoPost['slug']);

						//Atualizamos o carrinho na sessão com array $produtos sem o pproduto que foi removido //
						session()->set('carrinho', $produtos);


						return redirect()->back()->with('sucesso', 'Produto removido do carrinho de compras com sucesso');

					}


		}else{

		}

	}


	//Retono da  função com array

public function limpar(){

  //Removendo todo os produtos  do carrinho //
	session()->remove('carrinho');
	return redirect()->to(site_url('carrinho'));
}

public function consultaCep(){

  if(!$this->request->isAjax()){

		 return redirect()->back();
	}

	$this->validacao->setRule('cep','CEP','required|exact_length[9]');
	  if(!$this->validacao->withRequest($this->request)->run()){
	  	$retorno['erro'] = '<span class="text-danger small">'. $this->validacao->getError() .'</span>';
			return $this->response->setJSON($retorno);
	}
	$cep = str_replace("-", "", $this->request->getGet('cep'));

	//Carregamos o helper do cep//

	 helper('consulta_cep');

	 $consulta = consultaCep($cep);

	 if(isset($consulta->erro) && !isset($consulta->cep)){

		 $retorno['erro'] = '<span class="text-danger small">Inforne um cep valido</span>';
		 return $this->response->setJSON($retorno);

	 }

   $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);

	 $bairro = $this->bairroModel->select('nome, valor_entrega')
	 ->where('slug', $bairroRetornoSlug)
	 ->where('ativo', true)->first();

	 if($bairro == null || $bairro == null){

		 $retorno['erro'] = '<span class="text-dark bg-danger" style="padding: 10px;"><b>Atenção:</b> Não atendemos neste Bairro: '
		 . esc($consulta->bairro)
		 .' - '. esc($consulta->localidade)
		 .' - CEP '. esc($consulta->cep)
		 .' - '. esc($consulta->uf)
		 . '</span>';
		 return $this->response->setJSON($retorno);
	 }

	 $retorno['valor_entrega'] = 'R$ '.esc(number_format($bairro->valor_entrega, 2));

	 $retorno['bairro'] = '<span class="text-white bg-success" style="padding:10px;"><b>Valor de entrega para o bairro: </b>'
	 . esc($consulta->bairro)
	 .' - '. esc($consulta->localidade)
	 .' - CEP '. esc($consulta->cep)
	 .' - '. esc($consulta->uf)
	 .' - R$ '. esc(number_format($bairro->valor_entrega, 2))
	 . '</span>';

	 $carrinho = session()->get('carrinho');

	  $total = 0;

	  foreach($carrinho as $produto){

			$total += $produto['preco'] * $produto['quantidade'];

		}

		$total += esc(number_format($bairro->valor_entrega, 2));

		$retorno['total'] = 'R$ '.esc(number_format($total, 2));

		return $this->response->setJSON($retorno);

}


private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos){

		$produtos  = array_map(function ($linha) use ($acao, $slug, $quantidade) {

			if ($linha['slug'] == $slug){

				if ($acao === 'adicionar'){
					 $linha['quantidade'] += $quantidade;

				}

				if ($acao === 'especial'){
					 $linha['quantidade'] += $quantidade;

				}


				if($acao === 'atualizar'){

						$linha['quantidade'] = $quantidade;

			    	}
	   		}

			return $linha;

		}, $produtos);

		return $produtos;

	}

private function removeProduto(array $produtos, string $slug){

	return array_filter($produtos, function ($linha) use ($slug) {

		return $linha['slug'] != $slug;

	});

}


}
