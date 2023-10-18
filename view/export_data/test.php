<?php


include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();


$files = scandir('../../upload/*');
// echo '<pre>';
// var_dump($files);
// echo '</pre>';

foreach($files as $file) {

    // list($a, $b, $c, $d) = explode('/', $file);
    // list($type, $img) = explode(';', $img);
    // list($a, $b) = explode('.', $b);
    echo '<pre>';
    var_dump($file);
    // if ($a == $ext)
    echo '</pre>';
}



// var_dump($file);