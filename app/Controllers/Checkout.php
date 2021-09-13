<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController{

	private $usuario;
	private $formaPagamentoModel;
	private $bairroModel;
	private $pedidoModel;

	public function __construct() {
		//$this->usuario = new \App\Models\Usuario();

		$this->usuario = service('autenticacao')->pegaUsuarioLogado();
		$this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
		$this->bairroModel = new \App\Models\BairroModel();
		$this->pedidoModel = new \App\Models\PedidoModel();

	}
	public function index()
	{
		if(!session()->has('carrinho') || count(session()->get('carrinho')) < 1){

			return redirect()->to(site_url('carrinho'));

		}

		  $data = [
				'titulo' => 'Finalizar pedido',
				'carrinho' => session()->get('carrinho'),
				'formas' => $this->formaPagamentoModel->where('ativo', true)->findAll(),
			];

			return view('Checkout/index', $data);
	}

	public function consultaCep(){

		if(!$this->request->isAJAX()){

			return redirect()->to(site_url('/'));

		}


		$validacao = service('validation');
		$validacao->setRule('cep','CEP','required|exact_length[9]');
		if(!$validacao->withRequest($this->request)->run()){

			$retorno['erro'] = '<span class="text-danger small">'.$validacao->getError().'</span>';
			return $this->response->setJSON($retorno);
		}
		$cep = str_replace("-", "", $this->request->getGet('cep'));

		//Carregamos o helper do cep//

		 helper('consulta_cep');

		 $consulta = consultaCep($cep);

		 if(isset($consulta->erro) && !isset($consulta->cep)){

			 $retorno['erro'] = '<span class="text-danger">Inforne um cep valido</span>';
			 return $this->response->setJSON($retorno);
			 }

			 $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);

			 $bairro = $this->bairroModel->select('nome, valor_entrega, slug')
			 ->where('slug', $bairroRetornoSlug)
			 ->where('ativo', true)->first();

			 if($consulta->bairro == null || $bairro == null){
			 //if($bairro == null){

				 $retorno['erro'] = '<span class="text-danger"><b>Atenção:</b> Não atendemos neste Bairro: '
				 . esc($consulta->bairro)
				 .' - '. esc($consulta->localidade)
				 .' - CEP '. esc($consulta->cep)
				 .' - '. esc($consulta->uf)
				 . '</span>';
				 return $this->response->setJSON($retorno);
			 }

			 $retorno['valor_entrega'] = 'R$ '.esc(number_format($bairro->valor_entrega, 2));

			 $retorno['bairro'] = '<span class="text-success" style="padding:10px;"><b>Valor de entrega para o bairro: </b>'
			 . esc($consulta->bairro)
			 .' - '. esc($consulta->localidade)
			 .' - CEP '. esc($consulta->cep)
			 .' - '. esc($consulta->uf)
			 .' - R$ '. esc(number_format($bairro->valor_entrega, 2))
			 . '</span>';

			 $retorno['endereco'] = esc($consulta->bairro)
			 .' - '. esc($consulta->localidade)
			 .' - '. esc($consulta->logradouro)
			 .' - CEP '. esc($consulta->cep)
			 .' - '. esc($consulta->uf);


			 $retorno['logradouro'] = $consulta->logradouro;
			 $retorno['bairro_slug'] = $bairro->slug;

			 $retorno['total'] =  number_format($this->somaValorProdutosCarrinho() + $bairro->valor_entreg, 2);
			  session()->set('endereco_entrega', $retorno['endereco']);
				return $this->response->setJSON($retorno);
	}
 public function processar(){

	if($this->request->getMethod() === 'post'){

		 $checkoutPost = $this->request->getPost('checkout');

		 $validacao = service('validation');

		 $validacao->setRules([
				 'checkout.rua' => ['label' => 'Endereço', 'rules' => 'required|max_length[99]'],
				 'checkout.numero' => ['label' => 'Número', 'rules' => 'required|max_length[30]'],
				 'checkout.referencia' => ['label' => 'Ponto de referência', 'rules' => 'required|max_length[50]'],
				 'checkout.forma_id' => ['label' => 'Forma de pagamento na entrega', 'rules' => 'required|integer'],
				 'checkout.bairro_slug' => ['label' => 'Taxa de entrega', 'rules' => 'required|string|max_length[40]'],

	 ]);

		 if(!$validacao->withRequest($this->request)->run()){

			 session()->remove('endereco_entrega');

			 return redirect()->back()
												 ->with('errors_model', $validacao->getErrors())
												 ->with('atencao', 'Por favor verifique, os erros a baixo e tente nnovamente');


		 }

		 $forma = $this->formaPagamentoModel->where('id', $checkoutPost['forma_id'])->where('ativo', true)->first();

		 if($forma == null){
			 session()->remove('endereco_entrega');
			 return redirect()->back()
												->with('errors_model', $validacao->getErrors())
												->with('atencao', "Por favor escolha a <strong>Forma de Pagamento na Entrega</strong> e tente novamente.");
		 }

		 $bairro = $this->bairroModel->where('slug', $checkoutPost['bairro_slug'])->where('ativo', true)->first();

		if($bairro == null){

			session()->remove('endereco_entrega');
			return redirect()->back()

											 ->with('atencao', "Por favor <strong>Informe seu CEP</strong> e calcule a texa de entrega novamente.");
		}
    if(!session()->get('endereco_entrega')){
			return redirect()->back()
			->with('atencao', "Por favor <strong>Informe seu CEP</strong> e calcule a texa de entrega novamente.");
			}

	/* Já podemos salvar o pedido */


	$pedido = new \App\Entities\Pedido();

	$pedido->usuario_id = $this->usuario->id;
	$pedido->codigo = $this->pedidoModel->geraCodigoPedido();
	$pedido->forma_pagamento = $forma->nome;
	$pedido->produtos = serialize(session()->get('carrinho'));//Quando eu salvar esse tipo de arquivos não posso salvar em varchar somente em campo text.
	$pedido->valor_produtos = number_format($this->somaValorProdutosCarrinho(), 2);
  $pedido->valor_entrega = number_format($bairro->valor_entrega, 2);
	$pedido->valor_pedido = number_format($pedido->valor_produto + $pedido->valor_entrega, 2);//
	$pedido->endereco_entrega = session()->get('endereco_entrega').' - Número '.$checkoutPost['numero'];

			 if($forma->id == 1){
				 if(isset($checkoutPost['sem_troco'])){

					 $pedido->observacoes = 'Ponto de referência: ' . $checkoutPost['referencia'] . ' - Número: ' . $checkoutPost['numero'] .'. Você informou que não precisa de troco';
			 }


			 if(isset($checkoutPost['troco_para'])) {

				 $trocoPara = str_replace(',','', $checkoutPost['troco_para']);
				 if($trocoPara < 1){
					 return redirect()->back()
		 			->with('atencao', "Por favor digite um valor na opção <b>Troco para</b>, ou Marque a opção que <b>Não preciso de troco</b>");

				 }
				 $pedido->observacoes = 'Ponto de referência: '.$checkoutPost['referencia'] . ' - Número: ' . $checkoutPost['numero'] . '. Você informou que precisa de troco para: R$ '.number_format($trocoPara, 2);
            }
           }else{
					/* Cliente escolheu uma forma diferente de Dinheiro*/
					$pedido->observacoes = 'Ponto de referência: '.$checkoutPost['referencia'] .' - Número: ' .$checkoutPost['numero'];
         }



				 $this->pedidoModel->save($pedido);

				 $pedido->usuario = $this->usuario;

				 $this->enviaEmailPedidoRealizado($pedido);

				 //Limpar dados da sessão

				 session()->remove('carrinho');
				 session()->remove('endereco_entrega');

				// exit('Sucesso!');
				return redirect()->to("checkout/sucesso/$pedido->codigo");


	 }else{

		 return redirect()->back();
	 }


 }

