<?php require_once('../Connections/senimandigital.php'); ?>
<?php
mysql_select_db($database_senimandigital, $senimandigital);
$query_dreamweaver = "SELECT *  FROM dreamweaver ORDER BY dreamweaver.dreamweaver_urutan";
$dreamweaver = mysql_query($query_dreamweaver, $senimandigital) or die(mysql_error());
$row_dreamweaver = mysql_fetch_assoc($dreamweaver);
$totalRows_dreamweaver = mysql_num_rows($dreamweaver);

$_REQUEST['count'] = $_REQUEST['count'] ? $_REQUEST['count'] : 2;
?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<p role="deskripsi">Ada banyak sebab yang membuat kita butuh untuk membandingkan struktur file. fasilitas ini membantu mempermudah hal tersebut.</p>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-compare">Comvare Version</a></li>
  </ul>
  <div id="tabs-compare">
    <form method="get" action="<?php echo $WEBSITE['DOMAIN']['FOLDER']; ?>compare_version.php">
      <table frame="box">
        <thead>
        <tr>
<?php for ($i = 1 ; $i <= $_REQUEST['count']; $i++) { ?>
          <th>Version</th>
<?php } ?>
          <th colspan="2" width="100px">Action</th>
        </tr>
        </thead>
        <tbody>
          <tr>
<?php for ($i = 1 ; $i <= $_REQUEST['count']; $i++) { ?>
            <td><select name="folder[<?php echo $i; ?>]">
              <?php do {  ?>
              <option value="<?php echo $row_dreamweaver['dreamweaver_location']?>"><?php echo $row_dreamweaver['dreamweaver_judul']?></option>
              <?php } while ($row_dreamweaver = mysql_fetch_assoc($dreamweaver)); $rows = mysql_num_rows($dreamweaver); if($rows > 0) { mysql_data_seek($dreamweaver, 0); $row_dreamweaver = mysql_fetch_assoc($dreamweaver); } ?>
            </select></td>
<?php } ?>
            <td width="32"><img href="?count=<?php echo $_REQUEST['count']+1; ?>" src="<?php echo $WEBSITE['DOMAIN']['GAMBAR']; ?>website/form-action-plus.png" title="Tambah" /></td>
            <td width="50"><input type="submit" value="Compare" /></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
</section>
</td>
<td role="aside"><?php include $WEBSITE['HOSTING']['TEMPLATES'] . 'php/menu_samping.php'; ?></td>
</tr>
</table>
<?php
mysql_free_result($dreamweaver);
?>
