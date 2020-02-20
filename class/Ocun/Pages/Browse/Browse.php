<?php

namespace Ocun\Pages\Browse;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Language;
use Ocun\Database\Linguistic\Source;
use Ocun\Database\User\Session;


class Browse extends Controller{

  protected static function getSourceList(){
    $src = new Source;
    $lst = $src->loadList();
    $theList = array();
    foreach ($lst as $l){
      if($src->getInfo($l['id'])['license'] != 'private'){
        $theList[] = $src->getInfo($l['id']);
      } else {
        foreach($src->loadListAccess() as $row){
          if($row['id'] == $l['id']){
            //self::$sourceData = $row;
            $theList[] = $src->getInfo($l['id']);
          }
        }
      }
    }
    return $theList;
  }

  public static function load() {
    Session::denyAccess(0);

    echo self::loadTemplate("/../Browse/template.html.php", ['list' => self::getSourceList()]);


  }



}
