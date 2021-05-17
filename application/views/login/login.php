<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from brandio.io/envato/iofrm/html/login9.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Sep 2020 00:20:14 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iofrm</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login-assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login-assets/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/login-assets/css/iofrm-theme9.css">
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Get more things done with Deksol revenue platform.</h3>
                    <p>Access to the most powerfull tool to collect data and mobilize revenue.</p>
                    <img src="<?=base_url();?>assets/login-assets/images/graphic5.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <!-- <a href="<?=base_url();?>">
                                <div class="logo">
                                    <img class="logo-size" src="<?=base_url();?>assets/login-assets/images/logo-light.svg" alt="">
                                </div>
                            </a> -->
                        </div>
                        <div class="page-links">
                            <a href="<?=base_url();?>" class="active">Login</a>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <?=$this->session->flashdata("message")?>
                          </div>
                        </div>
                        <form method="post" action="signin" autocomplete="off">
                            <input class="form-control" type="text" name="user" placeholder="Username" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button> 
                                <!-- <a href="forget9.html">Forget password?</a> -->
                            </div>
                        </form>
                        <!-- <div class="other-links">
                            <span>Or login with</span><a href="#">Facebook</a><a href="#">Google</a><a href="#">Linkedin</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?=base_url();?>assets/login-assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/login-assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/login-assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/login-assets/js/main.js"></script>
</body>

<!-- Mirrored from brandio.io/envato/iofrm/html/login9.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Sep 2020 00:20:25 GMT -->
</html>