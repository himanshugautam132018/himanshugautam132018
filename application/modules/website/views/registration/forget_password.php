<div class="container signup_section">
    <div class="row">
    <form method="POST" class="signup_form" id="forget_password_form" action="<?php echo base_url("reset-password"); ?>" enctype="multipart/form-data">
    <h2 class="heading_custom text-center">Reset Password</h2>

            <div class="row">
                <div class="col-12">
                    <input type="email" name="forget_email" class="form-control" id="forget_email" aria-describedby="emailHelp" placeholder="Registered email address" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn form_button">Reset Password</button>
                </div>
            </div>
            <span  class="sign_up_link">Not a member? <a href="<?php echo base_url("signup") ?>">Sign Up</a> </span>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#forget_password_form").validate({
            submitHandler: function(form) {
                $(".error").remove();

                var formId = $('#forget_password_form')[0];
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
                            $('#forget_password_form')[0].reset();
                            Swal.fire(
                                'forget password',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url() ?>";
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
                                Swal.fire(
                                    'forget password',
                                    data.message,
                                    'warning'
                                );

                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'forget password',
                            '<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>',
                            'error'
                        );


                    }
                });
            }
        });
    });
</script>