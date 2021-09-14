<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model');
        $this->table = "xcmg_user";
        $this->uploadPath = 'uploads/user/';
        if (!array_key_exists('xcmgarc_userData', $_SESSION) && empty($_SESSION['xcmgarc_userData'])) {
            return redirect(base_url());
        }
    }

    public function index()
    {
        $data = array();
        $userId = $this->session->userdata('xcmgarc_userData')->user_id;
        $data['user_info'] = read_data_where_row($this->table, array("user_id" => $userId));
        $this->load->view('include/header');
        $this->load->view('dashboard/index', $data);
        $this->load->view('include/footer');
    }
    public function xcmg_user_profile_update()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('fname', 'First name', 'required');
        $this->form_validation->set_rules('lname', 'Last name', 'trim|required');
        $this->form_validation->set_rules('comapny', 'Company', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
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
            $where = array();
            $where = array(
                'user_id  ' => $postdata['user_id']
            );
            $imgData = array();
            $imgData = array(
                'user_first_name' => $postdata['fname'],
                'user_last_name' => $postdata['lname'],
                'user_company' => $postdata['comapny'],
                'user_email' => $postdata['email'],
                'user_phone' => $postdata['mobile'],
                'user_updated' => date("Y-m-d h:i:s")
            );
            if (!empty($_FILES['user_profile_image']['name'])) {

                $this->load->library('image_lib');
                $imageName = $_FILES['user_profile_image']['name'];

                $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $imageName);
                $new_img_name = time() . '-' . $strreplaced;
                $config['file_name'] = $new_img_name;
                if (preg_match('/(\.tif|\.tiff)$/i', $config['file_name'])) {
                    echo json_encode(array('msg' => 'tiff Extension image Not supported!!! ', 'status' => false));
                    die;
                }
                // File upload configuration 
                $config['upload_path'] = $this->uploadPath;
                $config['allowed_types'] = '*';
                $config['max_size'] = 2000;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server 
                if ($this->upload->do_upload('user_profile_image')) {
                    $filename_check = $this->db->get_where($this->table, array("user_id" => $postdata['user_id']))->row('user_profile_image');
                    if (!empty($filename_check)) {
                        @unlink($this->uploadPath . $filename_check);
                    }
                    $image_data = $this->upload->data();
                    $configer = array(
                        'image_library' => 'gd2',
                        'source_image' => $image_data['full_path'],
                        'maintain_ratio' => TRUE,
                        'width' => 250,
                        'height' => 140,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();
                    $thumbnail_image = $image_data['raw_name'] . $image_data['file_ext'];
                    $imgData['user_profile_image'] = $thumbnail_image;
                } else {

                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode(array('msg' => $error['error'], 'status' => false));
                    die;
                }
            } else {
                $filename_check = $this->db->get_where($this->table, array("user_id" => $postdata['user_id']))->row('user_profile_image');
                if (empty($filename_check)) {
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Please upload Image!!!</div>'));
                    die;
                }
            }

            $update = update_data_where($this->table, $where, $imgData);
            if ($update) {
                echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">Profile Update Successfully.!!!</div>'));
                die;
            } else {
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Some problems occurred, please try again.!!!</div>'));
                die;
            }
        }
    }

    public  function chk_password_expression($str)
    {
        if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
            $this->form_validation->set_message('chk_password_expression', '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function xcmg_user_password_change()
    {
        $postdata = $this->input->post();
        $this->form_validation->set_rules('current_password', 'current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[35]|callback_chk_password_expression');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|min_length[6]|max_length[35]|matches[password]|callback_chk_password_expression');

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
            if ($postdata['password'] == $postdata['confirm_password']) {
                $getcustomerinfo = getDetail($this->table, array("user_id " => $postdata['active_user_id']));
                $prev_pass = $this->encryption->decrypt($getcustomerinfo->user_password);

                if ($prev_pass == $postdata['current_password']) {
                    $data2 = array(
                        'user_password' => $this->encryption->encrypt($postdata['password']),
                        'user_updated' => date('Y-m-d h:i:s')
                    );
                    $result = update_data_where($this->table, array("user_id" => $postdata['active_user_id']), $data2);
                    if ($result) {
                        $getcustomerupdateinfo = getDetail($this->table, array("user_id " => $postdata['active_user_id']));
                        $this->session->set_userdata('xcmgarc_userData', $getcustomerupdateinfo);
                        echo json_encode(array('status' => true, 'message' => '<div class="alert alert-success">Password Change Successfully</div>'));
                        die;
                    } else {
                        echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Unable to Update Please Try Again !!</div>'));
                        die;
                    }
                } else {
                    echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Current Password Invalid Please Try Again!!!!</div>'));
                    die;
                }
            } else {
                echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Password and confirm password should be same</div>'));
                die;
            }
        }
    }


    public function xcmg_user_logout()
    {
        $session_data = $this->session->userdata('xcmgarc_userData');
        if (!empty($session_data)) {
            update_data_where($this->table,array("user_id"=>$session_data->user_id),array("is_login"=>0));
            $this->session->unset_userdata('xcmg_user');
            $this->session->unset_userdata('xcmgarc_userData');
            redirect(base_url());
        }
        redirect(base_url());
    }
}
