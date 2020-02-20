
<!-- Adaptado de W3Schools.com
     Editar atributos em /pub/css/topbar.css -->

<div class="topbar" id="topbar">
  <a href="index.php"><img src="svg/logo.svg" height="23px"></a>
  <?php if(isset($_SESSION['user'])): ?>
    <div class="dropdown">
      <button id="usrtopbar" class="dropbtn"><?=$_SESSION['name']?></button>
      <div class="dropdown-content">
        <a href="?page=UserProfile"><i class="material-icons">account_box</i>  Perfil</a>
        <a href="?page=LogOut"><i class="material-icons">exit_to_app</i>  Sair</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Navegar</button>
      <div class="dropdown-content">
        <a href="index.php?page=Browse"><i class="material-icons">font_download</i> Línguas</a>
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
  <?php else: ?>
    <div class="dropdown" id="login-form">
      <button id="usrtopbar" class="dropbtn">Entrar</button>
      <div class="dropdown-content">
        <form action="?page=Welcome" method="post">
          <div>
            <input type="email" name="email" placeholder="Seu e-mail" autocomplete="off" required/>
            <input type="password" name="password" placeholder="Sua senha" required/>
            <input type="submit" value="Entrar"/>
          </div>
        </form>
      </div>
    </div>
    <a href="?page=CreateUser">Cadastre-se!</a>
  <?php endif;?>

  <a href="javascript:void(0);" class="icon" onclick="topbarResponsive()">&#9776;</a>
</div>
