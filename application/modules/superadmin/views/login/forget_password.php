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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/custom.css">



  <!-- <link rel="shortcut icon" href="images/favicon.png" /> -->
  <style>
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

    label#email_id-error {
      display: block !important;
      position: unset !important;
      text-align: left;
      width: 100%;
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
                  <h2>Reset Password</h2>
                  <span>Enter your registered Email ID. <br> We will send a link to your registered Email.</span>
                  <div class="loader"></div>
                  <span id="admin_forget_message" class="signup_message" style="font-size:20px;"></span>
                  <form class="pt-5" id="forget_password_form" method="POST" action="<?= base_url('superadmin/forget-link') ?>">
                    <!--<form class="pt-5"  id="admin-forget-form" action="">-->
                    <div class="form-group">
                      <label for="email_id"><i class="fa fa-envelope"></i></label>
                      <input type="email" class="form-control" name="forget_admin_email" id="email_id" placeholder="Email ID">
                    </div>
                    <div class="mt-1 mb-3">
                      <input type="submit" value="Submit" class="btn btn-block custom_btn btn-lg font-weight-medium">
                    </div>
                    <div class="text-center">
                      <a href="<?php echo base_url("superadmin") ?>" class="auth-link">Sign in using a different account</a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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

  <script src="<?php echo base_url() ?>assets/js/tooltips.js"></script>
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