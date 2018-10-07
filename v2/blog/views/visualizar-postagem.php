
<div class='container'>    

    <div class='jumbotron postagem-content'>

    	<div class='text-center'>
      		<h3><?= $postagem['titulo'] ?></h3>

      		<img src='<?=BASE_URL2?>assets/img/posts/<?= $postagem['foto'] ?>' width='400'/>
		</div> 

		<hr/>     		      

      <p><?= $postagem['conteudo'] ?></p>

    </div>    

    <div class='panel panel-primary'>

      <div class='panel-heading'><h3><i class="far fa-comment"></i> Poste seu comentário aqui</h3></div>
      <div class='panel-body'>

        <form id='comentarios'>

        	<input type='hidden' id='idPostagem' value='<?=base64_encode($postagem['id'])?>'/>	
	      <div class='form-group'>
	        <label for='nome'>Nome</label>

	        <p id="alert-nome">O nome é obrigatório!</p>
	        <input type='text' id='nome' name='nome' class='form-control' required/>
	      </div>

          <div class='form-group'>
            <label for='email'>E-Mail</label>

            <p id="alert-email">O email é obrigatório!</p>
            <input type='email' id='email' name='email' class='form-control' required/>
          </div>

          <div class='form-group'>
            <label for='comentario'>Comentário</label>

            <p id="alert-comentario">O comentário é obrigatório!</p>
            <textarea name='comentario' id='comentario' rows='5'  minlength='3' class='form-control' required></textarea>
          </div>

          <div class='form-group text-center'>
            <button class='btn btn-primary' id='btn-comentario'><i class="fas fa-check"></i> Enviar Comentário</button>
          </div>

        </form>

      </div>
    </div>

  	<div class='panel panel-primary'>

    	<div class='panel-heading'>
    		<h3><i class="far fa-comments"></i> Comentários</h3>
    	</div>
    	<div class='panel-body'>    

    		<?php 
    			if($comentarios){   

    				foreach($comentarios as $comentario){ 				
    		?>    		
		    			<div class='row'>
		    				<div class='col-md-12'>
		    					<h4 class='text-center'>
		    						<strong><?=$comentario['nome']?></strong>
		    					</h4>

		    					<h4>Comentado em:<?=' '.date('d/m/Y \à\s H:i:s', strtotime($comentario['data_comentario']))?></h4>
						        <h4>E-Mail:<?=' '.$comentario['email'] ?></h4>
						        <h4>Comentário:<?=' '.$comentario['comentarios'] ?></h4>
		    				</div>
		    			</div>

		    			<hr/>
    		<?php
    				}	

    			}else{
    		?>
    		
    			<div class='row'>
    				<div class='col-md-12 comentarios-empty'>
    					<h3>Esse Post ainda não foi comentado <i class="far fa-frown"></i></h3>

    					<i class="fas fa-bullhorn"></i>
    				</div>
    			</div>

    		<?php		
    			}
    		?>

    	</div>
    </div>    
    	
</div>