<?php
namespace Ocun\Statistics\Probability;
use Ocun\Statistics\iStatistics;

abstract class Morpheme implements iStatistics{

  protected $data;
  protected $mode;
  protected $chain;

  public function __construct($morphemeChain, $mode, $wordBoundaries = false){
    $this->chain = $morphemeChain;
    $this->mode = $mode;
    if(!$wordBoundaries){
      $this->data = $this->$mode($this->clearWordBoundaries($morphemeChain));
    } else {
      $this->data = $this->$mode($morphemeChain);
    }
  }

  protected function morpheme($morphemeChain){
    $array = array();
    foreach($morphemeChain as $morpheme){
      $array[] = ['morpheme' => "{$morpheme['form']} {$morpheme['meaning']}"];
    }
    return $this->countSingleColumn($array, 'morpheme');
  }

  protected function form($morphemeChain){
    return $this->countSingleColumn($morphemeChain, 'form');
  }

  protected function meaning($morphemeChain){
    return $this->countSingleColumn($morphemeChain, 'meaning');
  }

  protected function clearWordBoundaries($morphemeChain){
    foreach($morphemeChain as $key => $value){
      if($value['form'] == '_' && $value['meaning'] == '_'){
        unset($morphemeChain[$key]);
      }
    }
    return array_values($morphemeChain);
  }

  protected function countSingleColumn($chain, $column){
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

  abstract public function getPlotLyObject($option, $opacity, $color);

  public function getTable(){
    usort($this->data, function($a, $b){
      return ($a['logP'] <= $b['logP'] ? -1 : 1);
    });
    $table = array();
    foreach($this->data as $row){
      if($this->mode == 'morpheme'){
        $morpheme = explode(" ", $row[$this->mode]);
        $table[0][] = $morpheme[0];
        $table[1][] = $morpheme[1];
        $table[2][] = $row['count'];
        $table[3][] = $row['frequency'];
        $table[4][] = $row['logP'];
      } else {
        $table[0][] = $row[$this->mode];
        $table[1][] = $row['count'];
        $table[2][] = $row['frequency'];
        $table[3][] = $row['logP'];
      }
    }

    return $table;
  }


}







 ?>
