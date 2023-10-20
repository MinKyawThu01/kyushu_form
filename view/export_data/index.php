<?php


include('../../app/classes/Export.php');

$export = new Export();


if ($export->index()) {
    $export->createFolder();
    $export->delImg();
    $export->dataExport();
    $export->exportZip();
} else {
    echo '<h1>There is no data to export.</h1>';
}
