<?php

class postagensController extends controller{
  
  public function index(){}

  public function submitPostagem(){
    $check = false;    

    if(!isset($_POST['usuario']) || empty($_POST['usuario'])){

      header("Content-Type: application/json");
      echo json_encode($check);  

    }elseif(!isset($_FILES['foto']) || $_FILES['foto']['error'] == 4){

      $check = 'foto empty';

      header("Content-Type: application/json");
      echo json_encode($check); 

    }else{

      $idUsuario = base64_decode($_POST['usuario']);
      $titulo = addslashes($_POST['titulo']);
      $conteudo = addslashes($_POST['conteudo']);
      $foto = $_FILES['foto'];

      $p = new Postagens();
      $check = $p->adicionarPostagem((int)$idUsuario, $titulo, $conteudo, $foto);

      header("Content-Type: application/json");
      echo json_encode($check); 

    }
    
  }

  public function selecionarPostagem(){
    $array = array();

    if(isset($_GET['id_postagem']) && !empty($_GET['id_postagem'])){

      $idPostagem = addslashes($_GET['id_postagem']);

      $p = new Postagens();
      $array = $p->getPostagem($idPostagem);

    }    

    header("Content-Type: application/json");
    echo json_encode($array); 
  }

  public function atualizarPostagem(){
    $check = false;

    if(isset($_POST['id_postagem']) && !empty($_POST['id_postagem'])){

      $idPostagem = addslashes($_POST['id_postagem']);
      $titulo = addslashes($_POST['titulo']);
      $conteudo = addslashes($_POST['conteudo']);

      $p = new Postagens();
      $check = $p->updatePostagem($idPostagem,$titulo,$conteudo);

    }    

    header("Content-Type: application/json");
    echo json_encode($check); 
  }

  public function atualizarFotoPostagem(){
    $resultado = array();
    $resultado['check'] = false;

    if(!isset($_FILES['foto']) || $_FILES['foto']['error'] == 4){
      
      $resultado['check'] = 'foto empty';
      
    }else{

      $idPostagem = addslashes($_POST['postagem_id']);
      $foto = $_FILES['foto'];

      $p = new Postagens();
      $resultado['foto'] = $p->updateFotoPostagem($idPostagem,$foto);
      
      if($resultado['foto'] != false){

        $resultado['check'] = true;

      }      

    }

    header("Content-Type: application/json");
    echo json_encode($resultado); 
  }

  public function excluirPostagem(){
    $check = false;

    if(isset($_POST['id_postagem']) && !empty($_POST['id_postagem'])){

      $idPostagem = addslashes($_POST['id_postagem']);

      $p = new Postagens();
      $check = $p->deletaPostagem($idPostagem);

    }

    header("Content-Type: application/json");
    echo json_encode($check); 
  }

  public function adicionarComentarios(){
    $check = false;

    if(isset($_POST['id_postagem']) && !empty($_POST['id_postagem'])){

      $idPostagem = addslashes($_POST['id_postagem']);
      $idPostagem = (int)base64_decode($idPostagem);
      $nome = addslashes($_POST['nome']);
      $email = addslashes($_POST['email']);
      $comentario = addslashes($_POST['comentario']);

      $i = new Internauta();
      $check = $i->addComentario($nome, $email, $comentario, $idPostagem);

    }

    header("Content-Type: application/json");
    echo json_encode($check);   
  }
  
}
