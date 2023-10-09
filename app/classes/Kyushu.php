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
                if ($this->validate($post, $files)) {
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
                    $custom_campaign = $post['custom_campaign'];
                    // $termsCondition = $post['termsConditions'];

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

                    if ($campaign == "other" && isset($custom_campaign)) {
                        $custom_data_cp = $custom_campaign;
                    } else {
                        $custom_data_cp = $campaign;
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
                            'know_campaign' => $custom_data_cp,
                            'custom_know_campaign' => $custom_campaign
                            // 'terms&conditions' => $termsCondition
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

            //Image Validate Start
            $image_size = $files['image']['size'];
            $image_name = $files['image']['name'];
            $image_ext = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
            $ext = array('jepg', 'jpg', 'png');

            if (in_array($image_ext, $ext) === false && !empty($image_name)) {
                $_SESSION['image'] = 'Image file not support. Please upload JEPG, JPG, PNG.';
                $no_error = false;
            }

            if ($image_size > 40000000) {
                $_SESSION['image'] = 'Image Error';
                $no_error = false;
            }
            //image validate end

            //date 
            $dob = new DateTime($post['dob']);
            $dob_tc = new DateTime($post['dob_tc']);
            $current  = new DateTime('today');
            $age = $dob->diff($current)->y;
            $age_tc = $dob_tc->diff($current)->y;

            if (empty($post['first_name'])) {
                $_SESSION['first_name'] = "Please fills the required field.";
                $_SESSION['old_fn'] = $post['first_name'];
                $no_error = false;
            } else {
                $_SESSION['old_fn'] = $post['first_name'];
                $no_error = false;
            }

            if (is_numeric($post['first_name'])) {
                $_SESSION['first_name'] = "First name cannot be number.";
                $no_error = false;
            }

            if (strlen($post['first_name']) > 128) {
                $_SESSION['first_name'] = "First Name character can't be more than 128.";
                $no_error = false;
            }


            if (empty($post['last_name'])) {
                $_SESSION['last_name'] = "Please fills the required field.";
                $_SESSION['old_ln'] = $post['last_name'];
                $no_error = false;
            } else {
                $_SESSION['old_ln'] = $post['last_name'];
                $no_error = false;
            }

            if (is_numeric($post['last_name'])) {
                $_SESSION['last_name'] = "First name cannot be number.";
                $no_error = false;
            }

            if (strlen($post['last_name']) > 128) {
                $_SESSION['last_name'] = "Last Name character can't be more than 128.";
                $no_error = false;
            }

            if (empty($post['dob'])) {
                $_SESSION['dob'] = "Please fills the required field.";
                $_SESSION['old_dob'] = $post['dob'];
                $no_error = false;
            } else {
                $_SESSION['old_dob'] = $post['dob'];
                $no_error = false;
            }

            if ($age > 120) {
                $_SESSION ['dob'] = 'You cannot be older than 120 years.';
                $no_error = true;
            }

            if ($post['dob'] >= date('Y-m-d')) {
                $_SESSION ['dob'] = 'Date of birth cannot be today or future.';
                $no_error = true;
            }

            if (empty($post['gender'])) {
                $_SESSION['gender'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_gender'] = $post['gender'];
                $no_error = false;
            }

            if (empty($post['nationality'])) {
                $_SESSION['nationality'] = "Please fills the required field.";
                // $_SESSION['old_nati'] = $post['nationality'] ;
                $no_error = false;
            } else if ($post['nationality'] == 'other' && empty($post['custom_country'])) {
                $_SESSION['nationality'] = "Please fills your nationality in other field.";
                $no_error = false;
            } 
            
            if (  !empty($post['custom_country']) && strlen($post['custom_country']) > 128) {
                $_SESSION['nationality'] = "Nationality character can't be more than 128.";
                $no_error = false;
            }
            
            if (!empty($post['nationality'])){
                $_SESSION['old_nati'] = $post['nationality'] ;
                $no_error = false;
            }
            
            if (isset($post['nationality'])  && $post['nationality'] == 'other' && isset($post['custom_country'])) {
                $_SESSION['old_nati_cc'] = $post['custom_country'];
                $no_error = false;
            } 

            if (empty($post['occupation'])) {
                $_SESSION['occupation'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_occ'] = $post['occupation'] ;
                $no_error = false;
            }

            if (strlen($post['occupation']) > 400) {
                $_SESSION['occupation'] = "Occupation character can't be more than 400.";
                $no_error = false;
            }

            if (empty($post['religion'])) {
                $_SESSION['religion'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_reli'] = $post['religion'] ;
                $no_error = false;
            }

            if (strlen($post['religion']) > 400) {
                $_SESSION['religion'] = "Religion character can't be more than 400.";
                $no_error = false;
            }

            if (strlen($post['sns_username']) > 128) {
                $_SESSION['religion'] = "Username character can't be more than 128.";
                $no_error = false;
            } 

            if (!empty($post['sns_username'])) {
                $_SESSION['old_sns'] = $post['sns_username'] ;
                $no_error = false;
            }


            if (empty($post['japan_before'])) {
                $_SESSION['japan_before'] = "Please fills the required field.";
                // $_SESSION['old_before'] = $post['japan_before'];
                $no_error = false;
            } else {
                $_SESSION['old_before'] = $post['japan_before'] ;
                $no_error = false;
            }

            if (empty($post['region']) && isset($post['japan_before']) && $post['japan_before'] != 'never' ) {
                $_SESSION['region'] = "Please fills the required field.";
                $no_error = false;
            } 

            if (empty($post['region']) && !isset($post['japan_before'])) {
                $_SESSION['region'] = "Please fills the required field.";
                $no_error = false;
            }

            if (isset($post['region'])) {
                $_SESSION['old_reg'] = $post['region'] ;
                $no_error = false;
            }

            if (empty($post['restriction'])) {
                $_SESSION['restriction'] = "Please fills the required field.";
                $no_error = false;
            }  else {
                $_SESSION['old_restri'] = $post['restriction'];
                $no_error = false;
            }


            if (strlen($post['restriction']) > 400) {
                $_SESSION['restriction'] = "Character can't be more than 400.";
                $no_error = false;
            }

            if (empty($post['email'])) {
                $_SESSION['email'] = "Please fills the required field.";
                $_SESSION['old_email'] = $post['email'];
                $no_error = false;
            } else {
                $_SESSION['old_email'] = $post['email'];
                $no_error = false;
            }

            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL) && !empty($post['email'])) {
                $_SESSION['email'] = "Please fills valid Email address.";
                $no_error = false;
            }

            if (empty($post['ph_num'])) {
                $_SESSION['ph_num'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_ph'] = $post['ph_num'];
                $no_error = false;
            }

            if (!preg_match('/^([0-9]{10})$/', $post['ph_num']) && !empty($post['ph_num'])) {
                $_SESSION['ph_num'] = "Please fills the valid phone number.";
                $no_error = false;
            }

            if (empty($post['first_name_tc'])) {
                $_SESSION['first_name_tc'] = "Please fills the required field.";
                $_SESSION['old_fn_tc'] = $post['first_name_tc'];
                $no_error = false;
            } else {
                $_SESSION['old_fn_tc'] = $post['first_name_tc'];
                $no_error = false;
            }

            if (is_numeric($post['first_name_tc'])) {
                $_SESSION['first_name_tc'] = "First name can't be number.";
                $no_error = false;
            }

            if (strlen($post['first_name_tc']) > 128) {
                $_SESSION['first_name_tc'] = "Last Name character can't be more than 128.";
                $no_error = false;
            }

            if (empty($post['last_name_tc'])) {
                $_SESSION['last_name_tc'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_ln_tc'] = $post['last_name_tc'];
                $no_error = false;
            }

            if (is_numeric($post['last_name_tc'])) {
                $_SESSION['last_name_tc'] = "Last Name can't be number.";
                $no_error = false;
            }

            if (strlen($post['last_name_tc']) > 128) {
                $_SESSION['last_name_tc'] = "Last Name character can't be more than 128.";
                $no_error = false;
            }

            if (empty($post['dob_tc'])) {
                $_SESSION['dob_tc'] = "Please fills the required field.";
                $_SESSION['old_dob_tc'] = $post['dob_tc'];
                $no_error = false;
            } else {
                $_SESSION['old_dob_tc'] = $post['dob_tc'];
                $no_error = false;
            }

            if ($age_tc > 120) {
                $_SESSION ['dob_tc'] = 'The age cannot be older than 120 years.';
                $no_error = true;
            }

            if ($post['dob_tc'] >= date('Y-m-d')) {
                $_SESSION ['dob_tc'] = 'Date of birth cannot be today or future.';
                $no_error = true;
            }

            if (empty($post['gender_tc'])) {
                $_SESSION['gender_tc'] = "Please fills the required field.";
                $no_error = false;
            }  else {
                $_SESSION['old_gender_tc'] = $post['gender_tc'];
                $no_error = false;
            }


            if (empty($post['nationality_tc'])) {
                $_SESSION['nationality_tc'] = "Please fills the required field.";
                $no_error = false;
            } else if ($post['nationality_tc'] == 'other' && empty($post['custom_country_tc'])) {
                $_SESSION['nationality_tc'] = "Please fills your nationality in other field.";
                $no_error = false;
            } else if (!empty($post['custom_country_tc']) && strlen($post['custom_country_tc']) > 128 ) {
                $_SESSION['nationality_tc'] = "Nationality can't be more than 128.";
                $no_error = false;
            }
            
            if (!empty($post['nationality_tc'])){
                $_SESSION['old_nati_tc'] = $post['nationality_tc'] ;
                $no_error = false;
            } 
            
            if ( isset($post['nationality_tc']) && $post['nationality_tc'] == 'other' && isset($post['custom_country_tc'])) {
                $_SESSION['old_nati_cc_tc'] = $post['custom_country_tc'];
                $no_error = false;
            } 

            if (empty($post['relationship_tc'])) {
                $_SESSION['relationship_tc'] = "Please fills the required field.";
                $_SESSION['old_rs_tc'] = $post['relationship_tc'];
                $no_error = false;
            } else {
                $_SESSION['old_rs_tc'] = $post['relationship_tc'];
                $no_error = false;
            } 

            if (is_numeric($post['relationship_tc'])) {
                $_SESSION['relationship_tc'] = "The field cannot be number.";
                $no_error = false;
            }

            if (strlen($post['relationship_tc']) > 128) {
                $_SESSION['relationship_tc'] = "This field of character can't be more than 128.";
                $no_error = false;
            }

            if (empty($post['restriction_tc'])) {
                $_SESSION['restriction_tc'] = "Please fills the required field.";
                $no_error = false;
            }

            if (is_numeric($post['restriction_tc'])) {
                $_SESSION['restriction_tc'] = "The field cannot be number.";
                $no_error = false;
            }

            if (strlen($post['restriction_tc']) > 400) {
                $_SESSION['restriction_tc'] = "This field of character can't be more than 400.";
                $no_error = false;
            }

            if (empty($post['first_name_jp'])) {
                $_SESSION['first_name_jp'] = "Please fills the required field.";
                $_SESSION['old_fn_jp'] = $post['first_name_jp'];
                $no_error = false;
            } else {
                $_SESSION['old_fn_jp'] = $post['first_name_jp'];
                $no_error = false;
            } 

            if (strlen($post['first_name_jp']) > 128) {
                $_SESSION['first_name_jp'] = "First Name character can't be more than 128.";
                $no_error = false;
            }

            if (is_numeric($post['first_name_jp'])) {
                $_SESSION['first_name_jp'] = "First name cannot be number.";
                $no_error = false;
            }

            if (empty($post['last_name_jp'])) {
                $_SESSION['last_name_jp'] = "Please fills the required field.";
                $_SESSION['old_ln_jp'] = $post['last_name_jp'];
                $no_error = false;
            } else {
                $_SESSION['old_ln_jp'] = $post['last_name_jp'];
                $no_error = false;
            } 

            if (strlen($post['last_name_jp']) > 128) {
                $_SESSION['last_name_jp'] = "Last Name character can't be more than 128.";
                $no_error = false;
            }

            if (is_numeric($post['last_name_jp'])) {
                $_SESSION['last_name_jp'] = "Last name cannot be number.";
                $no_error = false;
            }

            if (empty($post['period'])) {
                $_SESSION['period'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_period'] = $post['period'];
                $no_error = false;
            } 

            if (empty($post['video_upload'])) {
                $_SESSION['video_upload'] = "Please fills the required field.";
                $no_error = false;
            } else {
                $_SESSION['old_vd'] = $post['video_upload'];
                $no_error = false;
            } 

            if (empty($post['campaign'])) {
                $_SESSION['campaign'] = "Please fills the required field.";
                $no_error = false;
            }else {
                $_SESSION['old_camp'] = $post['campaign'];
                $no_error = false;
            } 


            return $no_error;
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
