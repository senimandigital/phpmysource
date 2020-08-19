<?php require_once('../Connections/senimandigital.php'); ?>
<?php
mysql_select_db($database_senimandigital, $senimandigital);
$query_dreamweaver = "SELECT * FROM dreamweaver ORDER BY dreamweaver.dreamweaver_urutan";
$dreamweaver = mysql_query($query_dreamweaver, $senimandigital) or die(mysql_error());
$row_dreamweaver = mysql_fetch_assoc($dreamweaver);
$totalRows_dreamweaver = mysql_num_rows($dreamweaver);
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<?php include $WEBSITE['HOSTING']['TEMPLATES'] .'php/deskripsi.php'; ?>
<?php include $WEBSITE['HOSTING']['TEMPLATES'] .'php/konten.php'; ?>
</section>
</td>
<td role="aside">
<section>
<h3>My Dreamweaverd</h3>
<ul>
<?php do { ?>
 <li><a href="/dreamweaver_edit.php?dreamweaver_id=<?php echo $row_dreamweaver['dreamweaver_id']; ?>"><?php echo $row_dreamweaver['dreamweaver_judul']; ?></a></li>
<?php } while ($row_dreamweaver = mysql_fetch_assoc($dreamweaver)); ?>
</ul>
<center>
  <a href="../dreamweaver_tambah.php">Daftar Baru</a>
</center>
</section>
</td>
</tr>
</table>
<?php
mysql_free_result($dreamweaver);
?>
