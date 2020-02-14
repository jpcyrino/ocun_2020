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
  <div style="border-style: solid; border-width: thin; padding: 5px;">
  <p>
  <?php foreach($sent as $m): ?>
    <?php if($m['form'] == '_' && $m['meaning'] == "_"): ?>
      <div style="display: inline-block;">&nbsp;</div>
    <?php else:?>
      <div onclick="wi(showMorpheme, '<?=$m['id']?>', '<?=$m['sentence']?>')" class="morpheme" ><?=$m['form']?><br><?=$m['meaning']?></div>
    <?php endif;?>
  <?php endforeach;?>
  <br>
  <?php if(isset($sent[0])): ?>
    <?="\"". $sent[0]['translation'] . "\""?>
  <?php endif;?>
  </p>
  </div>
  <div id="window-<?=$sent[0]['sentence']?>" style="display: none; border-style: solid; border-width: thin; padding: 5px;"></div>
<br>
<?php endforeach;?>
</div>






<script>
function show(resp){
  //console.log(resp);
  d = JSON.parse(resp);
  document.getElementById("plot").innerHTML = "";
  if(d.morpheme.type == "histogram"){
    showHist(d.morpheme,d.meaning,d.form, d.title, d.labelx, d.labely);
  } else if(d.morpheme.type == "table"){
    showTable(d.morpheme, d.title);
  }
}

function showTable(data, title){
  data.cells.line = {color: "black", width: 1};
  data.cells.line = {color: "black"};
  data.cells.font = {color: "black"};
  data.header.line = {color: "black", width: 1};
  data.header.fill = {color: "#0892d0"};
  data.header.font = {color: "white"};
  Plotly.newPlot('plot', [data], {title: title}, {responsive: true});
}

function showHist(morpheme, meaning, form, title, xlabel, ylabel){
  traceMorpheme = morpheme;
  traceMeaning = meaning;
  traceForm = form;
  traceMorpheme.name = 'Morfema';
  traceMeaning.name = 'Significado';
  traceForm.name = 'Forma';
  Plotly.newPlot('plot', [traceMorpheme, traceMeaning, traceForm], {
    title : title,
    barmode: 'overlay',
    xaxis : {title: xlabel},
    yaxis : {title: ylabel}
  }, {responsive: true});
}

function showMorpheme(id,sentence){
  console.log("morpheme!" + id + " " + sentence);
}

function wi(func, id,sentence){
  document.getElementById("window-"+sentence).innerHTML = "wawawawaww   "+id;
  document.getElementById("window-"+sentence).style.display = "block";
  func(id, sentence);
}
</script>
