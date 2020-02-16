<?php
namespace Ocun\Statistics\Probability;
use Ocun\Statistics\iStatistics;

abstract class Morpheme implements iStatistics{

  protected $data;
  protected $mode;

  protected function countUnigrams($chain, $mode){
    $array = array();
    foreach($chain as $morpheme){
      $array[] = $mode == 'morpheme' ? "{$morpheme['form']} {$morpheme['meaning']}" : $morpheme[$mode];
    }
    $retarray = array();
    foreach(array_count_values($array) as $key => $value){
      $retarray[] = [
          $mode => $key,
          'count' => $value,
          'P' => $value/count($chain),
          'logP' => log($value/count($chain), 2) * -1
        ];
    }
    return $retarray;
  }


  abstract public function getPlotLyObject($option);
  abstract public function getTable();




}







 ?>
