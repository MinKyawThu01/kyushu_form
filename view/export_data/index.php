<?php

include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();

// var_dump($data->id);
foreach($data as $row) {
    
}

?>