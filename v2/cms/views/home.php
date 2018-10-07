<?php 

require 'topo.php';

    if(isset($postagens[0]['titulo']) && !empty($postagens[0]['titulo'])){
        
?>

  <div class='container'>

    <div class='row'>
      <div class='col-md-12'>
        
        <a href="<?=BASE_URL?>home/postagem" class='btn btn-lg btn-primary'><i class="fas fa-plus"></i> Nova Postagem</a>

      </div>
    </div>

    <hr/>

    <div class="table-responsive">
       <table class='table table-striped table-hover table-bordered'>
        <thead>
          <tr>
            <th>Cod.</th>
            <th>Imagem</th>
            <th>Título</th>
            <th>Postado em:</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>

          <?php 

          $count = 1;

          foreach($postagens as $post){ 

          ?>

            <tr class='row-table' id='row-<?=$count?>'>
              <td class='td-id' id='postagem-<?=$count?>'><?= $post['id'] ?></td>
              <td class='td-foto'>
                <img src='<?= BASE_URL.'assets/img/posts/'.$post['foto'] ?>' width='75px' height='70px'>
              </td>
              <td class='td-titulo'><?= $post['titulo'] ?></td>
              <td><?= date('d/m/Y \à\s H:i:s', strtotime($post['data_postagem'])) ?></td>
              <td class='td-actions'>
                <a href='http://localhost/teste-backend/v2/blog/home' class='btn btn-sm btn-success btn-abrir' target='_blank'>
                  <i class="fas fa-external-link-alt"></i> Abrir
                </a>

                <a href="#" data-toggle="modal" data-target="#editar-postagem" data-postagem="<?= $post['id'] ?>" class='btn btn-sm btn-warning btn-editar'>
                  <i class="fas fa-wrench"></i> Editar
                </a>

                <a href='javascript:void(0)' class='btn btn-sm btn-danger' onclick='excluirPostagem(<?=$count?>)'>
                  <i class="far fa-trash-alt"></i> Excluir
                </a>
              </td>
            </tr>

          <?php 

            $count++;

            } 

          ?>  

        </tbody>
      </table>
    </div>   

  </div>  

<?php

    }else{

?>
    <div class='container'>
        <div class='row' style="margin-top: 50px">
            <div class='col-md-12'>
                <div class='empty-container'>

                   <h2>Olá <?= ($postagens['usuario'])?''.$postagens['usuario'].'!':','?></h2>               

                   <h4>Você ainda não possui postagens...</h4>

                   <i class="far fa-frown"></i>

                   <br/>

                   <a href="<?=BASE_URL?>home/postagem" class='btn btn-lg btn-primary'><i class="fas fa-plus"></i> Nova Postagem</a>

                </div>            
            </div>
        </div>
    </div>
<?php
    }
?>

<!-- Modal de confirmação de exclusão da postagem -->

<div id="dialog-excluir"> 

  <h4 style="margin-top: 30px;"><span class="ui-icon ui-icon-alert"></span> Deseja realmente excluir essa postagem?</h4>

</div>

<?php 
	require 'modal/editar_postagem.php';
	
?>



