<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manage_Permit_calculation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->model('email_model');
        $this->load->model('Customer_model');
        $this->load->model('Common_model', 'cm');
        $this->table = 'xcmg_permit_calculation';
        $this->state = 'xcmg_state';
        $this->permit_type = 'xcmg_permit_type';
        $this->truck_type = 'xcmg_truck_type';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  permittype list Section
      | -------------------------------------------------------------------------
     * 
     */

    public function index()
    {
        $data = array();
        $order_key = 'xcp_id';
        $order_value = 'desc';
        $data['permit_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
        $this->load->view('common/header');
        $this->load->view('permit/permit_calculation/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |User  add form Section
      | -------------------------------------------------------------------------
     * 
     */

    public function xcmg_create_permit_calculation_form()
    {
        $data = [];
        $data['state_list'] = read_data($this->state, "state_id", "desc");
        $data['permit_type'] = read_data($this->permit_type, "permit_id", "desc");
        $data['truck_type'] = read_data($this->truck_type, "xcmg_truck_type_id", "desc");
        $this->load->view('common/header');
        $this->load->view('permit/permit_calculation/create_form', $data);
        $this->load->view('common/footer');
    }
    /*
      | -------------------------------------------------------------------------
      |User Edit Form  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function permit_calculation_update($slider_id)
    {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/permit/permit_calculation');
        }
        $where = array();
        $where = array('xcp_id' => urldecrypt($slider_id));

        $data['xcp_id'] = urldecrypt($slider_id);
        $data['permit_calculation'] = read_data_where_row($this->table, $where);
        $data['truck_type'] = read_data($this->truck_type, "xcmg_truck_type_id", "desc");
        $data['state_list'] = read_data_where($this->state,array("state_status"=>1), "state_id", "desc");
        $data['permit_type'] = read_data_where($this->permit_type,array("permit_status"=>1), "permit_id", "desc");
        $this->load->view('common/header');
        $this->load->view('permit/permit_calculation/create_form', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |Permit Calculation update and insert
      | -------------------------------------------------------------------------
     * 
     */

    public function permit_calculation_validatation()
    {
        $this->form_validation->set_rules('truck_type_id', 'Select Truck type', 'required');
        $this->form_validation->set_rules('state_id', 'Select state', 'required');
        $this->form_validation->set_rules('permit_type_id', 'Select Permit type', 'required');
        // $this->form_validation->set_rules('width_limit_ft', 'width limit (ft)', 'required');
        // $this->form_validation->set_rules('height_limit_ft', 'Height limit (ft)', 'required');
        // $this->form_validation->set_rules('length_limit_ft', 'Length limit (ft)', 'required');
        // $this->form_validation->set_rules('tandem_lb', 'Tandem (lb)', 'required');
        // $this->form_validation->set_rules('tridem_lb', 'Tridem (lb)', 'required');
        if ($this->form_validation->run() == FALSE) {
            $validation = $this->form_validation->error_array();
            $field = array();
            foreach ($validation as $key => $value) {
                array_push($field, $key);
            }
            $res = array(
                'status' => "form_error",
                'field' => $field,
                'validation' => $validation,
                'message' => 'Submission failed due to validation error.'
            );
            echo json_encode($res);
            die;
        }
    }
    public function permit_calculation_update_insert()
    {
        $postdata = $this->input->post();
        $this->permit_calculation_validatation();
        $insert_data = array(
            "xcp_truck_type_id" => !empty($postdata['truck_type_id']) ? $postdata['truck_type_id'] : 0,
            "xcp_state_id" => !empty($postdata['state_id']) ? $postdata['state_id'] : 0,
            "xcp_permit_type_id" => !empty($postdata['permit_type_id']) ? $postdata['permit_type_id'] : 0,
            "xcp_width_limit_ft" => !empty($postdata['width_limit_ft']) ? $postdata['width_limit_ft'] : "",
            "xcmg_overall_operator" => !empty($postdata['overall_operator']) ? $postdata['overall_operator'] : "",
            "xcp_width_rule_operator" => !empty($postdata['width_rule_operator']) ? $postdata['width_rule_operator'] : "",
            "xcp_height_limit_ft" => !empty($postdata['height_limit_ft']) ? $postdata['height_limit_ft'] : "",
            "xcp_height_rule_operator" => !empty($postdata['height_rule_operator']) ? $postdata['height_rule_operator'] : "",
            "xcp_length_limit_ft" => !empty($postdata['length_limit_ft']) ? $postdata['length_limit_ft'] : "",
            "xcp_length_limit_operator" => !empty($postdata['length_limit_operator']) ? $postdata['length_limit_operator'] : "",
            "xcp_front_overhang_ft" => !empty($postdata['front_overhang_ft']) ? $postdata['front_overhang_ft'] : "",
            "xcp_rear_overhang_ft" => !empty($postdata['rear_overhang_ft']) ? $postdata['rear_overhang_ft'] : "",
            "xcp_steer_axle_lb" => !empty($postdata['steer_axle_lb']) ? $postdata['steer_axle_lb'] : "",
            "xcp_steer_axle_lb_in" => !empty($postdata['steer_axle_lb_in']) ? $postdata['steer_axle_lb_in'] : "",
            "xcp_single_axle_lb" => !empty($postdata['single_axle_lb']) ? $postdata['single_axle_lb'] : "",
            "xcp_single_axle_lb_in" => !empty($postdata['single_axle_lb_in']) ? $postdata['single_axle_lb_in'] : "",
            "xcp_axle_width_ft" => !empty($postdata['axle_width_ft']) ? $postdata['axle_width_ft'] : "",
            "xcp_axle_width_operator" => !empty($postdata['axle_width_operator']) ? $postdata['axle_width_operator'] : "",
            "xcp_tandem_lb" => !empty($postdata['tandem_lb']) ? $postdata['tandem_lb'] : "",
            "xcp_tandem_lb_in" => !empty($postdata['tandem_lb_in']) ? $postdata['tandem_lb_in'] : "",
            "xcp_tridem_lb" => !empty($postdata['tridem_lb']) ? $postdata['tridem_lb'] : "",
            "xcp_tridem_lb_in" => !empty($postdata['tridem_lb_in']) ? $postdata['tridem_lb_in'] : "",
            "xcp_quad_lb" => !empty($postdata['quad_lb']) ? $postdata['quad_lb'] : "",
            "xcp_quad_lb_in" => !empty($postdata['quad_lb_in']) ? $postdata['quad_lb_in'] : "",
            "xcp_5_axles_lb" => !empty($postdata['5_axles_lb']) ? $postdata['5_axles_lb'] : 0,
            "xcp_5_axles_lb_in" => !empty($postdata['5_axles_lb_in']) ? $postdata['5_axles_lb_in'] : 0,
            "xcp_gvw" => !empty($postdata['gvw']) ? $postdata['gvw'] : 0,
            "xcp_gvw_operator" => !empty($postdata['gvw_operator']) ? $postdata['gvw_operator'] :'',
            "xcp_noted" => !empty($postdata['noted']) ? $postdata['noted'] : "",
            "xcp_status" => !empty($postdata['status']) ? $postdata['status'] : 1,
        );

        if (!empty($postdata['calculation_id'])) {

            $where = array("xcp_id" => $postdata['calculation_id']);
            $insert_data['xcp_updated'] = date("Y-m-d h:i:s");
            $res = $this->Customer_model->update_data_where($insert_data, $where, $this->table);
            $msg = 'Permit Calculation Updated successfully';
        } else {
            $insert_data['xcp_created'] = date("Y-m-d h:i:s");
            $res = $this->db->insert($this->table, $insert_data);
            $msg = 'Permit Calculation Created successfully';
        }
        if ($res) {
            echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">' . $msg . '</div>'));
            die;
        } else {
            echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Somthing went wrong ,Please try again</div>'));
            die;
        }
    }



    public function delete_permit_calculation_($id)
    {
        if (!empty($id)) {
            $permittype = array();
            $permittype["xcp_id"] = urldecrypt($id);
            $response = delete_record($this->table, $permittype);
            if ($response) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit Calculation Deleted Successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/permit/permit_calculation");
        }
    }

    public function block_permit_calculation($id)
    {

        if ($id) {
            $data = array('xcp_status' => 2);
            $where = array();
            $where["xcp_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit Calculation has been Inactive successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            }
        }
    }

    public function unblock_permit_calculation($id)
    {
        if ($id) {
            $data = array('xcp_status' => 1);
            $where = array();
            $where["xcp_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {

                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit Calculation has been activated successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/permit_calculation");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some thing missing ,Please try again once</div>");
            redirect(base_url() . "superadmin/permit/permit_calculation");
        }
    }


    public function view_permit_calculation_details($userId)
    {
        if (empty($userId)) {
            redirect(base_url() . 'superadmin/permit/permit_calculation');
        }
        $where = array();
        $where = array(
            'xcp_id' => urldecrypt($userId)
        );
        $data['xcp_id'] = urldecrypt($userId);
        $data['permit_calculation'] = read_data_where_row($this->table, $where);
        $this->load->view('common/header');
        $this->load->view('permit/permit_calculation/view_calculation', $data);
        $this->load->view('common/footer');
    }
}
