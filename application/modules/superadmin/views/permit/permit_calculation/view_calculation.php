<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="view_page_info">
                <div class="main_content_header">
                    <h3 class="card-title mb-0"><small>View Permit Calculation:</small> <?php echo !empty($permit_calculation->user_first_name) ? $permit_calculation->user_first_name : ""; ?></h3>
                    <div>
                        <span class="btn btn-outline-custom" onclick="history.back()">Back</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <?php if (!empty($permit_calculation)) { 
                                // pre($permit_calculation);
                                $truck_type = read_data_where_row("xcmg_truck_type", array("xcmg_truck_type_id" => $permit_calculation->xcp_truck_type_id));
                                $get_state = read_data_where_row("xcmg_state", array("state_id" => $permit_calculation->xcp_state_id));
                                $get_permit_type = read_data_where_row("xcmg_permit_type", array("permit_id" => $permit_calculation->xcp_permit_type_id));
                                
                                ?>
                                
                                <tr>
                                    <th>Truck Type</th>
                                    <td><?php echo !empty($truck_type->xcmg_truck_type_name) ? $truck_type->xcmg_truck_type_name : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Permit State</th>
                                    <td><?php echo !empty($get_state->state_name) ? $get_state->state_name : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Permit Type</th>
                                    <td><?php echo !empty($get_permit_type->permit_type) ? $get_permit_type->permit_type : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Width Limit (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_width_limit_ft) ? $permit_calculation->xcp_width_limit_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Width Rule Operator</th>
                                    <td><?php echo !empty($permit_calculation->xcp_width_rule_operator) ? $permit_calculation->xcp_width_rule_operator : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Height Limit (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_height_limit_ft) ? $permit_calculation->xcp_height_limit_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Height Rule Operator</th>
                                    <td><?php echo !empty($permit_calculation->xcp_height_rule_operator) ? $permit_calculation->xcp_height_rule_operator : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Length Limit (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_length_limit_ft) ? $permit_calculation->xcp_length_limit_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Length Limit Operator</th>
                                    <td><?php echo !empty($permit_calculation->xcp_length_limit_operator) ? $permit_calculation->xcp_length_limit_operator : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Front Overhang (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_front_overhang_ft) ? $permit_calculation->xcp_front_overhang_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Rear Overhang (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_rear_overhang_ft) ? $permit_calculation->xcp_rear_overhang_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Steer Axle (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_steer_axle_lb) ? $permit_calculation->xcp_steer_axle_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Steer Axle (Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_steer_axle_lb_in) ? $permit_calculation->xcp_steer_axle_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Single Axle (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_single_axle_lb) ? $permit_calculation->xcp_single_axle_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Single Axle (Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_single_axle_lb_in) ? $permit_calculation->xcp_single_axle_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Axle Width (Ft)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_axle_width_ft) ? $permit_calculation->xcp_axle_width_ft : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Axle Width Operator</th>
                                    <td><?php echo !empty($permit_calculation->xcp_axle_width_operator) ? $permit_calculation->xcp_axle_width_operator : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Tandem (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_tandem_lb) ? $permit_calculation->xcp_tandem_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Tandem(Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_tandem_lb_in) ? $permit_calculation->xcp_tandem_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Tridem (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_tridem_lb) ? $permit_calculation->xcp_tridem_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Tridem (Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_tridem_lb_in) ? $permit_calculation->xcp_tridem_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Quad (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_quad_lb) ? $permit_calculation->xcp_quad_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Quad (Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_quad_lb_in) ? $permit_calculation->xcp_quad_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>5 Axles (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_5_axles_lb) ? $permit_calculation->xcp_5_axles_lb : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>5 Axles (Lb/In)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_5_axles_lb_in) ? $permit_calculation->xcp_5_axles_lb_in : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>GVW (Lb)</th>
                                    <td><?php echo !empty($permit_calculation->xcp_gvw) ? $permit_calculation->xcp_gvw : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>GVW Operator</th>
                                    <td><?php echo !empty($permit_calculation->xcp_gvw_operator) ? $permit_calculation->xcp_gvw_operator : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Notes:</th>
                                    <td><?php echo !empty($permit_calculation->xcp_noted) ? $permit_calculation->xcp_noted : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td><?php echo !empty($permit_calculation->xcp_created) ? date("d-m-Y",strtotime($permit_calculation->xcp_created)) : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo !empty($permit_calculation->xcp_status && $permit_calculation->xcp_status == 1) ? "Active" : "Inactive"; ?></td>
                                </tr>
                                

                            <?php } else { ?>
                                <tr>
                                    <td>No data Found !!!</td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>


        </div>
    </div>
</div>