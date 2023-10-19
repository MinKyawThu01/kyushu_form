<?php


include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();


$files = scandir('../../upload/*');
// echo '<pre>';
// var_dump($files);
// echo '</pre>';

// foreach($files as $file) {

//     // list($a, $b, $c, $d) = explode('/', $file);
//     // list($type, $img) = explode(';', $img);
//     // list($a, $b) = explode('.', $b);
//     echo '<pre>';
//     var_dump($file);
//     // if ($a == $ext)
//     echo '</pre>';
// }

$zip = new ZipArchive();
$zip_name = 'data.zip';
$pathdir = '../../upload';
if($zip -> open($zip_name, ZipArchive::CREATE ) === TRUE) { 
    
    $zip->addGlob("$pathdir*.{csv,jepg,jpg,png}*", GLOB_BRACE, [
    "add_path" => "inside/",
    "remove_all_path" => true
]);
    // Prompt download
     header('Content-Type: application/zip');
     header('Content-disposition: attachment; filename=' . $zip_name);
     header('Content-Length: ' . filesize($zip_name));
     readfile($zip_name);
    $zip ->close(); 
    
}


// var_dump($file);