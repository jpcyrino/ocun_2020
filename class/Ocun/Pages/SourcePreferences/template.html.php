<!-- Variáveis: $source, $sourceName, $languageName, $sourceLicense, $sourceURL, $sourceMorphemeSeparators -->

<h1>Preferências da Fonte</h1>
<form>
<p><b>Nome: </b><?=$sourceName?></p>
<p><b>Língua: </b><?=$languageName?></p>
</form>
<br>
<br>
<h2>Tornar fonte pública</h2>
<div id="publicize-source">
  <br>
  <p>Para tornar a fonte pública, disponível ao acesso de todos os usuários da plataforma Òcun, é necessário fornecer
    informações sobre a licença da fonte (deve ser algum tipo de acesso aberto) além do endereço onde a fonte pode ser encontrada
    e acessada. Para tornar a fonte privada, digite <em>private</em> no campo Licença</p>
  <br>
  <form action="index.php?page=SourcePreferences&id=<?=$source?>" method="post">
    <div class="form-field"><p>Licença:</p><p> <input type="text" value="<?=$sourceLicense?>" name="license" required> <input type="submit" value="Salvar"></p></div>
    <div class="form-field"><p>Endereço da fonte na WEB:</p><p> <input type="text" value="<?=$sourceURL?>" name="url" required>
    <input type="submit" value="Salvar"></p></div>
  </form>
  <br>
</div>

<h2>Separadores de morfemas</h2>
<div id="morpheme-separators">
  <br>
  <p>Por padrão, morfemas são separados nas gramáticas descritivas pelo símbolo - (hífen). Algumas gramáticas também se utilizam de outros
    símbolos, indicando alguma característica específica da separação. Para a plataforma òcun essas características específicas não são
    relevantes, de forma que qualquer caractere separador de morfema deve ser considerado. Adicione na caixa abaixo os separadores além de hífen.
    Caso insira mais de um símbolo separador, separe-os por vírgula (,).</p>
  <br>
  <form action="index.php?page=SourcePreferences&id=<?=$source?>" method="post">
    <div class="form-field"><p><input id="separators" type="text" value="<?=$sourceMorphemeSeparators?>" onkeypress="RemoveSpaces('separators')" name="separators"> <input type="submit" value="Salvar"></p></div>
  </form>
  <br>
</div>

<h2>Substituição de Caracteres</h2>
<div id="encode">
  <br>
  <p>Ao colar os dados de um arquivo pdf para um campo de texto da plataforma Òcun, pode haver falhas na correspondência entre os caracteres.
  Por essa razão, disponibilizamos a ferramenta abaixo que permite que o usuário repare o problema adicionando, no campo entrada, o
  caractere colado do arquivo PDF e, no campo saída, o caractere correto. Caso existam, regras de substiutição de caractere já presentes na fonte
  podem ser encontradas mais abaixo.</p>
  <br>
  <form action="index.php?page=SourcePreferences&id=<?=$source?>" method="post">
    <div class="form-field">
      <p><b>Adicionar substituição de caractere: </b></p>
      <p>
        <input style="width: 100px;" type="text" name="input" placeholder="entrada">
        <input style="width: 100px;" type="text" name="output" placeholder="saída">
        <input type="submit" value="Salvar">
      </p>
    </div>
  </form>
  <br>
  <?php if(count($encode) > 0): ?>
    <p><b>Editar substituições de caractere: <b></p>
    <br>
    <?php foreach($encode as $row): ?>
      <form action="index.php?page=SourcePreferences&id=<?=$source?>" method="post">
        <div class="form-field">
          <p>
            Id:
            <input style="width: 50px;" type="text" name="encid" value="<?=$row['id']?>" disabled>
            Entrada:
            <input style="width: 70px;" type="text" name="input" value="<?=$row['input']?>" placeholder="entrada">
            Saída:
            <input style="width: 70px;" type="text" name="output" value="<?=$row['output']?>" placeholder="saída">
            <input type="submit" value="Atualizar">
          </p>
        </div>
      </form>
    <?php endforeach;?>
  <?php endif;?>
</div>

<script>
function ShowHide(id){
  if(document.getElementById(id).style.display == 'none'){
    document.getElementById(id).style.display = 'block';
  } else {
    document.getElementById(id).style.display = 'none';
  }
}

function RemoveSpaces(id){
  document.getElementById(id).value = document.getElementById(id).value.replace(/ /gi, '');
}
</script>
