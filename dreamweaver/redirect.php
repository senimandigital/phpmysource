<?php require_once('../Connections/senimandigital.php'); ?>
<?php
$_GET['getSiteRoot'] = str_replace(array('file:///', '|'), array('', ':'), $_GET['getSiteRoot']);
$_GET['filename']    = str_replace(array('file:///', '|'), array('', ':'), $_GET['filename']);
$ConnectionContent = file_get_contents($_GET['getSiteRoot'] .'Connections/'. $_GET['ConnectionName'] .'.php');
preg_match_all('/[$]database_'. $_GET['ConnectionName'] .'[\s|\S]=[\s|\S]"([^\r\n]*?)";/i', $ConnectionContent, $db);
if (substr($_GET['target'], 0, 7) == 'http://') {
$_GET['target'] = str_replace(array('file:///', '|'), array('', ':'), $_GET['target']);
header("Location: ". $_GET['target'] ."?database=". $db[1][0]);
} else {
header("Location: http://localhost/phpmyadmin/". $_GET['target'] ."?db=". $db[1][0] ."&table=". $_GET['table']);
}
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<p role="deskripsi">Script ini berfungsi untuk meredirect permintaan, contoh Dreamweaver tidak mengetahui nama database namu ia mengetahui nama Connections yang digunakan. Sedangkan kita ingin mengirim perintah ke phpmyadmin tentu saja phpmyadmin tidak akan mengerti perintah yang dikirim oleh Dreamweaver, kita juga tidak mungkin mengupdate phpmyadmin setiap kali upgrade versi. Daripada bingung kita buat saja script redirect yang berfungsi menerima perintah dari dreamweaver kemudia langsung mengirimkanya ke bahasa yang dimengerti oleh PhpMyAdmin.</p>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-">Redirect</a></li>
  </ul>
  <div id="tabs-">
  <pre><?php print_r($db); ?></pre>
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