<?php require_once('../Connections/senimandigital.php'); ?>
<table>
<tr>
<td role="article" valign="top">
<section>
<h3><?php echo $WEBSITE['DOMAIN']['SUB'] . $_SERVER['SCRIPT_NAME']; ?></h3>
<?php include $WEBSITE['HOSTING']['TEMPLATES'] .'php/deskripsi.php'; ?>
<div role="tabs" id="tabs">
  <ul>
    <li><a href="#tabs-favicon">Favicon Manager</a></li>
  </ul>
  <div id="tabs-favicon">
<table column="10" cellspacing="10">
<tbody>
  <?php 
if (is_dir($WEBSITE["HOSTING"]["ROOT"])) { foreach(new DirectoryIterator($WEBSITE["HOSTING"]["ROOT"]) as $row_fileinfo_1){ ?>
  <?php if(in_array($row_fileinfo_1->getBasename(), array('.','..','_notes','_mmServerScripts','Connections')) ) continue; ?>
  <?php if(!$row_fileinfo_1->isDir()) continue; ?>
  <tr><td class="ui-widget-content">
  <div class="ui-widget-header" align="center";><a href="<?php echo APP; ?>configuration/serverbehaviors/<?php echo $row_fileinfo_1->getBasename(); ?>"><?php echo $row_fileinfo_1->getBasename(); ?></a></div>
  <div class="ui-widget-content;" align="center" style="padding-top:10px; padding-bottom:10px;">
  <?php if (file_exists($row_fileinfo_1->getPathname() .'/favicon.ico')) { ?>
  <img src="../gambar/website/check-green.jpg" height="64" />
  <?php } else { ?>
  <img src="../gambar/website/404-warning.jpg" height="64" />
  <?php } ?>
  </div>
  </td></tr>
  <?php }} // foreach(new RecursiveDirectoryIterator(__DIR__) as $row_fileinfo_1) ?>
<tbody>
</table>  </div>
</div>
</section>
</td>
<td role="aside">
<?php if (file_exists('_aside.php')) { include "_aside.php"; } elseif (file_exists($WEBSITE['HOSTING']['TEMPLATES'] .'_aside.php')) { include $WEBSITE['HOSTING']['TEMPLATES'] ."_aside.php"; } else { include $WEBSITE['HOSTING']['TEMPLATES'] .'php/menu_samping.php'; } ?>
</td>
</tr>
</table>