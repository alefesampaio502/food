<?php
namespace App\Libraries;
/*
Essa classe cuida da parte da autenticação da aplicação
*Descição

*/

/**
 *
 */
class Autenticacao
{

   private $usuario;

  public function login(string $email, string $password){
    $usuarioModel = new \App\Models\UsuarioModel();

    $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

    /* Se não encontrar usuário por e-mail reretornado false */
    if($usuario === null){
      return false;
    }
    /* Se a não senha não combinar com o papassword_hash, retorna false */
    if(!$usuario->verificaPassword($password)){
      return false;
  }
/* Se usuário não tive ativo não fazer acessar a aplaplicação  reretornado false */
      if(!$usuario->ativo){
            return false;
            }
  /* Nesse ponto está tudo certo e podemos logar uusuário na apaplicação invocando o método abaixo */

        $this->LogaUsuario($usuario);

        /* Retornamos true... tudo certo */

        return true;
}


    public function logout(){

    session()->destroy();

    }
    public function pegaUsuarioLogado(){

      ///Não esquecer de compatilhar instancia com sservice a///
       if($this->usuario === null){
         $this->usuario = $this->pegaUsuarioDaSessao();
       }
       //Retornamos o usuário que foi ddefinido para início da clclasse///
       return $this->usuario;
    }

    /*
    @description: O metedo só permite ficar llogado para aplicação aqueles que ainda existir na base
    e que estaeja ativo.
    @uso: No filtro LoginFilter
    retuen: retorna  true  se o método ppegaUsuarioLogado() não for Null. Ou seja, se o ususuário estiver logado.
     */
    public function estaLogado(){
      return $this->pegaUsuarioLogado() !== null;

    }

  private function pegaUsuarioDaSessao(){
   if(!session()->has('usuario_id')){
     return null;
   }

   //Instanciamos o usuário Models ///
   $usuarioModel = new \App\Models\UsuarioModel();

   //Recuperamos  o usuário de acordo com a chave da sessão ///
   $usuario = $usuarioModel->find(session('usuario_id'));

   //Só retorno usuário se mesmo estiver ativo ///
     if($usuario && $usuario->ativo){
       return $usuario;
     }
  }
   private function logaUsuario(object $usuario){

     $session = session();
     $session->regenerate();
     $session->set('usuario_id', $usuario->id);

  }
}
