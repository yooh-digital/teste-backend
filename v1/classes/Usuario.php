<?php

class Usuario{

  public function login($login, $senha){
    global $pdo;

      $sql = $pdo->prepare("SELECT id FROM usuarios WHERE login = :login AND senha = :senha");
      $sql->bindValue(':login', $login);
      $sql->bindValue(':senha', md5($senha));
      $sql->execute();

      if($sql->rowCount() > 0){
        $array = $sql->fetch();
        $_SESSION['login'] = $array['id'];

        return true;
      }else{
        return false;
      }
  }

}

?>
