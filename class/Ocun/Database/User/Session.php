<?php

namespace Ocun\Database\User;

class Session{

  public static function CheckRegisteredLevel(){
    if(!isset($_SESSION['user'])){
      $_SESSION['level'] = 0;
    }
  }

  public static function DenyAccess($level){
    if($_SESSION['level'] < $level){
      header("Location: index.php?page=AccessDenied");
    }
  }

}
