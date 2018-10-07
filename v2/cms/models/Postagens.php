<?php

class Postagens extends model{

	public function getPostagensPorUsuario($idUser){

		$array = array();		

	    $sql = $this->db->prepare("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.data_postagem
	    FROM postagem
	    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id
	    WHERE id_usuario = :id_usuario
	    ORDER BY postagem.id DESC"); // Acrescentar paginação

	    $sql->bindValue(':id_usuario', (int)$idUser);
	    $sql->execute();
	                                  
	    if($sql->rowCount() > 0){	    	

	     	$array = $sql->fetchAll();		     	

	    }else{

	    	$sql = $this->db->prepare("SELECT login as usuario FROM usuarios WHERE id = :id_usuario");
	    	$sql->bindValue(':id_usuario', $idUser);
	    	$sql->execute();

	    	if($sql->rowCount() > 0){
	    		$array = $sql->fetch();	    		
	    	}
	    }

	   return $array; 

	}


}