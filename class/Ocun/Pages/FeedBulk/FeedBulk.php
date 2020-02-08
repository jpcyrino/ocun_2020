<?php
namespace Ocun\Pages\FeedBulk;
use Ocun\Bulk\BulkFeeder;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\DataFeeder;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;

class FeedBulk extends Controller {


  private static function handlePost(){
    if(isset($_POST['source'])){
      if(isset($_POST['bulk'])){
        $feeder = new DataFeeder($_POST['source']);
        $bulk = new BulkFeeder($feeder);
        return $bulk->feed(htmlspecialchars($_POST['bulk'], ENT_QUOTES, 'UTF-8'));
      }
    }
    return "";
  }

  public static function load(){
    Session::denyAccess(6);
    $status = self::handlePost();
    $src = new Source;
    $sources = $src->loadList();
    echo self::loadTemplate("/../FeedBulk/template.html.php", ['sources' => $sources, 'status' => $status]);
  }


}



 ?>
