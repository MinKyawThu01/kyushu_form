<?php

include('../../app/classes/Kyushu.php');

session_start();

$kyushu = new Kyushu();

if ($kyushu->store($_POST, $_FILES)) {
    echo '<script>location.href="../complete/index.php"</script>';
    session_destroy();
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
                        <div class="form_gp">
                            <h5 class="title">Date of Birth</h5>
                            <input disabled type="date" id="dateOfBirth" name="dob" disabled value="<?php if (isset($_SESSION['old_dob'])) {
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
                        <div class="form_gp">
                            <h5 class="title">Gender</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_gender'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio"><?= $_SESSION['old_gender']; ?>
                                            <input disabled type="radio" name="gender" value="<?= $_SESSION['old_gender'] ?>" disabled checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                        <!-- Nationality -->
                        <div class="form_gp">
                            <h5 class="title">Nationality</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_nati']) && !isset($_SESSION['old_nati_cc'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input"><?= $_SESSION['old_nati'] ?>
                                            <input disabled type="radio" name="nationality" value="<?= $_SESSION['old_nati'] ?>" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } else if (isset($_SESSION['old_nati']) && isset($_SESSION['old_nati_cc'])) {
                                ?>
                                    <div class="others">
                                        <label class="all_checks_radio others-input"><?= $_SESSION['old_nati'] ?>:
                                            <input disabled type="radio" name="nationality" value="<?= $_SESSION['old_nati'] ?>" checked>
                                            <span class="checkmark"></span>
                                        </label>

                                        <!-- test 1 remove disable and class = dim -->
                                        <input disabled type="text" class=" all_input" id="nation_opt1" name="custom_country" value="<?php echo $_SESSION['old_nati_cc']; ?>">
                                    </div>
                                    </li>
                                <?php
                                } ?>
                            </ul>

                        </div>
                        <!-- Occupation -->
                        <div class="form_gp">
                            <h5 class="title">Occupation</h5>
                            <input disabled type="text" id="occupation" placeholder="Type..." name="occupation" value="<?php if (isset($_SESSION['old_occ'])) {
                                                                                                                            echo $_SESSION['old_occ'];
                                                                                                                        } ?>" />

                        </div>
                        <!-- Religion -->
                        <div class="form_gp">
                            <h5 class="title">Religion</h5>
                            <p>(We will try to caster to religion preferences, but should you not wish to specify, please answer "prefer not to say")</p>
                            <input disabled type="text" id="religion" class="full_width reli_sns_input" placeholder="Type..." name="religion" value="<?php if (isset($_SESSION['old_reli'])) {
                                                                                                                                                            echo $_SESSION['old_reli'];
                                                                                                                                                        } ?>" />

                        </div>
                        <!-- SNS username -->
                        <div class="form_gp">
                            <h5 class="title">SNS username<span class="sub_txt">(Facebook/Instagram/Tiktok/Youtube)</h5>
                            <p>*Leave the option blank if you do not have any Social Media account</p>
                            <input disabled type="text" id="sns" class="full_width reli_sns_input" placeholder="" name="sns_username" value="<?php if (isset($_SESSION['old_sns'])) {
                                                                                                                                                        echo $_SESSION['old_sns'];
                                                                                                                                                    } ?>" />

                        </div>
                        <div class="form_gp">
                            <h5 class="title">Have you been to Japan before?</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_before'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio"><?= $_SESSION['old_before'] ?>
                                            <input disabled type="radio" name="japan_before" id="never_input" class="c-form_radio" value="<?= $_SESSION['old_before'] ?>" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } ?>

                            </ul>

                        </div>
                        <!-- Region visited in past Japan travels -->
                        <?php if (isset($_SESSION['old_reg']) && $_SESSION['old_before'] != "Never") {
                        ?>
                            <div class="visited_japan form_gp">
                                <h5 class="title">Region(s) visited in past Japan travels</h5>
                                <div class="region">
                                    <ul class="custom-checkbox">
                                        <?php foreach ($_SESSION['old_reg'] as $old_reg) {
                                        ?>
                                            <li>
                                                <label class="all_checks_label"><?= $old_reg ?>
                                                    <input disabled type="checkbox" name="region[]" value="<?= $old_reg ?>" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        <?php
                                        } ?>

                                    </ul>
                                </div>
                            </div>
                        <?php
                        } ?>

                        <!-- Dietary  Restrictions-->
                        <div class="form_gp">
                            <h5 class="title">Dietary Restrictions <span class="sub_txt">(Including Alcohol)</span> </h5>
                            <input disabled type="text" id="dietary" placeholder="Type..." name="restriction" value="<?php if (isset($_SESSION['old_restri'])) {
                                                                                                                            echo $_SESSION['old_restri'];
                                                                                                                        } ?>" />

                        </div>
                        <!-- Email -->
                        <div class="form_gp">
                            <h5 class="title">Email Address</h5>
                            <input disabled type="text" id="email" placeholder="Email" name="email" value="<?php if (isset($_SESSION['old_email'])) {
                                                                                                                echo $_SESSION['old_email'];
                                                                                                            } ?>" />

                        </div>
                        <!-- Phone Number -->
                        <div class="form_gp">
                            <h5 class="title">Phone Number</h5>
                            <input disabled type="text" id="phone" placeholder="Phone Number" name="ph_num" value="<?php if (isset($_SESSION['old_ph'])) {
                                                                                                                        echo $_SESSION['old_ph'];
                                                                                                                    } ?>" />

                        </div>

                        <hr class="form_gp">

                        <!-- Travel Companion 01 -->
                        <h3 class="form_gp"><span class="star_icon">Travel Companion 01</span></h3>
                        <!-- Name -->
                        <div class="form_gp">
                            <h5 class="title">Full Name</h5>
                            <div class="fullname">
                                <div class="first-item">
                                    <input disabled type="text" id="name" class="first-name" placeholder="First Name" name="first_name_tc" value="<?php if (isset($_SESSION['old_fn_tc'])) {
                                                                                                                                                        echo $_SESSION['old_fn_tc'];
                                                                                                                                                    } ?>" />

                                </div>
                                <div class="second-item">
                                    <input disabled type="text" placeholder="Last Name" name="last_name_tc" value="<?php if (isset($_SESSION['old_ln_tc'])) {
                                                                                                                        echo $_SESSION['old_ln_tc'];
                                                                                                                    } ?>" />

                                </div>
                            </div>
                        </div>
                        <!-- Date of Birth -->
                        <div class="form_gp">
                            <h5 class="title">Date of Birth</h5>
                            <input disabled type="date" id="dateOfBirth" name="dob_tc" value="<?php if (isset($_SESSION['old_dob_tc'])) {
                                                                                                    echo $_SESSION['old_dob_tc'];
                                                                                                } ?>" />

                        </div>
                        <!-- Gender -->
                        <div class="form_gp">
                            <h5 class="title">Gender</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_gender_tc'])) {
                                ?>

                                    <li>
                                        <label class="all_checks_radio"><?= $_SESSION['old_gender_tc']; ?>
                                            <input disabled type="radio" name="gender_tc" value="$_SESSION['old_gender_tc']" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php
                                } ?>
                            </ul>

                        </div>
                        <!-- Nationality -->
                        <div class="form_gp">
                            <h5 class="title">Nationality</h5>
                            <ul>
                                <?php if (isset($_SESSION['old_nati_tc']) && !isset($_SESSION['old_nati_cc_tc'])) {
                                ?>
                                    <li>
                                        <label class="all_checks_radio others-input"><?= $_SESSION['old_nati_tc']; ?>
                                            <input disabled type="radio" name="nationality_tc" value="<?= $_SESSION['old_nati_tc']; ?>" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                <?php } else if (isset($_SESSION['old_nati_tc']) && isset($_SESSION['old_nati_cc_tc'])) { ?>
                                    <li>
                                        <div class="others">
                                            <label class="all_checks_radio others-input"><?= $_SESSION['old_nati_tc']; ?>:
                                                <input disabled type="radio" name="nationality_tc" value="<?= $_SESSION['old_nati_tc']; ?>" checked>
                                                <span class="checkmark"></span>
                                            </label>

                                            <!-- test 2 reomve disable  -->
                                            <input disabled type="text" class=" all_input" id="nation_opt2" name="custom_country_tc" value="<?= $_SESSION['old_nati_cc_tc']; ?>">
                                    </li>
                                <?php
                                }  ?>

                            </ul>

                        </div>
                        <!-- Relationship with applicate -->
                        <div class="form_gp">
                            <h5 class="title">Relationship with applicant</h5>
                            <input disabled type="text" id="relationship" placeholder="Type" name="relationship_tc" value="<?php if (isset($_SESSION['old_rs_tc'])) {
                                                                                                                                echo $_SESSION['old_rs_tc'];
                                                                                                                            } ?>" />
                        </div>
                        <!-- Dietary  Restrictions-->
                        <div class="form_gp">
                            <h5 class="title">Dietary Restrictions <span class="sub_txt">(Including Alcohol)</span></h5>
                            <input disabled type="text" id="dietary" placeholder="Type..." name="restriction_tc" value="<?php if (isset($_SESSION['old_res_tc'])) {
                                                                                                                            echo $_SESSION['old_res_tc'];
                                                                                                                        } ?>" />

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
                                <figure class="upload_img">
                                <?php if (isset($_SESSION['imgBase64'])) { ?>
                                    <img src="<?php echo $_SESSION['imgBase64']; ?>" alt="Your Uploaded Photo"">
                                <?php } ?>
                                </figure>
                               
                            </div>
                            <!-- Birthday  -->
                            <div class="form_gp">
                                <h5 class="title">The full name of the name who will receives the trip to Japan as their birthday gift</h5>
                                <div class="fullname">
                                    <div class="first-item">
                                        <input disabled type="text" id="person" class="fname" placeholder="First Name" name="first_name_jp" value="<?php if (isset($_SESSION['old_fn_jp'])) {
                                                                                                                                                        echo $_SESSION['old_fn_jp'];
                                                                                                                                                    } ?>" />
                                    </div>
                                    <div class="second-item">
                                        <input disabled type="text" placeholder="Last Name" name="last_name_jp" value="<?php if (isset($_SESSION['old_ln_jp'])) {
                                                                                                                            echo $_SESSION['old_ln_jp'];
                                                                                                                        } ?>" />

                                    </div>
                                </div>
                            </div>
                            <!-- travel period  -->
                            <div class="form_gp">
                                <h5 class="title">Please let us know your preferred traveling period</h5>
                                <ul>
                                    <?php if (isset($_SESSION['old_period'])) {
                                        foreach ($_SESSION['old_period'] as $old_period) {
                                    ?>
                                            <li>
                                                <label class="all_checks_label"><?= $old_period ?>
                                                    <input disabled type="checkbox" name="period[]" value="<?= $old_period ?>" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                    <?php
                                        }
                                    }  ?>

                                </ul>
                            </div>
                            <!-- campagin  -->
                            <div class="form_gp">
                                <h5 class="title">Please let us know how you came across this campaign</h5>
                                <ul>
                                    <?php if (isset($_SESSION['old_camp'])) {
                                        foreach ($_SESSION['old_camp'] as $old_camp) {
                                    ?>
                                            <li>
                                                <?php if ($old_camp == 'Other') {echo "<div class='others'>"; } ?>
                                                    <label class="all_checks_label others-input"><?= $old_camp ?>
                                                        <input disabled type="checkbox" class="selected" name="campaign[]" value="<?= $old_camp ?>" checked>
                                                        <span class="checkmark"></span>
                                                    </label>

                                                    <!-- remove dim class  -->

                                                    <?php if ($old_camp == 'Other' && isset($_SESSION['old_custom_camp'])) {
                                                    ?>
                                                        <input disabled type="text" class=" remove_dim_class all_input " name="custom_campaign" value="<?= $_SESSION['old_custom_camp']; ?>">
                                                    <?php
                                                    } ?>
                                            <?php if ($old_camp == 'Other') {echo "</div>"; } ?>
                                            </li>
                                    <?php
                                        }
                                    }  ?>
                                </ul>
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
                                    <?php }
                                    ?>
                                </div>

                                <!-- hid confirm -->
                                <div class="btn_submit">
                                    <a href="../index.php" class="back_link">Back</a>
                                    <button type="submit" name="confirm" class="submit_btn btn_lg">
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
                  <a href="#"  class="logo">
                    <img src="../assets/img/JNTO_logo.png" alt="JNTO" />
                  </a>
                  <ul class="contact">
                    <li ><a href="#">Home</a></li>
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