<?php

include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();

// echo "<pre>";
// var_dump($data->user_data);
// echo "</pre>";
foreach($data as $row) {
    $a = json_decode($row->user_data, true);
    if (isset( $a['other']['uploaded_image'])){
echo '<pre>';
echo $a['other']['uploaded_image'];
echo '</pre>';
    }
    // echo $a['main']['last_name'];
    // echo $a['main']['dob'];
}
