
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
