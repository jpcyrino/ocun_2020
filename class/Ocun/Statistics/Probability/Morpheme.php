<?php
namespace Ocun\Statistics\Probability;
use Ocun\Statistics\iStatistics;

abstract class Morpheme implements iStatistics{

  protected $data;

  final public function __construct($morphemeChain, $mode, $wordBoundaries = false){
    if(!$wordBoundaries){
      $this->data = $this->$mode($this->clearWordBoundaries($morphemeChain));
    } else {
      $this->data = $this->$mode($morphemeChain);
    }
  }

  final protected function morpheme($morphemeChain){
    $array = array();
    foreach($morphemeChain as $morpheme){
      $array[] = ['morpheme' => "{$morpheme['form']} {$morpheme['meaning']}"];
    }
    return $this->countSingleColumn($array, 'morpheme');
  }

  final protected function form($morphemeChain){
    return $this->countSingleColumn($morphemeChain, 'form');
  }

  final protected function meaning($morphemeChain){
    return $this->countSingleColumn($morphemeChain, 'meaning');
  }

  final protected function clearWordBoundaries($morphemeChain){
    foreach($morphemeChain as $key => $value){
      if($value['form'] == '_' && $value['meaning'] == '_'){
        unset($morphemeChain[$key]);
      }
    }
    return array_values($morphemeChain);
  }

  final protected function countSingleColumn($chain, $column){
    if(isset($chain[0][$column])){
      $array = array();
      foreach(array_count_values(array_column($chain, $column)) as $key => $count){
        $array[] = [
          $column => $key,
          'count' => $count,
          'frequency' => $count/count($chain),
          'logP' => log($count/count($chain)) * -1,
        ];
      }
      return $array;
    } else {
      echo "ERROR, provided column name {$column} does not exist";
      return false;
    }
  }

  abstract public function getPlotLyObject($option);
  final public function getTable(){
    return $this->data;
  }


}







 ?>
