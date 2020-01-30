<?php
namespace Ocun\Database\Linguistic;

class DataSplitter {

  private static function split(string $data){
    return explode("-", str_replace(" ", "-_-", $data));
  }

  public static function parse(string $languageData, string $glossData){
    if(count(self::split($languageData)) == count(self::split($glossData))){
      $morphemes = [];
      foreach(self::split($languageData) as $i => $form){
        $morphemes[] = [
          'form' => self::split($languageData)[$i],
          'meaning' => self::split($glossData)[$i]
        ];
      }
      return $morphemes;
    } else {
      return false;
    }
  }


}


 ?>
