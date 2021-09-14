<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Can_i_get_permits extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index()
    {
        $data = array();
        $data['tab'] = 1;
        $data['title'] = "Can I Get Permits";
        $this->load->view('include/header');
        $this->load->view('canigetpermit/index', $data);
        $this->load->view('include/footer');
    }

    public function can_i_get_route_ajax_form()
    {
        $data = array();
        $postdata = $this->input->post();
        $data['tab'] = $postdata['tabId'];
        $this->load->view('include/ajax_permit_form', $data);
    }
    function num_cond($var1, $op, $var2)
    {

        switch ($op) {
            case "=":
                return $var1 == $var2;
            case "!=":
                return $var1 != $var2;
            case ">=":
                return $var1 >= $var2;
            case "<=":
                return $var1 <= $var2;
            case ">":
                return $var1 >  $var2;
            case "<":
                return $var1 <  $var2;
            default:
                return true;
        }
    }
    public function can_i_get_calculation_stored_session()
    {
        if ($_POST) {
            $permit_session = array("can_i_get" => $_POST);
            $this->session->set_userdata($permit_session);
            echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">success</div>'));
            die;
        } else {
            echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">failed</div>'));
            die;
        }
    }
    public function can_i_get_permit_calculation()
    {
        $postdata = $this->input->post();
        $tab = $postdata['tab_id'];
        $axle_weight_sum = 0;
        $axle_width_sum = 0;
        $steering_axle_weight_sum = 0;
        $name_attribute = !empty($tab) && $tab == 1 ? "tandem_axles" : ($tab == 2 ? "tridem_axles" : ($tab == 3 ? "tandem_axles" : ($tab == 4 ? "tridem_axles" : ($tab == 5 ? "quad_axles" : "5_axles"))));
      
        #can I Get form stored in session
        $this->session->unset_userdata('can_i_get');
        $permit_session = array("can_i_get" => $_POST);
        $this->session->set_userdata($permit_session);
        #end can I Get form stored in session

        if (!empty($name_attribute)) {

            $truck_type_title = !empty($tab) && $tab == 1 ? "Tandem" : ($tab == 2 ? "Tridem" : ($tab == 3 ? "Tandem" : ($tab == 4 ? "Tridem" : ($tab == 5 ? " Quad" : "5 Axles"))));


            #this section for tandem ,tridem ,quad,5 axle weight and tire size
            $t_axle2_weight = !empty($postdata[$name_attribute . "_axle2_weight"]) ? $postdata[$name_attribute . "_axle2_weight"] : 0;
            $t_axle3_weight = !empty($postdata[$name_attribute . "_axle3_weight"]) ? $postdata[$name_attribute . "_axle3_weight"] : 0;
            $t_axle_4_weight = !empty($postdata[$name_attribute . "_axle_4_weight"]) ? $postdata[$name_attribute . "_axle_4_weight"] : 0;
            $t_axle_5_weight = !empty($postdata[$name_attribute . "_axle_5_weight"]) ? $postdata[$name_attribute . "_axle_5_weight"] : 0;
            $t_axle_6_weight = !empty($postdata[$name_attribute . "_axle_6_weight"]) ? $postdata[$name_attribute . "_axle_6_weight"] : 0;
            $axle_weight_sum = $t_axle2_weight + $t_axle3_weight + $t_axle_4_weight + $t_axle_5_weight + $t_axle_6_weight;
            // pre($axle_weight_sum);
            // pre($axle_weight_sum);

            $number_of_tires = !empty($postdata[$name_attribute . "_number_of_tire"]) ? $postdata[$name_attribute . "_number_of_tire"] : 0;

            $axle2_tire_width = !empty($postdata[$name_attribute . "_axle2_tire_width"]) ? $postdata[$name_attribute . "_axle2_tire_width"] : 0;
            $axle3_tire_width = !empty($postdata[$name_attribute . "_axle3_tire_width"]) ? $postdata[$name_attribute . "_axle3_tire_width"] : 0;
            $axle_4_tire_width = !empty($postdata[$name_attribute . "_axle_4_tire_width"]) ? $postdata[$name_attribute . "_axle_4_tire_width"] : 0;
            $axle_5_tire_width = !empty($postdata[$name_attribute . "_axle_5_tire_width"]) ? $postdata[$name_attribute . "_axle_5_tire_width"] : 0;
            $axle_6_tire_width = !empty($postdata[$name_attribute . "_axle_6_tire_width"]) ? $postdata[$name_attribute . "_axle_6_tire_width"] : 0;
            $all_axle_tire_width_sum = $axle2_tire_width + $axle3_tire_width + $axle_4_tire_width + $axle_5_tire_width + $axle_6_tire_width;
            $all_axle_tire_size = !empty($all_axle_tire_width_sum) ? $axle_weight_sum / ($all_axle_tire_width_sum * $number_of_tires) : 0;
            // $all_axle_tire_size = 550;
            #end this section for tandem ,tridem ,quad,5 axle weight and tire size




            #steering axle 
            $steering_axle_weight_1 = !empty($postdata['steering_axle_weight_1']) ? $postdata['steering_axle_weight_1'] : 0;
            $steering_axle_2_weight = !empty($postdata['steering_axle_2_weight']) ? $postdata['steering_axle_2_weight'] : 0;
            $xcp_steer_axle_lb = $steering_axle_weight_1 +  $steering_axle_2_weight;

            $steering_number_of_tires = !empty($postdata['steering_number_of_tires']) ? $postdata['steering_number_of_tires'] : 0;


            $steering_axle_1_tire_width = !empty($postdata['steering_axle_1_tire_width']) ? $postdata['steering_axle_1_tire_width'] : 0;
            $steering_axle_2_tire_width = !empty($postdata['steering_axle_2_tire_width']) ? $postdata['steering_axle_2_tire_width'] : 0;
            $xcp_steer_axle_tire_width_total = $steering_axle_1_tire_width +  $steering_axle_2_tire_width;
            $xcp_steer_axle_tire_width = !empty($xcp_steer_axle_tire_width_total) ? $xcp_steer_axle_lb / ($xcp_steer_axle_tire_width_total * $steering_number_of_tires) : 0;
        }

        $data = array();
        $data['permit_calculation'] = read_data("xcmg_permit_calculation", "xcp_id", "DESC");
        $response = array();
        foreach ($data['permit_calculation'] as $calculation) {
            $state_list = $this->db->get_where('xcmg_state', array('state_id' => $calculation['xcp_state_id']))->row();

            if ($calculation['xcp_permit_type_id'] == 15) {

                $tab_calculation_for_weight = !empty($tab) && $tab == 1 ? $calculation['xcp_tandem_lb'] : ($tab == 2 ? $calculation['xcp_tridem_lb'] : ($tab == 3 ? $calculation['xcp_tandem_lb'] : ($tab == 4 ? $calculation['xcp_tridem_lb'] : ($tab == 5 ? $calculation['xcp_quad_lb'] : $calculation['xcp_5_axles_lb']))));
                $tab_db_name = !empty($tab) && $tab == 1 ? 'xcp_tandem_lb' : ($tab == 2 ? "xcp_tridem_lb" : ($tab == 3 ? "xcp_tandem_lb" : ($tab == 4 ? "xcp_tridem_lb" : ($tab == 5 ? "xcp_quad_lb" : "xcp_5_axles_lb"))));
                $tab_calculation_lb_in = !empty($tab) && $tab == 1 ? $calculation['xcp_tandem_lb_in'] : ($tab == 2 ? $calculation['xcp_tridem_lb_in'] : ($tab == 3 ? $calculation['xcp_tandem_lb_in'] : ($tab == 4 ? $calculation['xcp_tridem_lb_in'] : ($tab == 5 ? $calculation['xcp_quad_lb_in'] : $calculation['xcp_5_axles_lb_in']))));
                $tab_db_name_lb_in = !empty($tab) && $tab == 1 ? 'xcp_tandem_lb_in' : ($tab == 2 ? "xcp_tridem_lb_in" : ($tab == 3 ? "xcp_tandem_lb_in" : ($tab == 4 ? "xcp_tridem_lb" : ($tab == 5 ? "xcp_quad_lb_in" : "xcp_5_axles_lb_in"))));

                $calculation['xcp_steer_axle_lb'] = !empty($calculation['xcp_steer_axle_lb']) ? $calculation['xcp_steer_axle_lb'] : $calculation['xcp_single_axle_lb'];
                $calculation['xcp_steer_axle_lb_in'] = !empty($calculation['xcp_steer_axle_lb_in']) ? $calculation['xcp_steer_axle_lb_in'] : $calculation['xcp_single_axle_lb_in'];

                if (
                    !empty($calculation['xcp_width_limit_ft']) &&
                    num_condition_operator($postdata['width'], $calculation['xcp_width_rule_operator'], $calculation['xcp_width_limit_ft'])
                ) {
                    if (num_condition_operator($postdata['overallHeight'], $calculation['xcp_height_rule_operator'], $calculation['xcp_height_limit_ft'])) {
                        if (empty($calculation['xcp_length_limit_ft'])) {
                            if (empty($calculation['xcp_front_overhang_ft'])) {
                                if (empty($calculation['xcp_rear_overhang_ft'])) {
                                    if (empty($calculation['xcp_gvw'])) {
                                        if (empty($calculation['xcp_steer_axle_lb'])) {
                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                        } else {
                                            //cheked
                                            if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {
                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            } else {
                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                if (!empty($get_cal)) {
                                                    $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                    if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                    }
                                                    if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    }
                                                } else {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                }
                                            }
                                        }
                                    } else {
                                        if (num_condition_operator($postdata['gvw'], $calculation['xcmg_overall_operator'], $calculation['xcp_gvw'])) {

                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                        } else {
                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                            if (!empty($get_cal)) {
                                                if ($postdata['gvw'] >= $get_cal->xcp_gvw) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "Gross Vehicle Weight (GVW) ";
                                                }
                                                if ($postdata['gvw'] < $get_cal->xcp_gvw) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                }
                                            } else {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            }
                                        }
                                    }
                                } else {
                                    if (num_condition_operator($postdata['rearoverhang'], $calculation['xcmg_overall_operator'], $calculation['xcp_rear_overhang_ft'])) {
                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                    } else {
                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                        if (!empty($get_cal)) {
                                            if ($postdata['rearoverhang'] >= $get_cal->xcp_rear_overhang_ft) {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                $response[$calculation['xcp_state_id']]['violation'] = "Rear Ovehang (RO) ";
                                            }
                                            if ($postdata['rearoverhang'] < $get_cal->xcp_rear_overhang_ft) {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            }
                                        } else {
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                        }
                                    }
                                }
                            } else {

                                if (num_condition_operator($postdata['frontoverhang'], $calculation['xcmg_overall_operator'], $calculation['xcp_front_overhang_ft'])) {
                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                } else {
                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                    if (!empty($get_cal)) {
                                        if ($postdata['frontoverhang'] >= $get_cal->xcp_front_overhang_ft) {
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                            $response[$calculation['xcp_state_id']]['violation'] = "Front Ovehang (FO)";
                                        }
                                        if ($postdata['frontoverhang'] < $get_cal->xcp_front_overhang_ft) {
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                        }
                                    } else {
                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                    }
                                }
                            }
                        } else {

                            if (num_condition_operator($postdata['overall_crane_length'], $calculation['xcmg_overall_operator'], $calculation['xcp_length_limit_ft'])) {
                                if (empty($calculation['xcp_front_overhang_ft'])) {
                                    if (empty($calculation['xcp_rear_overhang_ft'])) {
                                        if (empty($calculation['xcp_gvw'])) {
                                            if (empty($calculation['xcp_steer_axle_lb'])) {

                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            } else {
                                                if (empty($calculation['xcp_steer_axle_lb']) && empty($xcp_steer_axle_lb)) {

                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                } else {

                                                    if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {

                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    } else {
                                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                        $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                        if (!empty($get_cal->xcp_steer_axle_lb)) {
                                                            if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                            }
                                                            if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            }
                                                        } else {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (num_condition_operator($postdata['gvw'], $calculation['xcmg_overall_operator'], $calculation['xcp_gvw'])) {
                                                if (empty($calculation['xcp_steer_axle_lb']) && empty($xcp_steer_axle_lb)) {
                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                } else {

                                                    if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {

                                                        if (empty($calculation['xcp_steer_axle_lb_in'])) {  //call when  empty xcp_steer_axle_lb_in
                                                            if (empty($tab_calculation_for_weight)) {
                                                                if (empty($tab_calculation_lb_in)) {
                                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                } else {

                                                                    if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    } else {
                                                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                        if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                            if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                            }
                                                                            if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            }
                                                                        } else {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        }
                                                                    }
                                                                }
                                                            } else {

                                                                if (num_condition_operator($axle_weight_sum, $calculation['xcmg_overall_operator'], $tab_calculation_for_weight)) {
                                                                    if (empty($tab_calculation_lb_in)) {
                                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    } else {

                                                                        if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        } else {
                                                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                            if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                                if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                                }
                                                                                if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                }
                                                                            } else {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                    if (!empty($get_cal->{$tab_db_name})) {
                                                                        if ($axle_weight_sum >= $get_cal->{$tab_db_name}) {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " Weight";
                                                                        }
                                                                        if ($axle_weight_sum < $get_cal->{$tab_db_name}) {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        }
                                                                    } else {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    }
                                                                }
                                                            }
                                                        } else {

                                                            if (num_condition_operator($xcp_steer_axle_tire_width, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb_in'])) {
                                                                //yahan s karenge change ab next k lia
                                                                #ye mothod tab hi call hoga jab xcp_steer_axle_lb_in empty hoga or less than hoga user input value se tb hi call hoga
                                                                //ye block tandem,tridem,5axle k lia hai 
                                                                if (empty($tab_calculation_for_weight)) {
                                                                    if (empty($tab_calculation_lb_in)) {
                                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    } else {

                                                                        if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        } else {
                                                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                            if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                                if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                                }
                                                                                if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                }
                                                                            } else {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            }
                                                                        }
                                                                    }
                                                                } else {

                                                                    if (num_condition_operator($axle_weight_sum, $calculation['xcmg_overall_operator'], $tab_calculation_for_weight)) {
                                                                        if (empty($tab_calculation_lb_in)) {

                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        } else {

                                                                            if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            } else {
                                                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                                if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                                    if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                        $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                                    }
                                                                                    if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                    }
                                                                                } else {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                }
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                        if (!empty($get_cal->{$tab_db_name})) {
                                                                            if ($axle_weight_sum >= $get_cal->{$tab_db_name}) {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " Weight";
                                                                            }
                                                                            if ($axle_weight_sum < $get_cal->{$tab_db_name}) {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            }
                                                                        } else {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        }
                                                                    }
                                                                }
                                                                //ye block yahan khatam hai 
                                                            } else {
                                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                $get_cal->xcp_steer_axle_lb_in = !empty($get_cal->xcp_steer_axle_lb_in) ? $get_cal->xcp_steer_axle_lb_in : $get_cal->xcp_single_axle_lb_in;
                                                                if (!empty($get_cal->xcp_steer_axle_lb_in)) {
                                                                    if ($xcp_steer_axle_tire_width >= $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "Tire Size";
                                                                    }
                                                                    if ($xcp_steer_axle_tire_width < $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    }
                                                                } else {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                        $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                        if (!empty($get_cal->xcp_steer_axle_lb)) {
                                                            if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                            }
                                                            if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            }
                                                        } else {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        }
                                                    }
                                                }
                                            } else {
                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                if (!empty($get_cal)) {
                                                    if ($postdata['gvw'] >= $get_cal->xcp_gvw) {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "Gross Vehicle Weight (GVW) ";
                                                    }
                                                    if ($postdata['gvw'] < $get_cal->xcp_gvw) {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    }
                                                } else {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                }
                                            }
                                        }
                                    } else {
                                        if (num_condition_operator($postdata['rearoverhang'], $calculation['xcmg_overall_operator'], $calculation['xcp_rear_overhang_ft'])) {
                                            if (empty($calculation['xcp_steer_axle_lb']) && empty($xcp_steer_axle_lb)) {
                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            } else {

                                                if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {
                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    $response[$calculation['xcp_state_id']]['calculation'][]  =  $calculation;
                                                } else {
                                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                    $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                    if (!empty($get_cal->xcp_steer_axle_lb)) {
                                                        if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                        }
                                                        if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        }
                                                    } else {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    }
                                                }
                                            }
                                        } else {
                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                            if (!empty($get_cal)) {
                                                if ($postdata['rearoverhang'] >= $get_cal->xcp_rear_overhang_ft) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "Rear Ovehang (RO)";
                                                }
                                                if ($postdata['rearoverhang'] < $get_cal->xcp_rear_overhang_ft) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                }
                                            } else {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            }
                                        }
                                    }
                                } else {

                                    if (num_condition_operator($postdata['frontoverhang'], $calculation['xcmg_overall_operator'], $calculation['xcp_front_overhang_ft'])) {
                                        if (num_condition_operator($postdata['rearoverhang'], $calculation['xcmg_overall_operator'], $calculation['xcp_rear_overhang_ft'])) {
                                            if (empty($calculation['xcp_gvw']) && empty($postdata['gvw'])) {
                                                //yah function tab call call  jab hoga $xcp_steer_axle_lb && $calculation['xcp_steer_axle_lb'] empty honge 
                                                if (empty($calculation['xcp_steer_axle_lb']) && empty($xcp_steer_axle_lb)) {
                                                    #when xcp_steer_axle_lb empty then call this 

                                                    if (empty($calculation['xcp_steer_axle_lb_in'])) {  //call when  empty xcp_steer_axle_lb_in
                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    } else {
                                                        if (num_condition_operator($xcp_steer_axle_tire_width, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb_in'])) {
                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        } else {
                                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                            $get_cal->xcp_steer_axle_lb_in = !empty($get_cal->xcp_steer_axle_lb_in) ? $get_cal->xcp_steer_axle_lb_in : $get_cal->xcp_single_axle_lb_in;
                                                            if (!empty($get_cal->xcp_steer_axle_lb_in)) {

                                                                if ($xcp_steer_axle_tire_width >= $get_cal->xcp_steer_axle_lb_in) {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "Tire Size";
                                                                }
                                                                if ($xcp_steer_axle_tire_width < $get_cal->xcp_steer_axle_lb_in) {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                }
                                                            } else {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    #when xcp_steer_axle_lb not empty then call this
                                                    if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {
                                                        if (empty($calculation['xcp_steer_axle_lb_in'])) {  //call when  empty xcp_steer_axle_lb_in
                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        } else {

                                                            if (num_condition_operator($xcp_steer_axle_tire_width, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb_in'])) {
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            } else {
                                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                $get_cal->xcp_steer_axle_lb_in = !empty($get_cal->xcp_steer_axle_lb_in) ? $get_cal->xcp_steer_axle_lb_in : $get_cal->xcp_single_axle_lb_in;
                                                                if (!empty($get_cal->xcp_steer_axle_lb_in)) {
                                                                    if ($xcp_steer_axle_tire_width >= $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "Tire Size";
                                                                    }
                                                                    if ($xcp_steer_axle_tire_width < $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    }
                                                                } else {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                        $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                        if (!empty($get_cal->xcp_steer_axle_lb)) {
                                                            if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                            }
                                                            if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            }
                                                        } else {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        }
                                                    }
                                                }
                                            } else {
                                                if (num_condition_operator($postdata['gvw'], $calculation['xcp_gvw_operator'], $calculation['xcp_gvw'])) {

                                                    if (empty($calculation['xcp_steer_axle_lb']) && empty($xcp_steer_axle_lb)) {
                                                        #when xcp_steer_axle_lb empty then call this 

                                                        if (empty($calculation['xcp_steer_axle_lb_in'])) {  //call when  empty xcp_steer_axle_lb_in
                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        } else {
                                                            if (num_condition_operator($xcp_steer_axle_tire_width, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb_in'])) {
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            } else {
                                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                $get_cal->xcp_steer_axle_lb_in = !empty($get_cal->xcp_steer_axle_lb_in) ? $get_cal->xcp_steer_axle_lb_in : $get_cal->xcp_single_axle_lb_in;
                                                                if (!empty($get_cal->xcp_steer_axle_lb_in)) {

                                                                    if ($xcp_steer_axle_tire_width >= $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "Tire Size";
                                                                    }
                                                                    if ($xcp_steer_axle_tire_width < $get_cal->xcp_steer_axle_lb_in) {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    }
                                                                } else {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        // echo "if";
                                                        #when xcp_steer_axle_lb not empty then call this
                                                        // pre($calculation['xcp_steer_axle_lb']);
                                                        if (num_condition_operator($xcp_steer_axle_lb, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb'])) {
                                                            if (empty($calculation['xcp_steer_axle_lb_in'])) {  //call when  empty xcp_steer_axle_lb_in
                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            } else {

                                                                if (num_condition_operator($xcp_steer_axle_tire_width, $calculation['xcmg_overall_operator'], $calculation['xcp_steer_axle_lb_in'])) {
                                                                    //yahan s karenge change ab next k lia
                                                                    #ye mothod tab hi call hoga jab xcp_steer_axle_lb_in empty hoga or less than hoga user input value se tb hi call hoga
                                                                    //ye block tandem,tridem,5axle k lia hai 
                                                                    if (empty($tab_calculation_for_weight)) {
                                                                        if (empty($tab_calculation_lb_in)) {
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        } else {

                                                                            if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            } else {
                                                                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                                if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                                    if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                        $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                                    }
                                                                                    if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                    }
                                                                                } else {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                }
                                                                            }
                                                                        }
                                                                    } else {

                                                                        if (num_condition_operator($axle_weight_sum, $calculation['xcmg_overall_operator'], $tab_calculation_for_weight)) {
                                                                            if (empty($tab_calculation_lb_in)) {

                                                                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            } else {

                                                                                if (num_condition_operator($all_axle_tire_size, $calculation['xcmg_overall_operator'], $tab_calculation_lb_in)) {
                                                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "NO";
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "N/A";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                } else {
                                                                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                                    if (!empty($get_cal->{$tab_db_name_lb_in})) {
                                                                                        if ($all_axle_tire_size >= $get_cal->{$tab_db_name_lb_in}) {
                                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                            $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " tire width";
                                                                                        }
                                                                                        if ($all_axle_tire_size < $get_cal->{$tab_db_name_lb_in}) {
                                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                        }
                                                                                    } else {
                                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                    }
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                            if (!empty($get_cal->{$tab_db_name})) {
                                                                                if ($axle_weight_sum >= $get_cal->{$tab_db_name}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = $truck_type_title . " Weight";
                                                                                }
                                                                                if ($axle_weight_sum < $get_cal->{$tab_db_name}) {
                                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                                }
                                                                            } else {
                                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                            }
                                                                        }
                                                                    }
                                                                    //ye block yahan khatam hai 
                                                                } else {
                                                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                                    $get_cal->xcp_steer_axle_lb_in = !empty($get_cal->xcp_steer_axle_lb_in) ? $get_cal->xcp_steer_axle_lb_in : $get_cal->xcp_single_axle_lb_in;
                                                                    if (!empty($get_cal->xcp_steer_axle_lb_in)) {
                                                                        if ($xcp_steer_axle_tire_width >= $get_cal->xcp_steer_axle_lb_in) {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "Tire Size";
                                                                        }
                                                                        if ($xcp_steer_axle_tire_width < $get_cal->xcp_steer_axle_lb_in) {
                                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                        }
                                                                    } else {
                                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            //error section
                                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                            $get_cal->xcp_steer_axle_lb = !empty($get_cal->xcp_steer_axle_lb) ? $get_cal->xcp_steer_axle_lb : $get_cal->xcp_single_axle_lb;
                                                            // pre($get_cal->xcp_steer_axle_lb);
                                                            // pre($xcp_steer_axle_lb);
                                                            if (!empty($get_cal->xcp_steer_axle_lb)) {
                                                                if ($xcp_steer_axle_lb >= $get_cal->xcp_steer_axle_lb) {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "Weight, Axle 1 (W1)";
                                                                }
                                                                if ($xcp_steer_axle_lb < $get_cal->xcp_steer_axle_lb) {
                                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                                }
                                                            } else {
                                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                                    if (!empty($get_cal->xcp_gvw)) {

                                                        if ($postdata['gvw'] >= $get_cal->xcp_gvw) {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "Gross Vehicle Weight (GVW)";
                                                        }
                                                        if ($postdata['gvw'] < $get_cal->xcp_gvw) {
                                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                                        }
                                                    } else {
                                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                                    }
                                                }
                                            }
                                        } else {
                                            $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                            $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                            $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                            if (!empty($get_cal)) {
                                                if ($postdata['rearoverhang'] >= $get_cal->xcp_rear_overhang_ft) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "Rear Ovehang (RO)";
                                                }
                                                if ($postdata['rearoverhang'] < $get_cal->xcp_rear_overhang_ft) {
                                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                                }
                                            } else {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            }
                                        }
                                    } else {
                                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                        if (!empty($get_cal)) {
                                            if ($postdata['frontoverhang'] >= $get_cal->xcp_front_overhang_ft) {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                                $response[$calculation['xcp_state_id']]['violation'] = "Front Ovehang (FO)";
                                            }
                                            if ($postdata['frontoverhang'] < $get_cal->xcp_front_overhang_ft) {
                                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                                $response[$calculation['xcp_state_id']]['violation'] = "";
                                            }
                                        } else {
                                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                            $response[$calculation['xcp_state_id']]['violation'] = "";
                                        }
                                    }
                                }
                            } else {
                                $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                                $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                                $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                                if (!empty($get_cal)) {
                                    if ($postdata['overall_crane_length'] >= $get_cal->xcp_length_limit_ft) {
                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                        $response[$calculation['xcp_state_id']]['violation'] = "Overall Crane Length (CL)";
                                    }
                                    if ($postdata['overall_crane_length'] < $get_cal->xcp_length_limit_ft) {
                                        $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                        $response[$calculation['xcp_state_id']]['violation'] = "";
                                    }
                                } else {
                                    $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                                    $response[$calculation['xcp_state_id']]['violation'] = "";
                                }
                            }
                        }
                    } else {
                        $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                        $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                        $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                        if (!empty($get_cal)) {
                            if ($postdata['overallHeight'] >= $get_cal->xcp_height_limit_ft) {
                                $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                                $response[$calculation['xcp_state_id']]['violation'] = "Overall Height (H)";
                            }
                            if ($postdata['overallHeight'] < $get_cal->xcp_height_limit_ft) {
                                $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                                $response[$calculation['xcp_state_id']]['violation'] = "";
                            }
                        } else {
                            $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                            $response[$calculation['xcp_state_id']]['violation'] = "";
                        }
                    }
                } else {
                    $response[$calculation['xcp_state_id']]['state_name'] = $state_list->state_name;
                    $response[$calculation['xcp_state_id']]['permit_required'] = "YES";
                    $get_cal = read_data_where_row("xcmg_permit_calculation", array("xcp_state_id" => $calculation['xcp_state_id'], "xcp_permit_type_id" => 17));
                    if (!empty($get_cal)) {
                        if ($postdata['width'] >= $get_cal->xcp_width_limit_ft) {
                            $response[$calculation['xcp_state_id']]['annual_permit'] = "No";
                            $response[$calculation['xcp_state_id']]['violation'] = "Width (W)";
                        }
                        if ($postdata['width'] < $get_cal->xcp_width_limit_ft) {
                            $response[$calculation['xcp_state_id']]['annual_permit'] = "YES";
                            $response[$calculation['xcp_state_id']]['violation'] = "";
                        }
                    } else {
                        $response[$calculation['xcp_state_id']]['annual_permit'] = "NO";
                        $response[$calculation['xcp_state_id']]['violation'] = "";
                    }
                }
            }
        }
        $data['width'] = $postdata['width'];
        $data['response'] = $response;
        $data['overallHeight'] = $postdata['overallHeight'];
        // pre($data['response']);die;

        $result = $this->load->view('canigetpermit/state_permit', $data, true);
        echo json_encode(array('status' => true, "result" => $result, 'message' => '<div class="alert alert-success">See your filterd resultt</div>'));
        die;
    }

    public function getAddress()
    {
        $RG_Lat = 100.753;
        $RG_Lon = 13.69362;

        $json = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" . $RG_Lat . "&lon=" . $RG_Lon . "&zoom=27&addressdetails=1";

        $ch = curl_init($json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0");
        $jsonfile = curl_exec($ch);
        curl_close($ch);

        $RG_array = json_decode($jsonfile, true);
        pre($RG_array);
        die;
        //   return $RG_array['display_name'];


        // $RG_array['address']['city'];
        // $RG_array['address']['country'];
    }


}
