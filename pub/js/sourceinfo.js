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

function barRequest(ajax, func, sent){
  Ajax(ajax, func);
  document.getElementById('plot-window-'+sent).innerHTML = "Aguarde, processando dados... (pode levar alguns instantes)";

}

function sentenceViews(source, sent, ajax){
  document.getElementById("window-"+sent).innerHTML = `
    <button onclick='document.getElementById("window-${sent}").style.display = "none"'>Fechar</button><br>
    <h3>Gráficos</h3>
    <div style="padding: 10px;">
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=sentenceLogP&st=${sent}', sentenceLogP, ${sent})">-logP(n)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=sentenceBar&st=${sent}', sentenceBar, ${sent})">-logP(n|n-1)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=inverseSentenceBar&st=${sent}', inverseSentenceBar, ${sent})">-logP(n-1|n)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=mutualMeaning&st=${sent}', mutualMeaning, ${sent})">Significado -logP(n|n-1) vs. -logP(n-1|n)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=mutualForm&st=${sent}', mutualForm, ${sent})">Forma -logP(n|n-1) vs. -logP(n-1|n)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=mutualMorpheme&st=${sent}', mutualMorpheme, ${sent})">Morfema -logP(n|n-1) vs. -logP(n-1|n)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=nBAMeaning&st=${sent}', nBAMeaning, ${sent})">Significado -logP(n) vs. -logP(n|n-1)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=nBAForm&st=${sent}', nBAMeaning, ${sent})">Forma -logP(n) vs. -logP(n|n-1)</button>
    <button onclick="barRequest('?page=SourceInfo&id=${source}&ajax=nBAMorpheme&st=${sent}', nBAMeaning, ${sent})">Morfema -logP(n) vs. -logP(n|n-1)</button>
    </div>
    <br><br><div id='plot-window-${sent}'></div>`;
  document.getElementById("window-"+sent).style.display = "block";
}

function sentenceBar(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.morpheme.name = "Morfema";
  d.data.meaning.name = "Significado";
  d.data.form.name = "Forma";
  //console.log(d);
  Plotly.newPlot(w,[d.data.morpheme, d.data.meaning, d.data.form], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}

function sentenceLogP(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.morpheme.name = "Morfema";
  d.data.meaning.name = "Significado";
  d.data.form.name = "Forma";
  Plotly.newPlot(w,[d.data.morpheme, d.data.meaning, d.data.form], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}

function nBAMeaning(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.n.x = (function(){var list = []; for(i = 0; i<=d.data.n.y.length;i++){list.push(i);} return list;}());
  d.data.n.y.push(0);
  d.data.n.name = "n";
  d.data.nGivenNMinusOne.x = d.data.n.x;
  d.data.nGivenNMinusOne.name = "n|n-1";
  d.data.mn = {
    x : d.data.n.x,
    y : (function(){
      var list = [];
      for(i = 0; i<=d.data.n.y.length;i++){
        list.push(d.data.n.y.reduce((previous, current) => current += previous)/d.data.n.y.length);
      }
      return list;
    }())
  };
  d.data.mn.name = "Média n";
  d.data.mnBA = {
    x : d.data.n.x,
    y : (function(){
      var list = [];
      for(i = 0; i<=d.data.n.y.length;i++){
        list.push(d.data.nGivenNMinusOne.y.reduce((previous, current) => current += previous)/d.data.n.y.length);
      }
      return list;
    }())
  };
  d.data.mnBA.name = "Média n|n-1";
  //console.log(d);
  Plotly.newPlot(w,[d.data.n, d.data.nGivenNMinusOne, d.data.mn, d.data.mnBA], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}


function inverseSentenceBar(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.morpheme.name = "Morfema";
  d.data.meaning.name = "Significado";
  d.data.form.name = "Forma";
  //console.log(d);
  Plotly.newPlot(w,[d.data.morpheme, d.data.meaning, d.data.form], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}

function mutualMeaning(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.plotBA.x = (function(){var list = []; for(i = 0; i<d.data.plotBA.y.length;i++){list.push(i);} return list;}());
  d.data.plotAB.x = (function(){var list = []; for(i = 0; i<d.data.plotAB.y.length;i++){list.push(i);} return list;}());
  d.data.plotBA.name = "n|n-1";
  d.data.plotAB.name = "n-1|n";
  //console.log(d);
  Plotly.newPlot(w,[d.data.plotBA, d.data.plotAB], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}

function mutualForm(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.plotBA.x = (function(){var list = []; for(i = 0; i<d.data.plotBA.y.length;i++){list.push(i);} return list;}());
  d.data.plotAB.x = (function(){var list = []; for(i = 0; i<d.data.plotAB.y.length;i++){list.push(i);} return list;}());
  d.data.plotBA.name = "n|n-1";
  d.data.plotAB.name = "n-1|n";
  //console.log(d);
  Plotly.newPlot(w,[d.data.plotBA, d.data.plotAB], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
}

function mutualMorpheme(resp){
  d = JSON.parse(resp);
  w = 'plot-'+d.window;
  document.getElementById(w).innerHTML = "";
  d.data.plotBA.x = (function(){var list = []; for(i = 0; i<d.data.plotBA.y.length;i++){list.push(i);} return list;}());
  d.data.plotAB.x = (function(){var list = []; for(i = 0; i<d.data.plotAB.y.length;i++){list.push(i);} return list;}());
  d.data.plotBA.name = "n|n-1";
  d.data.plotAB.name = "n-1|n";
  //console.log(d);
  Plotly.newPlot(w,[d.data.plotBA, d.data.plotAB], {title: d.data.title, xaxis: {title: d.data.labelx}, yaxis: {title: d.data.labely}}, {responsive: true});
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
