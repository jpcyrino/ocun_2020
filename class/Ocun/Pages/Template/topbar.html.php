
<!-- Adaptado de W3Schools.com
     Editar atributos em /pub/css/topbar.css -->

<div class="topbar" id="topbar">
  <a href="#home"><img src="svg/logo.svg" height="20px"></a>
  <a href="#home" class="active">Início</a>
  <div class="dropdown">
    <button class="dropbtn">Consultas</button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Administrativo</button>
    <div class="dropdown-content">
      <a href="index.php?page=SourceMenu">Fontes de Dados</a>
      <a href="index.php?page=FeedBulk">Inserir dados em Massa</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Usuário</button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div>
  <a href="#about">About</a>
  <a href=""><?=$min?></a>
  <a href="javascript:void(0);" class="icon" onclick="topbarResponsive()">&#9776;</a>
</div>
