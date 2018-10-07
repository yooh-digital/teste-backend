$(function(){	

	/* Script para inserir comentários na postagem */
	$('#comentarios').bind('submit', function(e){
		e.preventDefault();

		$('#alert-nome').hide();
		$('#alert-email').hide();
		$('#alert-comentario').hide();

		$('#btn-comentario').attr('disabled', 'disabled');
		$('#btn-comentario').html('<i class="fas fa-check"></i> Enviando...');

		var idPostagem = $('#idPostagem').val();
		var nome = $('#nome').val();
		var email = $('#email').val();
		var comentario = $('#comentario').val();

		if(!nome){

			$('#alert-nome').show();

			$('#btn-comentario').attr('disabled', false);
			$('#btn-comentario').html('<i class="fas fa-check"></i> Enviar Comentário');
		
		}else if(!email){

			$('#alert-email').show();

			$('#btn-comentario').attr('disabled', false);
			$('#btn-comentario').html('<i class="fas fa-check"></i> Enviar Comentário');
		
		}else if(!comentario){

			$('#alert-comentario').show();

			$('#btn-comentario').attr('disabled', false);
			$('#btn-comentario').html('<i class="fas fa-check"></i> Enviar Comentário');
		}


		$.ajax({
			type:'POST',
			url:'http://localhost/teste-backend/v2/api/postagens/adicionarComentarios',
			data:{id_postagem:idPostagem, nome:nome, email:email, comentario:comentario},
			dataType:'json',
			success:function(data){								

				if(data){

					$('#comentarios').each(function(){
						this.reset();
					});

					$('#btn-comentario').attr('disabled', false);
					$('#btn-comentario').html('<i class="fas fa-check"></i> Enviar Comentário');

					$.notify("Coementário realizado com sucesso!", {
						className: 'success'
					});

				}else{
					$.notify("Ops! Tivemos um problema, tente novamente mais tarde.", {
						className: 'error'
					});
				}				

			}	
		});


	});

});


