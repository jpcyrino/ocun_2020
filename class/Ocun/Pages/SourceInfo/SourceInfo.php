<?php
namespace Ocun\Pages\SourceInfo;
use Ocun\Pages\Controller;
use Ocun\Database\Linguistic\Sentence;
use Ocun\Statistics\Probability\MorphemeUnigram;

class SourceInfo extends Controller{

static $table;

private function getPlot(){
  $ml = new Sentence;
  $mu = new MorphemeUnigram($ml->morphemeList(8), 'meaning');
  self::$table = $mu->getTable();
  return $mu->getPlotLyObject('histogramLogP');
}

public static function load(){
  echo self::loadTemplate("/../SourceInfo/template.html.php", ['plot' => self::getPlot(), 'table' => self::$table]);

}


}





 ?>
