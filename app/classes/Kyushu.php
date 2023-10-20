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
                    $custom_country = isset($nationality,  $post['custom_country']) ? htmlspecialchars($post['custom_country']) : NULL ;
                    $occupation = htmlspecialchars($post['occupation']);
                    $religion = htmlspecialchars($post['religion']);
                    if (isset($post['sns_username']) && !empty($post['sns_username'])) {
                        $sns_username = htmlspecialchars($post['sns_username']);
                    } else {
                        $sns_username = NULL;
                    }

                    $japan_before = $post['japan_before'];
                    if (isset($post['region']) && isset($post['japan_before']) && $post['japan_before'] != 'Never') {
                        $region = $post['region'];
                    } else {
                        $region = NULL;
                    }

                    $restriction = htmlspecialchars($post['restriction']);
                    $email = htmlspecialchars($post['email']);
                    $ph_num = htmlspecialchars($post['ph_num']);

                    //travel companion 01
                    $first_name_tc = htmlspecialchars($post['first_name_tc']);
                    $last_name_tc = htmlspecialchars($post['last_name_tc']);
                    $dob_tc = htmlspecialchars($post['dob_tc']);
                    $gender_tc = $post['gender_tc'];
                    $nationality_tc = $post['nationality_tc'];
                    $custom_country_tc = isset($nationality_tc,  $post['custom_country_tc']) ? htmlspecialchars($post['custom_country_tc']) : null ;
                    $relationship_tc = htmlspecialchars($post['relationship_tc']);
                    $restriction_tc = htmlspecialchars($post['restriction_tc']);
                    $first_name_jp = htmlspecialchars($post['first_name_jp']);
                    $last_name_jp = htmlspecialchars($post['last_name_jp']);
                    $period = $post['period'];
                    $campaign = $post['campaign'];
                    $custom_camp = isset($post['custom_campaign']) ? $post['custom_campaign'] : null;

                    // image to base64 code
                    $tmp_img_name = $files['image']['tmp_name'];
                    $image_data =  file_get_contents($files['image']['tmp_name']);
                    $image_ext = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
                    $image_result = 'data:image/' .( ($image_ext =='svg')? $image_ext.'+xml' :$image_ext) . ';base64,' . base64_encode($image_data);

                    if ( isset($nationality) && $nationality == 'Other' && isset($custom_country)) {
                        $custom_data = $custom_country;
                    } else {
                        $custom_data = $nationality;
                    }

                    if (isset($nationality_tc) && $nationality_tc == 'Other' && isset($custom_country_tc)) {
                        $custom_data_tc = $custom_country_tc;
                    } else {
                        $custom_data_tc = $nationality_tc;
                    }

                    if (in_array('Other', $campaign) && isset($custom_camp)) {
                        $arr_search = array_search('Other', $campaign);
                        if ($arr_search !== false) {
                            $campaign[$arr_search] = $custom_camp;
                        }
                    }

                    if (!empty($files['image']['name'])) {
                        $imgData = $image_result;
                        $_SESSION['imgBase64'] = $imgData;
                    }

                    $user_data =
                        [
                            'main' =>
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
                            ],

                            'tc_1' =>
                            [
                                'first_name_travel_companion' => $first_name_tc,
                                'last_name_travel_companion' => $last_name_tc,
                                'dob_travel_companion' => $dob_tc,
                                'gender_travel_companion' => $gender_tc,
                                'nationality_travel_companion' => $custom_data_tc,
                                'relationship_travel_companion' => $relationship_tc,
                                'restriction_travel_companion' => $restriction_tc,
                            ],

                            'other' =>
                            [
                                'uploaded_image' => $imgData,
                                'first_name_japan_gift' => $first_name_jp,
                                'last_name_japan_gift' => $last_name_jp,
                                'travel_period' => $period,
                                'know_campaign' => $campaign
                            ]
                        ];

                    $_SESSION['user_data'] = $user_data;
                    return  $_SESSION['user_data'];
                
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
            $image_name = $files['image']['name'];
            $image_ext = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
            $ext = array('jepg', 'jpg', 'png', 'svg', 'gif', 'webp');
            if ($image_name == "" && $tmp_img_name == "") {
                $errors['image'] = 'Please upload a photo.';
            } else if (empty($image_name) && empty($tmp_img_name)) {
                $errors['image'] = 'Please upload a photo.';
            } else if (in_array($image_ext, $ext) === false && !empty($image_name)) {
                $errors['image'] = 'Image file not support. Please upload JEPG, JPG, PNG.';
            } else if ($image_size > 500000 && isset($image_name)) {
                $errors['image'] = 'Image file size not more than 5MB.';
            }
            $_SESSION['image_name'] = $files['image']['name'];
            //image validate end

            //date 
            $dob = new DateTime($post['dob']);
            $dob_tc = new DateTime($post['dob_tc']);
            $current  = new DateTime('today');
            $age = $dob->diff($current)->y;
            $age_tc = $dob_tc->diff($current)->y;

            $reg_num = '/^\d\w+$/';
            $reg_special = '/^[^!@#$%^&*()"?\/><|-]+$/';

            if (empty($post['first_name']) || ctype_space($post['first_name'])) {
                $errors['first_name'] = "Please fills the required field.";
                if(isset($_SESSION['old_fn'])){
                    unset($_SESSION['old_fn']);
                }
            } else {
                $_SESSION['old_fn'] = htmlspecialchars($post['first_name']);
            }

            if (preg_match($reg_num, $post['first_name']) && !empty($post['first_name'])) {
                $errors['first_name'] = "First name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['first_name']) && !empty($post['first_name'])) {
                $errors['first_name'] = "First name should not be include special characters.";
            }

            if (strlen($post['first_name']) > 128) {
                $errors['first_name'] = "First Name character can't be more than 128.";
            }

            if (empty($post['last_name']) || ctype_space($post['last_name'])) {
                $errors['last_name'] = "Please fills the required field.";
                if(isset($_SESSION['old_ln'])){
                    unset($_SESSION['old_ln']);
                }
            } else {
                $_SESSION['old_ln'] = htmlspecialchars($post['last_name']);
            }

           if (preg_match($reg_num, $post['last_name']) && !empty($post['last_name'])) {
                $errors['last_name'] = "Last name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['last_name']) && !empty($post['last_name'])) {
                $errors['last_name'] = "Last name should not be include special characters.";
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

            $inputDate = explode('-', $post['dob']);
            if (isset($post['dob']) && strlen($inputDate[0]) > 4) {
                $errors['dob'] = 'Please insert the valid date.';
            } else if ($post['dob'] > date('Y-m-d')) {
                $errors['dob'] = 'Date of birth cannot be today or future.';
            }


            if (empty($post['gender'])) {
                $errors['gender'] = "Please fills the required field.";
            } else {
                $_SESSION['old_gender'] = $post['gender'];
            }

            if (isset($post['nationality'])  && $post['nationality'] == 'Other' && isset($post['custom_country'])) {
                $_SESSION['old_nati_cc'] = htmlspecialchars($post['custom_country']);
            }

            if (empty($post['nationality'])) {
                $errors['nationality'] = "Please fills the required field.";
            } else if ($post['nationality'] == 'Other' && empty($post['custom_country'])) {
                $errors['nationality'] = "Please fills your nationality in other field.";
                if (isset($_SESSION['old_nati_cc'])) {
                    unset($_SESSION['old_nati_cc']);
                }
            } else if ($post['nationality'] == 'Singaporean') {
                if (isset($_SESSION['old_nati_cc'])) {
                    unset($_SESSION['old_nati_cc']);
                }
            } else if ($post['nationality'] == 'Other' && ctype_space($post['custom_country'])) {
                $errors['nationality'] = "Please fills your nationality in other field.";
                if (isset($_SESSION['old_nati_cc'])) {
                    unset($_SESSION['old_nati_cc']);
                }
            }

            if (!empty($post['custom_country']) && strlen($post['custom_country']) > 128) {
                $errors['nationality'] = "Nationality character can't be more than 128.";
            }

            if (!empty($post['custom_country']) && preg_match($reg_num, $post['custom_country']) && $post['nationality'] == 'Other' && isset($post['nationality'])) {
                $errors['nationality'] = "Nationality character can't be start with numbers.";
            }else if (!empty($post['custom_country']) && !preg_match($reg_special, $post['custom_country']) && $post['nationality'] == 'Other' && isset($post['nationality'])) {
                $errors['nationality'] = "Nationality character can't be include special characters.";
            }

            if (!empty($post['nationality'])) {
                $_SESSION['old_nati'] = $post['nationality'];
            }


            if (empty($post['occupation'])  || ctype_space($post['occupation'])) {
                $errors['occupation'] = "Please fills the required field.";
                 if (isset($_SESSION['old_occ'])){
                    unset($_SESSION['old_occ']);
                 }
            } else {
                $_SESSION['old_occ'] = htmlspecialchars($post['occupation']);
            }

            if (strlen($post['occupation']) > 400) {
                $errors['occupation'] = "Occupation character can't be more than 400.";
            }
           
            if (preg_match($reg_num, $post['occupation']) && !empty($post['occupation'])) {
                $errors['occupation'] = "Occupation should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['occupation']) && !empty($post['occupation'])) {
                $errors['occupation'] = "Occupation should not be include special characters.";
            }

            if (empty($post['religion']) || ctype_space($post['religion']) ) {
                $errors['religion'] = "Please fills the required field.";
                if(isset($_SESSION['old_reli'])) {
                    unset($_SESSION['old_reli']);
                }
            } else {
                $_SESSION['old_reli'] = htmlspecialchars($post['religion']);
            }
            
            if (strlen($post['religion']) > 400) {
                $errors['religion'] = "Religion character can't be more than 400.";
            }

            if (preg_match($reg_num, $post['religion']) && !empty($post['religion'])) {
                $errors['religion'] = "Religion should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['religion']) && !empty($post['religion'])) {
                $errors['religion'] = "Religion should not be include special characters.";
            }

             if(isset($post['sns_username']) && ctype_space($post['sns_username'])) {
                $errors['sns_username'] = "Please enter your username.";
                if(isset($_SESSION['old_sns'])) {
                    unset($_SESSION['old_sns']);
                }
            }else if (!empty($post['sns_username'])) {
                $_SESSION['old_sns'] = htmlspecialchars($post['sns_username']);
            }else if (empty($post['sns_username'])){
                if(isset($_SESSION['old_sns'])) {
                    unset($_SESSION['old_sns']);
                }
            }

            if (strlen($post['sns_username']) > 128) {
                $errors['sns_username'] = "Username character can't be more than 128.";
            }

            if (is_numeric($post['sns_username'])) {
                $errors['sns_username'] = "Username character can't benumber.";
            }

            if (empty($post['japan_before']) ) {
                $errors['japan_before'] = "Please fills the required field.";
            } else {
                $_SESSION['old_before'] = $post['japan_before'];
            }

            if (empty($post['region']) && isset($post['japan_before']) && $post['japan_before'] != 'Never') {
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

            if(isset($post['japan_before']) && $post['japan_before'] == 'Never') {
                if (isset($_SESSION['old_reg'])) {
                    unset($_SESSION['old_reg']);
                }
            }

            if (isset($post['region'])) {
                $_SESSION['old_reg'] = $post['region'];
            }

            if (empty($post['restriction']) ||  ctype_space($post['restriction'])) {
                $errors['restriction'] = "Please fills the required field.";
               if  (isset($_SESSION['old_restri'])) {
                unset($_SESSION['old_restri']);
               }
            } else {
                $_SESSION['old_restri'] = htmlspecialchars($post['restriction']);
            }


            if (strlen($post['restriction']) > 400) {
                $errors['restriction'] = "Character can't be more than 400.";
            }

            if (preg_match($reg_num, $post['restriction']) && !empty($post['restriction'])) {
                $errors['restriction'] = "Restriction should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['restriction']) && !empty($post['restriction'])) {
                $errors['restriction'] = "Restriction should not be include special characters.";
            }

            if (empty($post['email']) ||  ctype_space($post['email']) ) {
                $errors['email'] = "Please fills the required field.";
                if (isset($_SESSION['old_email'])) {
                    unset($_SESSION['old_email']);
                }
            } else {
                $_SESSION['old_email'] = htmlspecialchars($post['email']);
            }

            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL) && !empty($post['email']) && !ctype_space($post['email']) ) {
                $errors['email'] = "Please fills valid Email address.";
            }

            if (empty($post['ph_num']) ||  ctype_space($post['ph_num'])) {
                $errors['ph_num'] = "Please fills the required field.";
                if(isset($_SESSION['old_ph'])) {
                    unset($_SESSION['old_ph']);
                }
            } else {
                $_SESSION['old_ph'] = htmlspecialchars($post['ph_num']);
            }

             if (strlen($post['ph_num']) > 25 && !empty($post['ph_num']) && is_numeric($post['ph_num'])) {
                $errors['ph_num'] = "Phone number can't be more than 25 characters.";
            } else if (strlen($post['ph_num']) < 7  && !empty($post['ph_num']) && is_numeric($post['ph_num'])) {
                $errors['ph_num'] = "Phone number can't be less than 7 characters.";
            }else if (!is_numeric($post['ph_num'])) {
                $errors['ph_num'] = "Please enter the valid phone number.";
            }

            if (empty($post['first_name_tc']) ||  ctype_space($post['first_name_tc'])) {
                $errors['first_name_tc'] = "Please fills the required field.";
                if (isset($_SESSION['old_fn_tc'])){
                    unset($_SESSION['old_fn_tc']);
                }
            } else {
                $_SESSION['old_fn_tc'] = htmlspecialchars($post['first_name_tc']);
            }

            if (preg_match($reg_num, $post['first_name_tc']) && !empty($post['first_name_tc'])) {
                $errors['first_name_tc'] = "First name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['first_name_tc']) && !empty($post['first_name_tc'])) {
                $errors['first_name_tc'] = "First name should not be include special characters.";
            }

            if (strlen($post['first_name_tc']) > 128) {
                $errors['first_name_tc'] = "First Name character can't be more than 128.";
            }

            if (empty($post['last_name_tc']) ||  ctype_space($post['last_name_tc'])) {
                $errors['last_name_tc'] = "Please fills the required field.";
                if (isset($_SESSION['old_ln_tc'])){
                    unset($_SESSION['old_ln_tc']);
                }
            } else {
                $_SESSION['old_ln_tc'] = htmlspecialchars($post['last_name_tc']);
            }

            if (preg_match($reg_num, $post['last_name_tc']) && !empty($post['last_name_tc'])) {
                $errors['last_name_tc'] = "Last name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['last_name_tc']) && !empty($post['last_name_tc'])) {
                $errors['last_name_tc'] = "Last name should not be include special characters.";
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

            $inputDate = explode('-', $post['dob_tc']);

            if (isset($post['dob_tc']) && strlen($inputDate[0]) > 4) {
                $errors['dob_tc'] = 'Please insert the valid date.';
            } else if ($post['dob_tc'] > date('Y-m-d')) {
                $errors['dob_tc'] = 'Date of birth cannot be today or future.';
            }

            if (empty($post['gender_tc'])) {
                $errors['gender_tc'] = "Please fills the required field.";
            } else {
                $_SESSION['old_gender_tc'] = $post['gender_tc'];
            }

            if (isset($post['nationality_tc']) && $post['nationality_tc'] == 'Other' && isset($post['custom_country_tc'])) {
                $_SESSION['old_nati_cc_tc'] = htmlspecialchars($post['custom_country_tc']);
            }

            if (empty($post['nationality_tc'])) {
                $errors['nationality_tc'] = "Please fills the required field.";
            } else if ($post['nationality_tc'] == 'Other' && empty($post['custom_country_tc'])) {
                $errors['nationality_tc'] = "Please fills your nationality in other field.";
                if(isset($_SESSION['old_nati_cc_tc'])) {
                    unset($_SESSION['old_nati_cc_tc']);
                }
            }else if ($post['nationality_tc'] == 'Singaporean'){
                if(isset($_SESSION['old_nati_cc_tc'])) {
                    unset($_SESSION['old_nati_cc_tc']);
                }
            } else if ($post['nationality_tc'] == 'Other' && ctype_space($post['custom_country_tc'])) {
                $errors['nationality_tc'] = "Please fills your nationality in other field.";
                if(isset($_SESSION['old_nati_cc_tc'])) {
                    unset($_SESSION['old_nati_cc_tc']);
                }
            }
            
            if (!empty($post['custom_country_tc']) && strlen($post['custom_country_tc']) > 128) {
                $errors['nationality_tc'] = "Nationality can't be more than 128.";
            }
            if (!empty($post['custom_country_tc']) && preg_match($reg_num, $post['custom_country_tc']) && $post['nationality_tc'] == 'Other' && isset($post['nationality_tc'])) {
                $errors['nationality_tc'] = "Nationality can't be start with numbers.";
            } if (!empty($post['custom_country_tc']) && !preg_match($reg_special, $post['custom_country_tc']) && $post['nationality_tc'] == 'Other' && isset($post['nationality_tc'])) {
                $errors['nationality_tc'] = "Nationality should not be include special character.";
            }

            if (!empty($post['nationality_tc'])) {
                $_SESSION['old_nati_tc'] = $post['nationality_tc'];
            }
            
            if (empty($post['relationship_tc']) ||  ctype_space($post['relationship_tc'])) {
                $errors['relationship_tc'] = "Please fills the required field.";
                if(isset($_SESSION['old_rs_tc'])) {
                    unset($_SESSION['old_rs_tc']);
                }
            } else {
                $_SESSION['old_rs_tc'] = htmlspecialchars($post['relationship_tc']);
            }

            if (preg_match($reg_num, $post['relationship_tc']) && !empty($post['relationship_tc'])) {
                $errors['relationship_tc'] = "Relationship should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['relationship_tc']) && !empty($post['relationship_tc'])) {
                $errors['relationship_tc'] = "Relationship should not be include special characters.";
            }

            if (strlen($post['relationship_tc']) > 128) {
                $errors['relationship_tc'] = "This field of character can't be more than 128.";
            }

            if (empty($post['restriction_tc'])  ||  ctype_space($post['restriction_tc']) ) {
                $errors['restriction_tc'] = "Please fills the required field.";
                if (isset($_SESSION['old_res_tc'])) {
                    unset($_SESSION['old_res_tc']);
                }
            } else {
                $_SESSION['old_res_tc'] = htmlspecialchars($post['restriction_tc']);
            }

            if (preg_match($reg_num, $post['restriction_tc']) && !empty($post['restriction_tc'])) {
                $errors['restriction_tc'] = "Restriction should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['restriction_tc']) && !empty($post['restriction_tc'])) {
                $errors['restriction_tc'] = "Restriction should not be include special characters.";
            }

            if (strlen($post['restriction_tc']) > 400) {
                $errors['restriction_tc'] = "This field of character can't be more than 400.";
            }

            if (empty($post['first_name_jp']) ||  ctype_space($post['first_name_jp'])) {
                $errors['first_name_jp'] = "Please fills the required field.";
                if (isset($_SESSION['old_fn_jp'])) {
                    unset($_SESSION['old_fn_jp']);
                }
            } else {
                $_SESSION['old_fn_jp'] = htmlspecialchars($post['first_name_jp']);
            }

            if (strlen($post['first_name_jp']) > 128) {
                $errors['first_name_jp'] = "First Name character can't be more than 128.";
            }

            if (preg_match($reg_num, $post['first_name_jp']) && !empty($post['first_name_jp'])) {
                $errors['first_name_jp'] = "First name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['first_name_jp']) && !empty($post['first_name_jp'])) {
                $errors['first_name_jp'] = "First name should not be include special characters.";
            }

            if (empty($post['last_name_jp']) ||  ctype_space($post['last_name_jp']) ) {
                $errors['last_name_jp'] = "Please fills the required field.";
                if (isset($_SESSION['old_ln_jp'])) {
                    unset($_SESSION['old_ln_jp']);
                }
            } else {
                $_SESSION['old_ln_jp'] = htmlspecialchars($post['last_name_jp']);
            }

            if (strlen($post['last_name_jp']) > 128) {
                $errors['last_name_jp'] = "Last Name character can't be more than 128.";
            }

            if (preg_match($reg_num, $post['last_name_jp']) && !empty($post['last_name_jp'])) {
                $errors['last_name_jp'] = "Last name should not be start with numbers.";
            }else if (!preg_match($reg_special, $post['last_name_jp']) && !empty($post['last_name_jp'])) {
                $errors['last_name_jp'] = "Last name should not be include special characters.";
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
                if (isset($_SESSION['old_vd'])) {
                    unset($_SESSION['old_vd']);
                }
            } else {
                $_SESSION['old_vd'] = $post['video_upload'];
            }

            if (isset($post['campaign']) && in_array('Other', $post['campaign']) && isset($post['custom_campaign'])) {
                $_SESSION['old_custom_camp'] = htmlspecialchars($post['custom_campaign']);
            } else {
                if (isset($_SESSION['old_custom_camp'])) {
                    unset($_SESSION['old_custom_camp']);
                }
            }

            if (empty($post['campaign'])) {
                $errors['campaign'] = "Please fills the required field.";
                if (isset($_SESSION['old_camp'])) {
                    unset($_SESSION['old_camp']);
                }
            } else if (isset($post['campaign']) && in_array('Other', $post['campaign']) && $post['custom_campaign'] == '') {
                $errors['campaign'] = "Please fills your campaign in other field.";
            } else if (isset($post['campaign']) && in_array('Other', $post['campaign']) && ctype_space($post['custom_campaign'])) {
                $errors['campaign'] = "Please fills your campaign in other field.";
                if (isset($_SESSION['old_custom_camp'])) {
                    unset($_SESSION['old_custom_camp']);
                }
            } else if (!empty($post['custom_campaign']) && strlen($post['custom_campaign']) > 128) {
                $errors['campaign'] = "Campaign can't be more than 128.";
            } else if (!empty($post['custom_campaign']) && preg_match($reg_num, $post['custom_campaign'])) {
                $errors['campaign'] = "Campaign can't be start with numbers.";
            }else if (!empty($post['custom_campaign']) && !preg_match($reg_special, $post['custom_campaign'])) {
                $errors['campaign'] = "Campaign should not be include special character.";
            }

            if (!empty($post['campaign'])) {
                $_SESSION['old_camp'] = $post['campaign'];
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

    public function store(array $post, array $files)
    {
        try {
            if (isset($post['confirm'])) {
                $user_id = 1;
                $flag = 1;
                if (isset($_SESSION['user_data'])) {
                    $user_data = json_encode($_SESSION['user_data'], JSON_UNESCAPED_SLASHES);
                }

                $sql = "INSERT INTO `users_table`(`user_id`, `user_data`, `flag`) VALUES (:user_id, :user_data, :flag)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam('user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam('user_data', $user_data, PDO::PARAM_STR);
                $stmt->bindParam('flag', $flag, PDO::PARAM_INT);

                return $stmt->execute() ? true : false;
            }

            return false;
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
