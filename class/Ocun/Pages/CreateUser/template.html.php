<h1>Cadastrar Usuário</h1>
<p>Ao me cadastrar na plataforma Òcun comprometo-me a: </p>
<br>
<ul>
  <li>Ao mencionar, em quaisquer publicações, dados linguísticos obtidos na plataforma, fazer referência diretamente às fontes dos dados e não à plataforma Òcun.</li>
  <li>Ao mencionar, em quaisquer publicações, dados estatísticos obtidos na plataforma, fazer referência à plataforma Òcun e às fontes dos dados linguísticos levados em conta no levantamento.</li>
</ul>
<br>
<br>
<form action="?page=CreateUser" method="post">
  <div class="form-field">
    <p>E-mail: <br><input id="reg-email" onchange="checkEmail()" style="max-width: 500px;" type="email" name="email" required></p><span id="email-status" style="color: red;"></span></p>
    <p>Nome: <br><input type="text" style="max-width: 500px;"  name="name" required></p>
    <p>Senha (mínimo de 8 caracteres): <br><input id="reg-password" style="max-width: 500px;"  pattern=".{8,}" type="password" name="password" required title="Senha deve ter ao menos 8 caracteres"></p>
    <p>Confirmar senha: <br> <input onchange="checkPassword()" id="reg-conf-password" style="max-width: 500px;" pattern=".{8,}" type="password" required title="Senha deve ter ao menos 8 caracteres"> <span id="pass-status" style="color: red;"></span></p>
    <input id="submit" type="submit" name="submit" value="Cadastrar" disabled>
  </div>
</form>
<script>

var email = false;

function checkEmail(){
  Ajax('?page=CreateUser&ajax=' + document.getElementById("reg-email").value, emailExists);
}

function emailExists(resp){
  console.log(resp);
  if(resp == "true"){
    document.getElementById("email-status").innerHTML = "E-mail já cadastrado.";
    email = false;
  } else {
    document.getElementById("email-status").innerHTML = "";
    email = true;
  }
}

function checkPassword(){
  if(document.getElementById("reg-password").value != "" && document.getElementById("reg-password").value == document.getElementById("reg-conf-password").value){
    document.getElementById("pass-status").innerHTML = "";
    if(email){
      document.getElementById("submit").disabled = false;
    }
  }
  if(document.getElementById("reg-conf-password").value != "" && document.getElementById("reg-password").value != document.getElementById("reg-conf-password").value){
    document.getElementById("pass-status").innerHTML = "Senhas não correspondem. Por favor, verifique.";
    document.getElementById("submit").disabled = true;
  }
}

</script>
