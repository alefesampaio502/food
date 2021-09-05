<?php

namespace App\Models;

use CodeIgniter\Model;

class MedidaModel extends Model
{

	protected $table                = 'medidas';

	protected $returnType           = 'App\Entities\Medida';

	protected $useSoftDeletes       = True;
	protected $allowedFields        = ['nome','descricao','ativo'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'criado_em';
	protected $updatedField         = 'atualizado_em';
	protected $deletedField         = 'deletado_em';

	// Validation
		protected $validationRules = [
					'nome' => 'required|min_length[2]|max_length[120]|is_unique[medidas.nome]',
			];
			protected $validationMessages = [
					'nome' => [
							'required' => 'O campo Nome é obrigatório.',
							'is_unique' => 'Essa medida já existe.',
					],

			];

			//uso do Controllers do métdo procurar  traves do auto complete///
				// procurar Medidas no para request usar
				 public function procurar($term){

					 if($term === null){
							return [];

					 }

					 return $this->select('id, nome')
								->like('nome', $term)
								->withDeleted(true)
								->get()
								->getResult();

				 }

				 public function desfazerExclusao(int $id){
					return $this->protect(false)
					->where('id', $id)
					->set('deletado_em', null)
					->update();
				}


		/*
		@Uso : controller Produto/exibeValor
		@param : $medida_id
		@retuen :objeto contendo o maior valor
		*/
	public function exibeValor(int $medida_id){

			return $this->select('medidas.nome')->selectMax('produtos_especificacoes.preco')//Buscamos o maior valor de preço entre produtos customizados
									->join('produtos_especificacoes','produtos_especificacoes.medida_id = medidas.id')
									->where('medidas.id', $medida_id)
									->where('medidas.ativo', true)
									->first();


				}


}
