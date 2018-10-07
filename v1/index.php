<?php
session_start();
require 'conexao.php';
require 'classes/Usuario.php';
?>

<html>
  <head>
    <link rel='stylesheet' type='text/css' href='assets/css/bootstrap.min.css'/>
    <link rel='stylesheet' type='text/css' href='assets/css/layout.css'/>
    <title>Mini Blog</title>
  </head>

  <?php

    if(isset($_POST['login']) && !empty($_POST['login'])){
      $login = addslashes($_POST['login']);
      $senha = addslashes($_POST['senha']);

      $usuario = new Usuario();

      if($usuario->login($login, $senha)){

        header('Location: sistema.php');

      }else{
  ?>
        <div class='alert alert-danger'>Usuário OU senha inválidos!</div>

  <?php
    }
  }
  ?>

  <body>

    <div class='container'>

    <h3>Login</h3>

    <div class='jumbotron'>

      <form method='POST'>

        <div class='form-group'>
          <label for='login'>Usuário:</label>
          <input type='text' name='login' id='login' class='form-control'/>
        </div>

        <div class='form-group'>
          <label for='senha'>Senha:</label>
          <input type='password' name='senha' id='senha' class='form-control'/>
        </div>

        <div class='form-group'>
          <input type='submit' value='Entrar' class='btn btn-default'/>
        </div>

      </form>

      <strong>Usuário: admin</strong>
        <br/>
      <strong>Senha: admin</strong>

    </div>
  </div>

  </body>

</html>
