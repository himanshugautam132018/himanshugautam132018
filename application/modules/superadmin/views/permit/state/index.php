<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">State List</h3>
                <div><a href="<?php echo base_url('superadmin/state/create_state'); ?>" class="btn custom_btn">Create state</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th>State Code</th>
                                <th>State Name</th>
                                <th>Status</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($state_listing)) {
                                $i = 1;
                                foreach ($state_listing as $s_list) {
                                    $statusLink = ($s_list['state_status'] == 1) ? base_url('superadmin/state/state-block/' . urlencrypt($s_list['state_id'])) : base_url('superadmin/state/state-unblock/' . urlencrypt($s_list['state_id']));
                                    $statusTooltip = ($s_list['state_status'] == 1) ? 'Click to Inactive' : 'Click to Active';
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $s_list['state_code']; ?></td>
                                        <td><?php echo $s_list['state_name']; ?></td>
                                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($s_list['state_status'] == 1) ? 'btn-success' : 'btn-danger'; ?>"><?php echo ($s_list['state_status'] == 1) ? 'Active' : 'Inactive'; ?></span></a></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('superadmin/state/edit_state/' . urlencrypt($s_list['state_id'])); ?>" title="Edit" class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger delete" data-href="<?php echo base_url('superadmin/state/state_delete/' . urlencrypt($s_list['state_id'])); ?>" data-name="<?php echo $s_list['state_name']; ?>" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>
                                            </span>

                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" style="text-align: center">No Data Found !!</td>
                                </tr>
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
                </div>
                <div class="modal-footer">

                </div>
            </form>

        </div>
    </div>
</div>

<script>
  
    $(".delete").click(function() {
        var data_href = $(this).data('href');
        var data_name = $(this).data('name');
        $('#title').html('Delete : ' + data_name);
        $('.modal-body').html('<p>Do you really want to delete: ' + data_name + ' ?</p>');
        $('.modal-footer').html('<a href="#" class="btn btn-outline-custom" data-dismiss="modal">No</a><a href="' + data_href + '" class="btn custom_btn"> Delete</a>');
        $('#DeleteModal').modal('show');
        return false;
    });
</script>