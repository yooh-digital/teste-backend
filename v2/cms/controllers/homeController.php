<?php

class homeController extends controller{
  
  public function index(){

  	if(empty($_SESSION['login'])){

  		header('Location: http://localhost/teste-backend/v2/cms/login');
  		exit;
  	}  	

    $dados = array();

    $posts = new Postagens();

    $dados['postagens'] = $posts->getPostagensPorUsuario($_SESSION['login']);

    $this->loadTemplate('home', $dados);
  }

  public function postagem(){
    $array = array();

    $this->loadTemplate('novaPostagem', $array);
  }

  public function logout(){

    unset($_SESSION['login']);
    header('Location: http://localhost/teste-backend/v2/cms/login');
    exit;
  }

}
