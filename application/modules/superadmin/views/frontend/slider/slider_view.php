<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php if (!empty($slider_view)) { ?>
                <div class="view_page_info">
                    <div class="main_content_header">
                        <h3 class="card-title mb-0"><small>View Page:</small> <?php echo $slider_view->slider_title; ?></h3>
                        <div>
                            <span class="btn btn-outline-custom" onclick="history.back()">Back</span>
                        </div>
                    </div>
                    <div class="page_short_desc">
                        <p><?php echo $slider_view->slider_description; ?></p>
                    </div>
                    <div class="page_banner pb-4">
                        <div class="gallery_preview">
                            <ul>
                                <?php
                                if (!empty($slider_image)) {
                                    foreach ($slider_image as $s_image) {
                                        ?>
                                        <li>
                                            <img src="<?php echo base_url() ?>uploads/slider/<?php echo $s_image['imageUrl']; ?>" alt="">
                                        </li>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="view_page_info">
                    <div class="main_content_header">
                        <h3 class="card-title mb-0">No Data Found !!</h3>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>