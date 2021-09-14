<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manage_Permit_type extends MY_Controller
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
        $this->table = 'xcmg_permit_type';
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
        $order_key = 'permit_id';
        $order_value = 'desc';
        $data['permit_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
        $this->load->view('common/header');
        $this->load->view('permit/permittype/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |User  add form Section
      | -------------------------------------------------------------------------
     * 
     */

    public function permit_type_add_form()
    {
        $this->load->view('common/header');
        $this->load->view('permit/permittype/create_form');
        $this->load->view('common/footer');
    }
    /*
      | -------------------------------------------------------------------------
      |User Edit Form  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function permit_type_edit_form($slider_id)
    {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/permit/permit_type');
        }
        $where = array();
        $where = array('permit_id' => urldecrypt($slider_id));

        $data['permit_id'] = urldecrypt($slider_id);
        $data['permit_type_list'] = read_data_where_row($this->table, $where);
        $this->load->view('common/header');
        $this->load->view('permit/permittype/create_form', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |create User and Update user information
      | -------------------------------------------------------------------------
     * 
     */


    public function create_update_permit_type_information_section()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('permit_type', 'permittype Code', 'required');
        $this->form_validation->set_rules('permit_status', 'Status', 'required');

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
                "permit_type" => $postdata['permit_type'],
                "permit_status" => $postdata['permit_status'],
            );

            if (!empty($postdata['permit_id'])) {

                $where = array("permit_id" => $postdata['permit_id']);
                $insert_data['permit_updated'] = date("Y-m-d h:i:s");
                $res = $this->Customer_model->update_data_where($insert_data, $where, $this->table);
                $msg = 'Permit type Updated successfully';
            } else {
                $check_already_exist=validate($this->table,array("permit_type"=>$postdata['permit_type']));
                if($check_already_exist){
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">This permit type already exist ,Please use different permit type</div>'));
                    die;  
                }
                $insert_data['permit_created'] = date("Y-m-d h:i:s");
                $res = $this->db->insert($this->table, $insert_data);
                $msg = 'Permit type Created successfully';
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



    public function permit_type_delete($id)
    {
        if (!empty($id)) {
            $permittype = array();
            $permittype["permit_id"] = urldecrypt($id);
            $response = delete_record($this->table, $permittype);
            if ($response) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit type Deleted Successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/permit/permit_type");
        }
    }

    public function block($id)
    {

        if ($id) {
            $data = array('permit_status' => 2);
            $where = array();
            $where["permit_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit type has been Inactive successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            }
        }
    }

    public function unblock($id)
    {
        if ($id) {
            $data = array('permit_status' => 1);
            $where = array();
            $where["permit_id"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {

                $this->session->set_flashdata("message", "<div class='alert alert-success'>Permit type has been activated successfully</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/permit/permit_type");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some thing missing ,Please try again once</div>");
            redirect(base_url() . "superadmin/permit/permit_type");
        }
    }
}
