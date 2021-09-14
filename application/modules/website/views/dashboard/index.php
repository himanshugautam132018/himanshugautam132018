<style>
    .container.trade_section {
        max-width: 960px !important;
        background: #fff;
        margin-top: 40px !important;
        border-radius: 9px;
        padding: 20px;
    }

    /* User Profile */

    .profile_container .card-body ul.nav.nav-tabs li.nav-item a.active {
        background: #024d98 !important;
        color: #fff !important;
    }

    .profile_container .card-body ul.nav.nav-tabs li.nav-item a {
        color: #000 !important;
        border-radius: 4px;
    }

    .profile_container .card-body ul.nav.nav-tabs {
        border: none;
    }

    .profile_container .card-body.avatar {
        text-align: center;
    }

    .profile_container .card-body.avatar h4 {
        text-align: left;
        margin-bottom: 50px;
    }

    .profile_container .col-lg-4.align-items-stretch.fixed.left_sticky_section {
        position: relative;
    }

    .profile_container .left_sticky_section .card {
        position: sticky !important;
        top: 10px !important;
    }

    .card-body.avatar img {
        height: 44px;
        margin-left: 0px !important;
    }

    .card-body hr {
        width: 100% !important;
        border-top: 2px solid#dfdfdf !important;
        margin-bottom: 60px !important;
    }

    .container.login_content_section.profile_page {
        overflow: unset !important;
    }

    .container.trade_page.profile_page .form-group input {
        font-size: 14px;
    }

    .inner-body.trade_page.profile_page .header_title {
        padding-top: 0px !important;
        margin: 0;
    }
