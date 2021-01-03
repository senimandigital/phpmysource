<?php require_once('../Connections/senimandigital.php'); ?>
<?php
mysql_select_db($database_senimandigital, $senimandigital);
$query_show_tables = "SHOW TABLES";
$show_tables = mysql_query($query_show_tables, $senimandigital) or die(mysql_error());
$row_show_tables = mysql_fetch_assoc($show_tables);
$totalRows_show_tables = mysql_num_rows($show_tables);

do { // } while ($row_show_tables = mysql_fetch_assoc($show_tables));
if ($_GET['table'] != $row_show_tables['Tables_in_'. $database_senimandigital]) continue; $aman = true;
if (isset($_GET['table'])) {
$TABLE_NAME = $_GET['table'];
}
mysql_select_db($database_senimandigital, $senimandigital);
$query_show_columns = "SHOW COLUMNS FROM ". $TABLE_NAME;
$show_columns = mysql_query($query_show_columns, $senimandigital) or die(mysql_error());
$row_show_columns = mysql_fetch_assoc($show_columns);
$totalRows_show_columns = mysql_num_rows($show_columns);
} while ($row_show_tables = mysql_fetch_assoc($show_tables)); $rows = mysql_num_rows($show_tables); if($rows > 0) { mysql_data_seek($show_tables, 0); $row_show_tables = mysql_fetch_assoc($show_tables); }
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3>Local Storage - WebSQL</h3>
<p role="deskripsi">Ini adalah bahan belajar untuk bermain dengan Web SQL menggunakan database yang aktif saat ini, websql adalah data yang simpan pada browser dan dapat diakses menggunakan query SQL. <a href="http://administrator.senimandigital.kom/adminer.php?server=localhost&amp;username=senimandigital&amp;db=senimandigital&amp;dump=<?php echo $_GET['table']; ?>" target="_blank">Export Data</a></p>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-web-sql">Web SQL</a></li>
  </ul>
  <div id="tabs-web-sql">
<script>
var db = openDatabase('senimandigital', '1.0', 'Senimandigital', 2 * 1024 * 1024);
</script>
<textarea data-format="javascript" mode="javascript" name="javascript" >
<?php ob_start(); ?>
<script>
var db = openDatabase('senimandigital', '1.0', 'Senimandigital', 2 * 1024 * 1024);
db.transaction(function (tx) { 
   tx.executeSql('CREATE TABLE IF NOT EXISTS `<?php echo $_GET['table']; ?>` (<?php do { // } while ($row_show_columns = mysql_fetch_assoc($show_columns));  ?><?php echo $row_show_columns['Field']; ?>, <?php } while ($row_show_columns = mysql_fetch_assoc($show_columns)); $rows = mysql_num_rows($show_columns); if($rows > 0) { mysql_data_seek($show_columns, 0); $row_show_columns = mysql_fetch_assoc($show_columns); } ?>)');
   tx.executeSql('INSERT INTO `<?php echo $_GET['table']; ?>` (<?php do { // } while ($row_show_columns = mysql_fetch_assoc($show_columns));  ?><?php echo $row_show_columns['Field']; ?>, <?php } while ($row_show_columns = mysql_fetch_assoc($show_columns)); $rows = mysql_num_rows($show_columns); if($rows > 0) { mysql_data_seek($show_columns, 0); $row_show_columns = mysql_fetch_assoc($show_columns); } ?>) VALUES (1, "foobar")'); 
});
</script>
<?php $source = ob_get_contents(); ob_end_clean(); echo str_replace(', )', ')', $source); ?>
</textarea>
  </div>
</div>
</section>
</td>
<td role="aside">
<section>
<h3>Tabel</h3>
<ul data-filter="true" id="show-tables" active="<?php echo $_GET['table']; ?>">
<?php do { // } while ($row_show_tables = mysql_fetch_assoc($show_tables)); ?>
<li active="<?php echo $row_show_tables[key($row_show_tables)]; ?>"><a href="?table=<?php echo $row_show_tables[key($row_show_tables)]; ?>"><?php echo $row_show_tables[key($row_show_tables)]; ?></a></li>
<?php } while ($row_show_tables = mysql_fetch_assoc($show_tables)); $rows = mysql_num_rows($show_tables); if($rows > 0) { mysql_data_seek($show_tables, 0); $row_show_tables = mysql_fetch_assoc($show_tables); } ?>
</ul>
</section>
</td>
</tr>
</table>