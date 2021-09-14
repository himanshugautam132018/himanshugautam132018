<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="view_page_info">
                <div class="main_content_header">
                    <h3 class="card-title mb-0"><small>View User Details:</small> <?php echo !empty($user_details->user_first_name) ? $user_details->user_first_name : ""; ?></h3>
                    <div>
                        <span class="btn btn-outline-custom" onclick="history.back()">Back</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <?php if (!empty($user_details)) { ?>
                                
                                <tr>
                                    <th>First Name</th>
                                    <td><?php echo !empty($user_details->user_first_name) ? $user_details->user_first_name : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Last Name </th>
                                    <td><?php echo !empty($user_details->user_last_name) ? $user_details->user_last_name : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td><?php echo !empty($user_details->user_phone) ? $user_details->user_phone : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo !empty($user_details->user_email) ? $user_details->user_email : ""; ?></td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td><?php echo !empty($user_details->user_company) ? $user_details->user_company : ""; ?></td>
                                </tr>
                                <tr>
                                    <?php
                                    $imgsrc = $user_details->user_profile_image ? "uploads/user/" . $user_details->user_profile_image : "backend/assets/images/dummy-user.jpg"
                                    ?>
                                    <th>Profile Image</th>
                                    <td><img src="<?php echo base_url(); ?><?php echo $imgsrc; ?>" alt=""></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo !empty($user_details->user_status && $user_details->user_status == 1) ? "Active" : "Inactive"; ?></td>
                                </tr>
                                <tr>
                                    <th>Created</th>
                                    <td><?php echo !empty($user_details->user_created) ? date('d-m-Y  H:i:s', strtotime($user_details->user_created)) : ""; ?></td>
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