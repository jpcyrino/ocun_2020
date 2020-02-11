<?php
  namespace Ocun\Statistics\Probability;
  use Ocun\Statistics\Probability\Morpheme;
  use Ocun\Statistics\iStatistics;

  class MorphemeUnigram extends Morpheme implements iStatistics{

    public function getPlotLyObject($option){
      return $this->$option();
    }

    private function histogramLogP(){
      $array = array();
      foreach($this->data as $d){
        $array[] = $d['logP'];
      }
      return json_encode([
        'x' => $array,
        'type' => 'histogram'
      ]);
    }

  }


?>
