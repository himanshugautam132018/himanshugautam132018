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
            <h3 class="card-title mb-5">Create State:</h3>
            <div id="loader"></div>
            <span id="success_message" class="success_message" style="font-size:20px;"></span>
           
            <form method="POST" id="create_state" action="<?php echo base_url("superadmin/state/create_update_state"); ?>" enctype="multipart/form-data">
               
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="state_code">State Code</label>
                    <div class="col-sm-9">
                    <?php if (!empty($state_list->state_id)) { ?>
                            <input type="hidden" name="state_id" value="<?php echo $state_list->state_id; ?>">
                        <?php } ?>
                        <input type="text" name="state_code" id="state_code" class="form-control" value="<?php echo !empty($state_list->state_code) ? $state_list->state_code : '' ?>" placeholder="Enter State Code" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="state_name">State Name</label>
                    <div class="col-sm-9">
                    <input type="text" name="state_name" id="state_name" class="form-control" value="<?php echo !empty($state_list->state_name) ? $state_list->state_name : '' ?>" placeholder="Enter State Name" required />
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9 d-flex">
                        <select class="form-control" name="state_status" id="state_status">
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
        $("#create_state").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#create_state')[0];
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
                            $('#create_state')[0].reset();
                            Swal.fire(
                                'State Management',
                                data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = base_url + "superadmin/permit/state";
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
                                    'State Management ',
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
                            'State Error',
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