<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">Slider</h3>
                <div><a href="<?php echo base_url('superadmin/slider-create'); ?>" class="btn custom_btn">Create Slider</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th style="width: 15%;">slider title</th>
                                <th>slider Description</th>
                                <th>Status</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($slider_listing)) {
                                $i = 1;
                                foreach ($slider_listing as $s_list) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $s_list['slider_title']; ?></td>
                                        <td><?php echo $s_list['slider_description']; ?></td>
                                        <td><?php echo ($s_list['slider_status'] == 1) ? "Active" : 'Inactive'; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('superadmin/slider-view/' . urlencrypt($s_list['slider_id'])); ?>" title="View"
                                               class="btn btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('superadmin/slider-edit/' . urlencrypt($s_list['slider_id'])); ?>" title="Edit"
                                               class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger delete" data-href="<?php echo base_url('superadmin/slider-delete/' . urlencrypt($s_list['slider_id'])); ?>" data-name="<?php echo $s_list['slider_title']; ?>" data-toggle="modal" >
                                                <i class="fa fa-trash-o"></i>
                                            </span>

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


<div class="modal fade deleteModal" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are You Sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body text-center">
                    <h5 id="title">Title</h5>
                    page will be deleted permanently.
                </div>
                <div class="modal-footer">
                    <!--                                <button type="button" class="btn btn-outline-custom" data-dismiss="modal">Close</button>
                                                    <input type="submit" value="Delete" class="btn custom_btn">-->
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(".delete").click(function () {
        var data_href = $(this).data('href');
        var data_name = $(this).data('name');
        $('#title').html('Delete : ' + data_name);
        $('.modal-body').html('<p>Do you really want to delete: ' + data_name + ' ?</p>');
        $('.modal-footer').html('<a href="#" class="btn btn-outline-custom" data-dismiss="modal">No</a><a href="' + data_href + '" class="btn custom_btn"> Delete</a>');
        $('#DeleteModal').modal('show');
        return false;
    });
</script>