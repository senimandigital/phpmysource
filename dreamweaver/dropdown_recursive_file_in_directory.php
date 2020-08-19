<?php
$attr['onchange'] = ' onchange="eval(dwscripts.callCommand(this.options[this.selectedIndex].text))" ';
foreach($_REQUEST['attributes'] as $key => $value) {
$attr[$key] = $key .'="'. $value .'"';
}
?>
<select <?php echo implode(' ', $attr); ?>>
<?php
if ($_SERVER['WINDIR']) $_GET['folder_1'] = 'E:/Program Files (x86)/Adobe/Adobe Dreamweaver CS5/configuration/Commands/';
if (is_dir($_GET['folder_1'])) {
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_GET['folder_1'])) as $row_fileinfo_1){
if (!in_array($row_fileinfo_1->getExtension(), array('htm'))) continue; ?>
    <option><?php echo substr($row_fileinfo_1->getFilename(), 0, -4); ?></option>
    <?php }} // foreach(new RecursiveDirectoryIterator(__DIR__) as $row_fileinfo_1) ?>
</select>
