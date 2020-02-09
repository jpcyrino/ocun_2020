<?php

namespace Ocun\Pages\SQLQuery;
use Ocun\Pages\Controller;
use Ocun\Database\Connection;
use Ocun\Database\User\Session;

class SQLQuery extends Controller{

  private function loadQuery(){
    if(isset($_POST['query'], $_POST['submit'])){
      $conn = new Connection;
      return $conn->queryList($_POST['query']);
    } else {
      return false;
    }
  }

  public static function load(){
    Session::denyAccess(5);
    $result = self::loadQuery();
    echo self::loadTemplate("/../SQLQuery/template.html.php", $result ? ['result' => $result] : []);

  }




}







 ?>
