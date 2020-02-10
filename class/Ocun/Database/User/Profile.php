<?php

namespace Ocun\Database\User;
use Ocun\Database\ConnectionUpdatable;

Class Profile extends ConnectionUpdatable{

  public function createUser($name, $email, $password){
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO `user` SET `name` = :name, `email` = :email, `password` = :passwordHash, `level` = :level";
    return $this->execute($sql, [$name, $email, $passwordHash, 1]);
  }

  public function checkEmailExists($email){
    $sql = "SELECT `email` FROM `user` WHERE `email`='{$email}'";
    $result = $this->query($sql);
    if(isset($result['email'])){
      return true;
    } else {
      return false;
    }
  }

  public function showError(){
    return $this->connection->errorInfo();
  }

  public function authenticate($email, $password){
    $sql = "SELECT * FROM `user` WHERE `email`='{$email}'";
    $result = $this->query($sql);
    if(password_verify($password, $result['password'])){
      $_SESSION['user'] = $result['email'];
      $_SESSION['level'] = $result['level'];
      $_SESSION['id'] = $result['id'];
      $_SESSION['name'] = $result['name'];
      return true;
    } else {
      return false;
    }
  }

  public function changeUserLevel($email, $level){
    $sql = "UPDATE `user` SET `level` = :level WHERE `email`='{$email}'";
    return $this->execute($sql, [$level]);
  }

  public function changePassword($email, $password){
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE `user` SET `password` = :password WHERE `email`='{$email}'";
    return $this->execute($sql, [$passwordHash]);
  }

}




 ?>
