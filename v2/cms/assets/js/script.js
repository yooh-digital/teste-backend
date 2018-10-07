$(function(){	

	/* Script Login */	

	$('#login').bind('submit', function(e){
		e.preventDefault();
		var dados = $(this).serialize();				

		$('#alert-login').hide();
		$('#btn-entrar').attr('disabled','disabled');
		$('#btn-entrar').html('Entrando...');		

		$.ajax({
			type:'POST',
			url:'http://localhost/teste-backend/v2/api/usuarios/login',
			data:{dados:dados},
			dataType:'json',
			success:function(data){				

				if(data){

					$('#login').each(function(){
						this.reset();
					});					

					window.location.href = 'http://localhost/teste-backend/v2/cms/home';
				
				}else{

					$('#alert-login').replaceWith('<div class="alert alert-warning text-center" id="alert-login"> <p>Usuário e/ou Senha Inválidos! <i class="fas fa-times"></i></p></div>');

					$('#alert-login').show();

					$('#btn-entrar').attr('disabled', false);
					$('#btn-entrar').html('Entrar <i class="fas fa-sign-in-alt"></i>');
				}				
			}
		});


	});
	

	/* Script Sistema */

	// Carregar dados para edição no modal
	$('#editar-postagem').on('shown.bs.modal', function (e) {
		var idPostagem = $(e.relatedTarget).data('postagem');
		
		$.ajax({
			type:'GET',
			url:'http://localhost/teste-backend/v2/api/postagens/selecionarPostagem',
			data:{id_postagem:idPostagem},
			dataType:'json',
			success:function(data){					

				$('#formulario-editar').replaceWith('<div id="formulario-editar"> <div class="col-md-6 painel-edit"> <div class="postagem-descricao"> <div class="form-group"> <label for="titulo">Título</label> <p id="alert-titulo">O título deve ter no mínino 5 caracteres!</p><input type="text" id="titulo" name="titulo" class="form-control" value="'+data['titulo']+'"/> </div><div class="form-group"> <label for="conteudo">Conteúdo</label> <p id="alert-text">Seu Post deve ter no mínino 10 caracteres!</p><textarea name="conteudo" id="conteudo" rows="10" class="form-control">'+data['conteudo']+'</textarea> </div><div class="text-center"> <div class="form-group"> <button class="btn btn-sm btn-info" id="btn-postagem-update" onclick="updatePostagem('+data['id']+')"><i class="fas fa-check"></i> Atualizar Postagem</button> </div></div></div></div><div class="col-md-6 painel-edit"> <form id="foto-edit" enctype="multipart/form-data"> <input type="hidden" name="postagem_id" value="'+data['id']+'"/> <div class="postagem-foto foto-update"> <p id="alert-foto">Insira uma foto para sua postagem!</p><div id="foto-view"> <img src="assets/img/posts/'+data['foto']+'" width="400" height="290"/> </div><hr/> <div class="form-group text-center"> <label class="btn btn-sm btn-info" for="foto" id="btn-foto-update"><i class="fas fa-plus"></i> Atualizar Foto</label> <input type="file" name="foto" id="foto" onchange="updateFoto()"/> <input type="submit" id="foto-submit" value="Enviar" class="btn btn-default" onclick="submitFoto()"/> </div></div></form> </div></div>');

			}
		});

	});

});


function carregarFoto(){

	$('#alert-foto').hide();

	$('#foto-view').find('img').attr('src', 'http://localhost/teste-backend/v2/cms/assets/img/image.svg');

}

function submitPostagem(){

	$('#form-content').bind('submit', function(e){
		e.preventDefault();			

		var titulo = $('#titulo').val();
		var conteudo = $('#conteudo').val();

		$('#btn-postagem').attr('disabled', 'disabled');
		$('#btn-postagem').html('<i class="fas fa-check"></i> Postando...');

		$('#alert-titulo').hide();
		$('#alert-text').hide();
		$('#alert-foto').hide();

		if(titulo.length < 5){
			$('#alert-titulo').show();
		
		}else if(conteudo.length < 10){
			$('#alert-text').show();
		
		}else{

			$.ajax({
				type:'POST',
				url:'http://localhost/teste-backend/v2/api/postagens/submitPostagem',
				data: new FormData(this),
				cache:false,
				processData: false,
		    	contentType: false,
		    	dataType:'json',
		    	success:function(data){	    		
		    		
		    		console.log(data);

		    		if(!data){

		    			$('#btn-postagem').attr('disabled', false);
						$('#btn-postagem').html('<i class="fas fa-check"></i> Postar');	

						$.notify("Ops! Tivemos um problema, tente novamente mais tarde.", {
							className: 'error'
						});	    			

		    		}else if(data == 'foto empty'){

		    			$('#btn-postagem').attr('disabled', false);
						$('#btn-postagem').html('<i class="fas fa-check"></i> Postar');		    			

		    			$('#alert-foto').show();
		    		
		    		}else{
		    			window.location.href = 'http://localhost/teste-backend/v2/cms/home/';
		    		}
		    			    		
		    	}

			});	

		}		

	});

}

