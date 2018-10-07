<?php
session_start();
require 'conexao.php';
require 'classes/Postagem.php';

  if(empty($_SESSION['login'])){
    header('Location: index.php');
  }

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);

  }else{
    header('Location: sistema.php');
  }

  $p = new Postagem();
  $p->deletaPostagem($id);

  header('Location: sistema.php');
  exit;
?>
