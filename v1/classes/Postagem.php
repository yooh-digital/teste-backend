<?php

class Postagem{

  public function addPostagem($idUsuario, $titulo, $conteudo, $foto){
    global $pdo;

    if(count($foto) > 0){
      $tipo = $foto['type']; // Atribui a propriedade type do array $foto

      if(in_array($tipo, array('image/jpeg', 'image/png'))){ // Se dentro do array $tipo existir os tipos image/jpeg
                                                             // ou image/png, então a imagem será adicionada

        $nomeFoto = md5(time().rand(0, 9999)).'.jpg'; // Gerando o novo nome da foto
        move_uploaded_file($foto['tmp_name'],'assets/imagens/'.$nomeFoto); // Movendo para a pasta padrão de imagens

        // Inserir nome da imagem no banco
        $sql = $pdo->prepare("INSERT INTO foto_postagem SET nome = :nome");
        $sql->bindValue(':nome', $nomeFoto);
        $sql->execute();
      }
    }

    // Selecionar id da última foto adicionada
        $sql = $pdo->query("SELECT id FROM foto_postagem ORDER BY id DESC LIMIT 1");

        $array = array();

        if($sql->rowCount() > 0){
          $array = $sql->fetch();
        }

        $idFoto = $array['id'];

    // Inserir dados da postagem no banco
        $sql = $pdo->prepare("INSERT INTO postagem SET id_usuario = :id_usuario,
        id_foto_postagem = :id_foto_postagem, titulo = :titulo, conteudo = :conteudo");

        $sql->bindValue(':id_usuario', $idUsuario);
        $sql->bindValue(':id_foto_postagem', $idFoto);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':conteudo', $conteudo);
        $sql->execute();
  }

  public function getListaPostagens($postagemPorPagina){
    global $pdo;
    $array = array();

    $sql = $pdo->query("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
    FROM postagem
    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id
    ORDER BY postagem.id DESC LIMIT $postagemPorPagina, 3");
                                  // Limite inicial, limite final
    if($sql->rowCount() > 0){
      $array = $sql->fetchAll();
    }

    return $array;
  }

  public function getPostagem($id){
    global $pdo;
    $array = array();

    $sql = $pdo->prepare("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
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

  public function getTotalPostagens(){
    global $pdo;
    $total = 0;

    $sql = $pdo->query("SELECT foto_postagem.nome as foto, postagem.id, postagem.titulo, postagem.conteudo
    FROM postagem
    INNER JOIN foto_postagem ON postagem.id_foto_postagem = foto_postagem.id");

    $total = $sql->rowCount();

    return $total;
  }


  public function editaPostagem($titulo, $conteudo, $foto, $idPostagem){
    global $pdo;


    $sql = $pdo->prepare('UPDATE postagem SET titulo = :titulo, conteudo = :conteudo
    WHERE id = :id');

    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':conteudo', $conteudo);
    $sql->bindValue(':id', $idPostagem);
    $sql->execute();

  // Selecionar id da foto para atualização
        $sql = $pdo->prepare("SELECT id_foto_postagem FROM postagem
        WHERE id = :id");

        $sql->bindValue(':id', $idPostagem);
        $sql->execute();

        $array = array();

        if($sql->rowCount() > 0){
          $array = $sql->fetch();
        }

        $idFoto = $array['id_foto_postagem'];

    // Atualizar foto da postagem

        if(count($foto) > 0){
          $tipo = $foto['type'];

          if(in_array($tipo, array('image/jpeg', 'image/png'))){

            $nomeFoto = md5(time().rand(0, 9999)).'.jpg';
            move_uploaded_file($foto['tmp_name'],'assets/imagens/'.$nomeFoto);

            $sql = $pdo->prepare("UPDATE foto_postagem SET nome = :nome WHERE id = :id");
            $sql->bindValue(':nome', $nomeFoto);
            $sql->bindValue(':id', $idFoto);
            $sql->execute();
          }
        }

  }

  public function deletaPostagem($idPostagem){
    global $pdo;

    // Selecionar id da foto para deleção
    $sql = $pdo->prepare("SELECT id_foto_postagem FROM postagem
    WHERE id = :id");

    $sql->bindValue(':id', $idPostagem);
    $sql->execute();

    $array = array();

    if($sql->rowCount() > 0){
      $array = $sql->fetch();
    }

    $idFoto = $array['id_foto_postagem'];

    // Deletar foto da postagem
    $sql = $pdo->prepare("DELETE FROM foto_postagem WHERE id = :id");
    $sql->bindValue(':id', $idFoto);
    $sql->execute();

    // Deletar dados da postagem
    $sql = $pdo->prepare("DELETE FROM postagem WHERE id = :id");
    $sql->bindValue(':id', $idPostagem);
    $sql->execute();

  }

}

?>
