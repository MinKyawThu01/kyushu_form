<?php


include('../../app/classes/Export.php');

$export = new Export();

$export->delImg();
$export->dataExport();
$export->exportZip();

?>