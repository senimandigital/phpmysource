<?php require_once('../Connections/senimandigital.php'); ?>
<?php require_once('../Connections/information_schema.php'); ?>
<?php
$TABLESCHEMA_COLUMNS = "senimandigital";
if (isset($_GET['database'])) {
  $TABLESCHEMA_COLUMNS = $_GET['database'];
}
mysql_select_db($database_information_schema, $information_schema);
$query_COLUMNS = sprintf("SELECT *  FROM COLUMNS WHERE COLUMNS.TABLE_SCHEMA=%s ORDER BY length(CONCAT(TABLE_NAME, COLUMN_NAME)) DESC", GetSQLValueString($TABLESCHEMA_COLUMNS, "text"));
$COLUMNS = mysql_query($query_COLUMNS, $information_schema) or die(mysql_error());
$row_COLUMNS = mysql_fetch_assoc($COLUMNS);
$totalRows_COLUMNS = mysql_num_rows($COLUMNS);

mysql_select_db($database_information_schema, $information_schema);
$query_SCHEMATA = "SELECT *  FROM SCHEMATA";
$SCHEMATA = mysql_query($query_SCHEMATA, $information_schema) or die(mysql_error());
$row_SCHEMATA = mysql_fetch_assoc($SCHEMATA);
$totalRows_SCHEMATA = mysql_num_rows($SCHEMATA);
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<p role="deskripsi">Query yang anda tulis sudah bekerja sebagaimana mestinya... ? Oke itu bagus, tapi jauh lebih bagus jika query yang ditulis menggunakan standard penulisan query
yang paling aman dan ideal. Fasilitas ini membantu menyediakan script replace untuk menyempurnakan penulisan query. Penulisan query yang sempurnah memungkinkan anda untuk melakukan update
kode program dengan fasilias find and replace standard bawaan berbagai tool IDE.</p>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-database-migrasi">Script Replace</a></li>
  </ul>
  <div id="tabs-database-migrasi">
    <form method="post" name="form_database-migrasi">
<textarea data-format="php" mode="php" name="script">
&lt;?php
<?php do { // } while ($row_COLUMNS = mysql_fetch_assoc($COLUMNS));  ?>
$replace[<?php echo $row_COLUMNS['TABLE_NAME']; ?>.<?php echo $row_COLUMNS['COLUMN_NAME']; ?>] = '`<?php echo $row_COLUMNS['TABLE_NAME']; ?>`.`<?php echo $row_COLUMNS['COLUMN_NAME']; ?>`';    
<?php } while ($row_COLUMNS = mysql_fetch_assoc($COLUMNS)); $rows = mysql_num_rows($COLUMNS); if($rows > 0) { mysql_data_seek($COLUMNS, 0); $row_COLUMNS = mysql_fetch_assoc($COLUMNS); } ?>

// Urutkan berdasarkan key terpanjang lebih dahulu
$keys = array_map('strlen', array_keys($replace));
        array_multisort($keys, SORT_DESC, $replace);
$script = str_replace(array_keys($replace) , $replace, $script);
?&gt;
</textarea>
    </form>
  </div>
</div>

</section>
</td>
<td role="aside">
<section>
<h3>Database</h3>
<ul active="<?php echo $_REQUEST['database']; ?>">
<?php do { // } while ($row_SCHEMATA = mysql_fetch_assoc($SCHEMATA));  ?>
  <li active="<?php echo $row_SCHEMATA['SCHEMA_NAME']; ?>"><a href="?database=<?php echo $row_SCHEMATA['SCHEMA_NAME']; ?>"><?php echo $row_SCHEMATA['SCHEMA_NAME']; ?></a></li>
<?php } while ($row_SCHEMATA = mysql_fetch_assoc($SCHEMATA)); $rows = mysql_num_rows($SCHEMATA); if($rows > 0) { mysql_data_seek($SCHEMATA, 0); $row_SCHEMATA = mysql_fetch_assoc($SCHEMATA); } ?>
</ul>
</section>
</td>
</tr>
</table>
<?php
mysql_free_result($COLUMNS);
mysql_free_result($SCHEMATA);
?>