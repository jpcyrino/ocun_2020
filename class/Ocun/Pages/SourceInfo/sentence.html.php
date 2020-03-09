
<?php
  $text = "";
  foreach($sentences as $j => $sent){
    foreach($sent as $i => $m){
      if ($m['form'] == '_'){
        $text .= " ";
      } else{
        if ($i != 0 && $sent[$i-1]['form'] != "_"){
          $text .= "-";
        }
        $text .= $m['form'];
      }
    }
    $text .= "<br>";
    foreach($sent as $i => $m){
      if ($m['form'] == '_'){
        $text .= " ";
      } else{
        if ($i != 0 && $sent[$i-1]['form'] != "_"){
          $text .= "-";
        }
        $text .= $m['meaning'];
      }
    }
    $text .= "<br>";
    $text .= $sent[0]['translation'];
    if ($j < count($sentences)){
      $text .= "<br>";
    }
  }
 ?>

 <h1>Língua <?=$sourceData['name']?></h1>
 <br>
 <form>
 <h2>Informações da Fonte</h2>
 <p><b>Nome: </b><?=$sourceData['title']?></p>
 <p><b>Autor: </b><?=$sourceData['author']?></p>
 <p><b>Ano: </b><?=$sourceData['year']?></p>
 </form>
 <br>
 <br>
<h2>Clique nos dados para selecionar tudo</h2>
<div id="selectable" onclick="selectText('selectable')"><?=$text?></div>

<script>
function selectText(containerid) {
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
}
</script>
