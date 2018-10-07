<?php

  class Internauta{

    public function addComentario($nome, $email, $comentarios, $idPostagem){
      global $pdo;

      $sql = $pdo->prepare("INSERT INTO internauta SET nome = :nome, email = :email");
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':email', $email);
      $sql->execute();

      // Selecionar id do último internauta adicionado
          $sql = $pdo->query("SELECT id FROM internauta ORDER BY id DESC LIMIT 1");

          $array = array();

          if($sql->rowCount() > 0){
            $array = $sql->fetch();
          }

          $idInternauta = $array['id'];

      $sql = $pdo->prepare("INSERT INTO comentarios SET id_internauta = :id_internauta,
      id_postagem = :id_postagem, comentarios = :comentarios");

      $sql->bindValue(':id_internauta', $idInternauta);
      $sql->bindValue(':id_postagem', $idPostagem);
      $sql->bindValue(':comentarios', $comentarios);
      $sql->execute();
    }

    public function getComentarios($idPostagem){
      global $pdo;
      $array = array();

      $sql = $pdo->prepare("SELECT internauta.nome, internauta.email, comentarios.comentarios
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
