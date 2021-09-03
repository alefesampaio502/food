<?php

namespace App\Models;

use CodeIgniter\Model;

class EntregadorModel extends Model
{

	protected $table                = 'entregadores';


	protected $returnType           = 'App\Entities\Entregador';
	protected $useSoftDeletes       = true;

	protected $allowedFields        = [
		'nome',
		'cpf',
		'cnh',
		'email',
		'telefone',
		'imagem',
		'ativo',
		'veiculo',
		'placa',
		'endereco',
	];




	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'criado_em';
	protected $updatedField         = 'atualizado_em';
	protected $deletedField         = 'deletado_em';

	// Validation

					 //Validações
					 protected $validationRules    = [
					 'nome'     => 'required|min_length[4]|max_length[250]',
					 'email'        => 'required|valid_email|is_unique[entregadores.email]',
					 'cpf'        => 'required|exact_length[14]|validaCpf|is_unique[entregadores.cpf]',
					 'cnh'        => 'required|exact_length[11]|is_unique[entregadores.cnh]',
					 'telefone'   => 'required|max_length[15]|is_unique[entregadores.telefone]',
					 'endereco'   => 'required|max_length[250]',
					 'veiculo'   => 'required|max_length[250]',
					 'placa'   => 'required|min_length[7]|max_length[8]|is_unique[entregadores.placa]',


			 ];

			 protected $validationMessages = [

				 'nome'        => [
						'required' => 'O campo Nome e obrigatório',
				],
					 'email'        => [
							 'is_unique' => 'Desculpe esse e-mail já eexiste.',
							 'required' => 'O campo Email e obrigatório.',
					 ],

					 'cpf'        => [
							'is_unique' => 'Desculpe esse cpf já eexiste.',
							'required' => 'O campo CPF e obrigatório.',
					],

					'telefone'        => [

						 'required' => 'O campo Telefone e obrigatório.',
				 ],

			 ];



			 //uso do Controllers do métdo pprocurar  traves do auto complete///
		 		// procurar entregadores no para request usar
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
}
