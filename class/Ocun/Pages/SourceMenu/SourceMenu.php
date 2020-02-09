<?php
namespace Ocun\Pages\SourceMenu;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;

class SourceMenu extends Controller {


  public static function load(){
    Session::denyAccess(3);
    $src = new Source;
    $sources = $src->loadListAccess();
    echo self::loadTemplate("/../SourceMenu/template.html.php", ['sources' => $sources]);
  }


}



 ?>
