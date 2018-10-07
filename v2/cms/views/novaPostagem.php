<?php 

require 'topo.php';
$idUser = base64_encode($_SESSION['login']);

?>

<!-- Inserir breadcrumbs -->


<div class='container'>
	<div class='row'>
        <div class='col-md-12'>
            <div class='postagem-container'>

            	<h3>Nova Postagem</h3>				

            	<form id='form-content' enctype='multipart/form-data'>

					<div class='postagem-descricao'>

						<input type='hidden' name='usuario' value='<?=$idUser?>'/>
						
						<div class='form-group'>						
							<label for='titulo'>Título</label>

							<p id="alert-titulo">O título deve ter no mínino 5 caracteres!</p>

						    <input type='text' id='titulo' name='titulo' class='form-control'/>
						</div>

						<div class='form-group'>						
						    <label for='conteudo'>Conteúdo</label>

						    <p id="alert-text">Seu Post deve ter no mínino 10 caracteres!</p>

						    <textarea name='conteudo' id='conteudo' rows='10' class='form-control'></textarea>
						</div>

					</div>
					

					<div class='postagem-foto'>
						
						<div class='form-group'>
						    <label class='btn btn-sm btn-default' for='foto'><i class="fas fa-plus"></i> Adicionar Foto</label>
						    <input type='file' name='foto' id='foto' onchange='carregarFoto()'/>
						</div>

						<p id="alert-foto">Insira uma foto para sua postagem!</p>

						<hr/>						

						<div id='foto-view'>
							<img src='<?=BASE_URL?>assets/img/image-upload.svg' width='300' height='200' />	
						</div>							
						
					</div>
					
					<div class='postagem-submit'>
						<div class='form-group'>
						    <button class='btn btn-lg btn-primary' id='btn-postagem' onclick='submitPostagem()'><i class="fas fa-check"></i> Postar</button>
						</div>
					</div>				  				

				</form>	

 			</div>            
        </div>
    </div>
</div>