<?php

class Postagens extends model{

	public function getResumoPostagens($postagemPorPagina){
		$array = array();

	    $sql = $this->db->query("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
	    FROM postagem
	    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id
	    ORDER BY postagem.id DESC LIMIT $postagemPorPagina, 3");
	                                  // Limite inicial, limite final
	    if($sql->rowCount() > 0){
	      $array = $sql->fetchAll();
	    }

	    return $array;
	}

	public function getTotalPostagens(){	    
	    $total = 0;

	    $sql = $this->db->query("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
	    FROM postagem
	    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id");

	    $total = $sql->rowCount();

	    return $total;
	}	

	public function getPostagem($idPostagem){

		$array = array();

	    $sql = $this->db->prepare("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
	    FROM postagem
	    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id
	    WHERE postagem.id = :id");

	    $sql->bindValue(':id', $idPostagem);
	    $sql->execute();

	    if($sql->rowCount() > 0){
	      $array = $sql->fetch();
	    }

	    return $array;

	}

}