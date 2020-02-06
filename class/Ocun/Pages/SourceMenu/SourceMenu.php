<?php
namespace Ocun\Pages\SourceMenu;
use Ocun\Bulk\BulkFeeder;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\DataFeeder;
use Ocun\Database\Linguistic\Source;

class SourceMenu extends Controller {


  public static function load(){
    $src = new Source;
    $sources = $src->loadList();
    echo self::loadTemplate("/../SourceMenu/template.html.php", ['sources' => $sources]);
  }


}



 ?>
