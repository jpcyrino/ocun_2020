<?php
  namespace Ocun\Statistics\Probability;
  use Ocun\Statistics\Probability\Morpheme;
  use Ocun\Statistics\iStatistics;

class MorphemeBigram extends Morpheme implements iStatistics{

  protected $chain;

  public function __construct($morphemeChain, $mode){
    $this->data = $this->countBigrams($this->prepareChain($morphemeChain), $mode);
    $this->mode = $mode;
  }

  private function prepareChain($chain){
    $ids = array_unique(array_map(function($el){return $el['sentence'];}, $chain));
    $narray = array();
    foreach($ids as $id){
      $subarray = array();
      $subarray[] = ['sentence' => $id, 'form' => "<", 'meaning' => "<"];
      foreach($chain as $morpheme){
        if($morpheme['sentence']==$id) $subarray[] = $morpheme;
      }
      $subarray[] = ['sentence' => $id, 'form' => ">", 'meaning' => ">"];
      $narray = array_merge($narray, array_filter($subarray, function($el){return $el['form'] != '_' && $el['meaning'] != '_';}));
    }
    return $narray;
  }

  private function countBigrams($chain, $mode){
    $unigrams = $this->countUnigrams($chain, $mode);
    $array = array();
    foreach($chain as $k => $morpheme){
      if($k < count($chain)-1){
        $array[] = $mode == 'morpheme' ? "{$chain[$k]['form']} {$chain[$k]['meaning']},{$chain[$k+1]['form']} {$chain[$k+1]['meaning']}": "{$chain[$k][$mode]},{$chain[$k+1][$mode]}";
      }
    }
    $retarray = array();
    $s = count($array) + 1;
    foreach(array_count_values($array) as $key => $value){
      $v = explode(",", $key);
      $logpv = $unigrams[array_search($v[0], array_column($unigrams, $mode))]['logP'];
      $logpw = $unigrams[array_search($v[1], array_column($unigrams, $mode))]['logP'];
      $retarray[] = [
        $mode.'-A' => $v[0],
        $mode.'-B' => $v[1],
        'count' => $value,
        'P' => $value/$s,
        'logP' => log($value/$s, 2) * -1,
        'logP B|A' => (log($value/$s, 2) * -1) - $logpv,
        'logP A|B' => (log($value/$s, 2) * -1) - $logpw,
        'P B|A' => pow(2,-1 * ((log($value/$s, 2) * -1) - $logpv)),
        'P A|B' => pow(2,-1 * ((log($value/$s, 2) * -1) - $logpw))
      ];
    }
    return $retarray;
  }

  public function getPlotLyObject($option, $filterChain = NULL, $opacity = 1, $color = 'blue'){
    return $this->$option($filterChain, $opacity, $color);
  }

  public function morphemesInSentence($chain, $mode){
    $retarray = array();
    $chain = $this->prepareChain($chain);
    foreach($chain as $key => $morpheme){
      if($key > 0){
        $search = $mode == 'morpheme' ? ["{$chain[$key-1]['form']} {$chain[$key-1]['meaning']}","{$morpheme['form']} {$morpheme['meaning']}"] : ["{$chain[$key-1][$mode]}","{$morpheme[$mode]}"];
        $retarray[] = array_values(array_filter($this->data, function($m) use ($search, $mode){
          return ($m[$mode.'-A'] == $search[0] && $m[$mode.'-B'] == $search[1]);
        }))[0];
      }
    }
    return $retarray;
  }

  private function sentenceBar($filterChain, $opacity, $color){
    if(isset($filterChain) && count($filterChain) > 1){
      $x = array();
      foreach($this->morphemesInSentence($filterChain, $this->mode) as $key => $e){
        $x[] = "{$key}-{$e[$this->mode.'-B']}|{$e[$this->mode.'-A']} "; //- {$e[0][$this->mode.'-B']}
      }
      //$x = array_map(function($e){return "A:({$e[0][$this->mode.'-A']})B:({$e[0][$this->mode.'-B']})";}, $this->morphemesInSentence($filterChain, $this->mode));
      $y = array_map(function($e){return $e['logP B|A'];}, $this->morphemesInSentence($filterChain, $this->mode));
      return [
        'x' => $x,
        'y' => $y,
        'type' => 'bar',
      ];
    }
  }

  private function inverseSentenceBar($filterChain, $opacity, $color){
    if(isset($filterChain) && count($filterChain) > 1){
      $x = array();
      foreach($this->morphemesInSentence($filterChain, $this->mode) as $key => $e){
        $x[] = "{$key}-{$e[$this->mode.'-A']}|{$e[$this->mode.'-B']} "; //- {$e[0][$this->mode.'-B']}
      }
      //$x = array_map(function($e){return "A:({$e[0][$this->mode.'-A']})B:({$e[0][$this->mode.'-B']})";}, $this->morphemesInSentence($filterChain, $this->mode));
      $y = array_map(function($e){return $e['logP A|B'];}, $this->morphemesInSentence($filterChain, $this->mode));
      return [
        'x' => $x,
        'y' => $y,
        'type' => 'bar'
      ];
    }
  }

  public function getTable(){
    return $this->data;
  }



}
?>
