<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->model('Common_model', 'cm');
        $this->load->model('Customer_model');
        $this->load->model('email_model');
        $this->load->model('login_model');
        $this->load->model('action_api_model');
        $this->table = 'koala_nursery_superadmin';
        $this->uploadPath = 'uploads/admin/';
//        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
//            return redirect(base_url());
//        }
    }

#Dashboard page 

    public function index() {

        $data=array();
        $this->load->view('common/header');
        $this->load->view('login/dashboard', $data);
        $this->load->view('common/footer');
    }
    
   
    
    public function admin_setting() {
        $login_user_data = $this->session->userdata('superadmin_data')->sa_id;
        $data['account_manager_profile'] = read_data_where_row($this->table, array('sa_id' => $login_user_data));
        $this->load->view('common/header');
        $this->load->view('setting/setting', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |admin profile update Section
      | -------------------------------------------------------------------------
     * 
     */

    public function admin_profile_update() {
        $table = $this->table;
        $data = $this->input->post();
        $sa_id = $this->input->post('superadmin_id');
        if (!empty($data['sa_name']) && !empty($data['sa_phone']) && !empty($data['sa_email']) && !empty($data['sa_address'])) {
            $where = array();
            $where = array(
                'sa_id ' => $sa_id
            );
            $imgData = array();
            $imgData = array(
                'sa_name' => $data['sa_name'],
                'sa_phone' => $data['sa_phone'],
                'sa_email' => $data['sa_email'],
                'sa_address' => $data['sa_address'],
                'sa_update' => date("Y-m-d h:i:s")
            );
            if (!empty($_FILES['image']['name'])) {

                $this->load->library('image_lib');
                $imageName = $_FILES['image']['name'];

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
                if ($this->upload->do_upload('image')) {
                    $filename_check = $this->db->get_where($this->table, array("sa_id" => $sa_id))->row('sa_picture');
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
                    $imgData['sa_picture'] = $thumbnail_image;
                } else {
                    $errorUploadType = $_FILES['image']['name'] . ' | ';
                    $error = array('error' => $this->upload->display_errors());
//                    $errorUploadType_result = !empty($errorUploadType) ? '<br/>File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    echo json_encode(array('msg' => $error['error'], 'status' => false));
                    die;
                }
            } else {
                $filename_check = $this->db->get_where($this->table, array("sa_id" => $sa_id))->row('sa_picture');
                if (empty($filename_check)) {
                    echo json_encode(array('msg' => 'Please upload Image!!! ', 'status' => false));
                    die;
                }
            }

//        $update = $this->Customer_model->update($imgData, $id, $table);
            $update = $this->Customer_model->update_data_where($imgData, $where, $this->table);
            if ($update) {
                echo json_encode(array('msg' => 'Profile Update Successfully.!!! ', 'status' => true));
                die;
            } else {
                echo json_encode(array('msg' => 'Some problems occurred, please try again.!!! ', 'status' => true));
                die;
            }
        } else {
            echo json_encode(array('msg' => 'Please Fill All Mandatory Field !!! ', 'status' => false));
            die;
        }
    }

    /*
      | -------------------------------------------------------------------------
      |Change Password Section
      | -------------------------------------------------------------------------
     * 
     */

    public function superadmin_password_change() {
        $data2 = array();
        $table = $this->table;
        $data = $this->input->post();
        if (!empty($data['sa_id']) && !empty($data['current_password']) && !empty($data['new_password']) && !empty($data['cnew_password'])) {
            if ($data['new_password'] == $data['cnew_password']) {
                $getcustomerinfo = $this->Customer_model->getCustomerDetail($data['sa_id']);
                $prev_pass = $this->encryption->decrypt($getcustomerinfo->sa_password);
                if ($prev_pass == $data['current_password']) {
                    $data2 = array(
                        'sa_id' => $data['sa_id'],
                        'sa_password' => $this->encryption->encrypt($data['new_password']),
                        'sa_update' => date('Y-m-d h:i:s')
                    );
                    $result = $this->Customer_model->updateClientPass($table, $data2);
                    if ($result) {
                        $getcustomerupdateinfo = $this->Customer_model->getCustomerDetail($data['sa_id']);
                        $this->session->set_userdata('account_manager_data', $getcustomerupdateinfo);

                        echo json_encode(array('msg' => 'Password Change Successfully', 'status' => true));
                        die;
                    } else {
                        echo json_encode(array('msg' => 'Unable to Update Please Try Again !!', 'status' => false));
                        die;
                    }
                } else {
                    echo json_encode(array('msg' => 'Current Password Invalid Please Try Again!!!!', 'status' => false));
                    die;
                }
            } else {
                echo json_encode(array('msg' => 'Password Mismatch Please Try Again !!!!', 'status' => false));
                die;
            }
        } else {
            echo json_encode(array('msg' => 'Please Fill All Mandatory Field !!! ', 'status' => false));
            die;
        }
    }

}
