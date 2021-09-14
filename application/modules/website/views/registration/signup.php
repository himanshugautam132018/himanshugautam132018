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
    input.form-control.ps.error {
        width: 80% !important;
    }
    .input-group-addon {
    border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px !important;
}

    .fafaicon {
        font-size: 24px !important;
    }
</style>
<div class="container signup_section">
    <div class="row">

        <form class="signup_form" method="POST" id="User_registration" action="<?php echo base_url("registration"); ?>" enctype="multipart/form-data">
            <h2 class="heading_custom text-center">Sign Up</h2>
            <div class="loader"></div>
            <span id="signup_message" class="signup_message" style="font-size:20px;"></span>
            <div class="row">
                <div class="col">
                    <input type="text" name="first_name" class="form-control" placeholder="First name" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="last_name" placeholder="Last name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="text" name="company" class="form-control" placeholder="Company" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="email" name="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="" name="phone" aria-describedby="phoneHelp" placeholder="Phone" required>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="input-group show_hide_confirm_password" id="show_hide_confirm_password">
                    <div class="input-group-addon psh">
                            <a><i class="fa fa-eye-slash fafaicon" aria-hidden="true"></i></a>
                        </div>
                        <input class="form-control ps" type="password" name="password" placeholder="Password" required>
                        
                    </div>
                </div>
                <div class="col">
                    <div class="input-group show_hide_confirm_password">
                    <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash fafaicon" aria-hidden="true"></i></a>
                        </div>
                        <input class="form-control ps" type="password" placeholder="Confirm Password" name="confirm_password" required>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn form_button">Register</button>
                </div>
            </div>
            <span href="#" class="sign_up_link">Already have an account? <a href="#" onclick="openSideNav()">Login</a> </span>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#User_registration").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#User_registration')[0];
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
                            $('#signup_message').html(data.message).focus();
                            $('#signup_message').css('color', 'green');
                            $('#User_registration')[0].reset();
                            Swal.fire(
                                'User Registration',
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

                                $('#signup_message').html(data.message).focus();
                                $('#signup_message').css('color', 'red');
                                Swal.fire(
                                    'User Registration ',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#signup_message').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'User Registration Error',
                            "Something went wrong . please try again once",
                            'warning'
                        );
                        $('#signup_message').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>').focus();
                        $('#signup_message').css('color', 'red');
                        setTimeout(function() {
                            $('#signup_message').html('');
                        }, 5000);

                    }
                });
            }
        });
    });
</script>