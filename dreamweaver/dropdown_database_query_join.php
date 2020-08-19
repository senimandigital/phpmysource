<?php require_once('../Connections/senimandigital_phpmyadmin.php'); ?>
<?php $path = str_replace(array('file:///', '|', '/'), array('', ':', '\\'), $_GET['LocalRootURL']) .'Connections\\'. $_GET['ConnectionName'] .'.php'; ?>
<?php $handle = file_get_contents($path); ?>
<?php preg_match_all('/[$]database_'. $_GET['ConnectionName'] .'[\s|\S]=[\s|\S]"([^\r\n]*?)";/i', $handle, $database_table_name); ?>
<?php 
$masterdb_pma_relation = $_REQUEST['database'];
if (isset($database_table_name[1][0])) {
  $masterdb_pma_relation = $database_table_name[1][0];
}
$mastertable_pma_relation = "anggota";
if (isset($_GET['tabel'])) {
  $mastertable_pma_relation = $_GET['tabel'];
}
mysql_select_db($database_senimandigital_phpmyadmin, $senimandigital_phpmyadmin);
$query_pma_relation = sprintf("SELECT * FROM `pma_relation` WHERE `pma_relation`.`master_db`=%s AND `pma_relation`.`master_table`=%s", GetSQLValueString($masterdb_pma_relation, "text"),GetSQLValueString($mastertable_pma_relation, "text"));
$pma_relation = mysql_query($query_pma_relation, $senimandigital_phpmyadmin) or die(mysql_error());
$row_pma_relation = mysql_fetch_assoc($pma_relation);
$totalRows_pma_relation = mysql_num_rows($pma_relation);

$masterdb_pma_relation_turun = "-1";
if (isset($database_table_name[1][0])) {
  $masterdb_pma_relation_turun = $database_table_name[1][0];
}
$foreigntable_pma_relation_turun = "-1";
if (isset($_GET['tabel'])) {
  $foreigntable_pma_relation_turun = $_GET['tabel'];
}
mysql_select_db($database_senimandigital_phpmyadmin, $senimandigital_phpmyadmin);
$query_pma_relation_turun = sprintf("SELECT * FROM pma_relation WHERE pma_relation.master_db=%s AND pma_relation.foreign_table=%s", GetSQLValueString($masterdb_pma_relation_turun, "text"),GetSQLValueString($foreigntable_pma_relation_turun, "text"));
$pma_relation_turun = mysql_query($query_pma_relation_turun, $senimandigital_phpmyadmin) or die(mysql_error());
$row_pma_relation_turun = mysql_fetch_assoc($pma_relation_turun);
$totalRows_pma_relation_turun = mysql_num_rows($pma_relation_turun);
?>
<?php do { ?>
<option value="<?php echo $row_pma_relation['foreign_table']; ?> ON <?php echo $row_pma_relation['foreign_table']; ?>.<?php echo $row_pma_relation['foreign_field']; ?> = <?php echo $row_pma_relation['master_table']; ?>.<?php echo $row_pma_relation['master_field']; ?>"> ON <?php echo $row_pma_relation['foreign_table']; ?>.<?php echo $row_pma_relation['foreign_field']; ?> = <?php echo $row_pma_relation['master_table']; ?>.<?php echo $row_pma_relation['master_field']; ?></option>
<?php } while ($row_pma_relation = mysql_fetch_assoc($pma_relation)); ?>
<?php   /*  ?>
<option>----- ----- -----</option>
<?php do {?>
<option value="<?php echo $row_pma_relation_turun['master_table']; ?> ON <?php echo $row_pma_relation_turun['master_table']; ?>.<?php echo $row_pma_relation_turun['master_field']; ?> = <?php echo $row_pma_relation_turun['foreign_table']; ?>.<?php echo $row_pma_relation_turun['foreign_field']; ?>">ON <?php echo $row_pma_relation_turun['master_table']; ?>.<?php echo $row_pma_relation_turun['master_field']; ?> = <?php echo $row_pma_relation_turun['foreign_table']; ?>.<?php echo $row_pma_relation_turun['foreign_field']; ?></option>
<?php } while ($row_pma_relation_turun = mysql_fetch_assoc($pma_relation_turun)); */ ?>
