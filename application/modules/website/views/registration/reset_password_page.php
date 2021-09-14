<style>
    .input-group-addon:last-child {
        border-left: 0px !important;
    }

    .input-group-addon,
    .input-group-btn {
        width: 1% !important;
        white-space: nowrap !important;
        vertical-align: middle !important;
    }

    .input-group-addon {
    border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px !important;
}

    .fafaicon {
        font-size: 24px !important;
    }
  .input-group .form-control.error {
    width: 80% !important;
}
.signup_section .input-group-addon {
    padding: 8px 40px !important;
}
</style>

<div class="container signup_section">
    <div class="row">

        <?php
        if (!empty($client_id)) { ?>
            <form method="POST" class="signup_form login_form_custom" action="<?php echo base_url("update-user-password"); ?>" enctype="multipart/form-data" id="update_forget_password_form">
<input type="hidden" name="user_id" value="<?php echo $client_id; ?>">
                <h2 class="heading_custom text-center">Reset Password</h2>
                <div class="loader"></div>
                <span id="success_message_update_password" class="success_message_update_password" style="font-size:20px;"></span>
                <div class="row">
                    <div class="col">
                        
                        <div class="input-group show_hide_confirm_password">
                    <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash fafaicon" aria-hidden="true"></i></a>
                        </div>
                       <input type="password" name="update_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password*" required>
                   
                    </div>
                          </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group show_hide_confirm_password" id="show_hide_confirm_password">
                    <div class="input-group-addon psh">
                            <a><i class="fa fa-eye-slash fafaicon" aria-hidden="true"></i></a>
                        </div>
                        <input type="password" name="update_confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Enter confirm password*" placeholder="Password" required>
                   
                        
                    </div>
                         </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn form_button">Login</button>
                    </div>
                </div>
                <a href="forgot-password.html" class="forget_password">Forgot your password?</a>
                <span href="#" class="sign_up_link">Not a member? <a href="register.html">Sign Up</a> </span>

            </form>
        <?php } else { ?>
            <div class="signup_form login_form_custom">
                <span style="color:black;font-size: 16px;font-weight: bold;">Sorry This Link Expire Plesae Try Again !!!</span><br />
                <div class="">
                    <a href="<?= base_url() ?>" class="btn btn-block custom_btn btn-lg font-weight-medium"> Back to Login</a><br />
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        // change password
        $("#update_forget_password_form").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#update_forget_password_form')[0];
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
                            $('#success_message_update_password').html(data.message).focus();
                            $('#success_message_update_password').css('color', 'green');
                            $('#update_forget_password_form')[0].reset();
                            Swal.fire(
                                'Change Password',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = base_url;
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
                                $('#success_message_update_password').html(data.message).focus();
                                $('#success_message_update_password').css('color', 'red');
                                Swal.fire(
                                    'Change Password',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#success_message_update_password').html('');
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
                        $('#success_message_update_password').html("Something went wrong . please try again once").focus();
                        $('#success_message_update_password').css('color', 'red');
                        setTimeout(function() {
                            $('#success_message_update_password').html('');
                        }, 3000);

                    }
                });
            }
        });

    });
</script>