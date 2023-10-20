<?php

include('DB.php');

class Export extends DB
{
    private $con;
    private $img_name_arr = [];

    public function __construct()
    {
        $this->con = $this->connect();
    }

    public function index()
    {
        try {
            $sql = "SELECT * FROM `users_table` WHERE `deleted_date` IS NULL";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return  $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createFolder()
    {
        try {
            if (!is_dir('../../upload/')) {
                mkdir( '../../upload/', 0777, true);    
                mkdir( '../../upload/images', 0777, true);    
           }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function dataExport()
    {
        try {
            $data = $this->index();
            $fileName = "../../upload/data.csv"; // Specify the path to the upload directory

            $titles = array('ID', 'User ID', 'Full Name', 'DOB', 'Gender', 'Nationality', 'Occupation', 'Religion', 'SNS Username', 'Japan Before', 'Region', 'Dietary Restrictions', 'Email', 'Phone Number', 'Full Name TC', 'DOB TC', 'Gender TC', 'Nationality TC', 'Relationship with applicant', 'Dietary Restrictions TC', 'Full Name(birthday gift)', 'Traveling Preiod', 'Know Campaign', 'Image Name', 'Area');

            // Open the output stream to the file
            $fp = fopen($fileName, 'w');

            // Add UTF-8 BOM to support special characters
            fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($fp, $titles);
            $x = 0;

            foreach ($data as $row) {
                $user_data = json_decode($row->user_data, true);
                if (isset($user_data['other']['uploaded_image']) && isset($user_data['main']['first_name'])) {
                    $img = $user_data['other']['uploaded_image'];

                    list($type, $img) = explode(';', $img);
                    list(, $img)      = explode(',', $img);
                    list(, $ext) = explode('/', $type);

                    $img_name = $row->user_id . 'kyushu' . '.' . (($ext == "svg+xml") ? "svg" : $ext);

                    $imageData = base64_decode($img);
                    $imgFolder = '../../upload/images/';
                    $imgPath = $imgFolder . $img_name;
                    $previousExt = $ext;

                    if (isset($previousExt) && $previousExt != $ext) {
                        $i = 1; // Reset the counter if the extension changes
                    } else {
                        $i = 1; // Initialize the counter if it's the first iteration or extension is the same
                    }

                    while (file_exists($imgPath)) {
                        $i++;
                        $img_name = $row->user_id . 'kyushu' . '_' . $i . '.' . $ext;
                        $imgPath = $imgFolder . $img_name;
                    }
                    
                    file_put_contents($imgPath, $imageData);
                }

                if (isset($user_data['main']['region']) && $user_data['main']['region'] !== NULL) {
                    $region = implode(', ', $user_data['main']['region']);
                } else if (!isset($user_data['main']['region'])) {
                    $region = 'null';
                }

                if (!isset($user_data['main']['sns_username'])) {
                    $sns = 'null';
                } else {
                    $sns = $user_data['main']['sns_username'];
                }

                $x++;

                $rowData = array(
                    $x,
                    $row->user_id,
                    $user_data['main']['first_name'] . ' ' . $user_data['main']['last_name'],
                    $user_data['main']['dob'],
                    $user_data['main']['gender'],
                    $user_data['main']['nationality'],
                    $user_data['main']['occupation'],
                    $user_data['main']['religion'],
                    $sns,
                    $user_data['main']['japan_before'],
                    $region,
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

            return true;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delImg()
    {
        try {
            $files = glob('../../upload/images/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            return true;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function exportZip()
    {
        try {
            $zip = new ZipArchive();
            $zip_name = 'data.zip';
            $pathdir = '../../upload/images';
            if ($zip->open($zip_name, ZipArchive::CREATE) === TRUE) {
                // Add all files and subdirectories recursively
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($pathdir),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = explode("\upload\\", $filePath)[1];
                        $zip->addFile($filePath, $relativePath);
                    }
                };
            }

            $zip->close();

            // Prompt download
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zip_name);
            header('Content-Length: ' . filesize($zip_name));
            readfile($zip_name);

            unlink($zip_name);

            return true;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
