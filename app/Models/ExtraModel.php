<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtraModel extends Model
{
	protected $table                = 'extras';

	protected $returnType           = 'App\Entities\Extra';
	protected $useSoftDeletes       = True;
	protected $allowedFields        = ['nome','slug','preco','descricao','ativo'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'criado_em';
	protected $updatedField         = 'atualizado_em';
	protected $deletedField         = 'deletado_em';

	// Validation
		protected $validationRules = [
					'nome' => 'required|min_length[2]|max_length[120]|is_unique[extras.nome]',
			];
			protected $validationMessages = [
					'nome' => [
							'required' => 'O campo Nome é obrigatório.',
							'is_unique' => 'Essa extra já existe.',
					],

			];
	//Eventos callback
	protected $beforeInsert = ['criaSlug'];
	protected $beforeUpdate = ['criaSlug'];

	protected function criaSlug(array $data){
	if(isset($data['data']['nome'])){

	 $data['data']['slug'] = mb_url_title($data['data']['nome'], '-', TRUE);

	}

	return $data;
	}

	//uso do Controllers do métdo pprocurar  traves do auto complete///
		// procurar extras no para request usar
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