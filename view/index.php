<?php

include('../app/classes/Kyushu.php');

session_start();

$kyushu = new Kyushu();

$kyushu->storeArray($_POST, $_FILES);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="f_container">
            <div class="inner_container">
                <p class="req">Please complete the application form below.</p>
                <p class="represent">Representative Applicant HELLLO FROMM HEIN HTET</p>
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
                                    <input type="text" id="name" class="fname" placeholder="First Name" name="first_name" />
                                    <?php if (isset($_SESSION['first_name'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['first_name']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['first_name']);
                                    ?>
                                </div>
                                <div class="lname">
                                    <input type="text" placeholder="Last Name" name="last_name" />
                                    <?php if (isset($_SESSION['last_name'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['last_name']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['last_name']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="dob_contact for_top">
                            <label for="dateOfBirth" class="label_name">Date of Birth</label>
                            <input type="date" id="dateOfBirth" class="full_width" name="dob" />
                            <?php if (isset($_SESSION['dob'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['dob']; ?></span>
                            <?php
                            }
                            unset($_SESSION['dob']);
                            ?>
                        </div>
                        <!-- Gender -->
                        <div class="gender_contact for_top">
                            <p class="radio_p">Gender</p>
                            <ul class="for_ul_top">
                                <li>
                                    <label class="all_checks_radio">Male
                                        <input type="radio" name="gender" value="male">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Female
                                        <input type="radio" name="gender" value="female">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Other
                                        <input type="radio" name="gender" value="other">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['gender'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['gender']; ?></span>
                            <?php
                            }
                            unset($_SESSION['gender']);
                            ?>
                        </div>
                        <!-- Nationality -->
                        <div class="nation_contact for_top">
                            <h4 class="radio_p">Nationality</h4>
                            <ul class="for_ul_top">
                                <li>
                                    <label class="all_checks_radio">Singaporean
                                        <input type="radio" name="nationality" value="singaporean">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <div class="others">
                                        <label class="all_checks_radio">Other:
                                            <input type="radio" name="nationality" value="other">
                                            <span class="checkmark"></span>
                                        </label>
                                        <input type="text" class="dim" name="custom_country">
                                    </div>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['nationality'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['nationality']; ?></span>
                            <?php
                            }
                            unset($_SESSION['nationality']);
                            ?>
                        </div>
                        <!-- Occupation -->
                        <div class="occupation for_top">
                            <label for="occupation" class="label_name">Occupation</label>
                            <input type="text" id="occupation" class="full_width" placeholder="Type..." name="occupation" />
                            <?php if (isset($_SESSION['occupation'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['occupation']; ?></span>
                            <?php
                            }
                            unset($_SESSION['occupation']);
                            ?>
                        </div>
                        <!-- Religion -->
                        <div class="religion for_top">
                            <label for="religion" class="label_name">Religion</label>
                            <p class="for_ul_top reli_sns">(We will try to caster to religion preferences, but should you not wish to specify, please answer "prefer not to say")</p>
                            <input type="text" id="religion" class="full_width reli_sns_input" placeholder="Type..." name="religion" />
                            <?php if (isset($_SESSION['religion'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['religion']; ?></span>
                            <?php
                            }
                            unset($_SESSION['religion']);
                            ?>
                        </div>
                        <!-- SNS username -->
                        <div class="sns_username for_top">
                            <label for="sns" class="label_name">SNS username <span class="label_rt">(Facebook/Instagram/Tiktok/Youtube)</span></label>
                            <p class="for_ul_top reli_sns">*Leave the option blank if you do not have any Social Media account</p>
                            <input type="text" id="sns" class="full_width reli_sns_input" placeholder="Type..." name="sns_username" />
                            <?php if (isset($_SESSION['sns_username'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['sns_username']; ?></span>
                            <?php
                            }
                            unset($_SESSION['sns_username']);
                            ?>
                        </div>
                        <!-- have been to japan -->
                        <div class="been_jp for_top">
                            <p class="radio_p">Have you been to Japan before?</p>
                            <ul class="for_ul_top">
                                <li>
                                    <label class="all_checks_radio">Never
                                        <input type="radio" name="japan_before" value="never">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">One
                                        <input type="radio" name="japan_before" value="one">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Twice
                                        <input type="radio" name="japan_before" value="twic">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Thrice
                                        <input type="radio" name="japan_before" value="thrice">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">More than 3 times
                                        <input type="radio" name="japan_before" value="more than 3 times">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['japan_before'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['japan_before']; ?></span>
                            <?php
                            }
                            unset($_SESSION['japan_before']);
                            ?>
                        </div>
                        <!-- Region visited in past Japan travels -->
                        <div class="visited_japan for_top">
                            <h4 class="radio_p">Region(s) visited in past Japan travels</h4>
                            <div class="hokkaido">
                                <h5 class="region_p">Hokkaido / Tohoku region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="kanto">
                                <h5 class="region_p">Kanto region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Hokuriku Shinetesu region">
                                <h5 class="region_p">Hokuriku Shinetesu region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Chubu region">
                                <h5 class="region_p">Chubu region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Kinki region">
                                <h5 class="region_p">Kinki region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Chugoku region">
                                <h5 class="region_p">Chugoku region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Shikoku region">
                                <h5 class="region_p">Shikoku region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                            <div class="Kyushu/Okinawa region">
                                <h5 class="region_p">Kyushu / Okinawa region</h5>
                                <ul class="for_ul_top all_checks_contact">
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
                                <?php if (isset($_SESSION['region'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['region']; ?></span>
                                <?php
                                }
                                unset($_SESSION['region']);
                                ?>
                            </div>
                        </div>
                        <!-- Dietary  Restrictions-->
                        <div class="dietary for_top">
                            <label for="dietary" class="label_name">Dietary Restrictions <span class="label_rt">(Including Alcohol)</span></label>
                            <input type="text" id="dietary" class="full_width reli_sns_input" placeholder="Type..." name="restriction" />
                            <?php if (isset($_SESSION['restriction'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['restriction']; ?></span>
                            <?php
                            }
                            unset($_SESSION['restriction']);
                            ?>
                        </div>
                        <!-- Email -->
                        <div class="email for_top">
                            <label for="email" class="label_name">Email Address</label>
                            <input type="email" id="email" class="full_width" placeholder="Email" name="email" />
                            <?php if (isset($_SESSION['email'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['email']; ?></span>
                            <?php
                            }
                            unset($_SESSION['email']);
                            ?>
                        </div>
                        <!-- Phone Number -->
                        <div class="phone for_top">
                            <label for="phone" class="label_name">Phone Number</label>
                            <input type="text" id="phone" class="full_width" placeholder="Phone Number" name="ph_num" />
                            <?php if (isset($_SESSION['ph_num'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['ph_num']; ?></span>
                            <?php
                            }
                            unset($_SESSION['ph_num']);
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
                                    <input type="text" id="name" class="fname" placeholder="First Name" name="first_name_tc" />
                                    <?php if (isset($_SESSION['first_name_tc'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['first_name_tc']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['first_name_tc']);
                                    ?>
                                </div>
                                <div class="lname">
                                    <input type="text" placeholder="Last Name" name="last_name_tc" />
                                    <?php if (isset($_SESSION['last_name_tc'])) {
                                    ?>
                                        <span class="for_err"> <?php echo $_SESSION['last_name_tc']; ?></span>
                                    <?php
                                    }
                                    unset($_SESSION['last_name_tc']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="dob_contact for_top">
                            <label for="dateOfBirth" class="label_name">Date of Birth</label>
                            <input type="date" id="dateOfBirth" class="full_width" name="dob_tc" />
                            <?php if (isset($_SESSION['dob_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['dob_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['dob_tc']);
                            ?>
                        </div>
                        <!-- Gender -->
                        <div class="gender_contact for_top">
                            <p class="radio_p">Gender</p>
                            <ul class="for_ul_top">
                                <li>
                                    <label class="all_checks_radio">Male
                                        <input type="radio" name="gender_tc" value="male">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Female
                                        <input type="radio" name="gender_tc" value="female">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="all_checks_radio">Other
                                        <input type="radio" name="gender_tc" value="other">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['gender_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['gender_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['gender_tc']);
                            ?>
                        </div>
                        <!-- Nationality -->
                        <div class="nation_contact for_top">
                            <h4 class="radio_p">Nationality</h4>
                            <ul class="for_ul_top">
                                <li>
                                    <label class="all_checks_radio">Singaporean
                                        <input type="radio" name="nationality_tc" value="singaporean">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <div class="others">
                                        <label class="all_checks_radio">Other:
                                            <input type="radio" name="nationality_tc" value="other">
                                            <span class="checkmark"></span>
                                        </label>
                                        <input type="text" class="dim" name="custom_country_tc">
                                    </div>
                                </li>
                            </ul>
                            <?php if (isset($_SESSION['nationality_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['nationality_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['nationality_tc']);
                            ?>
                        </div>
                        <!-- Relationship with applicate -->
                        <div class="relationship for_top">
                            <label for="relationship" class="label_name">Relationship with applicate</label>
                            <input type="text" id="relationship" class="full_width" placeholder="Type" name="relationship_tc" />
                            <?php if (isset($_SESSION['relationship_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['relationship_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['relationship_tc']);
                            ?>
                        </div>
                        <!-- Dietary  Restrictions-->
                        <div class="dietary for_top">
                            <label for="dietary" class="label_name">Dietary Restrictions <span class="label_rt">(Including Alcohol)</span></label>
                            <input type="text" id="dietary" class="full_width reli_sns_input" placeholder="Type..." name="restriction_tc" />
                            <?php if (isset($_SESSION['restriction_tc'])) {
                            ?>
                                <span class="for_err"> <?php echo $_SESSION['restriction_tc']; ?></span>
                            <?php
                            }
                            unset($_SESSION['restriction_tc']);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- image upload  -->
                <div class="files_upload">
                    <div class="f_container">
                        <div class="inner_container">
                            <div class="img_upload">
                                <label for="upload_avatar" class="upload_label">Please upload a photo that shows all applicate in the photo</label>
                                <input type="file" name="image" class="full_width" />
                                <?php if (isset($_SESSION['image'])) {
                                ?>
                                    <p> <?php echo $_SESSION['image']; ?></p>
                                <?php
                                }
                                unset($_SESSION['image']);
                                ?>
                            </div>
                            <div class="person_name for_top">
                                <label for="person" class="upload_label">The full name of the name who will receives the trip to Japan as their birthday gift</label>
                                <div class="fullname">
                                    <div class="fname">
                                        <input type="text" id="person" class="fname" placeholder="First Name" name="first_name_jp" />
                                        <?php if (isset($_SESSION['first_name_jp'])) {
                                        ?>
                                            <span class="for_err"> <?php echo $_SESSION['first_name_jp']; ?></span>
                                        <?php
                                        }
                                        unset($_SESSION['first_name_jp']);
                                        ?>
                                    </div>
                                    <div class="lname">
                                        <input type="text" placeholder="Last Name" name="last_name_jp" />
                                        <?php if (isset($_SESSION['last_name_jp'])) {
                                        ?>
                                            <span class="for_err"> <?php echo $_SESSION['last_name_jp']; ?></span>
                                        <?php
                                        }
                                        unset($_SESSION['last_name_jp']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please let us know your preferred traveling period</p>
                                <ul class="for_ul_top">
                                    <li>
                                        <label class="all_checks_label">Early January 2024
                                            <input type="checkbox" name="period[]" value="early_january_2024">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Mid January 2024
                                            <input type="checkbox" name="period[]" value="mid_january_2024">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Late January 2024
                                            <input type="checkbox" name="period[]" value="late_january_2024">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                                <?php if (isset($_SESSION['period'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['period']; ?></span>
                                <?php
                                }
                                unset($_SESSION['period']);
                                ?>
                            </div>
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please upload your introductory video below</p>
                                <input type="file"><span class="click_upload">Click here to upload</span>
                                <p class="intro_vd">Have you uploaded your introductory video?</p>
                                <label class="all_checks_label">Yes
                                    <input type="checkbox" name="video_upload" value="yes">
                                    <span class="checkmark"></span>
                                </label>
                                <?php if (isset($_SESSION['video_upload'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['video_upload']; ?></span>
                                <?php
                                }
                                unset($_SESSION['video_upload']);
                                ?>
                            </div>
                            <div class="traveling_period for_top">
                                <p class="upload_label">Please let us know how you came across this campaign</p>
                                <ul class="for_ul_top">
                                    <li>
                                        <label class="all_checks_label">JNTO's Website (japan.travel)
                                            <input type="checkbox" name="campaign[]" value="jnto's_website_(japan.travel)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">JNTO's Facebook (Visit Japan Now)
                                            <input type="checkbox" name="campaign[]" value="jnto's_facebook_(visit_japan_now)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">JNTO's Instagram (@visitjapansg)
                                            <input type="checkbox" name="campaign[]" value="jnto's_instagram_(@visitjapansg)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">JAPAN by Japan EDM
                                            <input type="checkbox" name="campaign[]" value="japan_by_japan_edm">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Japan Travel Fair
                                            <input type="checkbox" name="campaign[]" value="japan_travel_fai">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Social media
                                            <input type="checkbox" name="campaign[]" value="social_media">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Online news sites
                                            <input type="checkbox" name="campaign[]" value="online_news_sites">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Radio
                                            <input type="checkbox" name="campaign[]" value="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="all_checks_label">Friends/Family
                                            <input type="checkbox" name="campaign[]" value="friends/family">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_label">Other:
                                                <input type="checkbox" name="campaign[]" value="other">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input type="text" class="dim">
                                        </div>
                                    </li>
                                </ul>
                                <?php if (isset($_SESSION['campaign'])) {
                                ?>
                                    <span class="for_err"> <?php echo $_SESSION['campaign']; ?></span>
                                <?php
                                }
                                unset($_SESSION['campaign']);
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
                                    <label class="all_checks_label">By checking this box, you agree to the campaign’s <a href="#">Terms and Conditions</a> and confirm that you have read JAPAN by Japan’s <a href="#">Privacy Policy</a>.
                                        <input type="checkbox" name="termsConditions" value="yes">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="submit_btn" name="submit">Submit</button>
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
                        <figure class="logo"><img src="../assets/img/JNTO_logo.png" alt="JNTO" /></figure>
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
                            <figure><img src="../assets/img/facebook_logo.jpg" alt="facebook" />
                            </figure>
                        </a>
                        <a href="#" class="instagram">
                            <figure><img src="../assets/img/ig.png" alt="instagram"></figure>
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
</body>

</html>