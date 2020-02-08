
// Troca separador de morfemas = para -
function separatorEqual(){
  document.getElementById("bulk-box").value = document.getElementById("bulk-box").value.replace(/=/gi, '-');
}

/* Função retirada de W3Schools.com */
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function topbarResponsive() {
  var x = document.getElementById("topbar");
  if (x.className === "topbar") {
    x.className += " responsive";
  } else {
    x.className = "topbar";
  }
}

function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function validateFeed(){
  if(separators != ""){
    sep = new RegExp('('+separators+')', 'gi');
    document.getElementById("ioriginal").value = document.getElementById("ioriginal").value.replace(sep, "-").replace(/(\.$|[,]|\?$|\!$|\-$)/gi, "").trim();
    document.getElementById("igloss").value = document.getElementById("igloss").value.replace(sep, "-").replace(/(\.$|[,]|\?$|\!$|\-$)/gi, "").trim();
  }else{
    document.getElementById("ioriginal").value = document.getElementById("ioriginal").value.replace(/(\.$|[,]|\?$|\!$|\-$)/gi, "").trim();
    document.getElementById("igloss").value = document.getElementById("igloss").value.replace(/(\.$|[,]|\?$|\!$|\-$)/gi, "").trim();
  }
  for(var k in encode){
    enc = new RegExp('('+escapeRegExp(encode[k].input)+')','gi');
    document.getElementById("ioriginal").value = document.getElementById("ioriginal").value.replace(enc, encode[k].output);
  }
  io = document.getElementById("ioriginal").value.split(/(\s|-)/).filter(el => el != " " && el != "-");
  ig = document.getElementById("igloss").value.split(/(\s|-)/).filter(el => el != " " && el != "-");
  if(io.length == ig.length){
    document.getElementById("isend").disabled = false;
  } else {
    document.getElementById("isend").disabled = true;
  }
}
