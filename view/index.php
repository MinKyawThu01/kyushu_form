<?php

include('../app/classes/Kyushu.php');
// include('../app/classes/Test.php');

session_start();

$kyushu = new Kyushu();
if ($kyushu->storeArray($_POST, $_FILES)) {
    // echo "<pre>";
    // var_dump($_SESSION['user_data']);
    // echo "</pre>";
    // die();
    echo '<script>location.href="confirmed/index.php"</script>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/34c98ef48d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="f_container">
            <div class="inner_container">
                <p class="req"><strong>Please complete the application form below.</strong></p>
            </div>
        </div>
        <div class="form_container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="f_container">
                    <div class="inner_container">
                        <h3><span class="star_icon">Representative Applicant</span></h3>
                        <!-- Name -->
                        <div class="form_gp">
                            <h5 class="title">Full Name</h5>
                            <div class="fullname">
                                <div class="first-item">
                                    <input type="text" class="fname" placeholder="First Name"  name="first_name" value="<?php if (isset($_SESSION['old_fn'])) {echo $_SESSION['old_fn'];}  ?>">
                                    <?php if (isset($_SESSION['error']['first_name'])) {?> <span class="for_err"> <?php echo $_SESSION['error']['first_name']; ?></span> <?php } unset($_SESSION['error']['first_name']); ?>
                                </div>
                                <div class="second-item">
                                    <input type="text" placeholder="Last Name" name="last_name" value="<?php if (isset($_SESSION['old_ln'])) {echo $_SESSION['old_ln'];} ?>" >
                                    <?php if (isset($_SESSION['error']['last_name'])) {?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['last_name']; ?></span>
                                    <?php } unset($_SESSION['error']['last_name']); ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="form_gp">
                            <h5 class="title">Date of Birth</h5>
                            <input type="date" max='<?= date('Y-m-d') ?>' name="dob" value="<?php if (isset($_SESSION['old_dob'])) { echo $_SESSION['old_dob'];} ?>" />
                            <?php if (isset($_SESSION['error']['dob'])) { ?> 
                                <span class="for_err"> <?php echo $_SESSION['error']['dob']; ?></span>
                            <?php } unset($_SESSION['error']['dob']); ?>
                        </div>
                        <!-- Gender -->
                        <div class="form_gp">
                            <h5 class="title">Gender</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_gender'])) { ?>
                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input type="radio" name="gender" value="Male" <?php if ($_SESSION['old_gender'] == 'Male') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input type="radio" name="gender" value="Female" <?php if ($_SESSION['old_gender'] == 'Female') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input type="radio" name="gender" value="Other" <?php if ($_SESSION['old_gender'] == 'Other') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input type="radio" name="gender" value="Male">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input type="radio" name="gender" value="Female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input type="radio" name="gender" value="Other">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['gender'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['gender']; ?></span>
                            <?php } unset($_SESSION['error']['gender']); ?>
                        </div>
                        <!-- Nationality -->
                        <div class="form_gp">
                            <h5 class="title">Nationality</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_nati'])) { ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input type="radio" name="nationality" value="Singaporean" <?php if ($_SESSION['old_nati'] == 'Singaporean') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input type="radio" name="nationality" class=" all_input" value="Other" <?php if ($_SESSION['old_nati'] == 'Other') { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>

                                            <!-- test 1 remove disable and class = dim -->
                                            <input type="text" id="nation_opt1" name="custom_country" value="<?php if (isset($_SESSION['old_nati_cc'])) { echo $_SESSION['old_nati_cc'];} ?>">
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input type="radio" name="nationality" value="Singaporean">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <!-- copy remove disabled and calss = dim  -->
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input type="radio" name="nationality" value="Other" class=" all_input">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input type="text" id="nation_opt1" name="custom_country">
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['nationality'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['nationality']; ?></span>
                            <?php } unset($_SESSION['error']['nationality']); ?>
                        </div>
                        <!-- Occupation -->
                        <div class="form_gp">
                            <h5 class="title">Occupation</h5>
                            <input type="text" placeholder="Type..." name="occupation" value="<?php if (isset($_SESSION['old_occ'])) { echo $_SESSION['old_occ']; } ?>" />
                            <?php if (isset($_SESSION['error']['occupation'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['occupation']; ?></span>
                            <?php } unset($_SESSION['error']['occupation']); ?>
                        </div>
                        <!-- Religion -->
                        <div class="form_gp">
                            <h5 class="title">Religion</h5>
                            <p>(We will try to caster to religion preferences, but should you not wish to specify, please answer "prefer not to say")</p>
                            <input type="text" placeholder="Type..." name="religion" value="<?php if (isset($_SESSION['old_reli'])) { echo $_SESSION['old_reli']; } ?>" />
                            <?php if (isset($_SESSION['error']['religion'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['religion']; ?></span>
                            <?php } unset($_SESSION['error']['religion']); ?>
                        </div>
                        <!-- SNS username -->
                        <div class="form_gp">
                            <h5 class="title">SNS username<span class="sub_txt">(Facebook/Instagram/Tiktok/Youtube)</h5>
                            <p>*Leave the option blank if you do not have any Social Media account</p>
                            <input type="text"  placeholder="Type..." name="sns_username" value="<?php if (isset($_SESSION['old_sns'])) { echo $_SESSION['old_sns']; } ?>" />
                            <?php if (isset($_SESSION['error']['sns_username'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['sns_username']; ?></span>
                            <?php } unset($_SESSION['error']['sns_username']); ?>
                        </div>
                        <!-- have been to japan -->
                        <div class="form_gp">
                            <h5 class="title">Have you been to Japan before?</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_before'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio">Never
                                            <input type="radio" name="japan_before" id="never_input" class="c-form_radio" value="Never" <?php if ($_SESSION['old_before'] == 'Never') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Once
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Once" <?php if ($_SESSION['old_before'] == 'Once') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Twice
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Twice" <?php if ($_SESSION['old_before'] == 'Twice') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Thrice
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Thrice" <?php if ($_SESSION['old_before'] == 'Thrice') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">More than 3 times
                                            <input type="radio" name="japan_before" class="c-form_radio" value="More Than 3 Times" <?php if ($_SESSION['old_before'] == 'More Than 3 Times') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <label class="all_checks_radio">Never
                                            <input type="radio" name="japan_before" id="never_input" class="c-form_radio" value="Never">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Once
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Once">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Twice
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Twice">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Thrice
                                            <input type="radio" name="japan_before" class="c-form_radio" value="Thrice">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">More than 3 times
                                            <input type="radio" name="japan_before" class="c-form_radio" value="More than 3 times">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['japan_before'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['japan_before']; ?></span>
                            <?php } unset($_SESSION['error']['japan_before']); ?>
                        </div>
                        <!-- Region visited in past Japan travels -->
                        <?php if (isset($_SESSION['old_reg'])) { ?>
                            <div class="visited_japan form_gp">
                                <h5 class="title">Region(s) visited in past Japan travels</h5>
                                <div class="region">
                                    <h5 class="title">Hokkaido / Tohoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Hokkaido
                                                <input type="checkbox" name="region[]" value="Hokkaido" <?php if (in_array('Hokkaido', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aomori
                                                <input type="checkbox" name="region[]" value="Aomori" <?php if (in_array('Aomori', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Iwate
                                                <input type="checkbox" name="region[]" value="Iwate" <?php if (in_array('Iwate', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyagi
                                                <input type="checkbox" name="region[]" value="Miyagi" <?php if (in_array('Miyagi', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Akita
                                                <input type="checkbox" name="region[]" value="Akita" <?php if (in_array('Akita', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamagata
                                                <input type="checkbox" name="region[]" value="Yamagata" <?php if (in_array('Yamagata', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukushima
                                                <input type="checkbox" name="region[]" value="Fukushima" <?php if (in_array('Fukushima', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kanto region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Ibaraki
                                                <input type="checkbox" name="region[]" value="Ibaraki" <?php if (in_array('Ibaraki', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tochigi
                                                <input type="checkbox" name="region[]" value="Tochigi" <?php if (in_array('Tochigi', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gunma
                                                <input type="checkbox" name="region[]" value="Gunma" <?php if (in_array('Gunma', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saitama
                                                <input type="checkbox" name="region[]" value="Saitama" <?php if (in_array('Saitama', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Chiba
                                                <input type="checkbox" name="region[]" value="Chiba" <?php if (in_array('Chiba', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tokyo
                                                <input type="checkbox" name="region[]" value="Tokyo" <?php if (in_array('Tokyo', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kanagawa
                                                <input type="checkbox" name="region[]" value="Kanagawa" <?php if (in_array('Kanagawa', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Hokuriku Shinetesu region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Niigata
                                                <input type="checkbox" name="region[]" value="Niigata" <?php if (in_array('Niigata', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Toyama
                                                <input type="checkbox" name="region[]" value="Toyama" <?php if (in_array('Toyama', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ishikawa
                                                <input type="checkbox" name="region[]" value="Ishikawa" <?php if (in_array('Ishikawa', $_SESSION['old_reg'])) {  echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamanashi
                                                <input type="checkbox" name="region[]" value="Yamanashi" <?php if (in_array('Yamanashi', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagano
                                                <input type="checkbox" name="region[]" value="Nagano" <?php if (in_array('Nagano', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Chubu region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Shizuoka
                                                <input type="checkbox" name="region[]" value="Shizuoka" <?php if (in_array('Shizuoka', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aichi
                                                <input type="checkbox" name="region[]" value="Aichi" <?php if (in_array('Aichi', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gifu
                                                <input type="checkbox" name="region[]" value="Gifu" <?php if (in_array('Gifu', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mie
                                                <input type="checkbox" name="region[]" value="Mie" <?php if (in_array('Mie', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukui
                                                <input type="checkbox" name="region[]" value="Fukui" <?php if (in_array('Fukui', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kinki region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Shiga
                                                <input type="checkbox" name="region[]" value="Shiga" <?php if (in_array('Shiga', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kyoto
                                                <input type="checkbox" name="region[]" value="Kyoto" <?php if (in_array('Kyoto', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Osaka
                                                <input type="checkbox" name="region[]" value="Osaka" <?php if (in_array('Osaka', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hyogo
                                                <input type="checkbox" name="region[]" value="Hyogo" <?php if (in_array('Hyogo', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nara
                                                <input type="checkbox" name="region[]" value="Nara" <?php if (in_array('Nara', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Wakayama
                                                <input type="checkbox" name="region[]" value="Wakayama" <?php if (in_array('Wakayama', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Chugoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Tottori
                                                <input type="checkbox" name="region[]" value="Tottori" <?php if (in_array('Tottori', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Shimane
                                                <input type="checkbox" name="region[]" value="Shimane" <?php if (in_array('Shimane', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okayama
                                                <input type="checkbox" name="region[]" value="Okayama" <?php if (in_array('Okayama', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hiroshima
                                                <input type="checkbox" name="region[]" value="Hiroshima" <?php if (in_array('Hiroshima', $_SESSION['old_reg'])) { echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamaguchi
                                                <input type="checkbox" name="region[]" value="Yamaguchi" <?php if (in_array('Yamaguchi', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Shikoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Tokushima
                                                <input type="checkbox" name="region[]" value="Tokushima" <?php if (in_array('Tokushima', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagawa
                                                <input type="checkbox" name="region[]" value="Kagawa" <?php if (in_array('Kagawa', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ehima
                                                <input type="checkbox" name="region[]" value="Ehima" <?php if (in_array('Ehima', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kochi
                                                <input type="checkbox" name="region[]" value="Kochi" <?php if (in_array('Kochi', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kyushu / Okinawa region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Fukuoka
                                                <input type="checkbox" name="region[]" value="Fukuoka" <?php if (in_array('Fukuoka', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saga
                                                <input type="checkbox" name="region[]" value="Saga" <?php if (in_array('Saga', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagasaki
                                                <input type="checkbox" name="region[]" value="Nagasaki" <?php if (in_array('Nagasaki', $_SESSION['old_reg'])) {echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kumamoto
                                                <input type="checkbox" name="region[]" value="Kumamoto" <?php if (in_array('Kumamoto', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Oita
                                                <input type="checkbox" name="region[]" value="Oita" <?php if (in_array('Oita', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyazaki
                                                <input type="checkbox" name="region[]" value="Miyazaki" <?php if (in_array('Miyazaki', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagoshima
                                                <input type="checkbox" name="region[]" value="Kagoshima" <?php if (in_array('Kagoshima', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okinawa
                                                <input type="checkbox" name="region[]" value="Okinawa" <?php if (in_array('Okinawa', $_SESSION['old_reg'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <?php if (isset($_SESSION['error']['region'])) { ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['region']; ?></span>
                                    <?php } unset($_SESSION['error']['region']);
                                    ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="visited_japan form_gp">
                                <h5 class="title">Region(s) visited in past Japan travels</h5>
                                <div class="region">
                                    <h5 class="title">Hokkaido / Tohoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Hokkaido
                                                <input type="checkbox" name="region[]" value="Hokkaido">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aomori
                                                <input type="checkbox" name="region[]" value="Aomori">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Iwate
                                                <input type="checkbox" name="region[]" value="Iwate">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyagi
                                                <input type="checkbox" name="region[]" value="Miyagi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Akita
                                                <input type="checkbox" name="region[]" value="Akita">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamagata
                                                <input type="checkbox" name="region[]" value="Yamagata">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukushima
                                                <input type="checkbox" name="region[]" value="Fukushima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kanto region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Ibaraki
                                                <input type="checkbox" name="region[]" value="Ibaraki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tochigi
                                                <input type="checkbox" name="region[]" value="Tochigi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gunma
                                                <input type="checkbox" name="region[]" value="Gunma">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saitama
                                                <input type="checkbox" name="region[]" value="Saitama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Chiba
                                                <input type="checkbox" name="region[]" value="Chiba">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tokyo
                                                <input type="checkbox" name="region[]" value="Tokyo">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kanagawa
                                                <input type="checkbox" name="region[]" value="Kanagawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Hokuriku Shinetesu region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Niigata
                                                <input type="checkbox" name="region[]" value="Niigata">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Toyama
                                                <input type="checkbox" name="region[]" value="Toyama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ishikawa
                                                <input type="checkbox" name="region[]" value="Ishikawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamanashi
                                                <input type="checkbox" name="region[]" value="Yamanashi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagano
                                                <input type="checkbox" name="region[]" value="Nagano">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Chubu region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Shizuoka
                                                <input type="checkbox" name="region[]" value="Shizuoka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aichi
                                                <input type="checkbox" name="region[]" value="Aichi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gifu
                                                <input type="checkbox" name="region[]" value="Gifu">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mie
                                                <input type="checkbox" name="region[]" value="Mie">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukui
                                                <input type="checkbox" name="region[]" value="Fukui">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kinki region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Shiga
                                                <input type="checkbox" name="region[]" value="Shiga">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kyoto
                                                <input type="checkbox" name="region[]" value="Kyoto">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Osaka
                                                <input type="checkbox" name="region[]" value="Osaka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hyogo
                                                <input type="checkbox" name="region[]" value="Hyogo">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nara
                                                <input type="checkbox" name="region[]" value="Nara">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Wakayama
                                                <input type="checkbox" name="region[]" value="Wakayama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Chugoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Tottori
                                                <input type="checkbox" name="region[]" value="Tottori">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Shimane
                                                <input type="checkbox" name="region[]" value="Shimane">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okayama
                                                <input type="checkbox" name="region[]" value="Okayama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hiroshima
                                                <input type="checkbox" name="region[]" value="Hiroshima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamaguchi
                                                <input type="checkbox" name="region[]" value="Yamaguchi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Shikoku region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Tokushima
                                                <input type="checkbox" name="region[]" value="Tokushima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagawa
                                                <input type="checkbox" name="region[]" value="Kagawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ehima
                                                <input type="checkbox" name="region[]" value="Ehima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kochi
                                                <input type="checkbox" name="region[]" value="Kochi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="region">
                                    <h5 class="title">Kyushu / Okinawa region</h5>
                                    <ul class="custom-checkbox">
                                        <li>
                                            <label class="all_checks_label">Fukuoka
                                                <input type="checkbox" name="region[]" value="Fukuoka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saga
                                                <input type="checkbox" name="region[]" value="Saga">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagasaki
                                                <input type="checkbox" name="region[]" value="Nagasaki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kumamoto
                                                <input type="checkbox" name="region[]" value="Kumamoto">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Oita
                                                <input type="checkbox" name="region[]" value="Oita">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyazaki
                                                <input type="checkbox" name="region[]" value="Miyazaki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagoshima
                                                <input type="checkbox" name="region[]" value="Kagoshima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okinawa
                                                <input type="checkbox" name="region[]" value="Okinawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <?php if (isset($_SESSION['error']['region'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['region']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['region']);
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Dietary  Restrictions-->
                        <div class="form_gp">
                            <h5 class="title">Dietary Restrictions <span class="sub_txt">(Including Alcohol)</span> </h5>
                            <input type="text" placeholder="Type..." name="restriction" value="<?php if (isset($_SESSION['old_restri'])) { echo $_SESSION['old_restri']; } ?>" />
                            <?php if (isset($_SESSION['error']['restriction'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['restriction']; ?></span>
                            <?php } unset($_SESSION['error']['restriction']); ?>
                        </div>
                        <!-- Email -->
                        <div class="form_gp">
                            <h5 class="title">Email Address</h5>
                            <input type="text" placeholder="Email" name="email" value="<?php if (isset($_SESSION['old_email'])) { echo $_SESSION['old_email']; } ?>" />
                            <?php if (isset($_SESSION['error']['email'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['email']; ?></span>
                            <?php } unset($_SESSION['error']['email']); ?>
                        </div>
                        <!-- Phone Number -->
                        <div class="form_gp">
                            <h5 class="title">Phone Number</h5>
                            <input type="text" placeholder="Phone Number" name="ph_num" value="<?php if (isset($_SESSION['old_ph'])) { echo $_SESSION['old_ph']; } ?>" />
                            <?php if (isset($_SESSION['error']['ph_num'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['ph_num']; ?></span>
                            <?php } unset($_SESSION['error']['ph_num']); ?>
                        </div>

                        <hr class="form_gp">

                        <!-- Travel Companion 01 -->
                        <h3 class="form_gp"><span class="star_icon">Travel Companion 01</span></h3>
                        <!-- Name -->
                        <div class="form_gp">
                            <h5 class="title">Full Name</h5>
                            <div class="fullname">
                                <div class="first-item">
                                    <input type="text" class="first-name" placeholder="First Name" name="first_name_tc" value="<?php if (isset($_SESSION['old_fn_tc'])) { echo $_SESSION['old_fn_tc']; } ?>" />
                                    <?php if (isset($_SESSION['error']['first_name_tc'])) { ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['first_name_tc']; ?></span>
                                    <?php } unset($_SESSION['error']['first_name_tc']); ?>
                                </div>
                                <div class="second-item">
                                    <input type="text" placeholder="Last Name" name="last_name_tc" value="<?php if (isset($_SESSION['old_ln_tc'])) { echo $_SESSION['old_ln_tc']; } ?>" />
                                    <?php if (isset($_SESSION['error']['last_name_tc'])) { ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['last_name_tc']; ?></span>
                                    <?php } unset($_SESSION['error']['last_name_tc']); ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="form_gp">
                            <h5 class="title">Date of Birth</h5>
                            <input type="date" max='<?= date('Y-m-d') ?>' name="dob_tc" value="<?php if (isset($_SESSION['old_dob_tc'])) { echo $_SESSION['old_dob_tc']; } ?>" />
                            <?php if (isset($_SESSION['error']['dob_tc'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['dob_tc']; ?></span>
                            <?php } unset($_SESSION['error']['dob_tc']); ?>
                        </div>
                        <!-- Gender -->
                        <div class="form_gp">
                            <h5 class="title">Gender</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_gender_tc'])) { ?>

                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input type="radio" name="gender_tc" value="Male" <?php if ($_SESSION['old_gender_tc'] == 'Male') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input type="radio" name="gender_tc" value="Female" <?php if ($_SESSION['old_gender_tc'] == 'Female') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input type="radio" name="gender_tc" value="Other" <?php if ($_SESSION['old_gender_tc'] == 'Other') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>

                                <?php } else { ?>
                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input type="radio" name="gender_tc" value="Male">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input type="radio" name="gender_tc" value="Female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input type="radio" name="gender_tc" value="Other">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['gender_tc'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['gender_tc']; ?></span>
                            <?php } unset($_SESSION['error']['gender_tc']); ?>
                        </div>
                        <!-- Nationality -->
                        <div class="form_gp">
                            <h5 class="title">Nationality</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_nati_tc'])) { ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input type="radio" name="nationality_tc" value="Singaporean" <?php if ($_SESSION['old_nati_tc'] == 'Singaporean') { echo 'checked'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input type="radio" name="nationality_tc" class=" all_input" value="Other" <?php if ($_SESSION['old_nati_tc'] == 'Other') { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>

                                            <!-- test 2 reomve disable  -->
                                            <input type="text" id="nation_opt2" name="custom_country_tc" value="<?php if (isset($_SESSION['old_nati_cc_tc'])) {  echo $_SESSION['old_nati_cc_tc']; } ?>">
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input type="radio" name="nationality_tc" value="Singaporean">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input type="radio" name="nationality_tc" value="Other" class=" all_input">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input type="text" id="nation_opt2" name="custom_country_tc">
                                        </div>
                                    </li>
                                <?php } ?>

                            </ul>
                            <?php if (isset($_SESSION['error']['nationality_tc'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['nationality_tc']; ?></span>
                            <?php  } unset($_SESSION['error']['nationality_tc']); ?>
                        </div>
                        <!-- Relationship with applicate -->
                        <div class="form_gp">
                            <h5 class="title">Relationship with applicant</h5>
                            <input type="text" placeholder="Type..." name="relationship_tc" value="<?php if (isset($_SESSION['old_rs_tc'])) { echo $_SESSION['old_rs_tc']; } ?>" />
                            <?php if (isset($_SESSION['error']['relationship_tc'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['relationship_tc']; ?></span>
                            <?php } unset($_SESSION['error']['relationship_tc']); ?>
                        </div>
                        <!-- Dietary  Restrictions-->
                        <div class="form_gp">
                            <h5 class="title">Dietary Restrictions <span class="sub_txt">(Including Alcohol)</span></h5>
                            <input type="text" placeholder="Type..." name="restriction_tc" value="<?php if (isset($_SESSION['old_res_tc'])) { echo $_SESSION['old_res_tc']; } ?>" />
                            <?php if (isset($_SESSION['error']['restriction_tc'])) { ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['restriction_tc']; ?></span>
                            <?php } unset($_SESSION['error']['restriction_tc']); ?>
                        </div>
                    </div>
                </div>
                <!-- file upload  -->
                <div class="files_upload">
                    <div class="f_container">
                        <div class="inner_container">
                            <!-- image  -->
                            <div class="form_gp img_upload">
                                <h5 class="title">Please upload a photo that shows all applicate in the photo</h5>
                                <input type="file" name="image" class="" />
                                <?php if (isset($_SESSION['error']['image'])) { ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['image']; ?></span>
                                <?php  } unset($_SESSION['error']['image']); ?>
                            </div>
                            <!-- Birthday  -->
                            <div class="form_gp">
                                <h5 class="title">The full name of the name who will receives the trip to Japan as their birthday gift</h5>
                                <div class="fullname">
                                    <div class="first-item">
                                        <input type="text" class="fname" placeholder="First Name" name="first_name_jp" value="<?php if (isset($_SESSION['old_fn_jp'])) { echo $_SESSION['old_fn_jp']; } ?>">
                                        <?php if (isset($_SESSION['error']['first_name_jp'])) { ?>
                                            <span class="for_err"> <?php echo $_SESSION['error']['first_name_jp']; ?></span>
                                        <?php } unset($_SESSION['error']['first_name_jp']); ?>
                                    </div>
                                    <div class="second-item">
                                        <input type="text" placeholder="Last Name" name="last_name_jp" value="<?php if (isset($_SESSION['old_ln_jp'])) { echo $_SESSION['old_ln_jp']; } ?>">
                                        <?php if (isset($_SESSION['error']['last_name_jp'])) { ?>
                                            <span class="for_err"> <?php echo $_SESSION['error']['last_name_jp']; ?></span>
                                        <?php } unset($_SESSION['error']['last_name_jp']); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- travel period  -->
                            <div class="form_gp">
                                <h5 class="title">Please let us know your preferred traveling period</h5>
                                <ul>
                                    <?php if (isset($_SESSION['old_period'])) { ?>
                                        <li>
                                            <label class="all_checks_label">Early January 2024
                                                <input type="checkbox" name="period[]" value="Early January 2024" <?= (in_array('Early January 2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mid January 2024
                                                <input type="checkbox" name="period[]" value="Mid January 2024" <?= (in_array('Mid January 2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Late January 2024
                                                <input type="checkbox" name="period[]" value="Late January 2024" <?= (in_array('Late January 2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <label class="all_checks_label">Early January 2024
                                                <input type="checkbox" name="period[]" value="Early January 2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mid January 2024
                                                <input type="checkbox" name="period[]" value="Mid January 2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Late January 2024
                                                <input type="checkbox" name="period[]" value="Late January 2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <?php if (isset($_SESSION['error']['period'])) { ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['period']; ?></span>
                                <?php }  unset($_SESSION['error']['period']); ?>
                            </div>
                            <!-- video upload  -->
                            <div class="form_gp">
                                <h5 class="title">Please upload your introductory video below</h5>
                                <span class="click_upload">Click here to upload</span>
                                <p class="intro_vd">Have you uploaded your introductory video?</p>
                                <ul>
                                    <?php if (isset($_SESSION['old_vd'])) { ?>
                                        <li>
                                            <label class="all_checks_label">Yes
                                                <input type="checkbox" name="video_upload" value="Yes" <?php if ($_SESSION['old_vd'] == 'Yes') { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php  } else {  ?>
                                        <li>
                                            <label class="all_checks_label">Yes
                                                <input type="checkbox" name="video_upload" value="Yes">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php } if (isset($_SESSION['error']['video_upload'])) { ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['video_upload']; ?></span>
                                    <?php  } unset($_SESSION['error']['video_upload']); ?>
                                </ul>
                            </div>
                            <div class="pr_vdo_uploader">
                                <div class="pr_modal_inner">
                                    <span class="close"></span>
                                    <div class="pr_vdo_item">
                                        <iframe src="https://app.box.com/f/c29a6af23f4049a09cde0f088f728b93" height="550" width="800"></iframe>
                                    </div>
                                </div>
                            </div>
                            <!-- campagin  -->
                            <div class="form_gp">
                                <h5 class="title">Please let us know how you came across this campaign</h5>
                                <ul>
                                    <?php if (isset($_SESSION['old_camp'])) { ?>
                                        <li>
                                            <label class="all_checks_label">JNTO's Website (japan.travel)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Website (japan.travel)" <?php if (in_array("JNTO's Website (japan.travel)", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Facebook (Visit Japan Now)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Facebook (Visit Japan Now)" <?php if (in_array("JNTO's Facebook (Visit Japan Now)", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Instagram (@visitjapansg)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Instagram (@visitjapansg)" <?php if (in_array("JNTO's Instagram (@visitjapansg)", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JAPAN by Japan EDM
                                                <input type="checkbox" name="campaign[]" value="JAPAN by Japan EDM" <?php if (in_array("JAPAN by Japan EDM", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Japan Travel Fair
                                                <input type="checkbox" name="campaign[]" value="Japan Travel Fair" <?php if (in_array("Japan Travel Fair", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Social media
                                                <input type="checkbox" name="campaign[]" value="Social media" <?php if (in_array("Social media", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Online news sites
                                                <input type="checkbox" name="campaign[]" value="Online news sites" <?php if (in_array("Online news sites", $_SESSION['old_camp'])) {  echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Radio
                                                <input type="checkbox" name="campaign[]" value="Radio" <?php if (in_array("Radio", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                        <li>
                                            <label class="all_checks_label">Friends/Family
                                                <input type="checkbox" name="campaign[]" value="Friends/Family" <?php if (in_array("Friends/Family", $_SESSION['old_camp'])) { echo 'checked'; }  ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        </li>
                                        <li>
                                            <div class="others">
                                                <label class="all_checks_label others-input">Other:
                                                    <input type="checkbox" class="all_input" name="campaign[]" value="Other" <?php if (in_array("Other", $_SESSION['old_camp'])) { echo 'checked'; } ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <input type="text" class=" remove_dim_class" name="custom_campaign" value="<?php if (isset($_SESSION['old_custom_camp'])) { echo $_SESSION['old_custom_camp']; } ?>">
                                            </div>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <label class="all_checks_label">JNTO's Website (japan.travel)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Website (japan.travel)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Facebook (Visit Japan Now)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Facebook (Visit Japan Now)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Instagram (@visitjapansg)
                                                <input type="checkbox" name="campaign[]" value="JNTO's Instagram (@visitjapansg)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JAPAN by Japan EDM
                                                <input type="checkbox" name="campaign[]" value="JAPAN by Japan EDM">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Japan Travel Fair
                                                <input type="checkbox" name="campaign[]" value="Japan Travel Fair">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Social media
                                                <input type="checkbox" name="campaign[]" value="Social media">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Online news sites
                                                <input type="checkbox" name="campaign[]" value="Online news sites">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Radio
                                                <input type="checkbox" name="campaign[]" value="Radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Friends/Family
                                                <input type="checkbox" name="campaign[]" value="Friends/Family">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <div class="others">
                                                <label class="all_checks_label others-input">Other:
                                                    <input type="checkbox" class="all_input" name="campaign[]" value="Other">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <input type="text" class=" remove_dim_class" name="custom_campaign">
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php if (isset($_SESSION['error']['campaign'])) { ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['campaign']; ?></span>
                                <?php } unset($_SESSION['error']['campaign']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f_container">
                    <div class="policy">
                        <?php if (isset($_SESSION['old_terms'])) {
                        ?>
                            <label class="all_checks_label">By checking this box, you agree to the campaign’s <a href="#">Terms and Conditions</a> and confirm that you have read JAPAN by Japan’s <a href="#">Privacy Policy</a>.
                                <input type="checkbox" name="termsConditions" value="yes" class="policy_input all_input" <?php if ($_SESSION['old_terms'] == 'yes') { echo 'checked'; } ?>>
                                <span class="checkmark"></span>
                            </label>
                        <?php } else {
                         ?>

                            <label class="all_checks_label">By checking this box, you agree to the campaign’s <a href="#">Terms and Conditions</a> and confirm that you have read JAPAN by Japan’s <a href="#">Privacy Policy</a>.
                                <input type="checkbox" name="termsConditions" value="yes" class="policy_input all_input">
                                <span class="checkmark"></span>
                            </label>
                        <?php  } if (isset($_SESSION['error']['termsConditions'])) { ?>
                            <span class="for_err"> <?php echo $_SESSION['error']['termsConditions']; ?></span>
                        <?php } unset($_SESSION['error']['termsConditions']); ?>
                    </div>
                    <div class="btn_submit">
                        <button type="submit" name="submit" disabled class="submit_btn">
                            <span>Submit</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="covid_contact">
                <div class="f_container">
                    <p>Get Advisory Information COVID-19 situation in Japan</p>
                    <a href="#">Go to Advisory Information website</a>
                </div>
            </div>
            <div class="home_contact">
                <div class="f_container">
                    <ul class="nav">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Gift an unforgettable birthday in Japan​!</a></li>
                        <li><a href="#">Application form for Hiroshima and Sanin route</a></li>
                    </ul>
                </div>
            </div>
            <div class="jnto ">
                <div class="f_container">
                    <a href="#" class="logo">
                        <img src="../assets/img/JNTO_logo.png" alt="JNTO" />
                    </a>
                    <ul class="contact">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a> </li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">JbyJ intro</a></li>
                    </ul>
                    <div class="social">
                        <a href="#" class=" fa-brands facebook fa-facebook-f">
                            <span>facebook</span>
                        </a>
                        <a href="#" class="instagram fa-brands fa-instagram">
                            <span>instagram</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="f_container">
                    <p>Copyright @ Japan National Tourists Organization. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/common.js"></script>
</body>

</html>