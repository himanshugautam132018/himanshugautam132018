<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model');
        $this->table = "xcmg_user";
    }


    public function signup()
    {
        $data = array();
        $this->load->view('include/header');
        $this->load->view('registration/signup', $data);
        $this->load->view('include/footer');
    }

    public function chk_password_expression($str)
    {

        if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
            $this->form_validation->set_message('chk_password_expression', '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function testmail()
    {
        $send_data = array(
            'name' => "Himanshu Gautam",
            'sender_email' => "gautam@fennelinfotech.com",
            'sender_pass' => "Admin@123"
        );
        $this->Email_model->sentRegistration_login_detail_client($send_data);
    }

#============================= XCMG ARC User Login section ===============================>
    public function xcmgarc_login()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
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
            $validation_data = validate($this->table, array("user_email" => $data['email']));
            if ($validation_data) {
                $db_password = $this->encryption->decrypt($validation_data->user_password);
                if ($db_password == $data['password']) {
                    $updateLogindata = array(
                        "login_date_time" => date('Y-m-d h:i:s'),
                        "is_login" => 1,
                        "ip_address" => $this->input->ip_address(),
                    );
                    update_data_where($this->table,array("user_id" => $validation_data->user_id),$updateLogindata);
                    $this->session->unset_userdata('superadmin');
                    $this->session->unset_userdata('superadmin_data');
                    $this->session->set_userdata('xcmg_user', true);
                    $this->session->set_userdata('xcmgarc_userData', $validation_data);
                    echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">You have login successfully </div>'));
                    die;
                } else {
                    echo json_encode(array("status" => false, 'message' => '<div class="alert alert-danger">Invalid Password</div>'));
                }
            } else {
                echo json_encode(array("status" => false, 'message' => '<div class="alert alert-danger">Invalid Email</div>'));
            }
        }
    }
#============================= End XCMG ARC User Login section ===============================>


    public function xcmg_arc_user_registration()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('company', 'Comapny', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('company', 'Comapny', 'required');
        $this->form_validation->set_rules('phone', 'Phone number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[25]|callback_chk_password_expression');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[6]|max_length[25]|matches[password]|callback_chk_password_expression');

        if ($this->form_validation->run() == FALSE) {
            $validation = $this->form_validation->error_array();
            $field = array();
            foreach ($validation as $key => $value) {
                pre($key);
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
            $value_Exist = value_Exist($this->table, array("user_email" => $postdata['email']));
            if ($value_Exist) {
                $sMsg = 'Account already exists';
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">' . $sMsg . '</div>'));
                die;
            }
            $tempdata = time() . rand('111111', '999999');
            $s_registeration_number = generator(8, $this->table, "user_registration_number");
            $insert_data = array(
                "user_first_name" => $postdata['first_name'],
                "user_last_name" => $postdata['last_name'],
                "user_company" => $postdata['company'],
                "user_registration_number" => $s_registeration_number,
                "user_email" => $postdata['email'],
                "user_phone" => $postdata['phone'],
                "user_password" =>  $this->encryption->encrypt($postdata['password']),
                "ip_address" => $this->input->ip_address(),
                "user_created" => date("Y-m-d h:i:s"),
                'temp' => $tempdata,

            );
            // pre($insert_data);die;
            $customer_result_id = insert_data($this->table, $insert_data);

            if ($customer_result_id) {
                $send_data = array(
                    'name' => $postdata['first_name'],
                    'sender_email' => $postdata['email'],
                    'sender_pass' => $postdata['password']
                );
                @$this->Email_model->sentRegistration_login_detail_client($send_data);
                echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">User Registration successfully ,We have sent login details your email id</div>'));
                die;
            } else {
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Somthing went wrong to submitted your Client Registration ,Please try again</div>'));
                die;
            }
        }
    }
}
