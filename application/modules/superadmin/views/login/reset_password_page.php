<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
  .auth form .form-group label {
    height: 67% !important;
  }
  label#sa_password-error {
    display: block !important;
    position: unset !important;
    text-align: left;
    width: 100% !important;
    background: none !important;
  }
  label#sa_confirm_password-error {
    display: block !important;
    position: unset !important;
    text-align: left;
    width: 100% !important;
    background: none !important;
  }
  .auth form .form-group label:first-child {
    position: absolute;
    top: 0;
    left: 0;
    width: 45px;
    height: 47px !important;
    background: rgba(229, 117, 116, 0.25);
    text-align: center;
    border-radius: 4px 0 0 4px;
    border-right: 1px solid rgba(229, 117, 116, 0.7);
  }

  .sup {
    color: red;
    font-size: 20px;
  }

  .error {
    color: red;
    font-size: 15px; 
    text-align: left !important;
    display: block !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 10px !important;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row w-100 h-100 no-gutters align-items-center">

        <div class="col-lg-12 auth-half-content">
          <div class="row h-100 align-items-center">
            <div class="col-lg-8 offset-lg-2">
              <div class="text-left p-5 login_form_admin">
                <img src="<?php echo base_url() ?>backend/assets/images/logo.png" alt="">
                <h2>Reset Password</h2>
                <!--<span>Reset Password</span>-->
                <div id="loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>

                <span class="project_content" id="err-msg"></span>
                <?php
                if (!empty($admin_id)) { ?>
                  <div class="loader"></div>
                  <span id="success_message_update_password" class="success_message_update_password" style="font-size:20px;"></span>
                  <form class="pt-5" method="POST" action="<?php echo base_url('superadmin/superadmin-password-update'); ?>" id="update_forget_password_form" >
                    <div class="form-group">
                      <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                      <label for="sa_password"><i class="fa fa-envelope"></i></label>
                      <input type="password" class="form-control" name="sa_password" id="sa_password" placeholder="Password" required>

                      <!--<input type="email" class="form-control" id="email" name="email" placeholder="Email ID" required>                      -->
                    </div>
                    <div class="form-group">
                      <label for="sa_confirm_password"><i class="fa fa-lock"></i></label>
                      <input type="password" class="form-control" name="sa_confirm_password" id="sa_confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="">
                      <input type="submit" value="Login" class="btn btn-block custom_btn btn-lg font-weight-medium">
                    </div>

                  </form>
                <?php } else { ?>
                  <span style="color:black;font-size: 16px;font-weight: bold;">Sorry This Link Expire Plesae Try Again !!!</span><br />
                  <!--<p class="register">Back<a href="<?= base_url() ?>">Login</a> </p></h4>-->
                  <div class="">
                    <a href="<?= base_url() ?>" class="btn btn-block custom_btn btn-lg font-weight-medium"> Back to Login</a><br />
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->
<!-- plugins:js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
                window.location.href = "<?php echo base_url('superadmin')?>";
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