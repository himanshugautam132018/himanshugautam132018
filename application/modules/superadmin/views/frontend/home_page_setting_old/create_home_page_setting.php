<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-5">Home Page Setting:</h2>


            <h3 class="mb-5">About us Section:</h3>
            <div id="create_home_block_setting_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
            <span class="" id="err_create_home_block_setting"></span>
            <form method="POST" id="create_home_block_setting" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="aboutus_title">About Us Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="aboutus_title" id="aboutus_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="about_us_page_url">About Us Page URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="about_us_page_url" id="about_us_page_url" class="form-control" placeholder="Enter URL" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_decription">About Us Description</label>
                    <div class="col-sm-9">
                        <textarea name="aboutus_description" id="aboutus_description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="about_us_thumbnail">About us Thumbnail Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="about_us_thumbnail" id="about_us_thumbnail" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                            <ul>

                            </ul>
                        </div>
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
    $('#create_home_block_setting').on('submit', function(e) {
        e.preventDefault();
        $(".error").remove();
        var aboutus_title = $("#aboutus_title").val();
       
        var aboutus_description = tinymce.get("aboutus_description").getContent();
        var about_us_thumbnail = $('#about_us_thumbnail')[0].files[0];
        

        if (aboutus_title == '' || aboutus_title == null) {
            $("#aboutus_title").after("<span class='error' style='color:red'>Please About us Title</span>").focus();
            return false;
        }
        
        if (aboutus_description == '' || aboutus_description == null) {
            $("#aboutus_description").after("<span class='error' style='color:red'>Please enter  description</span>").focus();
            return false;
        }
        if (!about_us_thumbnail) {
            $("#about_us_thumbnail").after("<span class='error' style='color:red'>Please upload About us  image</span>").focus();
            return false;
        }
        else {
            var form = $('#create_home_block_setting')[0];
            var formData = new FormData(form);
            formData.append('aboutus_description', tinymce.get("aboutus_description").getContent());
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/home-page-setting-save",
                method: "POST",
                data: formData,
                beforeSend: function() {
                    $("#create_home_block_setting").css("opacity", 0.2);
                    $("#create_home_block_setting_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    $("#create_home_block_setting_loaderID").hide();
                    $("#create_home_block_setting").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#create_home_block_setting')[0].reset();
                        $('#err_create_home_block_setting').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url('superadmin/slider'); ?>';
                        }, 2000);
                    } else {
                        $("#create_home_block_setting_loaderID").hide();
                        $("#create_home_block_setting").css("opacity", 1.0);
                        $('#err_create_home_block_setting').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#err_create_home_block_setting').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#create_home_block_setting_loaderID").hide();
                    $("#create_home_block_setting").css("opacity", 1.0);
                }
            });
        }


    });
</script>