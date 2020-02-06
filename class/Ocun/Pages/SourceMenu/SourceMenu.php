<?php
namespace Ocun\Pages\SourceMenu;
use Ocun\Bulk\BulkFeeder;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\DataFeeder;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;

class SourceMenu extends Controller {


  public static function load(){
    Session::DenyAccess(3);
    $src = new Source;
    $sources = $src->loadListAccess();
    echo self::loadTemplate("/../SourceMenu/template.html.php", ['sources' => $sources]);
  }


}



 ?>
