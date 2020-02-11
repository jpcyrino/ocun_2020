<h1>Plot: </h1>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id="MyPlot"></div>


<script>
console.log(JSON.parse('<?=$plot?>'));
t = JSON.parse('<?=$plot?>');
t.xbins = {size : 0.1}
Plotly.newPlot('MyPlot', [t], {
  title : "Histograma de -logP dos Morfemas",
  xaxis : {title: "-logP"},
  yaxis : {title: "Quantidade"}
});
</script>
