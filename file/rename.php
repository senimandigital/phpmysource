<?php require_once('../Connections/senimandigital.php'); ?>
<?php
$_REQUEST['folder'] = $_REQUEST['folder'] ? $_REQUEST['folder'] : 'D:\Online\Google Drive\phpmysource.kom'; 
$_REQUEST['find'] = $_REQUEST['find'] ? $_REQUEST['find'] : 'aplikasi'; 
$_REQUEST['replace'] = $_REQUEST['replace'] ? $_REQUEST['replace'] : 'application'; 
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<?php include $WEBSITE['HOSTING']['TEMPLATES'] .'php/deskripsi.php'; ?>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-rename">Konfigurasi Rename</a></li>
  </ul>
  <div id="tabs-rename">
<form method="get" name="form_rename" id="form_rename">
<table frame="box">
  <tbody>
    <tr>
      <td><label for="folder">folder</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><input type="text" name="folder" value="<?php echo $_REQUEST['folder']; ?>" /></td>
      </tr>
    <tr>
      <td><label for="find">find</label></td>
      <td><label for="replace">replace</label></td>
      </tr>
    <tr>
      <td><input type="text" name="find" value="<?php echo $_REQUEST['find']; ?>" /></td>
      <td><input type="text" name="replace" value="<?php echo $_REQUEST['replace']; ?>" /></td>
      </tr>
          
  </tbody>
  <caption align="bottom">
  <input type="submit" style="float:right" value="Dapatkan List File" />
  </caption>
</table>
</form>
    <table frame="box" border="1" cellpadding="0">
      <thead>
        <tr>
          <th><input type="checkbox" checkbox-control="replace" checked="checked" /></th>
          <th>Find</th>
          <th>Replace</th>
          <th>Progress</th>
        </tr>
      </thead>
      <tbody>
<?php foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_REQUEST['folder']), RecursiveIteratorIterator::CHILD_FIRST) as $fileInfo) {
if (!$fileInfo->isfile()) continue;
$replace = str_replace('\\','/', $fileInfo->getPathname()); $find = $replace;
$replace = explode('/', $replace);
if (str_replace($_REQUEST['find'], $_REQUEST['replace'], end($replace)) == end($replace) ) continue;
$replace[count($replace) - 1] = str_replace($_REQUEST['find'], $_REQUEST['replace'], end($replace)); 
$replace = implode('/', $replace);

$key = $key ? $key + 1 : 1;

?>
        <tr>
          <td width="5"><input type="checkbox" class="replace" key="<?php echo $key; ?>" value="<?php echo $find; ?>" replace="<?php echo $replace; ?>" checked="checked" /></td>
          <td><?php echo $find; ?></td>
          <td><?php echo $replace; ?></td>
        <td><a id="<?php echo $key; ?>_report">Ready</a></td>
        </tr>
<?php } ?>
      </tbody>
  <caption align="bottom">
  <input type="button" ajax-post=".replace" data-post="'filename[old]':'value','filename[new]':'replace'" style="float:right" value="Mulai Rename" />
  </caption>
    </table>
  </div>
</div>
</section>
</td>
<td role="aside">
<section>
<h3>Tabel Referensi</h3>
<ul data-filter="true" active="<?php $_GET['table']; ?>">
<?php do { // } while ($row_show_tables = mysql_fetch_assoc($show_tables));  ?>
<li active="="><a href="?referensi[<?php echo $row_show_tables['Tables_in_'. $database_senimandigital]; ?>]"><input url-change="parameter" name="referensi[<?php echo $row_show_tables['Tables_in_'. $database_senimandigital]; ?>]" type="checkbox" value="" /><?php echo $row_show_tables['Tables_in_'. $database_senimandigital]; ?></a></li>
<?php } while ($row_show_tables = mysql_fetch_assoc($show_tables)); $rows = mysql_num_rows($show_tables); if($rows > 0) { mysql_data_seek($show_tables, 0); $row_show_tables = mysql_fetch_assoc($show_tables); } ?>
</ul>
</section>
</td>
</tr>
</table>
<script>
$(document).ready(function() {      $( "[ajax-post]" ).click(function() {
var data_post = eval('({'+ $(this).attr('data-post') +'})');  
$( $(this).attr('ajax-post') ).each(function() {  var id = $(this).attr('key');  var datapost = Array();
  $.each(data_post, function(key, value){   datapost.push( key +'='+ $('[key='+ id +']').attr(value) );  });
  $.post( "<?php echo $WEBSITE['DOMAIN']['FILE']; ?>rename_action.php?ajax=true&"+ datapost.join('&'), function( data ) {  $( "a[id="+ id +"_report]" ).html( data ); });
});
}); });
</script>
