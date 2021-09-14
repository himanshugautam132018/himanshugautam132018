<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
    .tab-solid-primary .nav-link.active {
        background: #e57574 !important;
    }
</style>
<div class="content-wrapper">
    <div class="row user-profile">
        <div class="col-lg-4  align-items-stretch">


            <div class="card">
                <div class="card-body avatar">
                    <h4 class="card-title">Info</h4>
                    <?php
                    $image_src = !empty($account_manager_profile->sa_picture) ? base_url() . "uploads/admin/" . $account_manager_profile->sa_picture :
                        base_url() . "assets/images/default_logo.png";
                    ?>
                    <img src="<?php echo $image_src; ?>" alt="" style="max-width: 240px;margin-left: 93px;">
                    <p class="d-block text-center text-dark"></p>
                    <a class="d-block text-center text-dark" href="#"><?php echo !empty($account_manager_profile->sa_name) ? $account_manager_profile->sa_name : 'Koala Pre Nursery ' ?></a>
                    <a class="d-block text-center text-dark" href="#"><?php echo !empty($account_manager_profile->sa_email) ? $account_manager_profile->sa_email : 'info@koalanursery.com.qa ' ?></a>
                    <a class="d-block text-center text-dark" href="#"> <?php echo !empty($account_manager_profile->sa_phone) ? $account_manager_profile->sa_phone : '00974 44918811' ?></a>
                </div>
            </div>


        </div>
        <div class="col-lg-8 side-right stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Details</h4>
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
                                <div id="addmin_profile_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
                                <span class="" id="err_addmin_profile"></span>
                                <form method="POST" id="addmin_profile" action="" enctype="multipart/form-data">
                                    <div class="wrapper mb-2">
                                        <span class="badge text-danger">Note : </span>
                                        <p class="d-inline ml-3 text-muted">Image size is limited to not greater than 2MB .</p>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" class="dropify" data-max-file-size="1mb" data-default-file="<?php echo base_url() ?>assets/images/user-avatar.jpg" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="hidden" id="superadmin_id" name="superadmin_id" value="<?php echo !empty($account_manager_profile->sa_id) ? $account_manager_profile->sa_id : '' ?>" />
                                        <input type="text" class="form-control" id="sa_name" name="sa_name" value="<?php echo !empty($account_manager_profile->sa_name) ? $account_manager_profile->sa_name : '' ?>" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="number" class="form-control" id="sa_phone" name="sa_phone" value="<?php echo !empty($account_manager_profile->sa_phone) ? $account_manager_profile->sa_phone : '' ?>" placeholder="mobile number">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="sa_email" name="sa_email" value="<?php echo !empty($account_manager_profile->sa_email) ? $account_manager_profile->sa_email : '' ?>" placeholder="email address">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="sa_address" name="sa_address" rows="6" class="form-control" placeholder="Change address"><?php echo !empty($account_manager_profile->sa_address) ? $account_manager_profile->sa_address : '' ?></textarea>
                                    </div>

                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-success mr-2">Update</button>
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="window.history.back();">Cancel</a>
                                    </div>

                                </form>
                            </div><!-- tab content ends -->


                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <div id="change_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
                                <span class="err_change_password" id="err_change_password"></span>
                                <form method="post" class="forms-sample" id="admin_change_password">
                                    <div class="form-group">
                                        <label for="change-password"> password</label>
                                        <input type="hidden" id="sa_id" name="sa_id" value="<?php echo !empty($account_manager_profile->sa_id) ? $account_manager_profile->sa_id : '' ?>" />

                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter you current password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter you new password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="cnew_password" id="cnew_password" placeholder="Enter confirm password">
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
<script>
    $('#addmin_profile').on('submit', function(e) {
        e.preventDefault();
        $(".error").remove();
        var sa_name = $("#sa_name").val();
        var sa_phone = $("#sa_phone").val();
        var sa_email = $("#sa_email").val();
        var sa_address = $("#sa_address").val();
        if (sa_name == '' || sa_name == null) {
            $("#sa_name").after("<span class='error' style='color:red'>Please enter your name</span>").focus();
            return false;
        }

        if (sa_phone == '' || sa_phone == null) {
            $("#sa_phone").after("<span class='error' style='color:red'>Please enter Your Mobile Number</span>").focus();
            return false;
        }

        if (sa_email == '' || sa_email == null) {
            $("#sa_email").after("<span class='error' style='color:red'>Please enter Your Email</span>").focus();
            return false;
        }
        if (sa_address == '' || sa_address == null) {
            $("#sa_address").after("<span class='error' style='color:red'>Please enter your Address </span>").focus();
            return false;
        } else {
            var form = $('#addmin_profile')[0];
            var formData = new FormData(form);
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/update-setting",
                method: "POST",
                data: formData,
                beforeSend: function() {
                    $("#addmin_profile").css("opacity", 0.2);
                    $("#addmin_profile_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    $("#addmin_profile_loaderID").hide();
                    $("#addmin_profile").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#addmin_profile')[0].reset();
                        $('#err_addmin_profile').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $("#addmin_profile_loaderID").hide();
                        $("#addmin_profile").css("opacity", 1.0);
                        $('#err_addmin_profile').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#err_addmin_profile').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#addmin_profile_loaderID").hide();
                    $("#addmin_profile").css("opacity", 1.0);
                }
            });
        }


    });
</script>
<script>
    $('#admin_change_password').on('submit', function(e) {
        e.preventDefault();
        $(".error").remove();
        var current_password = $("#current_password").val();
        var new_password = $("#new_password").val();
        var cnew_password = $("#cnew_password").val();
        if (current_password == '' || current_password == null) {
            $("#current_password").after("<span class='error' style='color:red'>Please enter your Current Password</span>").focus();
            return false;
        }

        if (new_password == '' || new_password == null) {
            $("#new_password").after("<span class='error' style='color:red'>Please enter New password</span>").focus();
            return false;
        }

        if (cnew_password == '' || cnew_password == null) {
            $("#cnew_password").after("<span class='error' style='color:red'>Please enter Confirm password</span>").focus();
            return false;
        }
        if (new_password != cnew_password) {
            $("#cnew_password").after("<span class='error' style='color:red'>New Password and Confirm password should be same </span>").focus();
            return false;
        } else {
            var form = $('#admin_change_password')[0];
            var formData = new FormData(form);
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/change-password",
                method: "POST",
                data: formData,
                beforeSend: function() {
                    $("#admin_change_password").css("opacity", 0.2);
                    $("#change_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    $("#change_loaderID").hide();
                    $("#admin_change_password").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#admin_change_password')[0].reset();
                        $('#err_change_password').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $("#change_loaderID").hide();
                        $("#admin_change_password").css("opacity", 1.0);
                        $('#err_change_password').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#err_change_password').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#change_loaderID").hide();
                    $("#admin_change_password").css("opacity", 1.0);
                }
            });
        }


    });
</script>