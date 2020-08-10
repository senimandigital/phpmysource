<?php require_once('../Connections/senimandigital.php'); ?>
<?php
if ($_REQUEST['folder_a'] && $_REQUEST['folder_b']) {
$_REQUEST['folder_a'] = str_replace(array('\\\\','\\'), array('\\','/'), $_REQUEST['folder_a']);
$file_a  = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_REQUEST['folder_a']));
foreach($file_a AS $fileinfo_a){
$array_a[str_replace($_REQUEST['folder_a'], "", $fileinfo_a->getPathname())] = str_replace($_REQUEST['folder_a'], "", $fileinfo_a->getPathname());
}

$_REQUEST['folder_b'] = str_replace(array('\\\\','\\'), array('\\','/'), $_REQUEST['folder_b']);
$file_b = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_REQUEST['folder_b']));
foreach($file_b AS $fileinfo_b){
$array_b[str_replace($_REQUEST['folder_b'], "", $fileinfo_b->getPathname())] = str_replace($_REQUEST['folder_b'], "", $fileinfo_b->getPathname());
}}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td role="article">
<section>
<h3>FOLDER COMPARE</h3>
<p role="deskripsi">Fitur ini masih hanya membandingkan eksisteni file pada dua buah folder kemudian menggunakan fungsi md5 untuk membandingkan content dari masing-masing file.</p>
<form method="get" name="compare_folder">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td><input type="text" name="folder_a" placeholder="E:\Program Files (x86)\Macromedia\Dreamweaver 8\Configuration\Commands" style="width:100%" value="<?php echo $_REQUEST['folder_a']; ?>" /></td>
<td width="50" rowspan="2" valign="middle">
<button type="submit" style="border: 0; background: transparent">
 <img src="<?php echo $WEBSITE['DOMAIN']['GAMBAR']; ?>website/icon-go-button.png" height="50" alt="submit" />
</button>
</td>
</tr>
<tr>
<td><input name="folder_b" type="text" style="width:100%" value="<?php echo $_REQUEST['folder_b']; ?>" readonly="readonly" placeholder="E:\Program Files (x86)\Adobe\Adobe Dreamweaver CS4\Configuration\Commands" /></td>
</tr>
</table>
</form>
<div role="tabs" id="tabs">
<ul>
  <li><a href="#tabs-compare">Compare Folder</a></li>
</ul>
<div id="tabs-compare">
<table frame="box" border="0" cellpadding="0">
<thead>
<tr>
<td>File</td>
<td><?php echo basename($_REQUEST['folder_a']); ?></td>
<td><?php echo basename($_REQUEST['folder_b']); ?></td>
<td>Action</td>
</tr>
</thead>
<?php foreach(array_unique(array_merge($array_a, $array_b)) as $key => $value) { ?>
<tr<?php if (($array_a[$key] && $array_b[$key]) && (md5($_REQUEST['folder_a'] . $array_a[$key]) != md5($_REQUEST['folder_b'] . $array_b[$key])) ) { ?> bgcolor="#9999FF" <?php } ?>>
<td><?php echo $key; ?></td>
<td><?php echo $array_a[$key] ? md5($_REQUEST['folder_a'] . $array_a[$key]) : '<img src="'. $WEBSITE['DOMAIN']['GAMBAR'] .'website/form_hapus.png" width="12" height="12" />' ; ?></td>
<td><?php echo $array_b[$key] ? md5($_REQUEST['folder_b'] . $array_b[$key]) : '<img src="'. $WEBSITE['DOMAIN']['GAMBAR'] .'website/form_hapus.png" width="12" height="12" />' ; ?></td>
<td>
  <a target="_blank" popup="dialog" href="<?php echo $WEBSITE['DOMAIN']['FILE']; ?>compare.php?file_a=<?php echo$_REQUEST['folder_a'] . $array_a[$key]; ?>&file_b=<?php echo $_REQUEST['folder_b'] . $array_b[$key]; ?>">Compare</a>
| <a target="_blank" popup="dialog" href="<?php echo $WEBSITE['DOMAIN']['FILE']; ?>copy.php?file_a=<?php echo$_REQUEST['folder_a'] . $array_a[$key]; ?>&file_b=<?php echo $_REQUEST['folder_b'] . $array_b[$key]; ?>">Duplikasi</a>
| <a target="_blank" popup="dialog" href="<?php echo $WEBSITE['DOMAIN']['FILE']; ?>unlink.php?file_a=<?php echo$_REQUEST['folder_a'] . $array_a[$key]; ?>&file_b=<?php echo $_REQUEST['folder_b'] . $array_b[$key]; ?>">Remove</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
</section></td>
</tr>
</table>