function updatePostagem(idPostagem){

	var titulo = $('#titulo').val();
	var conteudo = $('#conteudo').val();

	$('#btn-postagem-update').attr('disabled', 'disabled');
	$('#btn-postagem-update').html('<i class="fas fa-check"></i> Atualizando...');

	$('#alert-titulo').hide();
	$('#alert-text').hide();
	$('#alert-foto').hide();

	if(titulo.length < 5){
		$('#alert-titulo').show();
	
	}else if(conteudo.length < 10){
		$('#alert-text').show();
	
	}else{
		
		$.ajax({
			type:'POST',
			url:'http://localhost/teste-backend/v2/api/postagens/atualizarPostagem',
			data:{id_postagem:idPostagem, titulo:titulo, conteudo:conteudo},
			dataType:'json',
			success:function(data){
				
				if(data){
					$('#btn-postagem-update').attr('disabled', false);
					$('#btn-postagem-update').html('<i class="fas fa-check"></i> Atualizar Postagem');

					$.notify("Postagem atualizada com sucesso!", {
						className: 'success'
					});	

					// Atualizar a página ao fechar o modal
					$('#editar-postagem').on('hidden.bs.modal', function (e) {
						window.location.href = window.location.href;
					});
				}
			}
		});

	}
}


/* Atualizar foto */
function updateFoto(){
	$('#foto-submit').trigger('click');
}

function submitFoto(){	

	$('#foto-edit').bind('submit', function(e){
		e.preventDefault();				

		$('#btn-foto-update').attr('disabled', 'disabled');
		$('#btn-foto-update').html('<i class="fas fa-check"></i> Atualizando...');	
		$.ajax({
			type:'POST',
			url:'http://localhost/teste-backend/v2/api/postagens/atualizarFotoPostagem',
			data: new FormData(this),
			cache:false,
			processData: false,
	    	contentType: false,
	    	dataType:'json',
	    	success:function(data){	
	    		console.log(data);

	    		if(data['check'] == 'foto empty'){

	    			$('#btn-foto-update').attr('disabled', false);
					$('#btn-foto-update').html('<i class="fas fa-check"></i> Atualizar Foto');	    			

	    			$('#alert-foto').show();
	    		
	    		}else if(!data['check']){

	    			$('#btn-foto-update').attr('disabled', false);
					$('#btn-foto-update').html('<i class="fas fa-check"></i> Atualizar Foto');	    				 

					$.notify("Ops! Tivemos um problema, tente novamente mais tarde.", {
						className: 'error'
					});	   				    			

	    		}else{	    			

	    			$('#btn-foto-update').attr('disabled', false);
					$('#btn-foto-update').html('<i class="fas fa-check"></i> Atualizar Foto');	    			

	    			$('#foto-view').find('img').attr('src', 'http://localhost/teste-backend/v2/cms/assets/img/posts/'+data['foto']);

	    			$.notify("Foto atualizada com sucesso!", {
						className: 'success'
					});	

	    			// Atualizar a página ao fechar o modal
					$('#editar-postagem').on('hidden.bs.modal', function (e) {
						window.location.href = window.location.href;
					});
	    		}
	    			    		
	    	}

		});		

	});

}

function excluirPostagem(countPostagem){

	var idPostagem = $('#postagem-'+countPostagem).text();
	idPostagem = parseInt(idPostagem);

	$( "#dialog-excluir" ).dialog({
		  show: { effect: "shake", duration: 350 },
		  hide: { effect: "scale", duration: 150 },
		  position: { my: "top", at: "top+20%", of: window },
	      resizable: false,
	      height: 200,
	      width: 500,	    
	      modal: true,
	      buttons: [
		      {
		        text:"Excluir",
		        icon: "ui-icon-trash",
		        click: function() {			        
		        						
					$.ajax({
						type:'POST',
						url:'http://localhost/teste-backend/v2/api/postagens/excluirPostagem',
						data:{id_postagem:idPostagem},
						dataType:'json',
						success:function(data){
							console.log(data);

							if(data){
								$( "#dialog-excluir" ).dialog( "close" );
								$('#row-'+countPostagem).remove();

								$.notify("Postagem Removida com Sucesso!", {
									className: 'success'
								});

							}else{
								$( "#dialog-excluir" ).dialog( "close" );

								$.notify("Ops! Tivemos um problema, tente novamente mais tarde.", {
									className: 'error'
								});
							}

						}	
					});
																	          
		        }
		      },
		      {
		        text:"Cancelar",
		        icon: "ui-icon-close",
		        click: function() {
		          $( this ).dialog( "close" );
		        }
		      }
	      ]
	});
}