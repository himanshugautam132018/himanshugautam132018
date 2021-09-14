<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">User List</h3>
                <div><a href="<?php echo base_url('superadmin/user/create-user'); ?>" class="btn custom_btn">Create User</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th style="width: 15%;">ID </th>
                                <th style="width: 15%;">Username </th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($slider_listing)) {
                                $i = 1;
                                foreach ($slider_listing as $s_list) {
                                    $statusLink = ($s_list['user_status'] == 1) ? base_url('superadmin/user/user-block/' . urlencrypt($s_list['user_registration_number'])) : base_url('superadmin/user/user-unblock/' . urlencrypt($s_list['user_registration_number']));
                                    $statusTooltip = ($s_list['user_status'] == 1) ? 'Click to Inactive' : 'Click to Active';
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $s_list['user_registration_number']; ?></td>
                                        <td><?php echo $s_list['user_first_name']; ?></td>
                                        <td><?php echo $s_list['user_phone']; ?></td>
                                        <td><?php echo $s_list['user_email']; ?></td>
           
                                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($s_list['user_status'] == 1) ? 'btn-success' : 'btn-danger'; ?>"><?php echo ($s_list['user_status'] == 1) ? 'Active' : 'Inactive'; ?></span></a></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('superadmin/user/view-user/' . urlencrypt($s_list['user_registration_number'])); ?>" title="View" class="btn btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('superadmin/user/update-user-form/' . urlencrypt($s_list['user_registration_number'])); ?>" title="Edit" class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger delete" data-href="<?php echo base_url('superadmin/user/user-delete/' . urlencrypt($s_list['user_registration_number'])); ?>" data-name="<?php echo $s_list['user_first_name']; ?>" data-toggle="modal">
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
                    page will be deleted permanently.
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