<!doctype html>
<html class="fixed sidebar-left-collapsed sidebar-light">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title><?= "REVENUE MANAGEMENT SYSTEM".'-'.$title?></title>
    <meta name="keywords" content="Admin Template" />
    <meta name="description" content="Revenue Management System Admin">
    <meta name="author" content="pmconsult.com.gh">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light|Assistant|Kranky" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />


    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/media/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/lightbox/css/lightbox.min.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css" />


    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <!-- Head Libs -->
    <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>

    <style>
    table{
      white-space:nowrap;
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #34A7C1;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #34A7C1;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    #mapPanel {
      position: absolute;
      top: 10px;  /* adjust value accordingly */
      left: 10px;  /* adjust value accordingly */
      width:20em;
    }

    .dropSheet {
      background-color: #fff;
      background-image: none;
      opacity: 0.8;
      filter: alpha(opacity=80);
    }

    #dvMap{
      height: 750px;
      width: 100%;
    }

    </style>

  </head>
  <body>
    <section class="body">

      <!-- start: header -->
      <header class="header">
        <div class="logo-container">
          <span class="logo" style="text-align: center; margin: 0 auto;margin-left:0.5em;">
            <h3 style="font-family:kranky;color: #319fbb">REVENUE MANAGEMENT SYSTEM</h3>
          </span>
          <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
          </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

          <span class="separator"></span>

          <ul class="notifications">
            <li>
              <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-envelope"></i>
                <span class="badge">0</span>
              </a>

              <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                  <span class="float-right badge badge-default">0</span>
                  Messages
                </div>

                <div class="content">
                  <ul>

                  </ul>

                  <hr />

                  <div class="text-right">
                    <a href="#" class="view-more">View All</a>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge">0</span>
              </a>

              <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                  <span class="float-right badge badge-default">0</span>
                  Alerts
                </div>

                <div class="content">
                  <ul>

                  </ul>

                  <hr />

                  <div class="text-right">
                    <a href="#" class="view-more">View All</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>

          <span class="separator"></span>

          <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
              <figure class="profile-picture">
                <img src="<?php echo base_url(); ?>assets/img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?php echo base_url(); ?>assets/img/!logged-user.jpg" />
              </figure>
              <div class="profile-info" data-lock-name="<?php echo $this->session->userdata('user_info')['firstname']." ".$this->session->userdata('user_info')['lastname']?>" data-lock-email="<?php echo $this->session->userdata('user_info')['email'] !== "" ? $this->session->userdata('user_info')['email'] : "..." ?>">
                <span class="name"><?php echo $this->session->userdata('user_info')['firstname']." ".$this->session->userdata('user_info')['lastname']?></span>
                <span class="role"><?php echo $this->session->userdata('user_info')['position']?></span>
              </div>

              <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
              <ul class="list-unstyled mb-2">
                <li class="divider"></li>
                <li>
                  <a role="menuitem" tabindex="-1" href="<?=base_url()?>change_password"><i class="fa fa-user"></i> Change Password</a>
                </li>
                <li>
                  <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                </li>
                <li>
                  <a role="menuitem" tabindex="-1" href="<?=base_url()?>logout"><i class="fa fa-power-off"></i> Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end: search & user box -->
      </header>
      <div id="faceoff">
          <div id="preloader">
              <div class="preloader-section"></div>
        </div>
      </div>
      <!-- end: header -->
