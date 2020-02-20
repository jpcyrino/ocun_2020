<h1>Navegar pelas Línguas</h1>
<p>Dispomos fontes de dados nas línguas abaixo. Clique em uma fonte para visualizar os dados.</p>
<br>
<br>
<?php foreach($list as $key => $source): ?>
  <?php if($key==0 || $list[$key-1]['language'] != $source['language']): ?>
    <div class="morpheme" style="display: block;">
    <h2><?=$source['name']?></h2>
    <br>
    <p><?=$source['information']?></p>
    <br>
    <h3>Fontes: </h3>
    <ul>
  <?php endif;?>
    <li><?=$source['author']?>, <?=$source['year']?>: <a href="?page=SourceInfo&id=<?=$source['sid']?>"><?=$source['title']?></a></li>
  <?php if($key == count($list)-1 || $list[$key+1]['language'] != $source['language']): ?>
    </ul>
    </div>
    <br>
  <?php endif;?>
<?php endforeach;?>
