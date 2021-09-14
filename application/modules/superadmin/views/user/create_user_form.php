<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
    /* .content-wrapper {
        width: 50% !important;
    } */

    .password {
        border: 1px solid #e57574;
    }
    /*#loader {*/
    /*    display: none;*/
    /*    position: fixed;*/
    /*    top: 0;*/
    /*    left: 0;*/
    /*    right: 0;*/
    /*    bottom: 0;*/
    /*    width: 100%;*/
    /*     background: rgba(0,0,0,0.75) url(<?php echo base_url("assets/load.gif")?>) no-repeat center center;*/
    /*    z-index: 10000;*/
    /*}*/
</style>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-5">Create User:</h3>
            <div id="loader"></div>
            <span id="success_message" class="success_message" style="font-size:20px;"></span>
           
            <form method="POST" id="create_user" action="<?php echo base_url("superadmin/user/user-information-update"); ?>" enctype="multipart/form-data">
               
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="first_name">First Name </label>
                    <div class="col-sm-9">
                    <?php if (!empty($user_list->user_registration_number)) { ?>
                            <input type="hidden" name="user_id" value="<?php echo $user_list->user_registration_number; ?>">
                        <?php } ?>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo !empty($user_list->user_first_name) ? $user_list->user_first_name : '' ?>" placeholder="Enter User Name" required />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="last_name">Last name</label>
                    <div class="col-sm-9">
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo !empty($user_list->user_last_name) ? $user_list->user_last_name : '' ?>" placeholder="Enter User Name" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="company">Comapny</label>
                    <div class="col-sm-9">
                        <input type="text" name="company" id="company" class="form-control" value="<?php echo !empty($user_list->user_company) ? $user_list->user_company : '' ?>" placeholder="Enter User Name" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo !empty($user_list->user_email) ? $user_list->user_email : '' ?>" placeholder="Enter Email" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                    <div class="col-sm-9">
                        <input type="number" name="phone" id="phone" class="form-control" value="<?php echo !empty($user_list->user_phone) ? $user_list->user_phone : '' ?>" placeholder="Enter Mobile number" required />
                    </div>
                </div>
                
                <?php if(empty($user_list->user_password)){ ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="old_password" value="<?php echo !empty($user_list->user_password) ? $this->encryption->decrypt($user_list->user_password) : '' ?>">
                        <div class="input-group password" id="show_hide_password">
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo !empty($user_list->gmc_u_password) ? $this->encryption->decrypt($user_list->gmc_u_password) : '' ?>" placeholder="Enter Password" required />
                            <span class="input-group-btn">
                                <a href="" class="btn btn-default reveal"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="confirm_password">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="text" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo !empty($user_list->user_password) ? $this->encryption->decrypt($user_list->user_password) : '' ?>" placeholder="Enter Confirm Password" required />
                    </div>
                </div>
                <?php } ?>
                
                

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="profile_pic">Profile Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="user_profile_image" id="user_profile_image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                            <div id="refresh_div">
                                <ul>
                                    <?php
                                    if (!empty($user_list->user_profile_image)) {
                                    ?>
                                        <li>
                                            <img src="<?php echo base_url() ?>uploads/user/<?php echo $user_list->user_profile_image ?>" alt="">
                                            <span class="remove_gallery_item_icon " onclick="page_delete('<?php echo $user_list->user_registration_number ?>')">
                                                <i class="fa fa-remove"></i>
                                            </span>


                                        </li>
                                    <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9 d-flex">
                        <select class="form-control" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div id="radio_error"></div>
                </div>

                <div class="text-right mt-3">
                    <input type="submit" value="Submit" class="btn custom_btn mr-2">
                    <span class="btn btn-light" onclick="history.back()">Cancel</span>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
    $(function() {
        $('#user_name').on('keypress', function(e) {
            $(".user_name_space").remove();
            if (e.which == 32) {
                $("#user_name").after("<span class='user_name_space' style='color:red'>Blank space not allowed</span>");
                console.log('Space Detected');
                return false;
            }
        });
    });
    $(document).ready(function() {
        var spinner = $('#loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#create_user").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#create_user')[0];
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
                            $('#success_message').html(data.message).focus();
                            $('#success_message').css('color', 'green');
                            $('#create_user')[0].reset();
                            Swal.fire(
                                'User Management',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = base_url + "superadmin/user/user_list";
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

                                $('#success_message').html(data.message).focus();
                                $('#success_message').css('color', 'red');
                                Swal.fire(
                                    'User Management ',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#success_message').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'User Create Error',
                            "Something went wrong . please try again once",
                            'warning'
                        );
                        $('#success_message').html("Something went wrong . please try again once").focus();
                        $('#success_message').css('color', 'red');
                        setTimeout(function() {
                            $('#success_message').html('');
                        }, 3000);

                    }
                });
            }
        });
    });
</script>