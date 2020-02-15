<?php
  namespace Ocun\Statistics\Probability;
  use Ocun\Statistics\Probability\Morpheme;
  use Ocun\Statistics\iStatistics;

class MorphemeBigram implements iStatistics{

  protected $chain;

  public function __construct($morphemeChain, $mode){
    $this->$chain = $this->prepareChain($morphemeChain);
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

  private function countUnigrams($chain, $mode){
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

  private function countBigrams($chain, $mode){
  $unigrams = countUnigrams($chain, $mode);
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
    $retarray[] = [
      $mode.'-A' => $v[0],
      $mode.'-B' => $v[1],
      'count' => $value,
      'P' => $value/$s,
      'logP' => log($value/$s, 2) * -1,
      'logP B|A' => (log($value/$s, 2) * -1) - $logpv,
      'P B|A' => pow(2,-1 * ((log($value/$s, 2) * -1) - $logpv))
    ];
  }
  return $retarray;
}

}
?>
