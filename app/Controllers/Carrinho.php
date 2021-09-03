<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController
{

	private $validacao;
	private $produtoEspecificaoModel;
	private $extraModel;
	private $produtoModel;



	public function __construct(){
		//$validation =  \Config\Services::validation();

		$this->validacao = service('validation');
		$this->produtoEspecificaoModel = new \App\Models\ProdutoEspecificacaoModel();
		$this->extraModel = new \App\Models\ExtraModel();
		$this->produtoModel = new \App\Models\ProdutoModel();

		$this->acao = service('router')->methodName();

	}
	public function index()
	{
		//
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
				//Validamos a existencia do produto e se mesmo estar ativo
					// Estamos utilizando no toArray para que possamos esse objeto
				$produto = $this->produtoModel->select(['id','nome','slug','ativo'])->where('slug', $produtoPost['slug'])->first()->toArray();

				if($produto == null || $produto['ativo'] == false){

					return redirect()->back()
					 //Quando ouver fraude no  forms chave slugs
					->with('fraude', 'Não conseguimos processar sua solicitação. Por favor, entre em contato com nossa equipe e informe o código de erro: <strong>ERRO-ADD-PROD-30003</strong>');

				}
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

		  return redirect()->back()->with('sucesso','Produto adicionado com sucesso!');
			}else{
						return redirect()->back();
		}
	}

	//Retono da  função com array
  private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos){

		$produtos  = array_map(function($linha) use($acao, $slug, $quantidade) {

			if ($linha['slug'] == $slug){

				if ($acao === 'adicionar'){
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

}
