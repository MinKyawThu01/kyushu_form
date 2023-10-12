<?php

include('../../app/classes/Kyushu.php');

session_start();

$kyushu = new Kyushu();

// var_dump(isset($kyushu->storeArray($_POST, $file)))
if ($kyushu->storeArray($_POST, $_FILES)) {
    echo '<script>location.href="confirmed/index.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="f_container">
            <div class="inner_container">
                <p class="req">Please complete the application form below.</p>
                <p class="represent">Representative Applicant</p>
            </div>
        </div>

        <div class="form_container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="f_container">
                    <div class="inner_container">
                        <!-- Name -->
                        <div class="name_contact for_top">
                            <label for="name" class="label_name">Full Name</label>
                            <div class="fullname">
                                <div class="fname">
                                    <input disabled type="text" id="name" class="fname" placeholder="First Name" disabled name="first_name" value="<?php if (isset($_SESSION['old_fn'])) {
                                                                                                                                                echo $_SESSION['old_fn'];
                                                                                                                                            }  ?>" />
                                    <?php if (isset($_SESSION['error']['first_name'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['first_name']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['first_name']);
                                    ?>
                                </div>
                                <div class="lname">
                                    <input disabled type="text" placeholder="Last Name" name="last_name" disabled value="<?php if (isset($_SESSION['old_ln'])) {
                                                                                                                    echo $_SESSION['old_ln'];
                                                                                                                } ?>" />
                                    <?php if (isset($_SESSION['error']['last_name'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['last_name']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['last_name']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="dob_contact for_top">
                            <label for="dateOfBirth" class="label_name">Date of Birth</label>
                            <input disabled type="date" id="dateOfBirth" class="full_width" name="dob" disabled value="<?php if (isset($_SESSION['old_dob'])) {
                                                                                                                    echo $_SESSION['old_dob'];
                                                                                                                } ?>" />
                            <?php if (isset($_SESSION['error']['dob'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['dob']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['dob']);
                            ?>
                        </div>
                        <!-- Gender -->
                        <div class="gender_contact for_top">
                            <p class="radio_p">Gender</p>
                            <ul class="for_ul_top">
                                <?php if (isset($_SESSION['old_gender'])) {
                                ?>

                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input disabled type="radio" name="gender" value="male" disabled <?php if ($_SESSION['old_gender'] == 'male') {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input disabled type="radio" name="gender" value="female" disabled <?php if ($_SESSION['old_gender'] == 'female') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input disabled type="radio" name="gender" value="other" disabled <?php if ($_SESSION['old_gender'] == 'other') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input disabled type="radio" name="gender" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input disabled type="radio" name="gender" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input disabled type="radio" name="gender" value="other">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['gender'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['gender']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['gender']);
                            ?>
                        </div>
                        <!-- Nationality -->
                        <div class="nation_contact for_top">
                            <h4 class="radio_p">Nationality </h4>
                            <ul class="for_ul_top">
                                <?php if (isset($_SESSION['old_nati'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input disabled type="radio" name="nationality" value="singaporean" <?php if ($_SESSION['old_nati'] == 'singaporean') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input disabled type="radio" name="nationality" value="other" <?php if ($_SESSION['old_nati'] == 'other') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>

                                            <!-- test 1 remove disable and class = dim -->
                                            <input disabled type="text" class=" all_input" id="nation_opt1" name="custom_country" value="<?php if (isset($_SESSION['old_nati_cc'])) {
                                                                                                                                    echo $_SESSION['old_nati_cc'];
                                                                                                                                } ?>">
                                        </div>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input disabled type="radio" name="nationality" value="singaporean">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <!-- original  -->
                                        <!-- <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input disabled type="radio" name="nationality" value="other">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input disabled type="text" class="dim all_input" id="nation_opt1" disabled="disabled" name="custom_country">
                                        </div> -->

                                        <!-- copy remove disabled and calss = dim  -->
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input disabled type="radio" name="nationality" value="other">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input disabled type="text" class=" all_input" id="nation_opt1" name="custom_country">
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['nationality'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['nationality']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['nationality']);
                            ?>
                        </div>
                        <!-- Occupation -->
                        <div class="occupation for_top">
                            <label for="occupation" class="label_name">Occupation</label>
                            <input disabled type="text" id="occupation" class="full_width" placeholder="Type..." name="occupation" value="<?php if (isset($_SESSION['old_occ'])) {
                                                                                                                                        echo $_SESSION['old_occ'];
                                                                                                                                    } ?>" />
                            <?php if (isset($_SESSION['error']['occupation'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['occupation']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['occupation']);
                            ?>
                        </div>
                        <!-- Religion -->
                        <div class="religion for_top">
                            <label for="religion" class="label_name">Religion</label>
                            <p class="for_ul_top reli_sns">(We will try to caster to religion preferences, but should you not wish to specify, please answer "prefer not to say")</p>
                            <input disabled type="text" id="religion" class="full_width reli_sns_input" placeholder="Type..." name="religion" value="<?php if (isset($_SESSION['old_reli'])) {
                                                                                                                                                echo $_SESSION['old_reli'];
                                                                                                                                            } ?>" />
                            <?php if (isset($_SESSION['error']['religion'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['religion']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['religion']);
                            ?>
                        </div>
                        <!-- SNS username -->
                        <div class="sns_username for_top">
                            <label for="sns" class="label_name">SNS username <span class="label_rt">(Facebook/Instagram/Tiktok/Youtube)</span></label>
                            <p class="for_ul_top reli_sns">*Leave the option blank if you do not have any Social Media account</p>
                            <input disabled type="text" id="sns" class="full_width reli_sns_input" placeholder="Type..." name="sns_username" value="<?php if (isset($_SESSION['old_sns'])) {
                                                                                                                                                echo $_SESSION['old_sns'];
                                                                                                                                            } ?>" />
                            <?php if (isset($_SESSION['error']['sns_username'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['sns_username']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['sns_username']);
                            ?>
                        </div>
                        <!-- have been to japan -->
                        <div class="been_jp for_top">
                            <p class="radio_p">Have you been to Japan before?</p>
                            <ul class="for_ul_top">
                                <?php if (isset($_SESSION['old_before'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio">Never
                                            <input disabled type="radio" name="japan_before" id="never_input" class="c-form_radio" value="never" <?php if ($_SESSION['old_before'] == 'never') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Once
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="one" <?php if ($_SESSION['old_before'] == 'one') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Twice
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="twice" <?php if ($_SESSION['old_before'] == 'twice') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Thrice
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="thrice" <?php if ($_SESSION['old_before'] == 'thrice') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">More than 3 times
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="more_than_3_times" <?php if ($_SESSION['old_before'] == 'more_than_3_times') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li>
                                        <label class="all_checks_radio">Never
                                            <input disabled type="radio" name="japan_before" id="never_input" class="c-form_radio" value="never">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Once
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="one">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Twice
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="twic">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Thrice
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="thrice">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">More than 3 times
                                            <input disabled type="radio" name="japan_before" class="c-form_radio" value="more than 3 times">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } ?>

                            </ul>
                            <?php if (isset($_SESSION['error']['japan_before'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['japan_before']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['japan_before']);
                            ?>
                        </div>
                        <!-- Region visited in past Japan travels -->
                        <?php if (isset($_SESSION['old_reg'])) {
                        ?>
                            <div class="visited_japan for_top">
                                <h4 class="radio_p">Region(s) visited in past Japan travels</h4>
                                <div class="hokkaido">
                                    <h5 class="region_p">Hokkaido / Tohoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Hokkaido
                                                <input disabled type="checkbox" name="region[]" value="Hokkaido" <?php if (in_array('Hokkaido', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aomori
                                                <input disabled type="checkbox" name="region[]" value="Aomori" <?php if (in_array('Aomori', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Iwate
                                                <input disabled type="checkbox" name="region[]" value="Iwate" <?php if (in_array('Iwate', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyagi
                                                <input disabled type="checkbox" name="region[]" value="Miyagi" <?php if (in_array('Miyagi', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Akita
                                                <input disabled type="checkbox" name="region[]" value="Akita" <?php if (in_array('Akita', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamagata
                                                <input disabled type="checkbox" name="region[]" value="Yamagata" <?php if (in_array('Yamagata', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukushima
                                                <input disabled type="checkbox" name="region[]" value="Fukushima" <?php if (in_array('Fukushima', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="kanto">
                                    <h5 class="region_p">Kanto region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Ibaraki
                                                <input disabled type="checkbox" name="region[]" value="Ibaraki" <?php if (in_array('Ibaraki', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tochigi
                                                <input disabled type="checkbox" name="region[]" value="Tochigi" <?php if (in_array('Tochigi', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?> <?php if (in_array('Aomori', $_SESSION['old_reg'])) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gunma
                                                <input disabled type="checkbox" name="region[]" value="Gunma" <?php if (in_array('Gunma', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saitama
                                                <input disabled type="checkbox" name="region[]" value="Saitama" <?php if (in_array('Saitama', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Chiba
                                                <input disabled type="checkbox" name="region[]" value="Chiba" <?php if (in_array('Chiba', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tokyo
                                                <input disabled type="checkbox" name="region[]" value="Tokyo" <?php if (in_array('Tokyo', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kanagawa
                                                <input disabled type="checkbox" name="region[]" value="Kanagawa" <?php if (in_array('Kanagawa', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Hokuriku Shinetesu region">
                                    <h5 class="region_p">Hokuriku Shinetesu region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Niigata
                                                <input disabled type="checkbox" name="region[]" value="Niigata" <?php if (in_array('Niigata', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Toyama
                                                <input disabled type="checkbox" name="region[]" value="Toyama" <?php if (in_array('Toyama', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ishikawa
                                                <input disabled type="checkbox" name="region[]" value="Ishikawa" <?php if (in_array('Ishikawa', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamanashi
                                                <input disabled type="checkbox" name="region[]" value="Yamanashi" <?php if (in_array('Yamanashi', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagano
                                                <input disabled type="checkbox" name="region[]" value="Nagano" <?php if (in_array('Nagano', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Chubu region">
                                    <h5 class="region_p">Chubu region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Shizuoka
                                                <input disabled type="checkbox" name="region[]" value="Shizuoka" <?php if (in_array('Shizuoka', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aichi
                                                <input disabled type="checkbox" name="region[]" value="Aichi" <?php if (in_array('Aichi', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gifu
                                                <input disabled type="checkbox" name="region[]" value="Gifu" <?php if (in_array('Gifu', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mie
                                                <input disabled type="checkbox" name="region[]" value="Mie" <?php if (in_array('Mie', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukui
                                                <input disabled type="checkbox" name="region[]" value="Fukui" <?php if (in_array('Fukui', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Kinki region">
                                    <h5 class="region_p">Kinki region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Shiga
                                                <input disabled type="checkbox" name="region[]" value="Shiga" <?php if (in_array('Shiga', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kyoto
                                                <input disabled type="checkbox" name="region[]" value="Kyoto" <?php if (in_array('Kyoto', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Osaka
                                                <input disabled type="checkbox" name="region[]" value="Osaka" <?php if (in_array('Osaka', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hyogo
                                                <input disabled type="checkbox" name="region[]" value="Hyogo" <?php if (in_array('Hyogo', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nara
                                                <input disabled type="checkbox" name="region[]" value="Nara" <?php if (in_array('Nara', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Wakayama
                                                <input disabled type="checkbox" name="region[]" value="Wakayama" <?php if (in_array('Wakayama', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Chugoku region">
                                    <h5 class="region_p">Chugoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Tottori
                                                <input disabled type="checkbox" name="region[]" value="Tottori" <?php if (in_array('Tottori', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Shimane
                                                <input disabled type="checkbox" name="region[]" value="Shimane" <?php if (in_array('Shimane', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okayama
                                                <input disabled type="checkbox" name="region[]" value="Okayama" <?php if (in_array('Okayama', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hiroshima
                                                <input disabled type="checkbox" name="region[]" value="Hiroshima" <?php if (in_array('Hiroshima', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamaguchi
                                                <input disabled type="checkbox" name="region[]" value="Yamaguchi" <?php if (in_array('Yamaguchi', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Shikoku region">
                                    <h5 class="region_p">Shikoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Tokushima
                                                <input disabled type="checkbox" name="region[]" value="Tokushima" <?php if (in_array('Tokushima', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagawa
                                                <input disabled type="checkbox" name="region[]" value="Kagawa" <?php if (in_array('Kagawa', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ehima
                                                <input disabled type="checkbox" name="region[]" value="Ehima" <?php if (in_array('Ehima', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kochi
                                                <input disabled type="checkbox" name="region[]" value="Kochi" <?php if (in_array('Kochi', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Kyushu/Okinawa region">
                                    <h5 class="region_p">Kyushu / Okinawa region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Fukuoka
                                                <input disabled type="checkbox" name="region[]" value="Fukuoka" <?php if (in_array('Fukuoka', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saga
                                                <input disabled type="checkbox" name="region[]" value="Saga" <?php if (in_array('Saga', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagasaki
                                                <input disabled type="checkbox" name="region[]" value="Nagasaki" <?php if (in_array('Nagasaki', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kumamoto
                                                <input disabled type="checkbox" name="region[]" value="Kumamoto" <?php if (in_array('Kumamoto', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Oita
                                                <input disabled type="checkbox" name="region[]" value="Oita" <?php if (in_array('Oita', $_SESSION['old_reg'])) {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyazaki
                                                <input disabled type="checkbox" name="region[]" value="Miyazaki" <?php if (in_array('Miyazaki', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagoshima
                                                <input disabled type="checkbox" name="region[]" value="Kagoshima" <?php if (in_array('Kagoshima', $_SESSION['old_reg'])) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okinawa
                                                <input disabled type="checkbox" name="region[]" value="Okinawa" <?php if (in_array('Okinawa', $_SESSION['old_reg'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
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
                        <?php
                        } else {
                        ?>
                            <div class="visited_japan for_top">
                                <h4 class="radio_p">Region(s) visited in past Japan travels</h4>
                                <div class="hokkaido">
                                    <h5 class="region_p">Hokkaido / Tohoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Hokkaido
                                                <input disabled type="checkbox" name="region[]" value="Hokkaido">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aomori
                                                <input disabled type="checkbox" name="region[]" value="Aomori">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Iwate
                                                <input disabled type="checkbox" name="region[]" value="Iwate">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyagi
                                                <input disabled type="checkbox" name="region[]" value="Miyagi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Akita
                                                <input disabled type="checkbox" name="region[]" value="Akita">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamagata
                                                <input disabled type="checkbox" name="region[]" value="Yamagata">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukushima
                                                <input disabled type="checkbox" name="region[]" value="Fukushima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="kanto">
                                    <h5 class="region_p">Kanto region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Ibaraki
                                                <input disabled type="checkbox" name="region[]" value="Ibaraki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tochigi
                                                <input disabled type="checkbox" name="region[]" value="Tochigi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gunma
                                                <input disabled type="checkbox" name="region[]" value="Gunma">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saitama
                                                <input disabled type="checkbox" name="region[]" value="Saitama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Chiba
                                                <input disabled type="checkbox" name="region[]" value="Chiba">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Tokyo
                                                <input disabled type="checkbox" name="region[]" value="Tokyo">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kanagawa
                                                <input disabled type="checkbox" name="region[]" value="Kanagawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Hokuriku Shinetesu region">
                                    <h5 class="region_p">Hokuriku Shinetesu region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Niigata
                                                <input disabled type="checkbox" name="region[]" value="Niigata">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Toyama
                                                <input disabled type="checkbox" name="region[]" value="Toyama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ishikawa
                                                <input disabled type="checkbox" name="region[]" value="Ishikawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamanashi
                                                <input disabled type="checkbox" name="region[]" value="Yamanashi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagano
                                                <input disabled type="checkbox" name="region[]" value="Nagano">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Chubu region">
                                    <h5 class="region_p">Chubu region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Shizuoka
                                                <input disabled type="checkbox" name="region[]" value="Shizuoka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Aichi
                                                <input disabled type="checkbox" name="region[]" value="Aichi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Gifu
                                                <input disabled type="checkbox" name="region[]" value="Gifu">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mie
                                                <input disabled type="checkbox" name="region[]" value="Mie">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Fukui
                                                <input disabled type="checkbox" name="region[]" value="Fukui">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Kinki region">
                                    <h5 class="region_p">Kinki region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Shiga
                                                <input disabled type="checkbox" name="region[]" value="Shiga">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kyoto
                                                <input disabled type="checkbox" name="region[]" value="Kyoto">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Osaka
                                                <input disabled type="checkbox" name="region[]" value="Osaka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hyogo
                                                <input disabled type="checkbox" name="region[]" value="Hyogo">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nara
                                                <input disabled type="checkbox" name="region[]" value="Nara">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Wakayama
                                                <input disabled type="checkbox" name="region[]" value="Wakayama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Chugoku region">
                                    <h5 class="region_p">Chugoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Tottori
                                                <input disabled type="checkbox" name="region[]" value="Tottori">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Shimane
                                                <input disabled type="checkbox" name="region[]" value="Shimane">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okayama
                                                <input disabled type="checkbox" name="region[]" value="Okayama">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Hiroshima
                                                <input disabled type="checkbox" name="region[]" value="Hiroshima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Yamaguchi
                                                <input disabled type="checkbox" name="region[]" value="Yamaguchi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Shikoku region">
                                    <h5 class="region_p">Shikoku region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Tokushima
                                                <input disabled type="checkbox" name="region[]" value="Tokushima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagawa
                                                <input disabled type="checkbox" name="region[]" value="Kagawa">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Ehima
                                                <input disabled type="checkbox" name="region[]" value="Ehima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kochi
                                                <input disabled type="checkbox" name="region[]" value="Kochi">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="Kyushu/Okinawa region">
                                    <h5 class="region_p">Kyushu / Okinawa region</h5>
                                    <ul class="for_ul_top all_checks_contact">
                                        <li>
                                            <label class="all_checks_label">Fukuoka
                                                <input disabled type="checkbox" name="region[]" value="Fukuoka">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Saga
                                                <input disabled type="checkbox" name="region[]" value="Saga">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Nagasaki
                                                <input disabled type="checkbox" name="region[]" value="Nagasaki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kumamoto
                                                <input disabled type="checkbox" name="region[]" value="Kumamoto">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Oita
                                                <input disabled type="checkbox" name="region[]" value="Oita">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Miyazaki
                                                <input disabled type="checkbox" name="region[]" value="Miyazaki">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Kagoshima
                                                <input disabled type="checkbox" name="region[]" value="Kagoshima">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Okinawa
                                                <input disabled type="checkbox" name="region[]" value="Okinawa">
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
                        <?php
                        } ?>

                        <!-- Dietary  Restrictions-->
                        <div class="dietary for_top">
                            <label for="dietary" class="label_name">Dietary Restrictions <span class="label_rt">(Including Alcohol)</span></label>
                            <input disabled type="text" id="dietary" class="full_width reli_sns_input" placeholder="Type..." name="restriction" value="<?php if (isset($_SESSION['old_restri'])) {
                                                                                                                                                    echo $_SESSION['old_restri'];
                                                                                                                                                } ?>" />
                            <?php if (isset($_SESSION['error']['restriction'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['restriction']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['restriction']);
                            ?>
                        </div>
                        <!-- Email -->
                        <div class="email for_top">
                            <label for="email" class="label_name">Email Address</label>
                            <input disabled type="text" id="email" class="full_width" placeholder="Email" name="email" value="<?php if (isset($_SESSION['old_email'])) {
                                                                                                                            echo $_SESSION['old_email'];
                                                                                                                        } ?>" />
                            <?php if (isset($_SESSION['error']['email'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['email']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['email']);
                            ?>
                        </div>
                        <!-- Phone Number -->
                        <div class="phone for_top">
                            <label for="phone" class="label_name">Phone Number</label>
                            <input disabled type="text" id="phone" class="full_width" placeholder="Phone Number" name="ph_num" value="<?php if (isset($_SESSION['old_ph'])) {
                                                                                                                                    echo $_SESSION['old_ph'];
                                                                                                                                } ?>" />
                            <?php if (isset($_SESSION['error']['ph_num'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['ph_num']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['ph_num']);
                            ?>
                        </div>

                        <hr class="for_top">

                        <!-- Travel Companion 01 -->
                        <p class="represent">Travel Companion 01</p>
                        <!-- Name -->
                        <div class="name_contact for_top">
                            <label for="name" class="label_name">Full Name</label>
                            <div class="fullname">
                                <div class="fname">
                                    <input disabled type="text" id="name" class="fname" placeholder="First Name" name="first_name_tc" value="<?php if (isset($_SESSION['old_fn_tc'])) {
                                                                                                                                        echo $_SESSION['old_fn_tc'];
                                                                                                                                    } ?>" />
                                    <?php if (isset($_SESSION['error']['first_name_tc'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['first_name_tc']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['first_name_tc']);
                                    ?>
                                </div>
                                <div class="lname">
                                    <input disabled type="text" placeholder="Last Name" name="last_name_tc" value="<?php if (isset($_SESSION['old_ln_tc'])) {
                                                                                                                echo $_SESSION['old_ln_tc'];
                                                                                                            } ?>" />
                                    <?php if (isset($_SESSION['error']['last_name_tc'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['last_name_tc']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['last_name_tc']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="dob_contact for_top">
                            <label for="dateOfBirth" class="label_name">Date of Birth</label>
                            <input disabled type="date" id="dateOfBirth" class="full_width" name="dob_tc" value="<?php if (isset($_SESSION['old_dob_tc'])) {
                                                                                                            echo $_SESSION['old_dob_tc'];
                                                                                                        } ?>" />
                            <?php if (isset($_SESSION['error']['dob_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['dob_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['dob_tc']);
                            ?>
                        </div>
                        <!-- Gender -->
                        <div class="gender_contact for_top">
                            <p class="radio_p">Gender</p>
                            <ul class="for_ul_top">
                                <?php if (isset($_SESSION['old_gender_tc'])) {
                                ?>

                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input disabled type="radio" name="gender_tc" value="male" <?php if ($_SESSION['old_gender_tc'] == 'male') {
                                                                                                    echo 'checked';
                                                                                                } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input disabled type="radio" name="gender_tc" value="female" <?php if ($_SESSION['old_gender_tc'] == 'female') {
                                                                                                    echo 'checked';
                                                                                                } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input disabled type="radio" name="gender_tc" value="other" <?php if ($_SESSION['old_gender_tc'] == 'other') {
                                                                                                    echo 'checked';
                                                                                                } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>

                                <?php
                                } else { ?>
                                    <li>
                                        <label class="all_checks_radio">Male
                                            <input disabled type="radio" name="gender_tc" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Female
                                            <input disabled type="radio" name="gender_tc" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_radio">Other
                                            <input disabled type="radio" name="gender_tc" value="other">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if (isset($_SESSION['error']['gender_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['gender_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['gender_tc']);
                            ?>
                        </div>
                        <!-- Nationality -->
                        <div class="nation_contact for_top">
                            <h4 class="radio_p">Nationality</h4>
                            <ul class="for_ul_top">
                                <?php if (isset($_SESSION['old_nati_tc'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input disabled type="radio" name="nationality_tc" value="singaporean" <?php if ($_SESSION['old_nati_tc'] == 'singaporean') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input disabled type="radio" name="nationality_tc" value="other" <?php if ($_SESSION['old_nati_tc'] == 'other') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>

                                            <!-- test 2 reomve disable  -->
                                            <input disabled type="text" class=" all_input" id="nation_opt2" name="custom_country_tc" value="<?php if (isset($_SESSION['old_nati_cc_tc'])) {
                                                                                                                                        echo $_SESSION['old_nati_cc_tc'];
                                                                                                                                    } ?>">
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input">Singaporean
                                            <input disabled type="radio" name="nationality_tc" value="singaporean">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input">Other:
                                                <input disabled type="radio" name="nationality_tc" value="other">
                                                <span class="checkmark"></span>
                                            </label>
                                            <!-- original -->
                                            <!-- <input disabled type="text" class="dim all_input" id="nation_opt2" disabled="disabled" name="custom_country_tc"> -->

                                            <!-- copy remove disable and class = dim  -->
                                            <input disabled type="text" class=" all_input" id="nation_opt2" name="custom_country_tc">
                                        </div>
                                    </li>
                                <?php
                                } ?>

                            </ul>
                            <?php if (isset($_SESSION['error']['nationality_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['nationality_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['nationality_tc']);
                            ?>
                        </div>
                        <!-- Relationship with applicate -->
                        <div class="relationship for_top">
                            <label for="relationship" class="label_name">Relationship with applicate</label>
                            <input disabled type="text" id="relationship" class="full_width" placeholder="Type" name="relationship_tc" value="<?php if (isset($_SESSION['old_rs_tc'])) {
                                                                                                                                            echo $_SESSION['old_rs_tc'];
                                                                                                                                        } ?>" />
                            <?php if (isset($_SESSION['error']['relationship_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['relationship_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['relationship_tc']);
                            ?>
                        </div>
                        <!-- Dietary  Restrictions-->
                        <div class="dietary for_top">
                            <label for="dietary" class="label_name">Dietary Restrictions <span class="label_rt">(Including Alcohol)</span></label>
                            <input disabled type="text" id="dietary" class="full_width reli_sns_input" placeholder="Type..." name="restriction_tc" value="<?php if (isset($_SESSION['old_rs_tc'])) {
                                                                                                                                                        echo $_SESSION['old_rs_tc'];
                                                                                                                                                    } ?>" />
                            <?php if (isset($_SESSION['error']['restriction_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['error']['restriction_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['error']['restriction_tc']);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- file upload  -->
                <div class="files_upload">
                    <div class="f_container">
                        <div class="inner_container">
                            <!-- inamge upload  -->
                            <div class="img_upload">
                                <label for="upload_avatar" class="upload_label">Please upload a photo that shows all applicate in the photo</label>
                                <input disabled type="file" name="image" class="full_width" />
                                <?php if (isset($_SESSION['error']['image'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['image']; ?></span>
                                <?php
                                }
                                unset($_SESSION['error']['image']);
                                ?>
                            </div>
                            <!-- Birthday  -->
                            <div class="person_name for_top">
                                <label for="person" class="upload_label">The full name of the name who will receives the trip to Japan as their birthday gift</label>
                                <div class="fullname">
                                    <div class="fname">
                                        <input disabled type="text" id="person" class="fname" placeholder="First Name" name="first_name_jp" value="<?php if (isset($_SESSION['old_fn_jp'])) {
                                                                                                                                                echo $_SESSION['old_fn_jp'];
                                                                                                                                            } ?>" />
                                        <?php if (isset($_SESSION['error']['first_name_jp'])) {
                                        ?>
                                            <span class="for_err"> <?php echo $_SESSION['error']['first_name_jp']; ?></span>
                                        <?php
                                        }
                                        unset($_SESSION['error']['first_name_jp']);
                                        ?>
                                    </div>
                                    <div class="lname">
                                        <input disabled type="text" placeholder="Last Name" name="last_name_jp" value="<?php if (isset($_SESSION['old_ln_jp'])) {
                                                                                                                    echo $_SESSION['old_ln_jp'];
                                                                                                                } ?>" />
                                        <?php if (isset($_SESSION['error']['last_name_jp'])) {
                                        ?>
                                            <span class="for_err"> <?php echo $_SESSION['error']['last_name_jp']; ?></span>
                                        <?php
                                        }
                                        unset($_SESSION['error']['last_name_jp']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- travel period  -->
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please let us know your preferred traveling period</p>
                                <ul class="for_ul_top">
                                    <?php if (isset($_SESSION['old_period'])) {
                                    ?>
                                        <li>
                                            <label class="all_checks_label">Early January 2024
                                                <input disabled type="checkbox" name="period[]" value="early_january_2024" <?= (in_array('early_january_2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mid January 2024
                                                <input disabled type="checkbox" name="period[]" value="mid_january_2024" <?= (in_array('mid_january_2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Late January 2024
                                                <input disabled type="checkbox" name="period[]" value="late_january_2024" <?= (in_array('late_january_2024', $_SESSION['old_period'])) ? 'checked' : ''; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li>
                                            <label class="all_checks_label">Early January 2024
                                                <input disabled type="checkbox" name="period[]" value="early_january_2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Mid January 2024
                                                <input disabled type="checkbox" name="period[]" value="mid_january_2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Late January 2024
                                                <input disabled type="checkbox" name="period[]" value="late_january_2024">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    <?php
                                    } ?>

                                </ul>
                                <?php if (isset($_SESSION['error']['period'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['period']; ?></span>
                                <?php
                                }
                                unset($_SESSION['error']['period']);
                                ?>
                            </div>
                            <!-- video upload  -->
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please upload your introductory video below</p>
                                <span class="click_upload">Click here to upload</span>
                                <p class="intro_vd">Have you uploaded your introductory video?</p>
                                <div class="option">
                                    <?php if (isset($_SESSION['old_vd'])) {
                                    ?>
                                        <label class="all_checks_label">Yes
                                            <input disabled type="checkbox" name="video_upload" value="yes" <?php if ($_SESSION['old_vd'] == 'yes') {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php
                                    } else {
                                    ?>
                                        <label class="all_checks_label">Yes
                                            <input disabled type="checkbox" name="video_upload" value="yes">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php
                                    }
                                    ?>

                                    <?php if (isset($_SESSION['error']['video_upload'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['video_upload']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['video_upload']);
                                    ?>
                                </div>
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
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please let us know how you came across this campaign</p>
                                <ul class="for_ul_top">
                                    <?php if (isset($_SESSION['old_camp'])) {
                                    ?>
                                        <li>
                                            <label class="all_checks_label">JNTO's Website (japan.travel)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_website_(japan.travel)" <?php if (in_array("jnto's_website_(japan.travel)", $_SESSION['old_camp'])) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Facebook (Visit Japan Now)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_facebook_(visit_japan_now)" <?php if (in_array("jnto's_facebook_(visit_japan_now)", $_SESSION['old_camp'])) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Instagram (@visitjapansg)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_instagram_(@visitjapansg)" <?php if (in_array("jnto's_instagram_(@visitjapansg)", $_SESSION['old_camp'])) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JAPAN by Japan EDM
                                                <input disabled type="checkbox" name="campaign[]" value="japan_by_japan_edm" <?php if (in_array("japan_by_japan_edm", $_SESSION['old_camp'])) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Japan Travel Fair
                                                <input disabled type="checkbox" name="campaign[]" value="japan_travel_fair" <?php if (in_array("japan_travel_fair", $_SESSION['old_camp'])) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Social media
                                                <input disabled type="checkbox" name="campaign[]" value="social_media" <?php if (in_array("social_media", $_SESSION['old_camp'])) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Online news sites
                                                <input disabled type="checkbox" name="campaign[]" value="online_news_sites" <?php if (in_array("online_news_sites", $_SESSION['old_camp'])) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Radio
                                                <input disabled type="checkbox" name="campaign[]" value="radio" <?php if (in_array("radio", $_SESSION['old_camp'])) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                        <li>
                                            <label class="all_checks_label">Friends/Family
                                                <input disabled type="checkbox" name="campaign[]" value="friends/family" <?php if (in_array("friends/family", $_SESSION['old_camp'])) {
                                                                                                                    echo 'checked';
                                                                                                                }  ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        </li>
                                        <li>
                                            <div class="others">
                                                <label class="all_checks_label others-input">Other:
                                                    <input disabled type="checkbox" class="selected" name="campaign[]" value="other" <?php if (in_array("other", $_SESSION['old_camp'])) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                                    <span class="checkmark"></span>
                                                </label>

                                                <!-- remove dim class  -->
                                                <input disabled type="text" class=" remove_dim_class all_input " name="custom_campaign" value="<?php if (isset($_SESSION['old_custom_camp'])) {
                                                                                                                                            echo $_SESSION['old_custom_camp'];
                                                                                                                                        }
                                                                                                                                        ?>">
                                            </div>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li>
                                            <label class="all_checks_label">JNTO's Website (japan.travel)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_website_(japan.travel)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Facebook (Visit Japan Now)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_facebook_(visit_japan_now)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JNTO's Instagram (@visitjapansg)
                                                <input disabled type="checkbox" name="campaign[]" value="jnto's_instagram_(@visitjapansg)">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">JAPAN by Japan EDM
                                                <input disabled type="checkbox" name="campaign[]" value="japan_by_japan_edm">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Japan Travel Fair
                                                <input disabled type="checkbox" name="campaign[]" value="japan_travel_fai">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Social media
                                                <input disabled type="checkbox" name="campaign[]" value="social_media">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Online news sites
                                                <input disabled type="checkbox" name="campaign[]" value="online_news_sites">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Radio
                                                <input disabled type="checkbox" name="campaign[]" value="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="all_checks_label">Friends/Family
                                                <input disabled type="checkbox" name="campaign[]" value="friends/family">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <div class="others">
                                                <label class="all_checks_label others-input">Other:
                                                    <input disabled type="checkbox" class="selected" name="campaign[]" value="other">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <input disabled type="text" class=" remove_dim_class all_input" name="custom_campaign">
                                            </div>
                                        </li>
                                    <?php
                                    } ?>
                                </ul>
                                <?php if (isset($_SESSION['error']['campaign'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['error']['campaign']; ?></span>
                                <?php
                                }
                                unset($_SESSION['error']['campaign']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="summit_contact">
                    <div class="f_container">
                        <div class="inner_container">
                            <div class="inner_submit">
                                <div class="policy">
                                    <?php if (isset($_SESSION['old_terms'])) {
                                    ?>
                                        <label class="all_checks_label">By checking this box, you agree to the campaign’s <a href="#">Terms and Conditions</a> and confirm that you have read JAPAN by Japan’s <a href="#">Privacy Policy</a>.
                                            <input disabled type="checkbox" name="termsConditions" value="yes" class="policy_input all_input" <?php if ($_SESSION['old_terms'] == 'yes') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php } else {
                                    ?>

                                        <label class="all_checks_label">By checking this box, you agree to the campaign’s <a href="#">Terms and Conditions</a> and confirm that you have read JAPAN by Japan’s <a href="#">Privacy Policy</a>.
                                            <input disabled type="checkbox" name="termsConditions" value="yes" class="policy_input">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php
                                    }
                                    if (isset($_SESSION['error']['termsConditions'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['error']['termsConditions']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['error']['termsConditions']);
                                    ?>
                                </div>

                                <!-- original  -->
                                <!-- <div class="btn_submit">
                                    <button type="submit" name="submit" disabled class="submit_btn">
                                        <span>Submit</span>
                                    </button>
                                </div> -->

                                <!-- test  -->
                                <div class="btn_submit">
                                    <a href="#" class="back_link">Back</a>
                                    <button type="submit" name="confirm" disabled class="submit_btn btn_lg">
                                        <span>Confirm</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="covid_contact">
                <div class="f_container">
                    <p>Get Advisory Information COVID-19 situation in Japan</p>
                    <a href="#" class="all_bt">Go to Advisory Information website</a>
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
                    <a href="#">
                        <figure class="logo"><img src="../../assets/img/JNTO_logo.png" alt="JNTO" /></figure>
                    </a>
                    <ul class="contact">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a> </li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">JbyJ intro</a></li>
                    </ul>
                    <div class="social">
                        <a href="#" class="facebook">
                            <figure><img src="../../assets/img/facebook_logo.jpg" alt="facebook" />
                            </figure>
                        </a>
                        <a href="#" class="instagram">
                            <figure><img src="../../assets/img/ig.png" alt="instagram"></figure>
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
    <!-- <script src="../assets/js/common.js"></script> -->
</body>

</html>