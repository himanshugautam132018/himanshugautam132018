<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
    sup {
        color: red !important;
        position: initial;
        font-size: 20px;
    }
</style>

<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-5">Permit Calculatiuon:</h3>
            <div class="wrapper">

                <div id="loader"></div>
                <span id="success_message" class="success_message" style="font-size:20px;"></span>

                <form method="POST" id="create_permit_calculation" action="<?php echo base_url("superadmin/permit/create_update_permit_type12"); ?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name">select state <sup>*</sup></label>
                            <select name="state_id" id="state_id" class="form-control">
                                <?php
                                if (!empty($state_list)) {
                                    foreach ($state_list as $s_list) { ?>

                                        <option value="<?php echo $s_list['state_id']; ?>"><?php echo $s_list['state_name'] . " (" . $s_list['state_code'] . ")"; ?></option>
                                    <?php }
                                } else { ?>

                                    <option value="">Please firsly add State </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="name">Select Permit Type <sup>*</sup></label>
                            <select name="permit_type_id" id="permit_type_id" class="form-control">
                                <?php
                                if (!empty($permit_type)) {
                                    foreach ($permit_type as $p_type) { ?>

                                        <option value="<?php echo $p_type['permit_id']; ?>"><?php echo $p_type['permit_type']; ?></option>
                                    <?php }
                                } else { ?>

                                    <option value="">Please firsly add Permit Type </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Width limit (ft)</label>
                            <input type="text" class="form-control" id="width_limit_ft" name="width_limit_ft" value="<?php echo !empty($permit_calculation->xcp_width_limit_ft) ? $permit_calculation->xcp_width_limit_ft : '' ?>" placeholder="Width limit (ft)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Width Rule Operator</label>
                            <select name="width_rule_operator" id="width_rule_operator" class="form-control">
                                <option value=">"> > </option>
                                <option value="<">
                                    < </option>
                                <option value=">="> >= </option>
                                <option value="<=">
                                    <= </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Height limit (ft)</label>
                            <input type="text" class="form-control" id="height_limit_ft" name="height_limit_ft" value="<?php echo !empty($permit_calculation->xcp_height_limit_ft) ? $permit_calculation->xcp_height_limit_ft : '' ?>" placeholder="Height limit (ft)">

                        </div>


                    </div>




                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="name">Height Rule Operator</label>
                            <select name="height_rule_operator" id="height_rule_operator" class="form-control">
                                <option value=">"> > </option>
                                <option value="<">
                                    < </option>
                                <option value=">="> >= </option>
                                <option value="<=">
                                    <= </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Length limit (ft)</label>
                            <input type="text" class="form-control" id="length_limit_ft" name="length_limit_ft" value="<?php echo !empty($permit_calculation->xcp_length_limit_ft) ? $permit_calculation->xcp_length_limit_ft : '' ?>" placeholder="Length limit (ft)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Length limit Operator</label>
                            <select name="length_limit_operator" id="length_limit_operator" class="form-control">
                                <option value=">"> > </option>
                                <option value="<">
                                    < </option>
                                <option value=">="> >= </option>
                                <option value="<=">
                                    <= </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Front Overhang (ft)</label>
                            <input type="text" class="form-control" id="front_overhang_ft" name="front_overhang_ft" value="<?php echo !empty($permit_calculation->xcp_front_overhang_ft) ? $permit_calculation->xcp_front_overhang_ft : '' ?>" placeholder="Front Overhang (ft)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">Rear Overhang (ft)</label>
                            <input type="text" class="form-control" id="rear_overhang_ft" name="rear_overhang_ft" value="<?php echo !empty($permit_calculation->xcp_rear_overhang_ft) ? $permit_calculation->xcp_rear_overhang_ft : '' ?>" placeholder="Rear Overhang (ft)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Steer Axle (lb)</label>
                            <input type="text" class="form-control" id="steer_axle_lb" name="steer_axle_lb" value="<?php echo !empty($permit_calculation->xcp_steer_axle_lb) ? $permit_calculation->xcp_steer_axle_lb : '' ?>" placeholder="Steer Axle (lb)">

                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="name">Steer Axle (lb/in)</label>
                            <input type="text" class="form-control" id="steer_axle_lb_in" name="steer_axle_lb_in" value="<?php echo !empty($permit_calculation->xcp_steer_axle_lb_in) ? $permit_calculation->xcp_steer_axle_lb_in : '' ?>" placeholder="Steer Axle (lb/in)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Single Axle (lb)</label>
                            <input type="text" class="form-control" id="single_axle_lb" name="single_axle_lb" value="<?php echo !empty($permit_calculation->xcp_single_axle_lb) ? $permit_calculation->xcp_single_axle_lb : '' ?>" placeholder="Single Axle (lb)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Single Axle (lb/in)</label>
                            <input type="text" class="form-control" id="single_axle_lb_in" name="single_axle_lb_in" value="<?php echo !empty($permit_calculation->xcp_single_axle_lb_in) ? $permit_calculation->xcp_single_axle_lb_in : '' ?>" placeholder="Single Axle (lb/in)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">Axle Width (ft)</label>
                            <input type="text" class="form-control" id="axle_width_ft" name="axle_width_ft" value="<?php echo !empty($permit_calculation->xcp_axle_width_ft) ? $permit_calculation->xcp_axle_width_ft : '' ?>" placeholder="Axle Width (ft)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Select Axle Width operator</label>
                            <select name="axle_width_operator" id="axle_width_operator" class="form-control">
                                <option value=">"> > </option>
                                <option value="<">
                                    < </option>
                                <option value=">="> >= </option>
                                <option value="<=">
                                    <= </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="name">Tandem (lb)</label>
                            <input type="text" class="form-control" id="tandem_lb" name="tandem_lb" value="<?php echo !empty($permit_calculation->xcp_tandem_lb) ? $permit_calculation->xcp_tandem_lb : '' ?>" placeholder="Tandem (lb)">

                        </div>



                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="name">Tandem(lb/in)</label>
                            <input type="text" class="form-control" id="tandem_lb_in" name="tandem_lb_in" value="<?php echo !empty($permit_calculation->xcp_tandem_lb_in) ? $permit_calculation->xcp_tandem_lb_in : '' ?>" placeholder="Tandem(lb/in)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">Tridem (lb)</label>
                            <input type="text" class="form-control" id="tridem_lb" name="tridem_lb" value="<?php echo !empty($permit_calculation->xcp_tridem_lb) ? $permit_calculation->xcp_tridem_lb : '' ?>" placeholder="Tridem (lb)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">Quad (lb)</label>
                            <input type="text" class="form-control" id="quad_lb" name="quad_lb" value="<?php echo !empty($permit_calculation->xcp_quad_lb) ? $permit_calculation->xcp_quad_lb : '' ?>" placeholder="Quad (lb)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">Quad (lb/in)</label>
                            <input type="text" class="form-control" id="quad_lb_in" name="quad_lb_in" value="<?php echo !empty($permit_calculation->xcp_quad_lb_in) ? $permit_calculation->xcp_quad_lb_in : '' ?>" placeholder="Quad (lb/in)">

                        </div>
                        <div class="col-md-2">
                            <label for="name">5 axles (lb)</label>
                            <input type="text" class="form-control" id="5_axles_lb" name="5_axles_lb" value="<?php echo !empty($permit_calculation->xcp_5_axles_lb) ? $permit_calculation->xcp_5_axles_lb : '' ?>" placeholder="5 axles (lb)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">5 axles (lb/in)</label>
                            <input type="text" class="form-control" id="5_axles_lb_in" name="5_axles_lb_in" value="<?php echo !empty($permit_calculation->xcp_5_axles_lb_in) ? $permit_calculation->xcp_5_axles_lb_in : '' ?>" placeholder="5 axles (lb/in)">

                        </div>



                    </div>



                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="name">GVW (lb)</label>
                            <input type="text" class="form-control" id="gvw" name="gvw" value="<?php echo !empty($permit_calculation->xcp_gvw) ? $permit_calculation->xcp_gvw : '' ?>" placeholder="GVW (lb)">

                        </div>

                        <div class="col-md-2">
                            <label for="name">GVW Operator</label>
                            <select name="gvw_operator" id="gvw_operator" class="form-control">
                                <option value=">"> > </option>
                                <option value="<">
                                    < </option>
                                <option value=">="> >= </option>
                                <option value="<=">
                                    <= </option>

                            </select>
                        </div>




                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="name">Notes: </label>
                            <textarea name="noted" id="noted" cols="30" rows="10" class="form-control" placeholder="Notes"></textarea>

                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="window.history.back();">Cancel</a>
                    </div>

                </form>




            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var spinner = $('#loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#create_permit_calculation").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#create_permit_calculation')[0];
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
                            $('#create_permit_calculation')[0].reset();
                            Swal.fire(
                                'Permit Calculation',
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
                                    'Permit Calculation ',
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
                            'Permit Calculation Error',
                            "<div class='alert alert-danger'>Something went wrong . please try again once</div>",
                            'error'
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