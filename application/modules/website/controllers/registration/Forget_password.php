<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forget_password extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('email_model');
        $this->load->model('login_model');
        $this->table = "xcmg_user";
    }

    public function index()
    {
        $data = array();
        $this->load->view('include/header');
        $this->load->view('registration/forget_password', $data);
        $this->load->view('include/footer');
    }
    public function sent_reset_password_link()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('forget_email', 'E-mail', 'required');

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
            if (!empty($postdata['forget_email'])) {
                $validation_data = validate($this->table, array("user_email" => $postdata['forget_email']));
                if ($validation_data) {
                    $updateLogindata = array(
                        "temp_time" => strtotime(date('Y-m-d h:i:s')),
                        "temp_time_status" => 1,
                    );
                    update_data_where($this->table, array("user_id" => $validation_data->user_id), $updateLogindata);
                    $mail_res = $this->email_model->sendCustomerResetMail($validation_data->user_id, $validation_data->user_email);
                    if ($mail_res) {
                        echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">We have sent you forget password link on your registered email </div>'));
                        die;
                    } else {
                        echo json_encode(array('status' => false, 'message' => '<div class="alert alert-success">something went wrong ,please try again once</div>'));
                        die;
                    }
                } else {
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Email not registered !!</div>'));
                    die;
                }
            } else {
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Please enter Email</div>'));
                die;
            }
        }
    }


    public function xcmg_user_forget_password_form_update_pasword($client_id = FALSE, $dtime = FALSE)
    {
        if (!empty($client_id) && !empty($dtime)) {
            $time_checker = $this->login_model->checkResetStatus($client_id, $dtime);
            $data['client_id'] = '';
            if ($time_checker) {
                $result = $this->login_model->upadateTimerStatus($client_id);

                if ($result) {

                    $data['client_id'] = $client_id;
                }
                $data['client_id'] = $client_id;
            }
            // pre($data);die;
            $this->load->view('include/header', $data);
            $this->load->view('registration/reset_password_page', $data);
            $this->load->view('include/footer');
        } else {
            redirect(base_url());
        }
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
    public function xcmg_user_forget_password_update()
    {
        $postdata = $this->input->post();
        if (!empty($postdata)) {
            $this->form_validation->set_rules('update_password', 'Password', 'trim|required|min_length[6]|max_length[25]|callback_chk_password_expression');
            $this->form_validation->set_rules('update_confirm_password', 'Confirm password', 'trim|required|min_length[6]|max_length[25]|matches[update_password]|callback_chk_password_expression');

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

                if ($postdata['update_password'] == $postdata['update_confirm_password']) {
                    $rest = array(
                        'user_password' => $this->encryption->encrypt($postdata['update_password']),
                        'user_updated' => date('Y-m-d h:i:s')
                    );
                    $result = update_data_where($this->table, array("user_id" => $postdata['user_id']), $rest);
                    if ($result) {
                        echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">Password Update Successfully </div>'));
                        die;
                    } else {
                        echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Unable to Update Please Try Again !!!</div>'));
                        die;
                    }
                } else {
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Password and Confirm Password Mismatch Please Try Again !!!</div>'));
                    die;
                }
            }
        } else {
            echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">All field are mandatory</div>'));
            die;
        }
    }
}
