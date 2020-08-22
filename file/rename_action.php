<?php 
if (is_file($_REQUEST['filename']['old']) && !file_exists($_REQUEST['filename']['new'])) {
 rename($_REQUEST['filename']['old'], $_REQUEST['filename']['new']);
}
if (file_exists($_REQUEST['filename']['new']) && $_REQUEST['ajax']=='true') {
	echo 'Sukses';
}
?>