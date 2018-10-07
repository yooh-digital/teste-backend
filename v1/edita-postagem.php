<?php
session_start();

if(empty($_SESSION['login'])){
  header('Location: sistema.php');
}

require 'header.php';
require 'classes/Postagem.php';

$p = new Postagem();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $idPostagem = addslashes($_GET['id']);
    $postagem = $p->getPostagem($idPostagem);

  }else{
    header('Location: sistema.php');
}

if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
  $titulo = addslashes($_POST['titulo']);
  $conteudo = addslashes($_POST['conteudo']);

  if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];
  }else{
    $foto = array();
  }

  $p->editaPostagem($titulo, $conteudo, $foto, $idPostagem);
?>
  <script type='text/javascript'>window.location.href='postagem-detalhe.php?id<?= $idPostagem ?>'</script>

<?php
  }
?>

<div class='container'>
  <h3>Editar Postagem</h3>

  <form method='POST' enctype='multipart/form-data'>

    <div class='form-group'>
      <label for='titulo'>Título</label>
      <input type='text' id='titulo' name='titulo' value='<?= $postagem['titulo'] ?>' class='form-control' required/>
    </div>

    <div class='form-group'>
      <label for='conteudo'>Conteúdo</label>
      <textarea name='conteudo' id='conteudo' rows='10' class='form-control' required>
        <?= $postagem['conteudo'] ?>
      </textarea>
    </div>

    <div class='form-group'>
      <label for='foto'>Foto</label>
      <input type='file' name='foto' id='foto' class='form-control' required/>
    </div>

    <div class='form-group'>
      <input type='submit' value='Atualizar' class='btn btn-primary' />
    </div>

  </form>

</div>

<?php
  require 'footer.php';
?>
