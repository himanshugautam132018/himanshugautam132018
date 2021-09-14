<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>

  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/jquery-bar-rating/css-stars.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/custom.css">



  <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->

  <script src="<?php echo base_url() ?>backend/assets/vendors/js/vendor.bundle.base.js"></script>
<style>
  .authform .form-group label {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 45px !important;
    height: 47px !important;
    background: rgba(229, 117, 116, 0.25) !important;
    text-align: center !important;
    border-radius: 4px 0 0 4px !important;
    border-right: 1px solid rgba(229, 117, 116, 0.7) !important;
}
.error{
  font-size: 15px !important;
    text-align: left !important;
    display: block !important;
}
</style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100 h-100 no-gutters align-items-center">
          
          <div class="col-lg-12 auth-half-content">
            <div class="row h-100 align-items-center">

              <div class="col-lg-8 offset-lg-2">

                <div class="text-left p-5 login_form_admin">
                  <img src="<?php echo base_url() ?>backend/assets/images/logo.png" alt="">
                  <h2>Login</h2>
                  <!-- <span>Sign In to your account</span> -->

                  <div id="loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>backend/assets/load.gif" /></div>
                  <span class="project_content" id="err-msg1"></span>
                  <form class="pt-5 authform" action="" id="superadmin_login_form" data-action="<?php echo base_url('superadmin/authenticate'); ?>" method="post">
                    <div class="form-group">
                      <label for="email"><i class="fa fa-envelope"></i></label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email ID">
                    </div>
                    <div class="form-group">
                      <label for="password"><i class="fa fa-lock"></i></label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                    </div>
                    <div class="mt-5 mb-2">
                      <a href="<?php echo base_url('superadmin/forget-password') ?>" class="auth-link">Forgot password?</a>
                    </div>
                    <div class="">
                      <input type="submit" value="Login" class="btn btn-block custom_btn btn-lg font-weight-medium">
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
    function validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    $(document).on('submit', '#superadmin_login_form', function(e) {
      e.preventDefault();
      $(".error").remove();
      var formdata = $(this).serialize();
      var url = $(this).attr('data-action');
      var email = $("#email").val();
      var password = $("#password").val();
      if (email == "") {
        $("#email").after('<span class="error" style="color:red">Please Enter Your Email </span>').focus();
        return false;
      } else {
        var regEx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
          $('#email').after('<span span class="error" style="color:red">Please Enter a valid email</span>');
          return false;
        }
      }
      if (password == "") {
        $("#password").after('<span class="error" style="color:red">Please Enter Your Password </span>').focus();
        return false;
      }
      $.ajax({
        type: "POST",
        url: url,
        data: formdata,
        beforeSend: function() {
          $("#superadmin_login_form").css("opacity", 0.2);
          $("#loaderID").show();
        },
        success: function(res) {

          var data = JSON.parse(res);
          $("#loaderID").hide();
          $("#superadmin_login_form").css("opacity", 1.0);
          if (data.success) {
            $('#err-msg1').html("<div class='alert alert-success' role='alert'>Login Successfully </div>").css({
              "display": "block",
              "font-weight": "600",
              "text-align": "center"
            });
            // $('#superadmin_login_form').hide();
            setTimeout(function() {
              // alert('successfully login');
              window.location.href = '<?php echo base_url('superadmin/dashboard'); ?>';
            }, 1000);
          } else {
            $('#err-msg1').html('<div class="alert alert-danger" role="alert">' + data.message + '</div>').css({
              "color": "black",
              "font-weight": "bold"
            });
          }

        },
        error: function(xhr, ajaxOptions, thrownError) {
          // swal("Error deleting!", "Please try again", "error");
          $('#err-msg1').html('<div class="alert alert-danger" role="alert">Something went wrong ,please try again!! </div>').focus();
          $("#superadmin_login_form").css("opacity", 1.0);
          $("#loaderID").hide();

        }
      });
    });
  </script>

  <script src="<?php echo base_url() ?>backend/assets/js/tooltips.js"></script>
  <!-- <script src="assets/vendors/js/vendor.bundle.base.js"></script> -->
  <script src="<?php echo base_url() ?>backend/assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/vendors/chart.js/Chart.min.js"></script>

  <script src="<?php echo base_url() ?>backend/assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/misc.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/jquery-ui.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/data-table.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/file-upload.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/apexcharts.js"></script>
  <script src="<?php echo base_url() ?>backend/assets/js/custom.js"></script>

</body>

</html>