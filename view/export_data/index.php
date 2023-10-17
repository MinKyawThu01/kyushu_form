<?php

include('../../app/classes/Kyushu.php');

$kyushu = new Kyushu();

$data = $kyushu->export();


// echo "<pre>";
// var_dump($data->user_data);
// echo "</pre>";



// data for excel 
$fileName = "users_data_" . date('Y-m-d') . ".xlsx";
$titles = array('ID', 'User ID', 'Full Name', 'DOB', 'Gender', 'Nationality', 'Occupation', 'Religion', 'SNS Username', 'Japan Before', 'Region', 'Dietary Restrictions', 'Email', 'Phone Number', 'Full Name TC', 'DOB TC', 'Gender TC', 'Nationality TC', 'Relationship with applicant', 'Dietary Restrictions TC', 'Full Name(birthday gift)', 'Traveling Preiod', 'Know Campaign', 'Image Name', 'Area');

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

// Open the output stream
$fp = fopen('php://output', 'w');

// Add UTF-8 BOM to support special characters
fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));

fputcsv($fp, $titles);


$files = glob('../../upload/' . '*');
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
    }
}

foreach ($data as $row) {
    $user_data = json_decode($row->user_data, true);
    // $i++;

    if (isset($user_data['other']['uploaded_image']) && isset($user_data['main']['first_name'])) {
        $img = $user_data['other']['uploaded_image'];

        $i = 1;
        // var_dump($a['other']['uploaded_image']);
        list($type, $img) = explode(';', $img);
        list(, $img)      = explode(',', $img);
        list(, $ext) = explode('/', $type);

        $img_name = $row->user_id . 'kyushu' . '.' . $ext;
        $imageData = base64_decode($img);
        $imgFolder = '../../upload/';
        $imgPath = $imgFolder . $img_name;

        while (file_exists($imgPath)) {
            $i++;
            $img_name = $row->user_id . 'kyushu' . '_' . $i . '.' . $ext;
            $imgPath = $imgFolder . $img_name;
        }

        file_put_contents($imgPath, $imageData);
    }

    if(isset($user_data['main']['region']) && $user_data['main']['region'] !== NULL) {
        $region = implode(', ', $user_data['main']['region']);
    }else if(!isset ($user_data['main']['region'])) {
        $region = 'null';
    }
    $i=0;
    $i++;

    $rowData = array(
        $i,
        $row->user_id,
        $user_data['main']['first_name'] . ' ' . $user_data['main']['last_name'],
        $user_data['main']['dob'],
        $user_data['main']['gender'],
        $user_data['main']['nationality'],
        $user_data['main']['occupation'],
        $user_data['main']['religion'],
        $user_data['main']['sns_username'],
        $user_data['main']['japan_before'],
        $region ,
        $user_data['main']['restriction'],
        $user_data['main']['email'],
        $user_data['main']['ph_num'],
        $user_data['tc_1']['first_name_travel_companion'] . ' ' . $user_data['tc_1']['last_name_travel_companion'],
        $user_data['tc_1']['dob_travel_companion'],
        $user_data['tc_1']['gender_travel_companion'],
        $user_data['tc_1']['nationality_travel_companion'],
        $user_data['tc_1']['relationship_travel_companion'],
        $user_data['tc_1']['restriction_travel_companion'],
        $user_data['other']['first_name_japan_gift'] . ' ' . $user_data['other']['last_name_japan_gift'],
        implode(', ', $user_data['other']['travel_period']),
        implode(', ', $user_data['other']['know_campaign']),
        $img_name,
        'Kyushu',
    );

    fputcsv($fp, $rowData);

}

fclose($fp);
exit();