<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manage_state extends MY_Controller
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
        $this->table = 'xcmg_state';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  state list Section
      | -------------------------------------------------------------------------
     * 
     */

    public function index()
    {
        $data = array();
        $order_key = 'state_id';
        $order_value = 'desc';
        $data['state_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
        $this->load->view('common/header');
        $this->load->view('permit/state/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |User  add form Section
      | -------------------------------------------------------------------------
     * 
     */

    public function state_add_form()
    {
        $this->load->view('common/header');
        $this->load->view('permit/state/state_create_form');
        $this->load->view('common/footer');
    }
    /*
      | -------------------------------------------------------------------------
      |User Edit Form  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function state_edit_form($slider_id)
    {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/permit/state');
        }
        $where = array();
        $where = array('state_id' => urldecrypt($slider_id));

        $data['state_id'] = urldecrypt($slider_id);
        $data['state_list'] = read_data_where_row($this->table, $where);
        $this->load->view('common/header');
        $this->load->view('permit/state/state_create_form', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |create User and Update user information
      | -------------------------------------------------------------------------
     * 
     */


    public function create_update_user_information_section()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('state_code', 'State Code', 'required');
        $this->form_validation->set_rules('state_code', 'State Name', 'required');

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
        } else {
            $insert_data = array(
                "state_code" => $postdata['state_code'],
                "state_name" => $postdata['state_name'],
            );


            if (!empty($postdata['state_id'])) {

                $where = array("state_id" => $postdata['state_id']);
                $insert_data['state_updated'] = date("Y-m-d h:i:s");
                $res = $this->Customer_model->update_data_where($insert_data, $where, $this->table);
                $msg = 'State Updated successfully';
            } else {
                $check_exist = validate($this->table, array("state_name" => $postdata['state_name']));
                if ($check_exist) {
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">State code and state name already exist !!</div>'));
                    die;
                }
                $insert_data['state_created'] = date("Y-m-d h:i:s");
                $res = $this->db->insert($this->table, $insert_data);
                $msg = 'State Created successfully';
            }
            if ($res) {
                echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">' . $msg . '</div>'));
                die;
            } else {
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Somthing went wrong ,Please try again</div>'));
                die;
            }
        }
    }



    public function state_delete($id)
    {
        if (!empty($id)) {
            $state = array();
            $state["state_id"] = urldecrypt($id);
            $response = delete_record($this->table, $state);
            if ($response) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>State Deleted Successfully</div>");
                redirect(base_url() . "superadmin/permit/state");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/permit/state");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/permit/state");
        }
    }

    public function block($id)
    {

        if ($id) {
            $data = array('state_status' => 2);
            $where = array();
            $where["state_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>State has been Inactive successfully</div>");
                redirect(base_url() . "superadmin/permit/state");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/state");
            }
        }
    }

    public function unblock($id)
    {
        if ($id) {
            $data = array('state_status' => 1);
            $where = array();
            $where["state_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {

                $this->session->set_flashdata("message", "<div class='alert alert-success'>State has been activated successfully</div>");
                redirect(base_url() . "superadmin/permit/state");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/state");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some thing missing ,Please try again once</div>");
            redirect(base_url() . "superadmin/permit/state");
        }
    }
}
