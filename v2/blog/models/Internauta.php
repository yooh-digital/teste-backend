<?php

  class Internauta extends model{

    public function getComentarios($idPostagem){      
      $array = array();

      $sql = $this->db->prepare("SELECT internauta.nome, internauta.email, comentarios.comentarios, comentarios.data_comentario
      FROM internauta
      INNER JOIN comentarios ON comentarios.id_internauta = internauta.id
      WHERE comentarios.id_postagem = :id_postagem");

      $sql->bindValue(':id_postagem', $idPostagem);
      $sql->execute();

      if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
      }

      return $array;
    }

  }

?>
