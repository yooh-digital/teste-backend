<?php 

class Internauta extends model{

    public function addComentario($nome, $email, $comentarios, $idPostagem){     

      $sql = $this->db->prepare("INSERT INTO internauta SET nome = :nome, email = :email");
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':email', $email);
      $sql->execute();

      // Selecionar id do último internauta adicionado
      $sql = $this->db->query("SELECT id FROM internauta ORDER BY id DESC LIMIT 1");

      $array = array();

      if($sql->rowCount() > 0){
        $array = $sql->fetch();
      }

      $idInternauta = $array['id'];

      $sql = $this->db->prepare("INSERT INTO comentarios SET id_internauta = :id_internauta, id_postagem = :id_postagem, comentarios = :comentarios, data_comentario = NOW()");

      $sql->bindValue(':id_internauta', $idInternauta);
      $sql->bindValue(':id_postagem', $idPostagem);
      $sql->bindValue(':comentarios', $comentarios);
      $sql->execute();

      return true;
    }


}