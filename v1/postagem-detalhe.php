<?php
session_start();

if(empty($_SESSION['login'])){
  header('Location: sistema.php');
  exit;
}

require 'header.php';
require 'classes/Postagem.php';
require 'classes/Internauta.php';

$p = new Postagem();

  if(isset($_GET['id']) && !empty($_GET['id'])){
      $idPostagem = addslashes($_GET['id']);
      $postagem = $p->getPostagem($idPostagem);

    }else{
      header('Location: sistema.php');
  }

  $i = new Internauta();

  if(isset($_POST['nome']) && !empty($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $comentario = addslashes($_POST['comentario']);

    $i->addComentario($nome, $email, $comentario, $idPostagem);
?>
    <script type='text/javascript'>window.location.href='postagem-detalhe.php?id=<?= $idPostagem ?>';</script>

<?php
  }
?>

  <div class='container'>

    <a href='edita-postagem.php?id=<?= $idPostagem ?>' class='btn btn-warning'>
      Editar Postagem
    </a>

    <a href='deleta-postagem.php?id=<?= $idPostagem ?>' class='btn btn-danger'>
      Excluir Postagem
    </a>

    <br/><br/>

    <div class='jumbotron'>

      <h3><?= $postagem['titulo'] ?></h3>

      <img src='assets/imagens/<?= $postagem['foto'] ?>' width='250'/>

      <p><?= $postagem['conteudo'] ?></p>

    </div>

    <br/><br/>

    <div class='panel panel-default'>

      <div class='panel-heading'><h3>Poste seu comentário aqui</h3></div>
      <div class='panel-body'>

        <form method='POST'>

          <div class='form-group'>
            <label for='nome'>Nome</label>
            <input type='text' id='nome' name='nome' class='form-control' required/>
          </div>

          <div class='form-group'>
            <label for='email'>E-Mail</label>
            <input type='email' id='email' name='email' class='form-control' required/>
          </div>

          <div class='form-group'>
            <label for='comentario'>Comentário</label>
            <textarea name='comentario' id='comentario' rows='5'  minlength='3' class='form-control' required></textarea>
          </div>

          <div class='form-group'>
            <input type='submit' value='Comentar' class='btn btn-primary' />
          </div>

        </form>

      </div>
    </div>

    <?php
      $internautas = $i->getComentarios($idPostagem);
    ?>

    <div class='panel panel-default'>

      <div class='panel-heading'><h3>Comentários</h3></div>
      <div class='panel-body'>

    <?php
      foreach($internautas as $comentario){
    ?>
        <h4>Nome:<?=' '.$comentario['nome'] ?></h4>
        <h4>E-Mail:<?=' '.$comentario['email'] ?></h4>
        <h4>Comentário:<?=' '.$comentario['comentarios'] ?></h4>

        <br/>

        <hr/>
    <?php
      }
    ?>

      </div>
    </div>
  </div>

<?php
  require 'footer.php';
?>
