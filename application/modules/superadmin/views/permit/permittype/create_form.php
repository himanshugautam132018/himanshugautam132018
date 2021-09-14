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
            <h3 class="card-title mb-5"><?php echo !empty($permit_type_list->permit_id)?"Update":"Create";?> Permit Type:</h3>
            <div id="loader"></div>
            <span id="success_message" class="success_message" style="font-size:20px;"></span>
           
            <form method="POST" id="create_permit_type" action="<?php echo base_url("superadmin/permit/create_update_permit_type"); ?>" enctype="multipart/form-data">
               
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="permit_type">Permit Type</label>
                    <div class="col-sm-9">
                    <?php if (!empty($permit_type_list->permit_id)) { ?>
                            <input type="hidden" name="permit_id" value="<?php echo $permit_type_list->permit_id; ?>">
                        <?php } ?>
                        <input type="text" name="permit_type" id="permit_type" class="form-control" value="<?php echo !empty($permit_type_list->permit_type) ? $permit_type_list->permit_type : '' ?>" placeholder="Enter Permit Type" required />
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9 d-flex">
                        <select class="form-control" name="permit_status" id="permit_status">
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
        var spinner = $('#loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#create_permit_type").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#create_permit_type')[0];
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
                            $('#create_permit_type')[0].reset();
                            Swal.fire(
                                'Permit Type',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = base_url + "superadmin/permit/permit_type";
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
                                    'Permit Type ',
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
                            'Permit type Error',
                            "Something went wrong . please try again once",
                            'warning'
                        );
                        $('#success_message').html('<div class="alert alert-danger">Something went wrong . please try again once</div>').focus();
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