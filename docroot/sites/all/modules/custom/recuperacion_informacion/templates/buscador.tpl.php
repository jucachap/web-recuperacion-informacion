
<form id="buscador" action="/buscador" method="post" accept-charset="UTF-8">
  <input id="keys" name="data[keys]" value="" type="text" size="80" placeholder="Escribe el texto a buscar aqui" autocomplete="off" />
  <input id="send" name="data[send]" value="Buscar" type="submit" />
  <fieldset>
    <legend>Opciones</legend>
    <div>
      <br />
      <input id="category" type="checkbox" name="data[category]" value="categorized" checked="checked" /><label for="category">Categorizar</label>
      <label>Cantidad Resultados</label>
      <select id="resultados" name="data[results]">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
      </select>
    </div>
  </fieldset>
</form>

<div id="results" class="search-results">
<?php

if (isset($documents)) {

  $path = 'http://190.121.139.11:8080/IRProject/reuters-news/';
  $clusters = array();

  for ($i=0; $i<count($documents); $i++) {
    $document = $documents[$i];
    $file_name = substr($document['path'], (87 - count($document['path'])));
    //if ($i%2) {
      $clusters[$document['cluster']] = (isset($clusters[$document['cluster']]) ? $clusters[$document['cluster']]+1 : 1);
    /*}
    else {
      $clusters['cat1'] = (isset($clusters['cat1']) ? $clusters['cat1']+1 : 1);
    }*/

    ?>
    <div class="<?php print $document['cluster']; ?>">
        <div>
            <h3><a href="<?php print $path.$file_name; ?>" target="_blank"><?php print $file_name; ?></a></h3>
        </div>
        <div>
            <h4><i><?php print $path.$file_name; ?></i></h4>
        </div>
        <div>
            <?php
                $text_content = file_get_contents($path.$file_name);
                print str_replace($keys, '<b>'. $keys .'</b>', $text_content);
            ?>
        </div>
    </div>
    <?php
  }
  ?>
</div>
<?php if ($show_cluster): ?>
<div id="cluster">
    <h3>Clustering</h3>
    <ul>
        <li><a href="#"><span>Mostrar Todos</span></a></li>
    <?php
    foreach ($clusters as $cluster => $total_docs) {
      ?><li><a href="#"><?php print '<span>' . $cluster . '</span> (' . $total_docs . ' documents)'; ?></a></li><?php
    }
    ?>
    </ul>
</div>
<?php
endif;
}

