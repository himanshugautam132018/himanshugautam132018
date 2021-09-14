<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-5">Create Slider:</h3>
            <div id="create_slider_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
            <span class="" id="err_create_slider"></span>
            <form method="POST" id="create_slider" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_title">Slider Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="slider_title" id="slider_title" class="form-control"  placeholder="enter Slider title"/>
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_decription">Slider Description</label>
                    <div class="col-sm-9">
                        <textarea name="slider_decription" id="slider_decription" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="enter slider Description" ></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_image">slider Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="slider_image" id="slider_image"
                               class="file-upload-default"  >
                        <div class="input-group col-xs-12">
                            <input type="text"
                                   class="form-control file-upload-info"
                                   disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info"
                                        type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9 d-flex">
                        <div class="form-radio mr-4">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="slider_status" id="slider_status_active" checked value="1">
                                Active
                                <i class="input-helper"></i></label>
                        </div>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="slider_status" id="slider_status_inactive" value="0">
                                Inactive
                                <i class="input-helper"></i></label>
                        </div>
                    </div> 
                    <div id="radio_error"></div>
                </div>

                <div class="text-right mt-3">
                    <input type="submit" value="Submit" class="btn custom_btn mr-2">
                    <span class="btn btn-light"
                          onclick="history.back()">Cancel</span>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $('#create_slider').on('submit', function (e) {
        e.preventDefault();
        $(".error").remove();
        var slider_title = $("#slider_title").val();
//        var slider_decription = $("#slider_decription").val();
        var slider_decription = tinymce.get("slider_decription").getContent();
        var slider_image = $('#slider_image')[0].files[0];
        if (slider_title == '' || slider_title == null) {
            $("#slider_title").after("<span class='error' style='color:red'>Please enter Title</span>").focus();
            return false;
        }
        
        if (slider_decription == '' || slider_decription == null) {
            $("#slider_decription").after("<span class='error' style='color:red'>Please enter  description</span>").focus();
            return false;
        }
        if (!slider_image) {
            $("#slider_image").after("<span class='error' style='color:red'>Please upload slider image</span>").focus();
            return false;
        } else {
            var form = $('#create_slider')[0];
            var formData = new FormData(form);
             formData.append('slider_decription', tinymce.get("slider_decription").getContent());
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/slider-details-save",
                method: "POST",
                data: formData,
                beforeSend: function () {
                    $("#create_slider").css("opacity", 0.2);
                    $("#create_slider_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (res)
                {
                    $("#create_slider_loaderID").hide();
                    $("#create_slider").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#create_slider')[0].reset();
                        $('#err_create_slider').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function () {
                            window.location.href = '<?php echo base_url('superadmin/slider'); ?>';
                        }, 2000);
                    } else {
                        $("#create_slider_loaderID").hide();
                        $("#create_slider").css("opacity", 1.0);
                        $('#err_create_slider').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#err_create_slider').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#create_slider_loaderID").hide();
                    $("#create_slider").css("opacity", 1.0);
                }
            });
        }


    });


</script>
