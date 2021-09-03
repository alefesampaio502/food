<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Entities\FormaPagamento;
class FormasPagamento extends BaseController{

private $formaPagamentoModel;
public function __construct(){
   $this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();

}
public function index()
{
	$data = [
		'titulo' => 'Listando as Formas de pagamentos',
			'formas' => $this->formaPagamentoModel->withDeleted(true)->paginate(10),
			'pager' => $this->formaPagamentoModel->pager,
	];
	return view('Admin/FormasPagamento/index', $data);
}
public function procurar(){
	if (!$this->request->isAJAX()){
		exit('Página não encontrada');
	}
	$formas = $this->formaPagamentoModel->procurar($this->request->getGet('term'));
	 $retorno = [];
	 foreach ($formas as $forma) {
		$data['id'] = $forma->id;
		$data['value'] = $forma->nome;
		$retorno[] = $data;
	 }
	return  $this->response->setJSON($retorno);
}

//Métodos criar
public function criar(){
	$formaPagamento = new FormaPagamento();
	$data = [
		'titulo' => "Cadastrando a forma forma de pagamento",
		'forma' => $formaPagamento,
			];
			 // dd($formaPagamento);
	 return view('Admin/FormasPagamento/criar',$data);
		}

		//cadastrando
		public function cadastrar(){
			if ($this->request->getMethod() === 'post') {

				// Passando todo os dados para do construtor do via post
				$formaPagamento = new FormaPagamento($this->request->getPost());

						 if($this->formaPagamentoModel->save($formaPagamento)){
							 return redirect()->to(site_url("admin/formas/show/". $this->formaPagamentoModel->getInsertID()))
							 ->with('sucesso',"Forma de pagamento $formaPagamento->nome cadastranda com sucesso!");
							 }else{
							 return redirect()->back()
							 ->with('errors_model', $this->formaPagamentoModel->errors())
							 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
							 ->withInput();
						}
				// dd($this->request->getPost());
			}else{
				return redirect()->back();
			}
		}

//Métodos show
public function show($id = null){
		$formaPagamento = $this->buscaFormaPagamentoOu404($id);
		$data = [
			'titulo' => "Detalhando as formas $formaPagamento->nome",
			'forma' => $formaPagamento,
				];
			 // dd($formaPagamento);
		 return view('Admin/FormasPagamento/show',$data);

			}
		//Métodos Editar
		public function editar($id = null){
			$formaPagamento = $this->buscaFormaPagamentoOu404($id);
			$data = [
				'titulo' => "Ediatando a forma $formaPagamento->nome",
				'forma' => $formaPagamento,
					];
					 // dd($formaPagamento);
			 return view('Admin/FormasPagamento/editar',$data);
				}

				//Atualizar a pagina
				public function atualizar($id = nul){
					if ($this->request->getMethod() === 'post') {
						$formaPagamento = $this->buscaFormaPagamentoOu404($id);
						$formaPagamento->fill($this->request->getPost());
						  if(!$formaPagamento->hasChanged()){
								 return redirect()->back()->with('info','Nâo há dados para atatualizar!');
								 }
								 if($this->formaPagamentoModel->save($formaPagamento)){
									 return redirect()->to(site_url("admin/formas/show/$formaPagamento->id"))
									 ->with('sucesso',"Forma de pagamento $formaPagamento->nome atualizada com sucesso!");
									 }else{
									 return redirect()->back()
									 ->with('errors_model', $this->formaPagamentoModel->errors())
									 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
									 ->withInput();
								}
						// dd($this->request->getPost());
					}else{
						return redirect()->back();
					}
				}
		// return objeto formas pagamento //

		//excluir novo cadastro de formaPagamento
		public function excluir($id = null){

			$formaPagamento = $this->buscaformaPagamentoOu404($id);

			if($formaPagamento->deletado_em != null){
				return redirect()->back()->with('info', "A forma de pagamento<b> $formaPagamento->nome</b> já encontra-se excluida.");
			}

			if($formaPagamento->id === 1){
				return redirect()->back()->with('info','Não é Possível excluir essa  <b>forma de pagamento</b>');
			}

			if($this->request->getMethod() === 'post'){
				 $this->formaPagamentoModel->delete($id);
				 return redirect()->to(site_url('admin/formas'))->with('sucesso', "forma dep pagamento $formaPagamento->nome; excluida ccom sucesso!");
			}

			$data = [

				'titulo' => "Excluindo a forma de pagamento $formaPagamento->nome",
				'forma' => $formaPagamento,

			];


			 return view('Admin/FormasPagamento/excluir',$data);


				}

				public function desfazerExclusao($id = null){

					$formaPagamento = $this->buscaformaPagamentoOu404($id);
						if($formaPagamento->deletado_em == null){
							return redirect()->back()->with('info',"Apenas forma de pagamento $formaPagamento->nome excluidas podem ser recuperadas!")	;
						}
						 if($this->formaPagamentoModel->desfazerExclusao($id)){
							 return redirect()->back()->with('sucesso','Exclusão desfeita com sucesso!')	;
						 }else{
							 return redirect()->back()
										 ->with('errors_model', $this->formaPagamentoModel->errors())
										 ->with('Atencâo', 'Por favor verifique, os erros a baixo!')
										 ->withInput();
				 }

			}



		public function buscaFormaPagamentoOu404(int $id = null) {
			if (!$id || !$formaPagamento = $this->formaPagamentoModel->withDeleted(true)->where('id', $id)->first()) {
				 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a formas de pagamentos $id");				}
			 return $formaPagamento;

		 }
}
