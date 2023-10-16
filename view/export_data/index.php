<?php

include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();

// echo "<pre>";
// var_dump($data->user_data);
// echo "</pre>";
foreach ($data as $row) {
    $a = json_decode($row->user_data, true);
    
    if (isset( $a['other']['uploaded_image']) && isset($a['main']['first_name'])) {
        $img = $a['other']['uploaded_image'];
        
        list($type, $img) = explode(';', $img);
        list(, $img)      = explode(',', $img);
        list(, $ext) = explode('/', $type);
        

        // echo $ext;
        // echo '<br>';
        // echo ($type);
        // echo '<br>';
        // echo ($img);
        // die();
        $img_name = $row->user_id . 'kyushu' . '_' . $a['main']['first_name'] . '.' . $ext;
        $imageData = base64_decode($img);
        
        $imgFolder = '../../upload/';
        $imgPath = $imgFolder . $img_name;
        echo $img_name;
        die();
        file_put_contents($imgPath, $imageData);
        
    }

}
