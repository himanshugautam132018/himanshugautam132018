<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">Permit type</h3>
                <div><a href="<?php echo base_url('superadmin/permit/create_permit_type'); ?>" class="btn custom_btn">Create Permit Type</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th>Permit Type </th>
                                <th>Status</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($permit_listing)) {
                                $i = 1;
                                foreach ($permit_listing as $p_list) {
                                    $statusLink = ($p_list['permit_status'] == 1) ? base_url('superadmin/permit/permit-type-block/' . urlencrypt($p_list['permit_id'])) : base_url('superadmin/permit/permit-type-unblock/' . urlencrypt($p_list['permit_id']));
                                    $statusTooltip = ($p_list['permit_status'] == 1) ? 'Click to Inactive' : 'Click to Active';
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $p_list['permit_type']; ?></td>
                                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($p_list['permit_status'] == 1) ? 'btn-success' : 'btn-danger'; ?>"><?php echo ($p_list['permit_status'] == 1) ? 'Active' : 'Inactive'; ?></span></a></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('superadmin/permit/edit_permit_type/' . urlencrypt($p_list['permit_id'])); ?>" title="Edit" class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger delete" data-href="<?php echo base_url('superadmin/permit/permit_type_delete/' . urlencrypt($p_list['permit_id'])); ?>" data-name="<?php echo $p_list['permit_type']; ?>" data-toggle="modal">
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