
<!-- Adaptado de W3Schools.com
     Editar atributos em /pub/css/topbar.css -->

<div class="topbar" id="topbar">
  <a href="#home"><img src="svg/logo.svg" height="23px"></a>
  <?php if(isset($_SESSION['user'])): ?>
    <div class="dropdown">
      <button id="usrtopbar" class="dropbtn"><?=$_SESSION['name']?></button>
      <div class="dropdown-content">
        <a href="?page=UserProfile"><i class="material-icons">account_box</i>  Perfil</a>
        <a href="?page=LogOut"><i class="material-icons">exit_to_app</i>  Sair</a>
      </div>
    </div>
  <?php else: ?>
    <a href="?page=RegisterUser">Cadastre-se!</a>
  <?php endif;?>
  <div class="dropdown">
    <button class="dropbtn">Navegar</button>
    <div class="dropdown-content">
      <a href="#">Línguas</a>
      <a href="#">Estudos</a>
      <a href="#">Sobre a plataforma Òcun</a>
    </div>
  </div>
  <?php if($_SESSION['level'] > 2): ?>
    <div class="dropdown">
      <button class="dropbtn">Dados</button>
      <div class="dropdown-content">
        <a href="index.php?page=SourceMenu"><i class="material-icons">subject</i>  Fontes de Dados</a>
        <?php if($_SESSION['level'] > 5): ?>
          <a href="index.php?page=SQLQuery"><i class="material-icons">developer_board</i> Consulta SQL</a>
          <a href="index.php?page=FeedBulk"><i class="material-icons">add_to_photos</i>  Inserir dados em Massa</a>
        <?php endif;?>
      </div>
    </div>
  <?php endif; ?>
  <a href="?page=OcunHelp">Ajuda</a>

  <a href="javascript:void(0);" class="icon" onclick="topbarResponsive()">&#9776;</a>
</div>
