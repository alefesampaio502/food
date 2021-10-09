<?php

namespace App\Controllers;

class Home extends BaseController {

	private $categoriaModel;
	private $produtoModel;
	private $sistemaModel;

	public function __construct() {
			$this->categoriaModel = new \App\Models\CategoriaModel();
			$this->produtoModel = new \App\Models\ProdutoModel();
			$this->sistemaModel = new \App\Models\SistemaModel();

	}

	public function index()
	{

		$data = [
			'titulo' => 'Seja muito bem vinda(a)',
			'categorias' => $this->categoriaModel->BuscaCategoriasWebHome(),
			'produtos' => $this->produtoModel->buscaProdutosWebHome(),
			//'sistemas' => $this->sistemaModel->procurar(),
			'sistemas' => $this->sistemaModel->where('ativo', true)->findAll(),
		];


		return view('Home/index', $data);
	}


}
