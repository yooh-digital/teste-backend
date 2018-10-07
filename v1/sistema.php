<?php
session_start();

if(empty($_SESSION['login'])){
  header('Location: index.php');
  exit;
}

require 'header.php';
require 'classes/Postagem.php';

$p = new Postagem();

// Preparando a paginação
$totalPostagens = $p->getTotalPostagens();

$paginas = ceil($totalPostagens / 3); // Cálculo do total de páginas, ceil() = arredonda resultado para cima

$pg = 1; // Número inicial da primeira página

if(isset($_GET['p']) && !empty($_GET['p'])){
  $pg = addslashes($_GET['p']); // Define o novo número da página atual
}

$postagemPorPagina = ($pg - 1) * 3; // Define o total de postagens para cada página, no caso, 3.

$postagens = $p->getListaPostagens($postagemPorPagina);

?>

  <div class='container'>

    <a href='add-postagem.php' class='btn btn-primary'>
      Nova Postagem
    </a>

    <?php
      foreach($postagens as $postagem) {
    ?>

    <br/><br/>

    <hr/>

    <div class='row'>

      <?php
        if(empty($postagem['foto'])){
      ?>
        <div class='col-sm-3'>
          <img src='assets/imagens/default.png' width='130'/>
        </div>

      <?php
        }else{
      ?>
        <div class='col-sm-3'>
          <img src='assets/imagens/<?= $postagem['foto'] ?>' width='130'/>
        </div>

      <?php
        }
      ?>

        <div class='col-sm-9'>
          <h3>
            <a href='postagem-detalhe.php?id=<?= $postagem['id'] ?>'>
              <?= $postagem['titulo'] ?>
            </a>
          </h3>

          <br/>

          <p><?= substr($postagem['conteudo'], 0, 100).'...' ?></p>
        </div>

    </div>

    <?php
      }
    ?>

    <hr/>

    <div class='centralizar'>

      <?php
        // Paginação

        for($i=1; $i<=$paginas; $i++){
      ?>                       <!--  $i = redireciona para a mesma página enviando um $_GET[$i] -->
          <a href='sistema.php?p=<?= $i ?>'>[<?= $i ?>]</a>
                                            <!-- $i = Exibe o número da página atual -->
      <?php
        }
      ?>

    </div>

  </div>

<?php
  require 'footer.php';
?>
