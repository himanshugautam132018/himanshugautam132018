<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- <style>
    img {
        height: 200px !important;
        width: 200px !important;
    }
</style> -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-5">Footer Setting:</h2>


            <h3 class="mb-5">About us:</h3>
            <div id="edit_footer_setting_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
            <span class="" id="err_edit_footer_setting"></span>
            <form method="POST" id="edit_footer_setting" action="" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo !empty($footer_setting->id) ? $footer_setting->id : ''; ?>" name="id" />
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="aboutus_title">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="aboutus_title" value="<?php echo !empty($footer_setting->aboutus_title) ? $footer_setting->aboutus_title : ''; ?>" id="aboutus_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="logo_image">Logo Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="logo_image" id="logo_image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                            <ul>
                                <?php
                                if (!empty($footer_setting->logo_image)) {

                                ?>
                                    <li>
                                        <img src="<?php echo base_url() ?>uploads/footer_setting/<?php echo $footer_setting->logo_image ?>" alt="">
                                    </li>
                                <?php

                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_decription">Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"><?php echo !empty($footer_setting->description) ? $footer_setting->description : ''; ?></textarea>
                    </div>
                </div>
             <h3 class="mb-5">Contact Us Details</h3>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <div class="col-sm-9">
                        <input type="text" id="email" name="email" value="<?php echo !empty($footer_setting->email) ? $footer_setting->email : ''; ?>" id="email" class="form-control" placeholder="Enter Email" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="phone">Mobile Number </label>
                    <div class="col-sm-9">
                        <input type="text" id="phone" name="phone" value="<?php echo !empty($footer_setting->phone) ? $footer_setting->phone : ''; ?>" class="form-control" placeholder="Enter Mobile Number" />
                    </div>
                </div>

                <h3 class="mb-5">Social Media link</h3>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="twitter">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" type="url" name="twitter" value="<?php echo !empty($footer_setting->twitter) ? $footer_setting->twitter : ''; ?>" id="event_title" class="form-control" placeholder="Enter Twitter link" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="facebbok">Facebook </label>
                    <div class="col-sm-9">
                        <input name="facebbok" type="url" id="facebbok" class="form-control " placeholder="Enter Facebook link" value="<?php echo !empty($footer_setting->facebbok) ? $footer_setting->facebbok : ''; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="instagram">Instagram </label>
                    <div class="col-sm-9">
                        <input name="instagram" type="url" class="form-control " id="instagram" placeholder="Enter Facebook link" value="<?php echo !empty($footer_setting->instagram) ? $footer_setting->instagram : ''; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="dribble">Dribble </label>
                    <div class="col-sm-9">
                        <input name="dribble" type="url" class="form-control " id="dribble" placeholder="Enter dribble link" value="<?php echo !empty($footer_setting->dribble) ? $footer_setting->dribble : ''; ?>" />
                    </div>
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
    $('#edit_footer_setting').on('submit', function(e) {
        e.preventDefault();
        $(".error").remove();
        var aboutus_title = $("#aboutus_title").val();
        var aboutus_description = tinymce.get("description").getContent();
        var email = $("#email").val();
        var phone = $("#phone").val();


        if (aboutus_title == '' || aboutus_title == null) {
            $("#aboutus_title").after("<span class='error' style='color:red'>Please About us Title</span>").focus();
            return false;
        }
        if (aboutus_description == '' || aboutus_description == null) {
            $("#description").after("<span class='error' style='color:red'>Please enter  description</span>").focus();
            return false;
        }
         else {
            var form = $('#edit_footer_setting')[0];
            var formData = new FormData(form);
            formData.append('description', tinymce.get("description").getContent());
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/update-footer-details",
                method: "POST",
                data: formData,
                beforeSend: function() {
                    $("#edit_footer_setting").css("opacity", 0.2);
                    $("#edit_footer_setting_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    $("#edit_footer_setting_loaderID").hide();
                    $("#edit_footer_setting").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#edit_footer_setting')[0].reset();
                        $('#err_edit_footer_setting').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url('superadmin/footer_setting'); ?>';
                        }, 2000);
                    } else {
                        $("#edit_footer_setting_loaderID").hide();
                        $("#edit_footer_setting").css("opacity", 1.0);
                        $('#err_edit_footer_setting').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#err_edit_footer_setting').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#edit_footer_setting_loaderID").hide();
                    $("#edit_footer_setting").css("opacity", 1.0);
                }
            });
        }


    });
</script>