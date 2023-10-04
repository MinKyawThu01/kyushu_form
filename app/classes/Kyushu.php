<?php

include('DB.php');

class Kyushu extends DB
{
    private $con;

    public function __construct()
    {
        $this->con = $this->connect();
    }

    public function storeArray(array $post, array $files)
    {
        try {

            if (isset($post['submit'])) { 
                if ($this->validate($post, $files)){
                    $first_name = htmlspecialchars($post['first_name']);
                    $last_name = htmlspecialchars($post['last_name']);
                    $dob = htmlspecialchars($post['dob']);
                    $gender = $post['gender'];
                    $nationality = $post['nationality'];
                    $custom_country = htmlspecialchars($post['custom_country']);
                    $occupation = htmlspecialchars($post['occupation']);
                    $religion = htmlspecialchars($post['religion']);
                    $sns_username = htmlspecialchars($post['sns_username']);
                    $japan_before = $post['japan_before'];
                    $region = $post['region'];
                    $restriction = htmlspecialchars($post['restriction']);
                    $email = htmlspecialchars($post['email']);
                    $ph_num = htmlspecialchars($post['ph_num']);

                    //travel companion 01
                    $first_name_tc = htmlspecialchars($post['first_name_tc']);
                    $last_name_tc = htmlspecialchars($post['last_name_tc']);
                    $dob_tc = htmlspecialchars($post['dob_tc']);
                    $gender_tc = $post['gender_tc'];
                    $nationality_tc = $post['nationality_tc'];
                    $custom_country_tc = $post['custom_country_tc'];
                    $relationship_tc = htmlspecialchars($post['relationship_tc']);
                    $restriction_tc = htmlspecialchars($post['restriction_tc']);
                    $first_name_jp = htmlspecialchars($post['first_name_jp']);
                    $last_name_jp = htmlspecialchars($post['last_name_jp']);
                    $period = $post['period'];
                    $video_upload = $post['video_upload'];
                    $campaign = $post['campaign'];
                    $termsCondition = $post['termsConditions'];

                    // image to base64 code
                    $tmp_img_name = $files['image']['tmp_name'];
                    $image_data =  file_get_contents($files['image']['tmp_name']);
                    $image_result = base64_encode($image_data);

                    if ($nationality == 'other' && isset($custom_country)) {
                        $custom_data = $custom_country;
                    } else {
                        $custom_data = $nationality;
                    }

                    if ($nationality_tc == 'other' && isset($custom_country_tc)) {
                        $custom_data_tc = $custom_country_tc;
                    } else {
                        $custom_data_tc = $nationality_tc;
                    }

                    if (!empty($files['image']['name'])) {
                        $imgData = $image_result;
                    }

                    $user_data =
                        [
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'dob' => $dob,
                            'gender' => $gender,
                            'nationality' => $custom_data,
                            'occupation' => $occupation,
                            'religion' => $religion,
                            'sns_username' => $sns_username,
                            'japan_before' => $japan_before,
                            'region' => $region,
                            'restriction' => $restriction,
                            'email' => $email,
                            'ph_num' => $ph_num,
                            'first_name_travel_companion' => $first_name_tc,
                            'last_name_travel_companion' => $last_name_tc,
                            'dob_travel_companion' => $dob_tc,
                            'gender_travel_companion' => $gender_tc,
                            'nationality_travel_companion' => $custom_data_tc,
                            'relationship_travel_companion' => $relationship_tc,
                            'restriction_travel_companion' => $restriction_tc,
                            'uploaded_image' => $imgData,
                            'first_name_japan_gift' => $first_name_jp,
                            'last_name_japan_gift' => $last_name_jp,
                            'travel_period' => $period,
                            'video_upload' => $video_upload,
                            'know_campaign' => $campaign,
                            'terms&conditions' => $termsCondition

                        ];
                    echo "<pre>";
                    var_dump($user_data);
                    echo "</pre>";
                    die();
                    return $user_data;
                }
            } 

            return false;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //validate
    public function validate(array $post, array $files)
    {
        try {
            $no_error = true;

            $image_size = $files['image']['size'];
            $image_name = $files['image']['name'];
            $image_ext = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
            $ext = array('jepg', 'jpg', 'png');

            if (in_array($image_ext, $ext) === false && !empty($image_name)) {
                $_SESSION['image'] = 'Image file not support. Please upload JEPG, JPG, PNG.';
                $no_error = false;
            }

            if ($image_size > 40000000 ) {
                $_SESSION['image'] = 'Image Error';
                $no_error=false;
            }

            if (empty($post['first_name'])) {
                $_SESSION['first_name'] = "Please fills the required field.";
                $no_error = false;
            }

            if (empty($post['last_name'])) {
                $_SESSION['last_name'] = "Please fills the required field.";
                $no_error = false;
            }

            if (empty($post['dob'])) {
                $_SESSION['dob'] = "Please fills the required field.";
                $no_error = false;
            }
            
           

            return $no_error;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
