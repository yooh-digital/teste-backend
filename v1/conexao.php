<?php

  global $pdo;

  try{
    $pdo = new PDO('mysql:dbname=mini-blog;host=localhost;charset=utf8','root','');

  }catch(PDOException $ex){
    echo 'Erro de conexão: '.$ex->getMessage();
    exit;
  }

?>
