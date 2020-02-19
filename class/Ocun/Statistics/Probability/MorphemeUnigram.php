<?php
  namespace Ocun\Statistics\Probability;
  use Ocun\Statistics\Probability\Morpheme;
  use Ocun\Statistics\iStatistics;

  class MorphemeUnigram extends Morpheme implements iStatistics{

    public function __construct($morphemeChain, $mode, $wordBoundaries = false){
      $this->chain = $morphemeChain;
      $this->mode = $mode;
      if(!$wordBoundaries){
        $this->data = $this->countUnigrams($this->clearWordBoundaries($morphemeChain), $mode);
      } else {
        $this->data = $this->countUnigrams($morphemeChain, $mode);
      }
    }

    private function clearWordBoundaries($morphemeChain){
      foreach($morphemeChain as $key => $value){
        if($value['form'] == '_' && $value['meaning'] == '_'){
          unset($morphemeChain[$key]);
        }
      }
      return array_values($morphemeChain);
    }

    public function getPlotLyObject($option, $search = null, $opacity = 1, $color = 'blue'){
      return $this->$option($opacity, $color, $search);
    }

    private function histogramLogP($opacity, $color, $search){
      $array = array();
      foreach($this->data as $d){
        $array[] = $d['logP'];
      }
      return [
        'x' => $array,
        'type' => 'histogram',
        'opacity' => $opacity,
        'xbins' => ['size' => 0.1],
        'marker' => [
          'color' => $color
        ]
      ];
    }

    private function histogramP($opacity, $color, $search){
      $array = array();
      foreach($this->data as $d){
        $array[] = $d['P'];
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

    private function morphemesInSentence($chain, $mode){
      $chain = $this->clearWordBoundaries($chain);
      $retarray = array();
      foreach($chain as $key => $morpheme){
          $search = $mode == 'morpheme' ? "{$morpheme['form']} {$morpheme['meaning']}" : "{$morpheme[$mode]}";
          $retarray[] = array_values(array_filter($this->data, function($m) use ($search, $mode){
            return $m[$mode] == $search;
          }))[0];
      }

      return $retarray;
    }

    private function sentenceLogP($opacity, $color, $search){
      $arr = $this->morphemesInSentence($search, $this->mode);
      $x = array();
      foreach($arr as $key => $el){
        $x[] = "{$key}-{$el[$this->mode]}";
      }
      $y = array_map(function($el){return $el['logP'];}, $arr);
      return [
        'x' => $x,
        'y' => $y,
        'type' => 'bar'
      ];
    }

    public function getData(){
      return $this->data;
    }

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
          $table[3][] = $row['P'];
          $table[4][] = $row['logP'];
        } else {
          $table[0][] = $row[$this->mode];
          $table[1][] = $row['count'];
          $table[2][] = $row['P'];
          $table[3][] = $row['logP'];
        }
      }

      return $table;
    }

  }


?>
