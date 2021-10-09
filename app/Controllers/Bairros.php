<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bairros extends BaseController{
	private $bairroModel;
	private $produtoModel;
	private $sistemaModel;

	public function __construct(){

		$this->bairroModel = new \App\Models\BairroModel();
			$this->produtoModel = new \App\Models\ProdutoModel();
			$this->sistemaModel = new \App\Models\SistemaModel();

	}
	public function index()
	{
		$data =[
			'titulo' =>  'Bairros que atendemos em Imperatriz - MA',
			'produtos' => $this->produtoModel->buscaProdutosWebHome(),
			'bairros' => $this->bairroModel->where('ativo', true)->findAll(),
			'sistemas' => $this->sistemaModel->where('ativo', true)->findAll(),
		];

		return view('Bairros/index', $data);
	}
}
