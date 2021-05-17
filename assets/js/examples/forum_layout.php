<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Forum</title>

  <link rel="apple-touch-icon" href="<?= base_url() ?>forum_assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/img/GHS-logo.png">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/css/site.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugin -->
  <link rel="stylesheet" href="/vendor/select2/select2.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/bootstrap-markdown/bootstrap-markdown.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/vendor/bootstrap-select/bootstrap-select.css">

  <!-- Page -->
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/css/apps/forum.css">

  <!-- font Awesome -->
  <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Fonts -->
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>forum_assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    <script src="<?= base_url() ?>forum_assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="<?= base_url() ?>forum_assets/vendor/media-match/media.match.min.js"></script>
    <script src="<?= base_url() ?>forum_assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="<?= base_url() ?>forum_assets/vendor/modernizr/modernizr.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

  .search {
    width: 100%;
    position: relative
  }

  .searchTerm {
    float: left;
    width: 100%;
    border: 3px solid #00B4CC;
    padding: 5px;
    height: 20px;
    border-radius: 5px;
    outline: none;
    color: #9DBFAF;
  }

  .searchTerm:focus{
    color: #00B4CC;
  }

  .searchButton {
    position: absolute;  
    right: -50px;
    width: 40px;
    height: 36px;
    border: 1px solid #00B4CC;
    background: #00B4CC;
    text-align: center;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    font-size: 20px;
  }

  /*Resize the wrap to see the search bar change!*/
  .wrap{
    width: 90%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>
<body class="app-forum">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="<?= base_url() ?>assets/img/GHS-logo.png" title=" GHS E-LEARNING">
        <span class="navbar-brand-text"> GHS <span class="hidden-sm hidden-xs">E-LEARNING</span></span>
      </div>
    </div>

    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
         
        </ul>
        <!-- End Navbar Toolbar -->

        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-category">General</li>
            <li class="site-menu-item">
              <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url().'index.php/public/Frontier/' ?>" data-slug="angular">
                <i class="site-menu-icon wb-home" aria-hidden="true"></i>
                <span class="site-menu-title">Homepage</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('index.php/public/Member/participant_dashboard/'.$_SESSION['username']) ?>" data-slug="angular">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('index.php/public/Member/view_modules') ?>" data-slug="angular">
                <i class="site-menu-icon wb-book" aria-hidden="true"></i>
                <span class="site-menu-title">Modules</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('index.php/public/Frontier/assessment_list') ?>" data-slug="angular">
                <i class="site-menu-icon wb-pencil" aria-hidden="true"></i>
                <span class="site-menu-title">Assignments</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('index.php/public/Frontier/list_quiz') ?>" data-slug="angular">
                <i class="site-menu-icon wb-check" aria-hidden="true"></i>
                <span class="site-menu-title">Quizes</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('index.php/public/Member/userComplains/'.$_SESSION['username']) ?>" data-slug="angular">
                <i class="site-menu-icon wb-envelope" aria-hidden="true"></i>
                <span class="site-menu-title">Report an issue</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url().'index.php/public/Frontier/forum_thread' ?>" data-slug="angular">
                <i class="site-menu-icon wb-chat-group" aria-hidden="true"></i>
                <span class="site-menu-title">Forum</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url().'index.php/public/Frontier/change_password' ?>" data-slug="angular">
                <i class="site-menu-icon fa fa-cog" aria-hidden="true"></i>
                <span class="site-menu-title">Change Password</span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?php echo base_url('/index.php/public/Member/logout') ?>" data-slug="angular">
                <i class="site-menu-icon wb-power" aria-hidden="true"></i>
                <span class="site-menu-title">Log out</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </div>

  <div class="page bg-white animsition">
    <!-- Forum Sidebar -->
    <div class="page-aside">
      <div class="page-aside-switch">
        <i class="icon wb-chevron-left" aria-hidden="true"></i>
        <i class="icon wb-chevron-right" aria-hidden="true"></i>
      </div>
      <div class="page-aside-inner">
        <section class="page-aside-section">
          <h5 class="page-aside-title">General Channels</h5>
          <div class="list-group">
            <?php foreach($general as $gen){ ?>
              <a class="list-group-item" href="#" onclick='channel_threads(<?= $gen->id?>)'>
                  <i class="icon wb-emoticon" aria-hidden="true"></i>
                  <span class="list-group-item-content"><?= $gen->name?></span>
                </a>
            <?php } ?> 
          </div>
          <h5 class="page-aside-title">Class Channels</h5>
           <div class="list-group">
            <?php foreach($class_channel as $gen){ ?>
                <a class="list-group-item" href="#" onclick='channel_threads(<?= $gen->id?>)'>
                  <i class="icon wb-emoticon" aria-hidden="true"></i>
                  <span class="list-group-item-content"><?= $gen->name?></span>
                </a>
            <?php } ?> 
          </div>
        </section>
      </div>
    </div>

    <!-- Forum Content -->
    <div class="page-main" id="content">
        <?= $content ?>
    </div>
  </div>


  <!-- Footer -->
  <footer class="site-footer">
    <span class="site-footer-legal">© <?= date('Y') ?> GHS E_LEARNING</span>
    <div class="site-footer-right">
      Powered by <a href="#">PMconsults</a>
    </div>
  </footer>

  <!-- Core  -->
  <script src="<?= base_url() ?>forum_assets/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="<?= base_url() ?>forum_assets/vendor/switchery/switchery.min.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/intro-js/intro.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/screenfull/screenfull.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/slidepanel/jquery-slidePanel.js"></script>

  <script src="<?= base_url() ?>forum_assets/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/bootstrap-select/bootstrap-select.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/marked/marked.js"></script>
  <script src="<?= base_url() ?>forum_assets/vendor/to-markdown/to-markdown.js"></script>

  <!-- Scripts -->
  <script src="<?= base_url() ?>forum_assets/js/core.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/site.js"></script>

  <script src="<?= base_url() ?>forum_assets/js/sections/menu.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/sections/menubar.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/sections/sidebar.js"></script>

  <script src="<?= base_url() ?>forum_assets/js/configs/config-colors.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/configs/config-tour.js"></script>

  <script src="<?= base_url() ?>forum_assets/js/components/asscrollable.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/components/animsition.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/components/slidepanel.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/components/switchery.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/apps/app.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/apps/forum.js"></script>
  <script src="<?= base_url() ?>forum_assets/js/components/bootstrap-select.js"></script>

  <script>
    (function(document, window, $) {
      'use strict';
      var AppForum = window.AppForum;

      $(document).ready(function() {
        AppForum.run();
      });
    })(document, window, jQuery);
  </script>
  <script>
    function group_discussion(){
          $('#content').html('<img src="<?=base_url()?>assets/video-js/source.gif"/>');
          $('#content').fadeIn('slow').load('<?=base_url()?>index.php/public/Frontier/group_discussion',function() {

          });
    }
  </script>

   <script>
    function general_discussion(){
          $('#content').html('<img src="<?=base_url()?>assets/video-js/source.gif"/>');
          $('#content').fadeIn('slow').load('<?=base_url()?>index.php/public/Frontier/general_discussion',function() {

          });
    }
  </script>
  
  <script>
    function channel_threads(id){
          $('#content').html('<img src="<?=base_url()?>assets/video-js/source.gif"/>');
          $('#content').fadeIn('slow').load('<?=base_url()?>index.php/public/Frontier/channel_threads/'+ id,function() {

          });
    }
  </script>

  <script>
    function comments(a){
          $('#content').html('<img src="<?=base_url()?>assets/video-js/source.gif"/>');
          $('#content').fadeIn('slow').load('<?=base_url()?>index.php/public/Frontier/forum_post1/'+ a,function() {

          });
    }
  </script>
</body>

</html>