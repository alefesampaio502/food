<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Token;
	class UsuarioModel extends Model
	{
				 protected $table                	= 'usuarios';
				 protected $returnType           	= 'App\Entities\Usuario';
				 protected $allowedFields        	= ['nome','email','cpf','telefone','password','reset_hash','reset_expira_em','ativacao_hash'];

				 //Datas
				 protected $useTimestamps 				= true;
				 protected $createdField  				= 'criado_em';
				 protected $updatedField  				= 'atualizado_em';
				 protected $dateFormat  			  	= 'datetime'; ///Para Uso com Software $deletedField
				 protected $useSoftDeletes       	= true;
				 protected $deletedField  				= 'deletado_em';

				 //Validações
				 protected $validationRules    = [
				 'nome'     => 'required|min_length[4]|max_length[120]',
				 'email'        => 'required|valid_email|is_unique[usuarios.email]',
				 'cpf'        => 'required|exact_length[14]|validaCpf|is_unique[usuarios.cpf]',
				 'password'     => 'required|min_length[6]',
				 'password_confirmation' => 'required_with[password]|matches[password]'
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

		//Eventos callback
	  protected $beforeInsert = ['hashPassword'];
	  protected $beforeUpdate = ['hashPassword'];

		protected function hashPassword(array $data){
			if(isset($data['data']['password'])){

				$data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
	     unset($data['data']['password']);
	     unset($data['data']['password_confirmation']);
		}

	  return $data;
	}

	//uso do Controllers do métdo pprocurar  traves do auto complete///
		// procurar usuarios no para request usar
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

  public function desabilitaValidacaoSenha(){
	    	unset($this->validationRules['password']);
	    	unset($this->validationRules['password_confirmation']);

			}

	public function desabilitaValidacaoTelefone(){
			unset($this->validationRules['telefone']);
	}

   public function desfazerExclusao(int $id){
				return $this->protect(false)
				->where('id', $id)
				->set('deletado_em', null)
				->update();
			}
			// Uso pela classe Autenticacao
			// @para string $email
			// return objeto $usuario
			public function buscaUsuarioPorEmail(string $email){
				return $this->where('email', $email)->first();

		 }

   public function buscaUsuarioParaResetarSenha(string $token){

      $token = new Token ($token);

			 $tokenHash = $token->getHash();

			 $usuario = $this->where('reset_hash', $tokenHash)->first();

			   if ($usuario != null) {
					   //
              //Verificamos se o token não está expirando de acordo com a data atuais
						//
			   	if ($usuario->reset_expira_em < date('Y-m-d H:i:s')) {
						//
						 //Token está eexpirado, então setamos o $ususuario = null
					 //
			   	    $usuario = null;
			   	}
					 return $usuario;
			   }

		 }

   public function ativaContaPeloToken(string $token){

		  $token = new Token ($token);

			$token_hash = $token->getHash();

			$usuario = $this->where('ativacao_hash', $token_hash)->first();

			   if($usuario != null){

					 $usuario->ativar();

					 $this->protect(false)->save($usuario);

				 }

	 }

	 public function recuperTotalClientesAtivo(){
		 return $this->where('is_admin', false)
		 						->where('ativo', true)
								->countAllResults();// Pegar objetos inteiros para busca de usuários


	 }


	}
