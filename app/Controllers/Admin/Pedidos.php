<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pedidos extends BaseController{
	private $pedidoModel;
	private $entregadorModel;

public function __construct() {

   $this->pedidoModel = new \App\Models\PedidoModel();
   $this->entregadorModel = new \App\Models\EntregadorModel();

}

	public function index(){
		$data = [
			'titulo' =>'Pedidos realizados',
		//	'pedidos' =>$this->pedidoModel->ListaTodosOsPedidos(),
		'pedidos' => $this->pedidoModel->ListaTodosOsPedidos(),

			'pager' => $this->pedidoModel->pager,
			];

	 return view('Admin/Pedidos/index', $data);
	}

	public function procurar(){
		if (!$this->request->isAJAX()){

			exit('Página não encontrada');

		}

		$pedidos = $this->pedidoModel->procurar($this->request->getGet('term'));
		 $retorno = [];

		 foreach ($pedidos as $pedido) {


			$data['value'] = $pedido->codigo;
			$retorno[] = $data;
		 }
		return  $this->response->setJSON($retorno);
	}


	public function show($codigoPedido = null){

   $pedido= $this->pedidoModel->buscaPedidoOu404($codigoPedido);
		$data = [
			'titulo' => "Detalhando o pedido $pedido->codigo",
			'pedido' =>  $pedido,
			];

	 return view('Admin/Pedidos/show', $data);
	}
	public function editar($codigoPedido = null){

   $pedido= $this->pedidoModel->buscaPedidoOu404($codigoPedido);

    if($pedido->situacao == 2){

			 return redirect()->back()->with('atencao','Esse pedido já foi entregue e portanto não é possível editá-lo');
		}

		if($pedido->situacao == 3){

			 return redirect()->back()->with('info','Esse pedido foi  cancelado e portanto não é possível editá-lo');
		}


		$data = [
			'titulo' => "Detalhando o pedido $pedido->codigo",
			'pedido' =>  $pedido,
			'entregadores' => $this->entregadorModel->select('id, nome')->where('ativo', true)->findAll(),
			];

	 return view('Admin/Pedidos/editar', $data);
	}

	public function atualizar($codigoPedido = null){

		if($this->request->getMethod() === 'post'){

			$pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

			if($pedido->situacao == 2){

				 return redirect()->back()->with('atencao','Esse pedido já foi entregue e portanto não é possível editá-lo');
			}

			if($pedido->situacao == 3){

				 return redirect()->back()->with('info','Esse pedido foi  cancelado e portanto não é possível editá-lo');
			}


			$pedidoPost = $this->request->getPost();

			if(!isset($pedidoPost['situacao'])){
				return redirect()->back()->with('atencao','Escolha a situacao do pedido');

			}


			if($pedidoPost['situacao'] == 1){

				if(strlen($pedidoPost['entregador_id']) < 1){
					return redirect()->back()->with('atencao','Se o pedido está saindo para entrega, por favor escolha um entregador');
				}

			}

			if($pedido->situacao == 0){

				if($pedidoPost['situacao'] == 2){
					return redirect()->back()->with('atencao','O pedido não pode ter sido entregue, pois ainda não <b>Saiu para enentrega!</b>');
				}

			}

			if($pedidoPost['situacao'] != 1){
        unset($pedidoPost['entregador_id']);

			}

			if($pedidoPost['situacao'] == 3){
        $pedidoPost['entregador_id'] = null;

			}
      /* Usaremos para avisar o admin para ligar para entregado avisando do cancelamento do pedido solicitado(Ligar entregador) */
			 $situacaoAnteriorPedido = $pedido->situacao;

			 $pedido->fill($pedidoPost);

					if(!$pedido->hasChanged()){
						return redirect()->back()->with('info','Não há informações para serem atualizado <b>Neste pedido!</b>');
					}


					if($this->pedidoModel->save($pedido)){
						if($pedido->situacao == 1){
    					$entregador = $this->entregadorModel->find($pedido->entregador_id);
							$pedido->entregador = $entregador;
							$this->enviaEmailPedidoSaiuEntrega($pedido);
						    }

						if($pedido->situacao == 2){
							$this->enviaEmailPedidoFoiEntregue($pedido);

									//Salva no banco de dados depois de verificar todas as etapas do curso.//
							   $this->insereProdutosDoPedido($pedido);

						   }

							 if($pedido->situacao == 3){
								 $this->enviaEmailPedidoFoiCancelado($pedido);

								 if($situacaoAnteriorPedido == 1){
									 	session()->setFlashdata('atencao','Administrador, esse pedido está em rota de entrega. Por favor entre em contato com entregador
										 para que ele retorne a base.');



								 }

										 //Salva no banco de dados depois de verificar todas as etapas do curso.//


									}

						return redirect()->to(site_url("admin/pedidos/show/$codigoPedido"))->with('sucesso','O pedido foi atualizado com <b>Sucesso!</b>');
					}else{

						return redirect()->back()
						->with('errors_model', $this->pedidoModel->errors())
						->with('Atencâo', 'Por favor verifique, os erros a baixo!');

					}

			// dd($pedidoPost);

		}else{
			return redirect()->back();
		}

	}



	public function excluir($codigoPedido = null){

	 $pedido= $this->pedidoModel->buscaPedidoOu404($codigoPedido);

	 if($pedido->situacao < 2){

		 return redirect()->back()->with('info','Apenas pedidos <b>Entregues ou cancelados</b> podem ser excluidos');

	 }
   if($this->request->getMethod() === 'post'){

		 $this->pedidoModel->delete($pedido->id);

			 return redirect()->to(site_url("admin/pedidos"))->with('successo','Pedido foi excluido com sucesso!');

	 }


		$data = [
			'titulo' => "Excluindo o pedido $pedido->codigo",
			'pedido' =>  $pedido,
			];

	 return view('Admin/Pedidos/excluir', $data);
	}

 //refazer conforme a necesidade dos pedido_id do dono do site
	// public function desfazerExclusao($id = null) {
	// 		$pedido= $this->pedidoModel->buscaPedidoOu404($id);
	//
	// 		if ($pedido->deletado_em == null) {
	// 				return redirect()->back()->with('info', 'Apenas pedidos excluídos podem ser recuperadas');
	// 		}
	//
	// 		if ($this->pedidoModel->desfazerExclusao($id)) {
	// 				return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
	// 		} else {
	// 				return redirect()->back()->with('errors_model', $this->pedidoModel->errors())
	// 												->with('atencao', 'Por favor verifiqie os erros abaixo')->withInput();
	// 		}
	// }



	private function enviaEmailPedidoSaiuEntrega(object $pedido){
	 $email = service('email');
			 $email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
			 $email->setTo($pedido->email);

			 $email->setSubject("Pedido $pedido->codigo saiu para entrega.");

			$mensagem = view('Admin/Pedidos/pedido_saiu_entrega_email', ['pedido' => $pedido]);
		 $email->setMessage($mensagem);
			$email->send();
	 }


	private function enviaEmailPedidoFoiEntregue(object $pedido){
	 $email = service('email');
			 $email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
			 $email->setTo($pedido->email);

			 $email->setSubject("Pedido $pedido->codigo foi entregue.");

			$mensagem = view('Admin/Pedidos/pedido_foi_entregue_email', ['pedido' => $pedido]);
		 $email->setMessage($mensagem);
			$email->send();
	 }

	 private function enviaEmailPedidoFoiCancelado(object $pedido){
 	 $email = service('email');
 			 $email->setFrom('no-replay@fooddelivery.com.br', 'Food Delivery');
 			 $email->setTo($pedido->email);

 			 $email->setSubject("Pedido $pedido->codigo foi cancelado.");

 			$mensagem = view('Admin/Pedidos/pedido_foi_cancelado_email', ['pedido' => $pedido]);
 		 $email->setMessage($mensagem);
 			$email->send();
 	 }


	 private function insereProdutosDoPedido(object $pedido){

		 $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

		 $produtos = unserialize($pedido->produtos);

		 /* Receba o push */

		 $produtosDoPedido = [];
		    foreach ($produtos as $produto){
					array_push($produtosDoPedido, [
						'pedido_id' => $pedido->id,
						'produto' => $produto['nome'],
						'quantidade' => $produto['quantidade'],

					]);

				}

			$pedidoProdutoModel->insertBatch($produtosDoPedido);


	 }




}
