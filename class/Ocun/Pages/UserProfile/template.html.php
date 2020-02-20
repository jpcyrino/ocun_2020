<?php if(isset($_GET['email'], $_GET['reset'])): ?>
  <h1>Alterar senha</h1>
  <form action="?page=UserProfile&email=<?=$_GET['email']?>" method="post">
    <div class="form-field">
      <p>Senha (mínimo de 8 caracteres): <br><input id="reg-password" style="max-width: 500px;"  pattern=".{8,}" type="password" name="password_new" required title="Senha deve ter ao menos 8 caracteres"></p>
      <p>Confirmar senha: <br> <input onchange="checkPassword()" id="reg-conf-password" style="max-width: 500px;" pattern=".{8,}" type="password" required title="Senha deve ter ao menos 8 caracteres"> <span id="pass-status" style="color: red;"></span></p>
      <input type="submit">
    </div>
  </form>
<?php endif;?>
<?php if(isset($result)) echo "<div class='morpheme'>{$result}</div>"; ?>
<?php if(isset($_SESSION['user'])): ?>
  <h1>Perfil</h1>
  <h2>Alterar senha</h2>
  <form action="?page=UserProfile" method="post">
    <div class="form-field">
      <p>Senha Antiga <br><input id="old-password" style="max-width: 500px;"  pattern=".{8,}" type="password" name="password_old" required title="Senha deve ter ao menos 8 caracteres"></p>
      <p>Senha (mínimo de 8 caracteres): <br><input id="reg-password" style="max-width: 500px;"  pattern=".{8,}" type="password" name="password_new" required title="Senha deve ter ao menos 8 caracteres"></p>
      <p>Confirmar senha: <br> <input onchange="checkPassword()" id="reg-conf-password" style="max-width: 500px;" pattern=".{8,}" type="password" required title="Senha deve ter ao menos 8 caracteres"> <span id="pass-status" style="color: red;"></span></p>
      <input type="submit">
    </div>
  </form>
<?php endif;?>
