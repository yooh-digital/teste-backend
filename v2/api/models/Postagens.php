<?php

class Postagens extends model{

	public function adicionarPostagem($idUsuario, $titulo, $conteudo, $foto){
		
		$tipo = $foto['type'];

		if(in_array($tipo, array('image/jpeg', 'image/png'))){ // Se dentro do array $tipo existir os tipos image/jpeg ou image/png, então a imagem será adicionada

			if($tipo == 'image/jpeg'){
				$tipo = '.jpg';

			}elseif($tipo == 'image/png'){
				$tipo = '.png';
			}

	        $nomeFoto = md5(time().rand(0, 9999)).$tipo; // Gerando o novo nome da foto	        

	        move_uploaded_file($foto['tmp_name'],'../cms/assets/img/posts/'.$nomeFoto); // Movendo para a pasta padrão de imagens

	        // Inserir nome da imagem no banco
	        $sql = $this->db->prepare("INSERT INTO foto_postagem SET nome = :nome");
	        $sql->bindValue(':nome', $nomeFoto);
	        $sql->execute();


	        // Selecionar id da última foto adicionada
	        $sql = $this->db->query("SELECT id FROM foto_postagem ORDER BY id DESC LIMIT 1");

	        $array = array();

	        if($sql->rowCount() > 0){
	          $array = $sql->fetch();
	        }

	        $idFoto = $array['id'];

	        // Inserir dados da postagem no banco
	        $sql = $this->db->prepare("INSERT INTO postagem SET id_usuario = :id_usuario, id_foto_postagem = :id_foto_postagem, titulo = :titulo, conteudo = :conteudo, data_postagem = NOW()");

	        $sql->bindValue(':id_usuario', $idUsuario);
	        $sql->bindValue(':id_foto_postagem', $idFoto);
	        $sql->bindValue(':titulo', $titulo);
	        $sql->bindValue(':conteudo', $conteudo);
	        $sql->execute();

	        return true;
	    
	    }else{
	    	return false;
	    }
	}

	public function getPostagem($id){
		$array = array();

	    $sql = $this->db->prepare("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
	    FROM postagem
	    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id
	    WHERE postagem.id = :id");

	    $sql->bindValue(':id', $id);
	    $sql->execute();

	    if($sql->rowCount() > 0){
	      $array = $sql->fetch();
	    }

	    return $array;
	}

	public function updatePostagem($idPostagem,$titulo,$conteudo){

		$sql = $this->db->prepare('UPDATE postagem SET titulo = :titulo, conteudo = :conteudo, data_postagem = NOW() WHERE id = :id');

	    $sql->bindValue(':titulo', $titulo);
	    $sql->bindValue(':conteudo', $conteudo);
	    $sql->bindValue(':id', $idPostagem);
	    $sql->execute();

	    return true;
	}

	public function updateFotoPostagem($idPostagem, $foto){
		$array = array();

		// Selecionar id da foto para atualização
        $sql = $this->db->prepare("SELECT id_foto_postagem FROM postagem
        WHERE id = :id");

        $sql->bindValue(':id', $idPostagem);
        $sql->execute();        

        if($sql->rowCount() > 0){
          $array = $sql->fetch();
        }

        $idFoto = $array['id_foto_postagem'];

        // Atualizar foto da postagem
        
	    $tipo = $foto['type'];

	    if(in_array($tipo, array('image/jpeg', 'image/png'))){

	    	if($tipo == 'image/jpeg'){
				$tipo = '.jpg';

			}elseif($tipo == 'image/png'){
				$tipo = '.png';
			}

	    	$nomeFoto = md5(time().rand(0, 9999)).$tipo;
	        move_uploaded_file($foto['tmp_name'],'../cms/assets/img/posts/'.$nomeFoto);

	        $sql = $this->db->prepare("UPDATE foto_postagem SET nome = :nome WHERE id = :id");
	        $sql->bindValue(':nome', $nomeFoto);
	        $sql->bindValue(':id', $idFoto);
	        $sql->execute();

	        return $nomeFoto;
	    
	    }else{
	    	return false;
	    }                
	}

	public function deletaPostagem($idPostagem){

		// Selecionar id da foto para deleção
	    $sql = $this->db->prepare("SELECT id_foto_postagem FROM postagem
	    WHERE id = :id");

	    $sql->bindValue(':id', $idPostagem);
	    $sql->execute();

	    $array = array();

	    if($sql->rowCount() > 0){
	      $array = $sql->fetch();
	    }

	    $idFoto = $array['id_foto_postagem'];

	    // Deletar foto da postagem
	    $sql = $this->db->prepare("DELETE FROM foto_postagem WHERE id = :id");
	    $sql->bindValue(':id', $idFoto);
	    $sql->execute();

	    // Deletar dados da postagem
	    $sql = $this->db->prepare("DELETE FROM postagem WHERE id = :id");
	    $sql->bindValue(':id', $idPostagem);
	    $sql->execute();

	    return true;
	}
}