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
                if($this->validate($post, $files)){
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

                    var_dump(($files));
                    $tmp_img_name = $files['image']['tmp_name'];
                    $image_name = $files['image']['name'];
                    // $image_data =  file_get_contents($files['image']['tmp_name']);
                    // $image_result = base64_encode($image_data);

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

                    // if (!empty($files['image']['name'])) {
                    //     $imgData = $image_result;
                    // }

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
                            'uploaded_image' => $image_name,
                            'first_name_japan_gift' => $first_name_jp,
                            'last_name_japan_gift' => $last_name_jp,
                            'travel_period' => $period,
                            'video_upload' => $video_upload,
                            'know_campaign' => $custom_data_cp,
                            'custom_know_campaign' => $custom_campaign
                            // 'terms&conditions' => $termsCondition
                        ];
                        // echo"<pre>";
                        // var_dump($user_data);
                        // echo"</pre>";
                        // die();
                    // return $user_data ? true : false;
                        return $user_data;
                    // if($user_data) {
                    //     echo '<script>location.href="confirmed/index.php"</script>';
                    // } else {
                    //     return false;
                    // }

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
            $errors = [];

            //Image Validate Start
            $tmp_img_name = $files['image']['tmp_name'];
            $image_size = $files['image']['size'];
            // var_dump(($image_name));
            $image_name = $files['image']['name'];
            $image_ext = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
            $ext = array('jepg', 'jpg', 'png');
            if($image_name == "" && $tmp_img_name == "") {
                $errors['image'] = 'Please upload a photo.';
            } else if (empty($image_name) && empty($tmp_img_name)) {
                $errors['image'] = 'Please upload a photo.';
            } else if (in_array($image_ext, $ext) === false && !empty($image_name)) {
                $errors['image'] = 'Image file not support. Please upload JEPG, JPG, PNG.';
            } else if ($image_size > 40000000) {
                $errrors['image'] = 'Image Error';
            } 
            $_SESSION['image_name'] = $files['image']['name']; 
            //image validate end

            //date 
            $dob = new DateTime($post['dob']);
            $dob_tc = new DateTime($post['dob_tc']);
            $current  = new DateTime('today');
            $age = $dob->diff($current)->y;
            $age_tc = $dob_tc->diff($current)->y;

            if (empty($post['first_name'])) {
                $errors['first_name'] = "Please fills the required field.";
                $_SESSION['old_fn'] = $post['first_name'];
            } else {
                $_SESSION['old_fn'] = $post['first_name'];
            }

            if (is_numeric($post['first_name'])) {
                $errors['first_name'] = "First name cannot be number.";
            }

            if (strlen($post['first_name']) > 128) {
                $errors['first_name'] = "First Name character can't be more than 128.";
            }


            if (empty($post['last_name'])) {
                $errors['last_name'] = "Please fills the required field.";
                $_SESSION['old_ln'] = $post['last_name'];
            } else {
                $_SESSION['old_ln'] = $post['last_name'];
            }

            if (is_numeric($post['last_name'])) {
                $errors['last_name'] = "Last name cannot be number.";
            }

            if (strlen($post['last_name']) > 128) {
                $errors['last_name'] = "Last Name character can't be more than 128.";
            }

            if (empty($post['dob'])) {
                $errors['dob'] = "Please fills the required field.";
                $_SESSION['old_dob'] = $post['dob'];
            } else {
                $_SESSION['old_dob'] = $post['dob'];
            }

            if ($age > 120) {
                $errors['dob'] = 'You cannot be older than 120 years.';
            }

            if ($post['dob'] >= date('Y-m-d')) {
                $errors['dob'] = 'Date of birth cannot be today or future.';
            }

            if (empty($post['gender'])) {
                $errors['gender'] = "Please fills the required field.";
            } else {
                $_SESSION['old_gender'] = $post['gender'];
            }

            if (empty($post['nationality'])) {
                $errors['nationality'] = "Please fills the required field.";
            } else if ($post['nationality'] == 'other' && empty($post['custom_country'])) {
                $errors['nationality'] = "Please fills your nationality in other field.";
            }

            if (!empty($post['custom_country']) && strlen($post['custom_country']) > 128) {
                $errors['nationality'] = "Nationality character can't be more than 128.";
            }

            if (!empty($post['nationality'])) {
                $_SESSION['old_nati'] = $post['nationality'];
            }

            if (isset($post['nationality'])  && $post['nationality'] == 'other' && isset($post['custom_country'])) {
                $_SESSION['old_nati_cc'] = $post['custom_country'];
            }

            if (empty($post['occupation'])) {
                $errors['occupation'] = "Please fills the required field.";
                $_SESSION['old_occ'] = $post['occupation'];
            } else {
                $_SESSION['old_occ'] = $post['occupation'];
            }

            if (strlen($post['occupation']) > 400) {
                $errors['occupation'] = "Occupation character can't be more than 400.";
            }

            if (empty($post['religion'])) {
                $errors['religion'] = "Please fills the required field.";
                $_SESSION['old_reli'] = $post['religion'];
            } else {
                $_SESSION['old_reli'] = $post['religion'];
            }

            if (strlen($post['religion']) > 400) {
                $errors['religion'] = "Religion character can't be more than 400.";
            }

            if (strlen($post['sns_username']) > 128) {
                $errors['sns_username'] = "Username character can't be more than 128.";
            }

            if (!empty($post['sns_username'])) {
                $_SESSION['old_sns'] = $post['sns_username'];
            } else {
                $_SESSION['old_sns'] = $post['sns_username'];
            }


            if (empty($post['japan_before'])) {
                $errors['japan_before'] = "Please fills the required field.";
            } else {
                $_SESSION['old_before'] = $post['japan_before'];
            }

            if (empty($post['region']) && isset($post['japan_before']) && $post['japan_before'] != 'never') {
                $errors['region'] = "Please fills the required field.";
                if (isset($_SESSION['old_reg'])) {
                    unset($_SESSION['old_reg']);
                }
            }

            if (empty($post['region']) && !isset($post['japan_before'])) {
                $errors['region'] = "Please fills the required field.";
                if (isset($_SESSION['old_reg'])) {
                    unset($_SESSION['old_reg']);
                }
            }

            if (isset($post['region'])) {
                $_SESSION['old_reg'] = $post['region'];
            }

            if (empty($post['restriction'])) {
                $errors['restriction'] = "Please fills the required field.";
                $_SESSION['old_restri'] = $post['restriction'];
            } else {
                $_SESSION['old_restri'] = $post['restriction'];
            }


            if (strlen($post['restriction']) > 400) {
                $errors['restriction'] = "Character can't be more than 400.";
            }

            if (empty($post['email'])) {
                $errors['email'] = "Please fills the required field.";
                $_SESSION['old_email'] = $post['email'];
            } else {
                $_SESSION['old_email'] = $post['email'];
            }

            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL) && !empty($post['email'])) {
                $errors['email'] = "Please fills valid Email address.";
            }

            if (empty($post['ph_num'])) {
                $errors['ph_num'] = "Please fills the required field.";
                $_SESSION['old_ph'] = $post['ph_num'];
            } else {
                $_SESSION['old_ph'] = $post['ph_num'];
            }

            if (!preg_match('/^([0-9]{10})$/', $post['ph_num']) && !empty($post['ph_num'])) {
                $errors['ph_num'] = "Please fills the valid phone number.";
            }

            if (empty($post['first_name_tc'])) {
                $errors['first_name_tc'] = "Please fills the required field.";
                $_SESSION['old_fn_tc'] = $post['first_name_tc'];
            } else {
                $_SESSION['old_fn_tc'] = $post['first_name_tc'];
            }

            if (is_numeric($post['first_name_tc'])) {
                $errors['first_name_tc'] = "First name can't be number.";
            }

            if (strlen($post['first_name_tc']) > 128) {
                $errors['first_name_tc'] = "First Name character can't be more than 128.";
            }

            if (empty($post['last_name_tc'])) {
                $errors['last_name_tc'] = "Please fills the required field.";
                $_SESSION['old_ln_tc'] = $post['last_name_tc'];
            } else {
                $_SESSION['old_ln_tc'] = $post['last_name_tc'];
            }

            if (is_numeric($post['last_name_tc'])) {
                $errors['last_name_tc'] = "Last Name can't be number.";
            }

            if (strlen($post['last_name_tc']) > 128) {
                $errors['last_name_tc'] = "Last Name character can't be more than 128.";
            }

            if (empty($post['dob_tc'])) {
                $errors['dob_tc'] = "Please fills the required field.";
                $_SESSION['old_dob_tc'] = $post['dob_tc'];
            } else {
                $_SESSION['old_dob_tc'] = $post['dob_tc'];
            }

            if ($age_tc > 120) {
                $errors['dob_tc'] = 'The age cannot be older than 120 years.';
            }

            if ($post['dob_tc'] >= date('Y-m-d')) {
                $errors['dob_tc'] = 'Date of birth cannot be today or future.';
            }

            if (empty($post['gender_tc'])) {
                $errors['gender_tc'] = "Please fills the required field.";
            } else {
                $_SESSION['old_gender_tc'] = $post['gender_tc'];
            }


            if (empty($post['nationality_tc'])) {
                $errors['nationality_tc'] = "Please fills the required field.";
            } else if ($post['nationality_tc'] == 'other' && empty($post['custom_country_tc'])) {
                $errors['nationality_tc'] = "Please fills your nationality in other field.";
            } else if (!empty($post['custom_country_tc']) && strlen($post['custom_country_tc']) > 128) {
                $errors['nationality_tc'] = "Nationality can't be more than 128.";
            }

            if (!empty($post['nationality_tc'])) {
                $_SESSION['old_nati_tc'] = $post['nationality_tc'];
            }

            if (isset($post['nationality_tc']) && $post['nationality_tc'] == 'other' && isset($post['custom_country_tc'])) {
                $errors['old_nati_cc_tc'] = $post['custom_country_tc'];
            }

            if (empty($post['relationship_tc'])) {
                $errors['relationship_tc'] = "Please fills the required field.";
                $_SESSION['old_rs_tc'] = $post['relationship_tc'];
            } else {
                $_SESSION['old_rs_tc'] = $post['relationship_tc'];
            }

            if (is_numeric($post['relationship_tc'])) {
                $errors['relationship_tc'] = "The field cannot be number.";
            }

            if (strlen($post['relationship_tc']) > 128) {
                $errors['relationship_tc'] = "This field of character can't be more than 128.";
            }

            if (empty($post['restriction_tc'])) {
                $errors['restriction_tc'] = "Please fills the required field.";
            }

            if (is_numeric($post['restriction_tc'])) {
                $errors['restriction_tc'] = "The field cannot be number.";
            }

            if (strlen($post['restriction_tc']) > 400) {
                $errors['restriction_tc'] = "This field of character can't be more than 400.";
            }

            if (empty($post['first_name_jp'])) {
                $errors['first_name_jp'] = "Please fills the required field.";
                $_SESSION['old_fn_jp'] = $post['first_name_jp'];
            } else {
                $_SESSION['old_fn_jp'] = $post['first_name_jp'];
            }

            if (strlen($post['first_name_jp']) > 128) {
                $errors['first_name_jp'] = "First Name character can't be more than 128.";
            }

            if (is_numeric($post['first_name_jp'])) {
                $errors['first_name_jp'] = "First name cannot be number.";
            }

            if (empty($post['last_name_jp'])) {
                $errors['last_name_jp'] = "Please fills the required field.";
                $_SESSION['old_ln_jp'] = $post['last_name_jp'];
            } else {
                $_SESSION['old_ln_jp'] = $post['last_name_jp'];
            }

            if (strlen($post['last_name_jp']) > 128) {
                $errors['last_name_jp'] = "Last Name character can't be more than 128.";
            }

            if (is_numeric($post['last_name_jp'])) {
                $errors['last_name_jp'] = "Last name cannot be number.";
            }

            if (empty($post['period'])) {
                $errors['period'] = "Please fills the required field.";
                if (isset($_SESSION['old_period'])) {
                    unset($_SESSION['old_period']);
                }
            }

            if (!empty($post['period'])) {
                $_SESSION['old_period'] = $post['period'];
            }

            if (empty($post['video_upload'])) {
                $errors['video_upload'] = "Please fills the required field.";
                if(isset($_SESSION['old_vd'])) {
                    unset ($_SESSION['old_vd']);
                }
            } else {
                $_SESSION['old_vd'] = $post['video_upload'];
            }

            if (empty($post['campaign'])) {
                $errors['campaign'] = "Please fills the required field.";
                if (isset($_SESSION['old_camp'])) {
                    unset($_SESSION['old_camp']);
                }
            } else if (in_array('other', $post['campaign']) && empty($post['custom_campaign'])) {
                $errors['campaign'] = "Please fills your campaign in other field.";
            } else if (!empty($post['custom_campaign']) && strlen($post['custom_campaign']) > 128) {
                $errors['campaign'] = "Campaign can't be more than 128.";
            }

            if (!empty($post['campaign'])) {
                $_SESSION['old_camp'] = $post['campaign'];
            }

            if (isset($post['campaign']) && in_array('other', $post['campaign']) && isset($post['custom_campaign'])) {
                $_SESSION['old_custom_camp'] = $post['custom_campaign'];
            } else {
                if (isset($_SESSION['old_custom_camp'])) {
                    unset($_SESSION['old_custom_camp']);
                }
            }

            if (empty($post['termsConditions'])) {
                $errors['termsConditions'] = "Please agree the terms & conditions.";
            } else {
                $_SESSION['old_terms'] = $post['termsConditions'];
            }

            $_SESSION['error'] = $errors;
            return  empty($_SESSION['error']);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}