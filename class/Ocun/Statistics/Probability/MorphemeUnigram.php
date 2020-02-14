<?php
  namespace Ocun\Statistics\Probability;
  use Ocun\Statistics\Probability\Morpheme;
  use Ocun\Statistics\iStatistics;

  class MorphemeUnigram extends Morpheme implements iStatistics{

    public function getPlotLyObject($option, $opacity = 1, $color = 'blue'){
      return $this->$option($opacity, $color);
    }

    private function histogramLogP($opacity, $color){
      $array = array();
      foreach($this->data as $d){
        $array[] = $d['logP'];
      }
      return [
        'x' => $array,
        'type' => 'histogram',
        'opacity' => $opacity,
        'marker' => [
          'color' => $color
        ]
      ];
    }

    private function histogramP($opacity, $color){
      $array = array();
      foreach($this->data as $d){
        $array[] = $d['frequency'];
      }
      return [
        'x' => $array,
        'type' => 'histogram',
        'histnorm' => 'probability',
        'opacity' => $opacity,
        'marker' => [
          'color' => $color
        ]
      ];
    }

  }


?>
