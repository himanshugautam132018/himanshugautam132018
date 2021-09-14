<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="main_content_header">
                <h3 class="card-title mb-0">Permit Calculation</h3>
                <div><a href="<?php echo base_url('superadmin/permit/create_permit_calculation'); ?>" class="btn custom_btn">Create Permit Calculation</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $this->session->flashdata("message"); ?>
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="order_no_column">S. No.</th>
                                <th>Truck type </th>
                                <th>Permit State </th>
                               <th>Permit type</th>
                                <th>Width limit (ft)</th>
                                <th>Height limit (ft)</th>
                                <th>Length limit (ft)</th>
                                <th>Status</th>
                                <th class="action_column text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($permit_listing)) {
                                $i = 1;
                                foreach ($permit_listing as $p_list) {
                                    $get_state = read_data_where_row("xcmg_state", array("state_id" => $p_list['xcp_state_id']));
                                    $get_truck_type = read_data_where_row("xcmg_truck_type", array("xcmg_truck_type_id" => $p_list['xcp_truck_type_id']));
                                    $get_permit_type = read_data_where_row("xcmg_permit_type", array("permit_id" => $p_list['xcp_permit_type_id']));
                                    $statusLink = ($p_list['xcp_status'] == 1) ? base_url('superadmin/permit/calculation_block/' . urlencrypt($p_list['xcp_id'])) : base_url('superadmin/permit/calculation_unblock/' . urlencrypt($p_list['xcp_id']));
                                    $statusTooltip = ($p_list['xcp_status'] == 1) ? 'Click to Inactive' : 'Click to Active';
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo ucfirst($get_truck_type->xcmg_truck_type_name); ?></td>
                                        <td><?php echo ucfirst($get_state->state_name); ?></td>
                                        <td><?php echo ucfirst($get_permit_type->permit_type); ?></td>
                                        <td><?php echo $p_list['xcp_width_limit_ft']; ?></td>
                                        <td><?php echo $p_list['xcp_height_limit_ft']; ?></td>
                                        <td><?php echo $p_list['xcp_length_limit_ft']; ?></td>
                                        <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($p_list['xcp_status'] == 1) ? 'btn-success' : 'btn-danger'; ?>"><?php echo ($p_list['xcp_status'] == 1) ? 'Active' : 'Inactive'; ?></span></a></td>
                                        <td class="text-center">
                                        <a href="<?php echo base_url('superadmin/permit/view_calculation/' . urlencrypt($p_list['xcp_id'])); ?>" title="View" class="btn btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url('superadmin/permit/edit_permit_calculation/' . urlencrypt($p_list['xcp_id'])); ?>" title="Edit" class="btn btn-outline-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <span class="btn btn-outline-danger delete" data-href="<?php echo base_url('superadmin/permit/calculation_delete/' . urlencrypt($p_list['xcp_id'])); ?>" data-name="<?php echo $get_permit_type->permit_type; ?>" data-toggle="modal">
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