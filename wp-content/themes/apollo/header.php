<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(' | ', true, 'left'); ?></title>
  <link href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <?php wp_head(); ?>
</head>

<body>

  <header>
    <div class="container-fluid m-0 p-0 top-bar-container">
      <!-- Top Bar Row -->
      <div class="row-fluid m-0 p-0">
        <div class="col-12 m-0 p-0">

          <div class="container">
            <div class="row m-0 p-0">
              <div class="col-12 m-0 p-0">
                <!-- Top Bar -->
                <div class="contact-top-bar">
                  <div class="contact-details">
                    <!-- Contact Info -->
                    <div class="contact-info">
                      <span class="contact-letter">E:</span>
                      <a href="mailto:edinburgh@apollo-blinds.co.za">edinburgh@apollo-blinds.co.za</a>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-info">
                      <span>T:</span>
                      <a href="mailto:tel:+441316390153">0131 639 0153</a>
                    </div>
                  </div>
                  <!-- Social Media -->
                  <div class="social-media">
                    <?php include('social-networks.php'); ?>
                  </div>
                </div>
                <!-- Top Bar -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid m-0 p-0">
      <!-- Top Bar Row -->
      <div class="row-fluid m-0 p-0">
        <div class="col-12 m-0 p-0">

          <div class="container-xxl">
            <div class="row m-0 p-0">
              <div class="col-12 m-0 p-0">
                <!-- Logo and Appointment Bar -->
                <div class="logo-appointment-bar">

                  <div class="logo-wrapper">
                    <a href="#"><img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/images/Logo.png" /></a>
                  </div>

                  <div class="appointment-button-wrapper">
                    <a href="#">BOOK AN APPOINTMENT</a>
                  </div>

                </div>
                <!-- Logo and Appointment Bar Ends -->
              </div>
            </div>
          </div>
          <!-- Top Bar Row Ends -->
        </div>
      </div>
    </div>


    <div class="container-fluid m-0 p-0 top-menu-bar-container">
      <!-- Top Bar Row -->
      <div class="row-fluid m-0 p-0">
        <div class="col-12 m-0 p-0">

          <div class="container-xxl">
            <div class="row m-0 p-0">
              <div class="col-12 m-0 p-0">
                <!-- Main Menu Features -->
                <div class="main-menu-features-wrapper">

                  <!-- A Single Feature -->
                  <div class="main-menu-feature">
                      <div class="feature-image-wrapper">
                      <img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/images/top_icn_1.png" />
                      </div>
                      <div class="feature-text-wrapper">
                        <p>MADE-TO-MEASURE</p>
                      </div>
                  </div>
                  <!-- A Single Feature Ends -->

                  <!-- A Single Feature -->
                  <div class="main-menu-feature">
                      <div class="feature-image-wrapper">
                      <img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/images/top_icn_2.png" />
                      </div>
                      <div class="feature-text-wrapper">
                        <p>FREE NO OBLIGATION QUOTE & DESIGN VISIT</p>
                      </div>
                  </div>
                  <!-- A Single Feature Ends -->

                  <!-- A Single Feature -->
                  <div class="main-menu-feature">
                      <div class="feature-image-wrapper">
                      <img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/images/top_icn_3.png" />
                      </div>
                      <div class="feature-text-wrapper">
                        <p>MOTORISED OPTIONS</p>
                      </div>
                  </div>
                  <!-- A Single Feature Ends -->

                  <!-- A Single Feature -->
                  <div class="main-menu-feature">
                      <div class="feature-image-wrapper">
                      <img class="img-fluid" src="<?php bloginfo('template_directory'); ?>/images/top_icn_4.png" />
                      </div>
                      <div class="feature-text-wrapper">
                        <p>25 YEAR GUARENTEE</p>
                      </div>
                  </div>
                  <!-- A Single Feature Ends -->

                </div>
                <!-- Main Menu Features Ends -->
              </div>
            </div>
          </div>
          <!-- Top Bar Row Ends -->
        </div>
      </div>
    </div>

  </header>
