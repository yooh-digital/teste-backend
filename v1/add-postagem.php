<?php
session_start();

if(empty($_SESSION['login'])){
  header('Location: sistema.php');
}

require 'header.php';
require 'classes/Postagem.php';

if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
  $titulo = addslashes($_POST['titulo']);
  $conteudo = addslashes($_POST['conteudo']);

  if(isset($_FILES['foto'])){
      $foto = $_FILES['foto'];
    }else{
      $foto = array();
    }

  $postagem = new Postagem();

  $postagem->addPostagem($_SESSION['login'], $titulo, $conteudo, $foto);

  header('Location: sistema.php');
  exit;
}
?>

  <div class='container'>
    <h3>Nova Postagem</h3>

    <form method='POST' enctype='multipart/form-data'>

      <div class='form-group'>
        <label for='titulo'>Título</label>
        <input type='text' id='titulo' name='titulo' class='form-control' required/>
      </div>

      <div class='form-group'>
        <label for='conteudo'>Conteúdo</label>
        <textarea name='conteudo' id='conteudo' rows='10' class='form-control' required></textarea>
      </div>

      <div class='form-group'>
        <label for='foto'>Foto</label>
        <input type='file' name='foto' id='foto' class='form-control'/>
      </div>

      <div class='form-group'>
        <input type='submit' value='Postar' class='btn btn-primary' />
      </div>

    </form>

  </div>

<?php
  require 'footer.php';
?>
