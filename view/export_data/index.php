<?php


include('../../app/classes/Export.php');

$export = new Export();

$export->createFolder();
$export->delImg();
$export->dataExport();
$export->exportZip();

?>