</style>
<div class="container signup_section inner-body trade_page profile_page">

    <div class="container trade_section profile_container">
        <div class="container header_title">
            <!-- <h2>Overview</h2> -->
            <h2 class="dashboard_title section_title">User Profile</h2>
            <!-- <div class="trade_btn"><a href="#">New Trade</a></div> -->

        </div>
        <div class="content-wrapper">
            <div class="row user-profile">
                <div class="col-lg-4  align-items-stretch left_sticky_section">


                    <div class="card">
                        <div class="card-body avatar">
                            <h4 class="card-title">Info</h4>
                            <?php
                            $image_src = !empty($user_info->user_profile_image) ? base_url() . "uploads/user/" . $user_info->user_profile_image :
                                base_url() . "assets/image/author.png";
                            ?>
                            <img src="<?php echo $image_src; ?>" alt="" class="" style="max-width: 240px;margin-left: 38px;">
                            <p class="d-block text-center text-dark"></p>
                            <?php if (!empty($user_info->user_first_name)) { ?>
                                <a class="d-block text-center text-dark" href="#">
                                    <?php echo !empty($user_info->user_first_name) ? $user_info->user_first_name : '' ?>
                                </a>
                            <?php }
                            if (!empty($user_info->user_email)) { ?>
                                <a class="d-block text-center text-dark" href="mailto:<?php echo $user_info->user_email; ?>">
                                    <?php echo !empty($user_info->user_email) ? $user_info->user_email : '' ?>
                                </a>
                            <?php }
                            if (!empty($user_info->user_phone)) { ?>
                                <a class="d-block text-center text-dark" href="tel:<?php echo $user_info->user_phone; ?>">
                                    <?php echo !empty($user_info->user_phone) ? $user_info->user_phone : '' ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>


                </div>
                <div class="col-lg-8 side-right stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">User Profile</h4>
                                <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active " id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">Security</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="wrapper">
                                <hr>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                                        <div class="loader"></div>
                                        <span id="success_message_profile" class="success_message_profile" style="font-size:20px;"></span>
                                        <form method="POST" id="update_user_info" action="<?php echo base_url("edit-profile"); ?>" enctype="multipart/form-data">

                                            <div class="wrapper mb-2">
                                                <span class="badge text-danger">Note : </span>
                                                <p class="d-inline ml-3 text-muted">Image size is limited to not greater than 2MB .</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" name="user_profile_image" class="dropify" data-max-file-size="1mb" data-default-file="<?php echo base_url() ?>assets/images/user-avatar.jpg" />
                                            </div>


                                            <div class="form-group">
                                                <label for="mobile">First Name</label>
                                                <input type="hidden" id="user_id" name="user_id" value="<?php echo !empty($user_info->user_id) ? $user_info->user_id : '' ?>" />

                                                <input type="texr" class="form-control" id="fname" name="fname" value="<?php echo !empty($user_info->user_first_name) ? $user_info->user_first_name : '' ?>" required value="" placeholder="Enter First name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Last Name </label>
                                                <input type="text" class="form-control" id="lname" name="lname" required value="<?php echo !empty($user_info->user_last_name) ? $user_info->user_last_name : '' ?>" placeholder="Enter Last name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Company </label>
                                                <input type="text" class="form-control" id="comapny" name="comapny" required value="<?php echo !empty($user_info->user_company) ? $user_info->user_company : '' ?>" placeholder="Enter Comapny name">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">E-Mail</label>
                                                <input type="email" class="form-control" id="email" readonly name="email" required value="<?php echo !empty($user_info->user_email) ? $user_info->user_email : '' ?>" placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Phone Number </label>
                                                <input type="number" class="form-control" id="mobile" name="mobile" required value="<?php echo !empty($user_info->user_phone) ? $user_info->user_phone : '' ?>" placeholder="Enter Mobile number">

                                            </div>
                                            


                                            <div class="form-group mt-5">
                                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                                <a href="javascript:void(0)" class="btn btn-primary" onclick="window.history.back();">Cancel</a>
                                            </div>

                                        </form>
                                    </div><!-- tab content ends -->

                                    <!-- Change password section -->
                                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                        <div class="loader"></div>
                                        <span class="err_change_password" id="err_change_password"></span>
                                        <form method="POST" class="forms-sample" action="<?php echo base_url("change-password"); ?>" enctype="multipart/form-data" id="client_change_password">
                                            <div class="form-group">
                                                <label for="change-password">Current Password</label>
                                                <input type="hidden" id="active_user_id" name="active_user_id" value="<?php echo !empty($user_info->user_id ) ? $user_info->user_id : '' ?>" />

                                                <input type="password" class="form-control" required id="current_password" name="current_password" placeholder="Enter you current password">
                                            </div>
                                            <div class="form-group">
                                                <label for="change-password"> Password</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter you new password" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="change-password">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" required id="confirm_password" placeholder="Enter confirm password">
                                            </div>
                                            <div class="form-group mt-5">
                                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                                <a href="javascript:void(0)" class="btn btn-primary" onclick="window.history.back();">Cancel</a>
                                                <!-- <button class="btn btn-primary" type="button" onclick="window.history.back();">Cancel</button> -->
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#update_user_info").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#update_user_info')[0];
                var datan = new FormData(formId);
                spinner.show();
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
                            spinner.hide();
                            $('#success_message_profile').html(data.message).focus();
                            $('#success_message_profile').css('color', 'green');
                            $('#update_user_info')[0].reset();
                            Swal.fire(
                                'Client Profile ',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.reload();
                                // window.location.href = base_url + "dashboard";
                            });

                        } else {
                            spinner.hide();
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
                                $('#success_message_profile').html(data.message).focus();
                                $('#success_message_profile').css('color', 'red');
                                Swal.fire(
                                    'Client Profile  ',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#success_message_profile').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'Client Profile  Error',
                            "Something went wrong . please try again once",
                            'error'
                        );
                        $('#success_message_profile').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>').focus();
                       
                        $('#success_message_profile').css('color', 'red');
                        setTimeout(function() {
                            $('#success_message_profile').html('');
                        }, 3000);

                    }
                });
            }
        });


        // change password
        $("#client_change_password").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#client_change_password')[0];
                var datan = new FormData(formId);
                spinner.show();
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
                            spinner.hide();
                            $('#err_change_password').html(data.message).focus();
                            $('#err_change_password').css('color', 'green');
                            $('#client_change_password')[0].reset();
                            Swal.fire(
                                'Change Password',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.reload();
                                // window.location.href = base_url + "dashboard";
                            });

                        } else {
                            spinner.hide();
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
                                $('#err_change_password').html(data.message).focus();
                                $('#err_change_password').css('color', 'red');
                                Swal.fire(
                                    'Change Password',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#err_change_password').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'Change Password Error',
                            "Something went wrong . please try again once",
                            'error'
                        );
                        $('#err_change_password').html("Something went wrong . please try again once").focus();
                        $('#err_change_password').css('color', 'red');
                        setTimeout(function() {
                            $('#err_change_password').html('');
                        }, 3000);

                    }
                });
            }
        });

    });
</script>