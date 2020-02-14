<?php
namespace Ocun\Pages;

abstract class Controller{


    protected static function loadTemplate($templatePath, $variables = []){
      $template = $templatePath;
      extract($variables);
      //variáveis de usuário...
      ob_start();
      include __DIR__ . "/Template/layout.html.php";
      return ob_get_clean();
    }

    abstract public static function load();


}




 ?>
