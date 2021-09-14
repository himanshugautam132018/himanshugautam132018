<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->helper('url');
        $this->load->model('email_model');
        $this->load->model('Customer_model');
        $this->load->model('Common_model', 'cm');
        $this->uploadPath = 'uploads/user/';
        $this->table = 'xcmg_user';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  slider Section
      | -------------------------------------------------------------------------
     * 
     */
    public function testmail()
    {
        $this->email_model->sendCustomerResetMail(585, "gautam@fennelinfotech.com");
    }
    public function index()
    {
        $data = array();
        $order_key = 'user_id  ';
        $order_value = 'desc';
        $data['slider_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
        //        pre($data['slider_listing']);die;
        $this->load->view('common/header');
        $this->load->view('user/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |User  add form Section
      | -------------------------------------------------------------------------
     * 
     */

    public function user_add_form()
    {
        $this->load->view('common/header');
        $this->load->view('user/create_user_form');
        $this->load->view('common/footer');
    }
    /*
      | -------------------------------------------------------------------------
      |User Edit Form  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function user_edit_form($slider_id)
    {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/user/user_list');
        }
        $where = array();
        $where = array(
            'user_registration_number ' => urldecrypt($slider_id)
        );
        $data['user_registration_number'] = urldecrypt($slider_id);
        $data['user_list'] = read_data_where_row($this->table, $where);
        $this->load->view('common/header');
        $this->load->view('user/create_user_form', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |create User and Update user information
      | -------------------------------------------------------------------------
     * 
     */
    public function chk_password_expression($str)

    {

        if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
            $this->form_validation->set_message('chk_password_expression', '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function save_user_information_update()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('company', 'Comapny', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone number', 'required');
        if (empty($postdata['user_id'])) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]|callback_chk_password_expression');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[6]|max_length[15]|matches[password]|callback_chk_password_expression');
        }
        
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
            $s_registeration_number = generator(8, $this->table, "user_registration_number");
            $insert_data = array(
                "user_first_name" => $postdata['first_name'],
                "user_last_name" => $postdata['last_name'],
                "user_company" => $postdata['company'],
                "user_email" => $postdata['email'],
                "user_phone" => $postdata['phone'],
                "user_status" => $postdata['status'],
            );
            if (!empty($_FILES['user_profile_image']['name'])) {
                $profile_pic = upload_image_doc_helper($_FILES['user_profile_image'], $this->uploadPath);
                if ($profile_pic['status'] == true) {
                    $fileData_res = $profile_pic['data'];
                    $insert_data['user_profile_image'] = $fileData_res['file_name'];
                } else {
                    $statusMsg = "Sorry, there was an error uploading Profile Pic." . $profile_pic['error'];
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">' . $statusMsg . '</div>'));
                    die;
                }
            }
            if (!empty($postdata['user_id'])) {

                $where = array("user_registration_number" => $postdata['user_id']);
                $insert_data['user_updated'] = date("Y-m-d h:i:s");
                $res = $this->Customer_model->update_data_where($insert_data, $where, $this->table);
               $msg = 'User Updated successfully';
            } else {
                $insert_data['user_registration_number'] = $s_registeration_number;
                $insert_data['user_password'] = $this->encryption->encrypt($postdata['password']);
                $insert_data['user_created'] = date("Y-m-d h:i:s");
                $res = $this->db->insert($this->table, $insert_data);
                $msg = 'User Created successfully';
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

    /*
      | -------------------------------------------------------------------------
      |View User Details Section
      | -------------------------------------------------------------------------
     * 
     */

    public function view_user_details($userId)
    {
        if (empty($userId)) {
            redirect(base_url() . '/superadmin/user/user_list');
        }
        $where = array();
        $where = array(
            'user_registration_number ' => urldecrypt($userId)
        );
        $data['user_registration_number'] = urldecrypt($userId);
        $data['user_details'] = read_data_where_row($this->table, $where);
        $this->load->view('common/header');
        $this->load->view('user/view_user', $data);
        $this->load->view('common/footer');
    }


    public function user_deleted($id)
    {
        if (!empty($id)) {
            $user = array();
            $user["user_registration_number"] = urldecrypt($id);
            $response = delete_record($this->table, $user);
            if ($response) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>User Deleted Successfully</div>");
                redirect(base_url() . "superadmin/user/user_list");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/user/user_list");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/user/user_list");
        }
    }

    public function block($id)
    {

        if ($id) {
            $data = array('user_status' => 2);
            $where = array();
            $where["user_registration_number"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            // $update = $this->modal->update_data_where("create_account", $where, $data);
            if ($update) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>user has been Inactive successfully</div>");
                redirect(base_url() . "superadmin/user/user_list");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/user/user_list");
            }
        }
    }

    public function unblock($id)
    {
        if ($id) {
            $data = array('user_status' => 1);
            $where = array();
            $where["user_registration_number"] = urldecrypt($id);
            $update = $this->Customer_model->update_data_where($data,  $where, $this->table);
            if ($update) {

                $this->session->set_flashdata("message", "<div class='alert alert-success'>User has been activated successfully</div>");
                redirect(base_url() . "superadmin/user/user_list");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Some problems occurred, please try again</div>");
                redirect(base_url() . "superadmin/user/user_list");
            }
        } else {
        }
    }
}
