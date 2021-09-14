<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-5">Home Page Setting:</h2>


            <h3 class="mb-5">About us Section:</h3>
            <div id="loader" class="loader"></div>
            <span class="" id="err_edit_home_block_setting"></span>
            
            <form method="POST" id="edit_home_block_setting" action="" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo !empty($home_page_setting->id) ? $home_page_setting->id : ''; ?>" name="id" />
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="aboutus_title">About Us Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="aboutus_title" value="<?php echo !empty($home_page_setting->aboutus_title) ? $home_page_setting->aboutus_title : ''; ?>" id="aboutus_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="slider_decription">About Us Description</label>
                    <div class="col-sm-9">
                        <textarea name="aboutus_description" id="aboutus_description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"><?php echo !empty($home_page_setting->aboutus_description) ? $home_page_setting->aboutus_description : ''; ?></textarea>
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
                                <?php
                                if (!empty($home_page_seeting_image)) {
                                    foreach ($home_page_seeting_image as $ei) {
                                ?>
                                        <li>

                                            <img src="<?php echo base_url() ?>uploads/homepagesetting/<?php echo $ei['imageUrl'] ?>" alt="">
                                            <span class="remove_gallery_item_icon " onclick="event_delete('<?php echo $ei['imageid'] ?>')">
                                                <i class="fa fa-remove"></i>
                                            </span>


                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <!-- Why Global Market Centre -->
                <h2 class="card-title mb-5">Why Global Market Centre?:</h2>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="gmc_title">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="gmc_title" value="<?php echo !empty($home_page_setting->gmc_title) ? $home_page_setting->gmc_title : ''; ?>" id="gmc_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="gmc_description">Description</label>
                    <div class="col-sm-9">
                        <textarea name="gmc_description" id="gmc_description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"><?php echo !empty($home_page_setting->gmc_description) ? $home_page_setting->gmc_description : ''; ?></textarea>
                    </div>
                </div>

                <br /><br />
                <!-- Highly Rated CFD Mobile platform -->
                <h2 class="card-title mb-5">Highly Rated CFD Mobile platform:</h2>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cfd_mobile_title">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="cfd_mobile_title" value="<?php echo !empty($home_page_setting->cfd_mobile_title) ? $home_page_setting->cfd_mobile_title : ''; ?>" id="cfd_mobile_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cfd_mobile_description">Description</label>
                    <div class="col-sm-9">
                        <textarea name="cfd_mobile_description" id="cfd_mobile_description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"><?php echo !empty($home_page_setting->cfd_mobile_description) ? $home_page_setting->cfd_mobile_description : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cfd_mobile_thumbnail">Thumbnail Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="cfd_mobile_thumbnail" id="cfd_mobile_thumbnail" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                        <ul>
                                <?php
                                if (!empty($home_page_setting->cfd_mobile_thumbnail)) {
                                ?>
                                    <li>
                                        <img src="<?php echo base_url() ?>uploads/homepagesetting/<?php echo $home_page_setting->cfd_mobile_thumbnail ?>" alt="">
                                        <span class="remove_gallery_item_icon " onclick="event_delete('<?php echo $home_page_setting->id ?>')">
                                            <i class="fa fa-remove"></i>
                                        </span>
                                    </li>
                                <?php

                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br /><br />
                <!-- Trade Cryptocurrencies with Leverage -->
                <h2 class="card-title mb-5">Trade Cryptocurrencies with Leverage:</h2>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cryptocurrencies_title">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="cryptocurrencies_title" value="<?php echo !empty($home_page_setting->cryptocurrencies_title) ? $home_page_setting->cryptocurrencies_title : ''; ?>" id="cfd_mobile_title" class="form-control" placeholder="Enter title" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cryptocurrencies_description">Description</label>
                    <div class="col-sm-9">
                        <textarea name="cryptocurrencies_description" id="cryptocurrencies_description" cols="30" rows="3" class="form-control myTinyMceEditor" placeholder="Enter  About Us Description"><?php echo !empty($home_page_setting->cryptocurrencies_description) ? $home_page_setting->cryptocurrencies_description : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="cryptocurrencies_thumbnail">Thumbnail Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="cryptocurrencies_thumbnail" id="cryptocurrencies_thumbnail" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Pics">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Browse</button>
                            </span>
                        </div>
                        <div class="gallery_preview">
                            <ul>
                                <?php
                                if (!empty($home_page_setting->cryptocurrencies_thumbnail)) {
                                ?>
                                    <li>
                                        <img src="<?php echo base_url() ?>uploads/homepagesetting/<?php echo $home_page_setting->cryptocurrencies_thumbnail ?>" alt="">
                                        <span class="remove_gallery_item_icon " onclick="event_delete('<?php echo $home_page_setting->id ?>')">
                                            <i class="fa fa-remove"></i>
                                        </span>
                                    </li>
                                <?php

                                }
                                ?>
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
    function event_delete(imageid) {
        $.ajax({
            url: "<?php echo base_url('superadmin/home-seeting-image-delete'); ?>",
            type: "POST",
            data: {
                imageid: imageid
            },
            dataType: "json",
            success: function(result) {
                if (result.status == true) {
                    $("#refresh_div").load(location.href + " #refresh_div");
                    Swal.fire(
                        'Image Deleted',
                        result.msg,
                        'success'
                    ).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Image not Deleted',
                        result.msg,
                        'warning'
                    )
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire(
                    'Something wrong',
                    "Error deleting!! Please try again!",
                    'error'
                )
            }
        });
    }


    var spinner = $('#loader');
        var base_url = "<?php echo base_url(); ?>";
    $('#edit_home_block_setting').on('submit', function(e) {
        e.preventDefault();
        $(".error").remove();
        var aboutus_title = $("#aboutus_title").val();

        var aboutus_description = tinymce.get("aboutus_description").getContent();
        if (aboutus_title == '' || aboutus_title == null) {
            $("#aboutus_title").after("<span class='error' style='color:red'>Please About us Title</span>").focus();
            return false;
        }

        if (aboutus_description == '' || aboutus_description == null) {
            $("#aboutus_description").after("<span class='error' style='color:red'>Please enter  description</span>").focus();
            return false;
        } else {
            var form = $('#edit_home_block_setting')[0];
            var formData = new FormData(form);
            formData.append('aboutus_description', tinymce.get("aboutus_description").getContent());
            formData.append('cryptocurrencies_description', tinymce.get("cryptocurrencies_description").getContent());
            formData.append('cfd_mobile_description', tinymce.get("cfd_mobile_description").getContent());
            formData.append('gmc_description', tinymce.get("gmc_description").getContent());
            spinner.show();
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/update-home-page-setting-details",
                method: "POST",
                data: formData,
                
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                  
                    if (res.status == true) {
                        $('#edit_home_block_setting')[0].reset();
                        spinner.hide();
                        $('#err_edit_home_block_setting').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url('superadmin/home_page_setting'); ?>';
                        }, 2000);
                    } else {
                        spinner.hide();
                        $("#edit_home_block_setting_loaderID").hide();
                        $("#edit_home_block_setting").css("opacity", 1.0);
                        $('#err_edit_home_block_setting').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    spinner.hide();
                    $('#err_edit_home_block_setting').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#edit_home_block_setting_loaderID").hide();
                    $("#edit_home_block_setting").css("opacity", 1.0);
                }
            });
        }


    });
</script>