
<div class='topo' style='background-image: url("<?=BASE_URL?>assets/img/topo.jpg")'>
	<div class='titulo-container'>
                  
    <h1 class="titulo-style"><i>Mini Blog</i></h1>
    
  </div>
</div>


<div class='container-fluid' style='padding-top: 20px'>	

	<?php		
      foreach($postagens as $postagem) {
    ?>
    	<div class='row'>

	    	<div class='col-md-2 col-md-offset-1'>
	          <img src='<?= BASE_URL2.'assets/img/posts/'.$postagem['foto'] ?>' width='130' height='120'/>
	        </div>

	        <div class='col-md-7'>
	          <h3>
	            <a href='<?=BASE_URL?>postagens/visualizar/<?= $postagem['id'] ?>'>
	              <?= $postagem['titulo'] ?>
	            </a>
	          </h3>

	          <br/>

	          <p><?= substr($postagem['conteudo'], 0, 100).'...' ?></p>
	        </div>

    	</div>

    	<hr/>

    <?php
      }
    ?>

    <div class='pagination-style'>

      <?php
        // Paginação

        for($i=1; $i<=$paginas; $i++){
      ?>                       <!--  $i = redireciona para a mesma página enviando um $_GET[$i] -->
          <a href='<?=BASE_URL?>?p=<?= $i ?>'>[<?= $i ?>]</a>
                                            <!-- $i = Exibe o número da página atual -->
      <?php
        }
      ?>

    </div>
		
</div>



