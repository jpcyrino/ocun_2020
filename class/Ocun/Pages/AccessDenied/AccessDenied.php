<?php

namespace Ocun\Pages\AccessDenied;
use Ocun\Pages\Controller;

class AccessDenied extends Controller{

  public static function load(){
    echo self::loadTemplate("/../AccessDenied/template.html.php", []);
  }

}



 ?>
