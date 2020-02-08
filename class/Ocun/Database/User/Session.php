<?php

namespace Ocun\Database\User;

class Session{

  public static function checkRegisteredLevel(){
    if(!isset($_SESSION['user'], $_SESSION['id'])){
      $_SESSION['level'] = 0;
    }
  }

  public static function denyAccess($level){
    if($_SESSION['level'] < $level){
      header("Location: index.php?page=AccessDenied");
    }
  }

}