public function sucesso($codigoPedido = null){

$pedido = $this->buscaPedidoOu404($codigoPedido);


   $data = [
 			'titulo' => "Pedido $codigoPedido realizado com sucesso",
			'pedido' => $pedido,
			'produtos' => unserialize($pedido->produtos),
	 ];

	 return view('Checkout/sucesso', $data);

	}



	//----------------------------- funções privada-------------------------///

	private function somaValorProdutosCarrinho() {

		$produtosCarrinho = array_map(function($linha){

			return $linha['quantidade'] * $linha['preco'];

		}, session()->get('carrinho') );

		return array_sum($produtosCarrinho);


	}

private function enviaEmailPedidoRealizado(object $pedido) {

		$email = service('email');
		$email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
		$email->setTo($this->usuario->email);
		$email->setSubject("Pedido $pedido->codigo realizado com sucesso!");
		$mensagem = view('Checkout/pedido_email', ['pedido' => $pedido]);
		$email->setMessage($mensagem);
		$email->send();

	}

	// param string $codigoPedido//
	// return objeto Produto //
	public function buscaPedidoOu404(string $codigoPedido = null) {
		if (!$codigoPedido || !$pedido = $this->pedidoModel
							->where('codigo', $codigoPedido)
							->where('usuario_id', $this->usuario->id)
							->first()) {

			 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos pedido $codigoPedido");				}
		 return $pedido;

	 }

}