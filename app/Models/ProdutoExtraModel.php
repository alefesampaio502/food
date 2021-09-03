<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoExtraModel extends Model
{

	protected $table                = 'produtos_extras';
	protected $returnType           = 'object';

	protected $protectFields        = true;
	protected $allowedFields        = ['produto_id','extra_id'];

	//Validações
	 protected $validationRules    = [

	 'extra_id'    => 'required|integer',

];

protected $validationMessages = [

 'extra_id'        => [
		'required' => 'O campo Extra e obrigatório',
			],
	];

/*
   @Descrição : recupera os produtos em questão
	 @uso controller Admin/Produtos/extras($id = null)
	 @param int $produto
	 @param int $quantidade_paginacao quantidade de paginação
*/
public function buscarExtrasDoProduto(int $produto_id = null, int $quantidade_paginacao = null){
		 return $this->select('extras.nome AS extra, extras.preco, produtos_extras.*')
								 ->join('extras', 'extras.id = produtos_extras.extra_id')
								 ->join('produtos', 'produtos.id = produtos_extras.produto_id')
								 ->where('produtos_extras.produto_id', $produto_id)
								 ->paginate($quantidade_paginacao);
		}

		/*
		   @Descrição : recupera os produtos em questão
			 @uso controller Produtos/detalhes e Produto/exibeTamanhos
			 @param int $produto_id
			 @param array objetos
		*/

		public function buscarExtrasDoProdutoDetalhes(int $produto_id = null){
				 return $this->select('extras.id, extras.nome, extras.preco, produtos_extras.id AS id_principal')
										 ->join('extras', 'extras.id = produtos_extras.extra_id')
										 ->join('produtos', 'produtos.id = produtos_extras.produto_id')
										 ->where('produtos_extras.produto_id', $produto_id)
										 ->findAll();
				}
}
