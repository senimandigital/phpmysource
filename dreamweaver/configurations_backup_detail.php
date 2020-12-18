<?php require_once('../Connections/senimandigital.php'); ?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3>Memeriksa Kostumasi Dreamweaver Yang Belum Di Backup</h3>
<p role="deskripsi">Kita sebagai pekerja Profesional selalu mengkostumasi alat kerja yang kita gunakan di sepanjang waktu dan pada setiap kesempatan. Fasilitas ini akan membantu melacak file mana saja yang belum kita backup ketempat penyimpanan yang lebih aman dan terdistribusi yang memungkinkan kita dapat segera melanjutkan perkejaan meskipun di komputer yang baru.</p>
<?php
$_REQUEST['folder']['dreamweaver'] = $_REQUEST['folder']['dreamweaver'] ? $_REQUEST['folder']['dreamweaver'] : "E:/Program Files (x86)/Adobe/Adobe Dreamweaver CS5/configuration/ServerBehaviors/PHP_MySQL";
$_REQUEST['folder']['backup']      = $_REQUEST['folder']['backup'] ? $_REQUEST['folder']['backup'] : "D:/Online/Dropbox/dreamweaver/ServerBehaviors/PHP_MySQL";

foreach($_REQUEST['folder'] as $key => $value) {
$_ENV[$key]  = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_REQUEST['folder'][$key]));
foreach($_ENV[$key] as $fileinfo) {
if (in_array($fileinfo->getBasename(), array('.','..') )) continue;
if (str_replace(array('Connections', '_notes'), array('','') , $fileinfo->getPathname()) != $fileinfo->getPathname()) continue;
if (in_array($fileinfo->getBasename(), array('.synkron.syncdb') )) continue;
if (in_array($fileinfo->getExtension(), array('lnk') )) continue;
$array_getKey[] = str_replace($_REQUEST['folder'][$key] ,'', $fileinfo->getPathname());
$array_getPathname[str_replace($_REQUEST['folder'][$key] ,'', $fileinfo->getPathname())][$key] = $fileinfo->getPathname();
}}
// print_r($array_getPathname);
?>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-informasi-backup">Informasi Backup</a></li>
  </ul>
  <div id="tabs-informasi-backup">
<table>
<?php foreach($_REQUEST['folder'] as $key => $value) { ?>
  <tr>
    <td><?php echo $key; ?></td>
    <td><?php echo $value; ?></td>
  </tr>
<?php } /* end foreach */ ?>
</table>

<table frame="box" border="1">
  <thead>
    <tr>
      <th scope="col">File</th>
      <th scope="col">Dreamweaver</th>
      <th scope="col">Dropbox</th>
      <th colspan="2">AKSI</th>
    </tr>
  </thead>
  <tbody rules="rows">
<?php foreach (array_unique( $array_getKey ) as $key => $file) { ?>
<?php if (md5_file($array_getPathname[$file]['dreamweaver']) == md5_file($array_getPathname[$file]['backup'])) continue; ?>
    <tr>
      <td><?php echo $file; ?></td>
      <td><?php echo str_replace($_REQUEST['folder']['dreamweaver'] ,'', $array_getPathname[$file]['dreamweaver']); ?></td>
      <td><?php echo str_replace($_REQUEST['folder']['backup'] ,'', $array_getPathname[$file]['backup']); ?></td>
      <td align="center" width="10px"><a data-icon="update">E</a></td>
      <td align="center" width="10px"><a data-icon="delete">H</a></td>
    </tr>
<?php } ?>
  </tbody>
</table>
</div>
</div>
</section></td>
<td role="aside">
<section>
<h3>KONFIGURASI</h3>
<form method="post" action="" ><table>
<?php foreach($_REQUEST['folder'] as $key => $value) { ?>
  <tr>
    <td><?php echo $key; ?></td>
  </tr>
  <tr>
    <td><input type="text" name="folder[<?php echo $key; ?>]" value="<?php echo $value; ?>" /></td>
  </tr>
<?php } /* end foreach */ ?>
  <caption align="bottom">
  <input type="submit" value="Eksekusi" />
  </caption>
</table>
</form>
</section>
</td>
</tr>
</table>