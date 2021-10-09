<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
	private $pedidoModel;
	private $usuarioModel;
	private $entregadorModel;
	private $pedidoProdutoModel;

	public function __construct() {

		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->entregadorModel = new \App\Models\EntregadorModel();
		$this->pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

	}
	public function index()
	{
		//
		$data = [
		'titulo' => 'Home da área restrita',
		'valorPedidosEntregues' => $this->pedidoModel->valorPedidosEntregues(),
		'valorPedidosCancelados' => $this->pedidoModel->valorPedidosCancelados(),
		'valorPedidosCancelados' => $this->pedidoModel->valorPedidosCancelados(),
		'totalClientesAtivo' => $this->usuarioModel->recuperTotalClientesAtivo(),
		'totalEntregadoresAtivo' => $this->entregadorModel->recuperTotalEntregadoresAtivo(),

		'produtosMaisVendidos' => $this->pedidoProdutoModel->recuperaProdutosMaisVendidos(5),
		'topClientes' => $this->pedidoModel->recuperaClientesMaisTop(5),
		'topEntregadores' => $this->entregadorModel->recuperaEntregadoresMaisTop(5),
	];

	$novosPedidos = $this->pedidoModel->where('situacao', 0)->orderBy('criado_em', 'DESC')->findAll();
 		if(!empty($novosPedidos)){
			 $data['novosPedidos'] = $novosPedidos;
 	 	}

	//  dd($data['topClientes']);

		echo view('Admin/Home/index',$data);

	}
}
