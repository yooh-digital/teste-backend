<?php

class postagensController extends controller{
  
  public function index(){}

  public function visualizar($idPostagem){

    $dados = array();    

    if($idPostagem){

        $idPostagem = addslashes($idPostagem);

        $p = new Postagens();
        $dados['postagem'] = $p->getPostagem($idPostagem); 

        $i = new Internauta();
        $dados['comentarios'] = $i->getComentarios($idPostagem);

        $this->loadTemplate('visualizar-postagem', $dados);

    }else{
        header('Location: http://localhost/teste-backend/v2/blog/home');
    }

  }
  
}
