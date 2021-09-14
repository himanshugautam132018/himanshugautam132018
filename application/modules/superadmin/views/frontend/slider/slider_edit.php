<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php if (!empty($slider_view)) { ?>
                <h3 class="card-title mb-5">
                    <!--<small>Edit Page:</small>-->
                    Edit Slider</h3>

                <div id="edit_slider_loaderID" style="position:absolute; left:50%; z-index:2;display:none;transform: translate(-50%, -50%);bottom: 34%;"><img style="padding: 0px;" src="<?= base_url(); ?>assets/load.gif" /></div>
                <span class="" id="edit_err_slider"></span>
                <form method="POST" id="edit_slider" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="slider_title">Slider Title</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="slider_id" value="<?php echo $slider_view->slider_id; ?>">
                            <input type="text" name="slider_title" value="<?php echo!empty($slider_view->slider_title) ? $slider_view->slider_title : ''; ?>" id="slider_title" class="form-control"  />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="slider_decription">Slider Description</label>
                        <div class="col-sm-9">
                            <textarea name="slider_decription" id="slider_decription" cols="30" rows="10" class="form-control myTinyMceEditor" ><?php echo!empty($slider_view->slider_description) ? $slider_view->slider_description : ''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="banner_img">Slider Image</label>
                        <div class="col-sm-9">
                            <input type="file" name="slider_image" id="slider_image"
                                   class="file-upload-default" >
                            <div class="input-group col-xs-12">
                                <input type="text"
                                       class="form-control file-upload-info"
                                       disabled="" placeholder="Upload Pics">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info"
                                            type="button">Browse</button>
                                </span>
                            </div>

                            <div class="gallery_preview" >
                                <div id="refresh_div">
                                    <ul > 

                                        <?php
                                        if (!empty($slider_image)) {
                                            foreach ($slider_image as $s_image) {
                                                ?>
                                                <li>

                                                    <img src="<?php echo base_url() ?>uploads/slider/<?php echo $s_image['imageUrl'] ?>" alt="">
                                                    <span class="remove_gallery_item_icon " onclick="page_delete('<?php echo $s_image['imageid'] ?>')">
                                                        <i class="fa fa-remove" ></i>
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
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 d-flex">
                            <div class="form-radio mr-4">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="slider_status" id="page_status_active" value="1" <?php echo ($slider_view->slider_status == 1) ? 'checked' : ''; ?> >
                                    Active
                                    <i class="input-helper"></i></label>
                            </div>
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="slider_status" id="page_status_inactive" value="0" <?php echo ($slider_view->slider_status == 0) ? 'checked' : ''; ?>>
                                    Inactive
                                    <i class="input-helper"></i></label>
                            </div>
                        </div>                                    
                    </div>

                    <div class="text-right mt-3">
                        <input type="submit" value="Submit" class="btn custom_btn mr-2">
                        <span class="btn btn-light"
                              onclick="history.back()">Cancel</span>
                    </div>

                </form>
            <?php } else { ?>
                <h3 class="card-title mb-5">No Data Found !!!.</h3>
<?php } ?>
        </div>
    </div>
</div>

<script>
    //delete image
    function page_delete(imageid) {
        $.ajax({
            url: "<?php echo base_url('superadmin/slider-image-delete'); ?>",
            type: "POST",
            data: {
                imageid: imageid
            },
            dataType: "json",
            success: function (result) {
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
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire(
                        'Something wrong',
                        "Error deleting!! Please try again!",
                        'error'
                        )
            }
        });
    }
    //Edit Slider 
    $('#edit_slider').on('submit', function (e) {
        e.preventDefault();
        $(".error").remove();
        var slider_title = $("#slider_title").val();
        var slider_decription = tinymce.get("slider_decription").getContent();
        if (slider_title == '' || slider_title == null) {
            $("#slider_title").after("<span class='error' style='color:red'>Please enter Title</span>").focus();
            return false;
        }
        
        if (slider_decription == '' || slider_decription == null) {
            $("#slider_decription").after("<span class='error' style='color:red'>Please enter  description</span>").focus();
            return false;
        } else {
            var form = $('#edit_slider')[0];
            var formData = new FormData(form);
               formData.append('slider_decription', tinymce.get("slider_decription").getContent());
            $.ajax({
                url: "<?php echo base_url(); ?>superadmin/update-slider-details",
                method: "POST",
                data: formData,
                beforeSend: function () {
                    $("#edit_slider").css("opacity", 0.2);
                    $("#edit_slider_loaderID").show();
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (res)
                {
                    $("#edit_slider_loaderID").hide();
                    $("#edit_slider").css("opacity", 1.0);
                    if (res.status == true) {
                        $('#edit_slider')[0].reset();
                        $('#edit_err_slider').html("<div class='alert alert-success' role='alert'>" + res.msg + "</div>");
                        setTimeout(function () {
                            window.location.href = '<?php echo base_url('superadmin/slider'); ?>';
                        }, 2000);
                    } else {
                        $("#edit_slider_loaderID").hide();
                        $("#edit_slider").css("opacity", 1.0);
                        $('#edit_err_slider').html('<div class="alert alert-danger" role="alert">' + res.msg + '</div>');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit_err_slider').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>');
                    $("#edit_slider_loaderID").hide();
                    $("#edit_slider").css("opacity", 1.0);
                }
            });
        }


    });


</script>