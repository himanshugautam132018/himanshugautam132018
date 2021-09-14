<div class="tab-content form_custom_content" id="myTabContent">
    <?php
    $user_data = $this->session->userdata('xcmgarc_userData');

    ?>
    <!-- First Tab: 1 steering with tandem  -->

    <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first_tab">
        <div class="truck_image_title">
            <?php
            $h_name = !empty($tab) && $tab == 1 ? "1 Steering with Tandem" : ($tab == 2 ? "1 Steering with Tridem" : ($tab == 3 ? "2 Steering with Tandem" : ($tab == 4 ? "2 Steering with Tridem" : ($tab == 5 ? "1 Steering with Quad" : "1 Steering with 5 Axles"))));
            $name_attribute = !empty($tab) && $tab == 1 ? "tandem_axles" : ($tab == 2 ? "tridem_axles" : ($tab == 3 ? "tandem_axles" : ($tab == 4 ? "tridem_axles" : ($tab == 5 ? "quad_axles" : "5_axles"))));


            ?>
            <h2><?php echo $h_name; ?></h2>
        </div>
        <?php
        $imgsrc = "";
        $path =  base_url() . "assets/image/";
        $img_name = !empty($tab) && $tab == 1 ? "graph1.png" : ($tab == 2 ? "graph2.png" : ($tab == 3 ? "graph3.png" : ($tab == 4 ? "graph4.png" : ($tab == 5 ? "graph5.png" : "graph6.png"))));
        $img_src = $path . $img_name;
        ?>
        <div class="thumnail_detail_image"><img src="<?php echo  $img_src; ?>" alt=""></div>
        <?php
        if (isset($_SESSION['can_i_get'])) {
            $can = $_SESSION['can_i_get'];
        } else {
            $can = [];
        }
        $action_url = base_url("can-i-get-permit-calculation-search");

        ?>
        <form class="permit_form" method="POST" id="can_i_get_permit_calculation" action="<?php echo $action_url; ?>" enctype="multipart/form-data">

            <div class="can_permit_truck_information">
                <h2 class="heading_custom_bottom">Truck Information</h2>
                <div class="loader"></div>
                <span id="canigetpermit_message" class="canigetpermit_message" style="font-size:20px;"></span>
                <div class="form_col2">
                    <div class="form-group required">
                        <label for="overall_crane_length">Overall Crane Length (CL) :</label>
                        <input type="hidden" name="tab_id" id="tab_id" value="<?php echo $tab; ?>">
                        <input type="number" class="form-control" id="overall_crane_length" name="overall_crane_length" value="<?php echo !empty($can['overall_crane_length']) ? $can['overall_crane_length'] : ""; ?>" aria-describedby="cranelengthHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="overall_chassis_length">Overall Chassis Length (OL) :</label>
                        <input type="number" class="form-control" id="overall_chassis_length" value="<?php echo !empty($can['overall_chassis_length']) ? $can['overall_chassis_length'] : ""; ?>" name="overall_chassis_length" aria-describedby="craneChassisHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>

                    <div class="form-group required">
                        <label for="bumberToAxle">Bumper to Axle 1 (BA) :</label>
                        <input type="number" class="form-control" id="bumberToAxle1" name="bumberToAxle1" value="<?php echo !empty($can['bumberToAxle1']) ? $can['bumberToAxle1'] : ""; ?>" aria-describedby="bumberToAxleHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="frontoverhang">Front Ovehang (FO) :</label>
                        <input type="number" class="form-control" id="frontoverhang" name="frontoverhang" value="<?php echo !empty($can['frontoverhang']) ? $can['frontoverhang'] : ""; ?>" aria-describedby="frontoverhangHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="rearoverhang">Rear Ovehang (RO) :</label>
                        <input type="number" class="form-control" id="rearoverhang" name="rearoverhang" value="<?php echo !empty($can['rearoverhang']) ? $can['rearoverhang'] : ""; ?>" aria-describedby="rearoverhangHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="overallHeight">Overall Height (H) :</label>
                        <input type="number" class="form-control" id="overallHeight" name="overallHeight" value="<?php echo !empty($can['overallHeight']) ? $can['overallHeight'] : ""; ?>" aria-describedby="overallHeightHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="width">Width (W) :</label>
                        <input type="number" class="form-control" id="width" name="width" value="<?php echo !empty($can['width']) ? $can['width'] : ""; ?>" aria-describedby="widthHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="extremeAxle_length">Extreme Axle Length (WB) :</label>
                        <input type="number" class="form-control" id="extremeAxle_length" name="extremeAxle_length" value="<?php echo !empty($can['extremeAxle_length']) ? $can['extremeAxle_length'] : ""; ?>" aria-describedby="extremeAxle_lengthHelp" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group required">
                        <label for="axle_12">Axle 1 - 2 (L1) :</label>
                        <input type="number" class="form-control" id="axle_12" name="axle_12" value="<?php echo !empty($can['axle_12']) ? $can['axle_12'] : ""; ?>" aria-describedby="axle_12Help" required>
                        <span class="size_label">(ft)</span>
                    </div>
                    <div class="form-group">
                        <label for="axle_23">Axle 2 - 3 (L2) :</label>
                        <input type="number" class="form-control" id="axle_23" name="axle_23" value="<?php echo !empty($can['axle_23']) ? $can['axle_23'] : ""; ?>" aria-describedby="axle_23Help">
                        <span class="size_label">(ft)</span>
                    </div>
                    <?php if (!empty($tab) && $tab != 1 || $tab == 2 && $tab == 3) { ?>
                        <div class="form-group">
                            <label for="axle_34">Axle 3 - 4 (L3) :</label>
                            <input type="number" class="form-control" id="axle_34" name="axle_34" value="<?php echo !empty($can['axle_34']) ? $can['axle_34'] : ""; ?>" aria-describedby="axle_34Help">
                            <span class="size_label">(ft)</span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($tab) && $tab != 1 && $tab != 2 && $tab != 3 || $tab == 4 && $tab == 5) { ?>
                        <div class="form-group">
                            <label for="axle_45">Axle 4 - 5 (L4) :</label>
                            <input type="number" class="form-control" id="axle_45" value="<?php echo !empty($can['axle_45']) ? $can['axle_45'] : ""; ?>" aria-describedby="axle_45Help">
                            <span class="size_label">(ft)</span>
                        </div>
                    <?php } ?>
                    <?php if (!empty($tab) && $tab != 1 && $tab != 2 && $tab != 3 && $tab != 4 && $tab != 4  && $tab != 5) { ?>
                        <div class="form-group">
                            <label for="axle_56">Axle 5 - 6 (L5) :</label>
                            <input type="number" class="form-control" id="axle_56" name="axle_56" value="<?php echo !empty($can['axle_56']) ? $can['axle_56'] : ""; ?>" aria-describedby="axle_56Help">
                            <span class="size_label">(ft)</span>
                        </div>
                    <?php } ?>
                    <div class="form-group required">
                        <label for="gvw">Gross Vehicle Weight (GVW) :</label>
                        <input type="number" class="form-control" id="gvw" name="gvw" value="<?php echo !empty($can['gvw']) ? $can['gvw'] : ""; ?>" aria-describedby="gvwHelp" required>
                        <span class="size_label">(lb)</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 radio_input">
                        <h5 class="field_category">Steering Axle</h5>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row input_radio_btn">
                            <label class="col-md-4">Number of tires in each axle :</label>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <?php

                                    $checked = '';
                                    $checked_4 = '';
                                    if (empty($can['steering_number_of_tires']) || $can['steering_number_of_tires'] == 2) {
                                        $checked = "checked";
                                    }
                                    if (!empty($can['steering_number_of_tires']) && $can['steering_number_of_tires'] == 4) {
                                        $checked_4 = "checked";
                                    }
                                    ?>
                                    <input class="form-check-input" type="radio" name="steering_number_of_tires" id="inlineRadio1" value="2" <?php echo $checked; ?>>
                                    <label class="form-check-label" for="inlineRadio1">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="steering_number_of_tires" id="inlineRadio2" value="4" <?php echo !empty($checked_4) ? $checked_4 : ""; ?>>
                                    <label class="form-check-label" for="inlineRadio2">4</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form_col2">
                    <div class="form-group">

                        <label for="steering_axle_width_1">Axle 1 Width (AW1) :</label>
                        <input type="number" class="form-control" id="steering_axle_width_1" name="steering_axle_width_1" value="<?php echo !empty($can['steering_axle_width_1']) ? $can['steering_axle_width_1'] : ""; ?>" aria-describedby="steering_axle_width_1Help">
                        <span class="size_label">(ft)</span>
                    </div>

                    <div class="form-group required">
                        <label for="steering_axle_weight_1">Weight, Axle 1 (W1) :</label>
                        <input type="number" class="form-control" id="steering_axle_weight_1" name="steering_axle_weight_1" value="<?php echo !empty($can['steering_axle_weight_1']) ? $can['steering_axle_weight_1'] : ""; ?>" aria-describedby="steering_axle_weight_1Help" required>
                        <span class="size_label">(lb)</span>
                    </div>
                    <div class="form-group dropdown_custom required">
                        <label for="Axle1">Axle 1 total tire width :</label>
                        <div class="select_inputs_custom">
                            <select class="steering_axle" id="steering_axle_1_tire_size" name="steering_axle_1_tire_size" required>
                                <option value="">Select Tire Size</option>
                                <?php
                                $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                $selected = '';
                                foreach ($tire_size as $ts) {
                                    if ($ts['xcmg_thread_width'] == $can['steering_axle_1_tire_size']) {
                                        $selected = "selected";
                                    }
                                ?>
                                    <option value="<?php echo $ts['xcmg_thread_width']; ?>" <?php echo $selected; ?>><?php echo $ts['xcmg_tire_size'] ?></option>
                                <?php } ?>

                            </select>
                            <!-- dynamic tyre width  -->
                            <input type="number" class="form-control" readonly id="steering_axle_1_tire_width" name="steering_axle_1_tire_width" value="<?php echo !empty($can['steering_axle_1_tire_width']) ? $can['steering_axle_1_tire_width'] : ""; ?>" aria-describedby="steering_axle_1_tire_widthHelp" required>
                        </div>
                        <span class="size_label">(in)</span>
                    </div>
                </div>
                <?php if (!empty($tab) && $tab == 3 || $tab == 4 || $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">

                            <label for="steering_axle_2_width">Axle 2 Width (AW2) :</label>
                            <input type="number" class="form-control" id="steering_axle_2_width" name="steering_axle_2_width" aria-describedby="steering_axle_2_widthHelp">
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group required">
                            <label for="steering_axle_2_weight">Weight, Axle 2 (W2) :</label>
                            <input type="number" class="form-control" id="steering_axle_2_weight" name="steering_axle_2_weight" aria-describedby="steering_axle_2_weightHelp" required>
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom required">
                            <label for="Axle2">Axle 2 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="steering_axle_2_tire_size" name="steering_axle_2_tire_size" required>
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $sel = '';
                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can['steering_axle_2_tire_size']) {
                                            $sel = "selected";
                                        }
                                    ?>
                                        <option value="<?php echo $ts['xcmg_thread_width']; ?>" <?php echo $sel; ?>><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>

                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" readonly  required class="form-control" id="steering_axle_2_tire_width" name="steering_axle_2_tire_width" value="<?php echo !empty($can['steering_axle_2_tire_width']) ? $can['steering_axle_2_tire_width'] : ""; ?>" aria-describedby="Axle1Help">
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-4 radio_input">
                        <?php
                        $title = !empty($tab) && $tab == 1 ? "Tandem " : ($tab == 2 ? "Tridem " : ($tab == 3 ? "Tandem " : ($tab == 4 ? "Tridem " : ($tab == 5 ? "Quad " : "5 "))));


                        ?>
                        <h5 class="field_category"><?php echo $title; ?> Axlee</h5>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row input_radio_btn">
                            <label class="col-md-4">Number of tires in each axle :</label>
                            <?php

                            $chec = '';
                            $che_4 = '';
                            if (empty($can[$name_attribute . '_number_of_tire']) || $can[$name_attribute . '_number_of_tire'] == 2) {
                                $chec = "checked";
                            }
                            if (!empty($can[$name_attribute . '_number_of_tire']) && $can[$name_attribute . '_number_of_tire'] == 4) {
                                $che_4 = "checked";
                            }
                            ?>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?php echo  $name_attribute; ?>_number_of_tire" id="inlineRadio3" value="2" <?php echo $chec; ?>>
                                    <label class="form-check-label" for="inlineRadio1">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?php echo  $name_attribute; ?>_number_of_tire" id="inlineRadio4" value="4" <?php echo $che_4; ?>>
                                    <label class="form-check-label" for="inlineRadio2">4</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($tab) && $tab == 1 || $tab == 2 && $tab != 3 || $tab == 5 || $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">
                            <label for="<?php echo  $name_attribute; ?>_axle2_width">Axle 2 Width (AW2) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle2_width" name="<?php echo  $name_attribute; ?>_axle2_width" value="<?php echo !empty($can[$name_attribute . '_axle2_width']) ? $can[$name_attribute . '_axle2_width'] : ""; ?>" aria-describedby="<?php echo  $name_attribute; ?>_axle2_widthHelp">
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group required">
                            <label for="<?php echo  $name_attribute; ?>_axle2_weight">Weight, Axle 2 (W2) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle2_weight" name="<?php echo  $name_attribute; ?>_axle2_weight" value="<?php echo !empty($can[$name_attribute . '_axle2_weight']) ? $can[$name_attribute . '_axle2_weight'] : ""; ?>" aria-describedby="WAxle2Help" required>
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom required">
                            <label for="Axle2">Axle 2 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="<?php echo  $name_attribute; ?>_axle2_tire_size" name="<?php echo  $name_attribute; ?>_axle2_tire_size" required>
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $s = '';
                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can[$name_attribute . '_axle2_tire_size']) {
                                            $s = "selected";
                                        }
                                    ?>
                                        <option <?php echo $s; ?> value="<?php echo $ts['xcmg_thread_width']; ?>"><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>

                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" readonly required class="form-control" id="<?php echo  $name_attribute; ?>_axle2_tire_width" name="<?php echo  $name_attribute; ?>_axle2_tire_width" value="<?php echo !empty($can[$name_attribute . '_axle2_tire_width']) ? $can[$name_attribute . '_axle2_tire_width'] : ""; ?>" aria-describedby="Axle1Help">
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($tab) && $tab == 1 || $tab == 2 || $tab == 3 || $tab == 4 || $tab == 5 || $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">

                            <label for="Axle3width">Axle 3 Width (AW3) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle3_width" name="<?php echo  $name_attribute; ?>_axle3_width" value="<?php echo !empty($can[$name_attribute . '_axle3_width']) ? $can[$name_attribute . '_axle3_width'] : ""; ?>" aria-describedby="Axle3widthHelp">
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group required">
                            <label for="WAxle2">Weight, Axle 3 (W3) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle3_weight" name="<?php echo  $name_attribute; ?>_axle3_weight" value="<?php echo !empty($can[$name_attribute . '_axle3_weight']) ? $can[$name_attribute . '_axle3_weight'] : ""; ?>" aria-describedby="WAxle2Help" required>
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom required">
                            <label for="Axle3">Axle 3 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="<?php echo  $name_attribute; ?>_axle3_tire_size" name="<?php echo  $name_attribute; ?>_axle3_tire_size" required>
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $sele = "";
                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can[$name_attribute . '_axle3_tire_size']) {
                                            $sele = "selected";
                                        }
                                    ?>
                                        <option <?php echo $sele; ?> value="<?php echo $ts['xcmg_thread_width']; ?>"><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>

                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" readonly class="form-control" required id="<?php echo  $name_attribute; ?>_axle3_tire_width" name="<?php echo  $name_attribute; ?>_axle3_tire_width" value="<?php echo !empty($can[$name_attribute . '_axle3_tire_width']) ? $can[$name_attribute . '_axle3_tire_width'] : ""; ?>" aria-describedby="Axle1Help">
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($tab) && $tab == 2 || $tab == 3 || $tab == 4 || $tab == 5 || $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">

                            <label for="Axle4width">Axle 4 Width (AW4) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_4_width" name="<?php echo  $name_attribute; ?>_axle_4_width" value="<?php echo !empty($can[$name_attribute . '_axle_4_width']) ? $can[$name_attribute . '_axle_4_width'] : ""; ?>" aria-describedby="Axle4widthHelp" >
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group required">
                            <label for="WAxle4">Weight, Axle 4 (W4) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_4_weight" name="<?php echo  $name_attribute; ?>_axle_4_weight" value="<?php echo !empty($can[$name_attribute . '_axle_4_weight']) ? $can[$name_attribute . '_axle_4_weight'] : ""; ?>" aria-describedby="WAxle4Help" required>
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom required">
                            <label for="Axle4">Axle 4 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="<?php echo  $name_attribute; ?>_axle_4_tire_size" name="<?php echo  $name_attribute; ?>_axle_4_tire_size" required>
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $selecteds = "";
                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can[$name_attribute . '_axle_4_tire_size']) {
                                            $selecteds = "selected";
                                        }
                                    ?>
                                        <option <?php $selecteds; ?> value="<?php echo $ts['xcmg_thread_width']; ?>"><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>

                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" readonly class="form-control" required id="<?php echo  $name_attribute; ?>_axle_4_tire_width" name="<?php echo  $name_attribute; ?>_axle_4_tire_width" value="<?php echo !empty($can[$name_attribute . '_axle_4_tire_width']) ? $can[$name_attribute . '_axle_4_tire_width'] : ""; ?>" aria-describedby="Axle1Help">
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($tab) && $tab == 4 || $tab == 5 || $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">

                            <label for="Axle5width">Axle 5 Width (AW5) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_5_width" name="<?php echo  $name_attribute; ?>_axle_5_width" value="<?php echo !empty($can[$name_attribute . '_axle_5_width']) ? $can[$name_attribute . '_axle_5_width'] : ""; ?>" aria-describedby="<?php echo  $name_attribute; ?>_axle_5_widthHelp">
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group required">
                            <label for="WAxle5">Weight, Axle 5 (W5) :</label>
                            <input type="number" class="form-control" required id="<?php echo  $name_attribute; ?>_axle_5_weight" name="<?php echo  $name_attribute; ?>_axle_5_weight" value="<?php echo !empty($can[$name_attribute . '_axle_5_weight']) ? $can[$name_attribute . '_axle_5_weight'] : ""; ?>" aria-describedby="WAxle5Help">
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom required">
                            <label for="Axle5">Axle 5 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="<?php echo  $name_attribute; ?>_axle_5_tire_size" name="<?php echo  $name_attribute; ?>_axle_5_tire_size" required>
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $selected_s = "";
                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can[$name_attribute . '_axle_5_tire_size']) {
                                            $selected_s = "selected";
                                        }
                                    ?>
                                        <option <?php echo $selected_s ?> value="<?php echo $ts['xcmg_thread_width']; ?>"><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>

                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_5_tire_width" name="<?php echo  $name_attribute; ?>_axle_5_tire_width" value="<?php echo !empty($can[$name_attribute . '_axle_5_tire_width']) ? $can[$name_attribute . '_axle_5_tire_width'] : ""; ?>" aria-describedby="Axle1Help" readonly>
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($tab) && $tab == 6) { ?>
                    <div class="form_col2">
                        <div class="form-group">

                            <label for="Axle6width">Axle 6 Width (AW6) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_6_width" name="<?php echo  $name_attribute; ?>_axle_6_width" value="<?php echo !empty($can[$name_attribute . '_axle_6_width']) ? $can[$name_attribute . '_axle_6_width'] : ""; ?>" aria-describedby="Axle6widthHelp">
                            <span class="size_label">(ft)</span>
                        </div>

                        <div class="form-group ">
                            <label for="WAxle6">Weight, Axle 6 (W6) :</label>
                            <input type="number" class="form-control" id="<?php echo  $name_attribute; ?>_axle_6_weight" name="<?php echo  $name_attribute; ?>_axle_6_weight" value="<?php echo !empty($can[$name_attribute . '_axle_6_weight']) ? $can[$name_attribute . '_axle_6_weight'] : ""; ?>" aria-describedby="WAxle6Help" >
                            <span class="size_label">(lb)</span>
                        </div>
                        <div class="form-group dropdown_custom ">
                            <label for="Axle6">Axle 6 total tire width :</label>
                            <div class="select_inputs_custom">
                                <select class="steering_axle" id="<?php echo  $name_attribute; ?>_axle_6_tire_size" name="<?php echo  $name_attribute; ?>_axle_6_tire_size" >
                                    <option value="">Select Tire Size</option>
                                    <?php
                                    $tire_size = read_data("xcmg_tire", "xcmg_tire_id", "DESC");
                                    $st = "";

                                    foreach ($tire_size as $ts) {
                                        if ($ts['xcmg_thread_width'] == $can[$name_attribute . '_axle_6_tire_size']) {
                                            $st = "selected";
                                        }
                                    ?>
                                        <option <?php echo $st; ?> value="<?php echo $ts['xcmg_thread_width']; ?>"><?php echo $ts['xcmg_tire_size'] ?></option>
                                    <?php } ?>
                                </select>
                                <!-- dynamic tyre width  -->
                                <input type="number" class="form-control"  id="<?php echo  $name_attribute; ?>_axle_6_tire_width" name="<?php echo  $name_attribute; ?>_axle_6_tire_width" value="<?php echo !empty($can[$name_attribute . '_axle_6_tire_width']) ? $can[$name_attribute . '_axle_6_tire_width'] : ""; ?>" aria-describedby="Axle1Help" readonly>
                            </div>
                            <span class="size_label">(in)</span>
                        </div>
                    </div>
                <?php } ?>
                <div class="form_col2 submit_button_grid">

                    <div class="form-group text-right">
                        <!-- <button type="submit" class="btn form_button simple_btn calculation">Calculation</button> -->
                        <?php
                        if (!empty($user_data)) {
                        ?>
                            <button type="submit" class="btn form_button simple_btn calculation">Calculation</button>
                        <?php } else {
                        ?>
                            <button type="button" class="btn form_button simple_btn calculation" onclick="storeCanIgetInfo()">Calculation</button>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <!-- End first Tab  -->

    <!-- End Sixth Tab  -->
</div>
<div class="state_list" id="append_filter_state">
</div>
<script>
    function storeCanIgetInfo() {
        var spinner = $('.loader');
        var form = $('#can_i_get_permit_calculation')[0];
        var formData = new FormData(form);
        $.ajax({
            url: "<?php echo base_url(); ?>can_i_get_stored",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                spinner.show();
            },
            success: function(res) {
                spinner.hide();
                openSideNav()
            }
        });
    }

    $('select').on('change', function() {
        var tireSize = $(this).parent().find('input').attr('id');
        $("#" + tireSize).val(this.value);
    });

    $(document).ready(function() {
        var spinner = $('.loader');
        var base_url = "<?php echo base_url(); ?>";
        $("#can_i_get_permit_calculation").validate({
            submitHandler: function(form) {
                $(".error").remove();
                var formId = $('#can_i_get_permit_calculation')[0];
                var datan = new FormData(formId);
                spinner.show();
                $.ajax({
                    url: form.action,
                    dataType: 'json',
                    type: form.method,
                    data: datan,

                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status === true) {
                            spinner.hide();
                            $('#canigetpermit_message').html(data.message).focus();
                            $('#canigetpermit_message').css('color', 'green');
                            // $('#can_i_get_permit_calculation')[0].reset();
                            $("#append_filter_state").html('');
                            $("#append_filter_state").html(data.result);
                            setTimeout(function() {
                                $('#canigetpermit_message').html('');
                            }, 3000);
                            // Swal.fire(
                            //     'Permit',
                            //     data.message,
                            //     'success'
                            // ).then((result) => {
                            //     window.location.href = base_url;
                            // });

                        } else {
                            spinner.hide();
                            if (data.status == 'form_error') {

                                var obj = data;
                                var i;
                                for (i = 0; i < obj.field.length; i++) {
                                    name = obj.field[i];
                                    $('.label-' + name).addClass('label-error');
                                    errors = JSON.stringify(obj.validation);
                                    validate = jQuery.parseJSON(errors);
                                    $("input[name=" + name + "]").after('<span class="error" style="color:red">' + validate[name] + '</span>').focus();
                                }
                            } else {
                                $('#canigetpermit_message').html(data.message).focus();
                                $('#canigetpermit_message').css('color', 'red');
                                Swal.fire(
                                    'Permit ',
                                    data.message,
                                    'warning'
                                );
                                setTimeout(function() {
                                    $('#canigetpermit_message').html('');
                                }, 3000);
                            }
                        }

                    },
                    error: function(data) {
                        spinner.hide();

                        Swal.fire(
                            'Permit Error',
                            "Something went wrong . please try again once",
                            'warning'
                        );
                        $('#canigetpermit_message').html('<div class="alert alert-danger" role="alert">Something went wrong . please try again once</div>').focus();
                        $('#canigetpermit_message').css('color', 'red');
                        setTimeout(function() {
                            $('#canigetpermit_message').html('');
                        }, 5000);

                    }
                });
            }
        });
    });
</script>