<!DOCTYPE html>
<html lang="en">

<head>
    <title>XCMG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url("assets/image/favicon.png"); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slick-theme.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js " integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin=" anonymous "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        .permit_form .form_col2 .form-group {
            align-self: flex-start;
        }

        .permit_form .form-group.required label.error {
            position: absolute;
        }

        .permit_form .form_col2 {
            grid-row-gap: 15px;
        }

        .loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url('<?php echo base_url(); ?>/assets/load.gif') no-repeat center center;
            z-index: 10000;
        }

        .sup {
            color: red;
            font-size: 20px;
        }

        .error {
            color: red;
            font-size: 15px;
        }

        .password {
            border: 1px solid #e57574;
        }

        .eyepassword {
            border: 1px solid #ff6f00 !important;
            background: #e8f0fe !important;
        }

        .forget-password {
            margin-right: 22px;
            text-align: right;
        }

        .loader_body {
            overflow-y: hidden !important;
        }
    </style>
</head>

<body class="">


    <?php
    $uri = $this->uri->segment(1);


    ?>
    <header class="header">
        <div class="header-wrapper">
            <div class="topbar" id="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="icon_contact">
                                <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>121 King Street, Melbourn</a></li>
                                <li><a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i>example@gmail.com</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-right">
                            <ul class="social-network">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg" id="myHeader">
                <div class="container">
                    <!-- <a href="#" class="navbar-brand"><img src="image/logotransparent.png" alt=""></a> -->
                    <a href="<?php echo base_url(); ?>" class="navbar-brand2">
                        <img src="<?php echo base_url(); ?>assets/image/logo.png" alt=""></a>
                    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown position-static">
                                <a class="nav-link <?php echo empty($uri) ? "active" : "" ?>" href="<?php echo base_url() ?>" id="navbarDropdown" role="button">Home</a>
                            </li>
                            <li class="nav-item dropdown position-static">
                                <a class="nav-link <?php echo !empty($uri) && $uri == "can-i-get-permit" ? "active" : "" ?>" href="<?php echo base_url("can-i-get-permit") ?>" id="navbarDropdown" role="button">Can i get permit?</a>
                            </li>
                            <li class="nav-item dropdown position-static">
                                <a class="nav-link <?php echo !empty($uri) && $uri == "route-permit" ? "active" : "" ?>" href="<?php echo base_url("route-permit") ?>" id="navbarDropdown" role="button">Route Permit</a>
                            </li>

                            <li class="nav-item dropdown position-static my-account-btn">
                                <a class="nav-link simple_btn my_account <?php echo !empty($uri) && $uri == "my-account" ? "active" : "" ?>" data-toggle="dropdown" href="#" id="navbarDropdown" role="button" onclick="openSideNav()">My Account</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- sidebar -->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="side_logo"><img src="<?php echo base_url(); ?>assets/image/logo.png" alt=""></div>
            <?php if (!empty($this->session->userdata('xcmgarc_userData'))) {
                $user = $this->session->userdata('xcmgarc_userData');
                $user_image = !empty($user->user_profile_image) ? base_url() . "uploads/user/" . $user->user_profile_image : base_url() . "assets/image/author.png";
            ?>
                <!-- My account details  -->
                <div class="myaccount_detail">
                    <div class="image_email_custom">
                        <img src="<?php echo $user_image; ?>" alt="">
                        <a href="mailto:customer@company.com" id="customer_mail_id"><?php echo !empty($user->user_email) ? $user->user_email : ""; ?></a>
                    </div>

                    <div class="dashboard_buttons">
                        <a href="<?php echo base_url("dashboard") ?>" class="button_custom">Dashboard</a>
                        <a href="<?php echo base_url("logout") ?>">Logout</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="login_form">
                    <h2>Login</h2>
                    <div class="loader" id="login_loader"></div>
                    <span id="login_message" class="login_message" style="font-size:20px;"></span>
                    <form method="POST" id="User_login" action="<?php echo base_url("login"); ?>" enctype="multipart/form-data">

                        <div class="form-group required">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group required">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn simple_btn">Login</button>
                        <!-- <a href="#" type="submit" class="btn simple_btn">Login</a> -->
                        <a href="<?php echo base_url("forgot-password") ?>" class="forget_password">Forgot your password?</a>
                        <span href="#" class="sign_up_link">Not a member? <a href="<?php echo base_url("signup") ?>">Sign Up</a> </span>
                    </form>
                </div>
            <?php } ?>


            <!-- ================== -->
            <div class="sidebar_text">
                <h2>Office Address</h2>
                <ul class="list_item">
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i>121 King Street, Australia</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:example@gmail.com">example@gmail.com</a></li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:1234567891">1234567891</a></li>
                </ul>
                <h2>Social List</h2>
                <ul class="list_social">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- sidebar end -->

    </header>
    <script>
        $(document).ready(function() {
            var current_path = $(location).attr('pathname');
            var url = $(location).attr('href'),
                parts = url.split("/"),
                last_part = parts[parts.length - 1];
            if (last_part == 'route-permit') {
                tab_click_route_form(1);
            }
            if (last_part == 'can-i-get-permit') {
                tab_click_calculation_form(1);
            }

        });
    </script>
    <script>
        var spinnerLogin = $('#login_loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#User_login").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#User_login')[0];
                var datan = new FormData(formId);
                spinnerLogin.show();
                $.ajax({
                    url: form.action,
                    dataType: 'json',
                    type: form.method,
                    data: datan,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {


                        if (data.status === true) {
                            spinnerLogin.hide();
                            $('#login_message').html(data.message).focus();
                            $('#login_message').css('color', 'green');
                            $('#User_login')[0].reset();
                            // toastAlert.fire({
                            //     title: data.message,
                            //     icon: 'success'
                            // });
                            // Swal.fire(
                            //     'User Login',
                            //     data.message,
                            //     'success',
                            // );
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                            // .then((result) => {
                            //     window.location.href = base_url + "dashboard";
                            // });

                        } else {
                            spinnerLogin.hide();
                            if (data.status == 'form_error') {

                                var obj = data;
                                var i;
                                for (i = 0; i < obj.field.length; i++) {
                                    name = obj.field[i];
                                    $('.label-' + name).addClass('label-error');
                                    errors = JSON.stringify(obj.validation);
                                    validate = jQuery.parseJSON(errors);
                                    $("input[name=" + name + "]").after('<span class="error" style="color:red">' + validate[name] + '</span>').focus();
                                }
                            } else {

                                $('#login_message').html(data.message).focus();
                                $('#login_message').css('color', 'red');
                                setTimeout(function() {
                                    $('#login_message').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinnerLogin.hide();
                        $('#login_message').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>').focus();
                        $('#login_message').css('color', 'red');
                        setTimeout(function() {
                            $('#login_message').html('');
                        }, 3000);

                    }
                });
            }
        });
    </script>