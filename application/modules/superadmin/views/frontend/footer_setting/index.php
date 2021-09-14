<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">Footer Setting</h3>
               
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th style="width: 15%;">About us title</th>
                                <th >Email</th>
                                <th >Phone</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($footer_setting)) {
                                $i = 1;
                                foreach ($footer_setting as $footer_setting_list) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $footer_setting_list['aboutus_title']; ?></td>
                                        <td><?php echo $footer_setting_list['email']; ?></td>
                                        <td><?php echo $footer_setting_list['phone']; ?></td>
                                        <td class="text-center">

                                            <a href="<?php echo base_url('superadmin/footer-setting-edit/' . urlencrypt($footer_setting_list['id'])); ?>" title="Edit"
                                               class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr><td colspan="5" style="text-align: center">No Data Found !!</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

