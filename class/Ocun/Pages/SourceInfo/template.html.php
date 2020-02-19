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
<h2>Estatísticas</h2>
<button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=tableMorpheme', show)">Tabela de Frequência dos Morfemas</button>
<button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=tableMeaning', show)">Tabela de Frequência dos Significados</button>
<button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=tableForm', show)">Tabela de Frequência das Formas</button>
<br>
<br>
<button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=hLogP', show)">Histograma de Complexidade dos Morfemas</button>
<button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=hP', show)">Histograma de Probabilidade dos Morfemas</button>
<br>
<div id="plot" style="margin-top: 10px;"></div>
<br>
<br>
<h2>Frases da língua</h2>
<p>Número de frases: <b><?=count($sentences)?></b></p>
<br>
<div style="height: 80vh; overflow: scroll;">
<?php foreach($sentences as $sent): ?>
  <div style="border-style: solid; border-width: thin; border-color: #0892d0; padding: 15px;">
  <p>
  <?php foreach($sent as $m): ?>
    <?php if($m['form'] == '_' && $m['meaning'] == "_"): ?>
      <div style="display: inline-block;">&nbsp;</div>
    <?php else:?>
      <div onclick="window.open('?page=MorphemeInfo&id=<?=$m['id']?>', '_blank')" class="morpheme" ><?=$m['form']?><br><?=$m['meaning']?></div>
    <?php endif;?>
  <?php endforeach;?>
  <br>
  <?php if(isset($sent[0])): ?>
    <p onclick="sentenceViews(<?=$_GET['id']?>, <?=$sent[0]['sentence']?>,'?page=SourceInfo&id=<?=$_GET['id']?>&ajax=sentenceBar&st=<?=$sent[0]['sentence']?>')"><?="\"". $sent[0]['translation'] . "\""?></p>
  <!--  <button onclick="Ajax('?page=SourceInfo&id=<?=$_GET['id']?>&ajax=sentenceBar&st=<?=$sent[0]['sentence']?>', sentenceBar)">Complexidade dos Bígramos</button> -->
  <?php endif;?>
  </p>
  </div>
  <div id="window-<?=$sent[0]['sentence']?>" style="display: none; border-style: solid; border-color: #0892d0; border-width: thin; padding: 10px;"></div>
<br>
<?php endforeach;?>
</div>






<script src="js/sourceinfo.js" type="text/javascript">

</script>
