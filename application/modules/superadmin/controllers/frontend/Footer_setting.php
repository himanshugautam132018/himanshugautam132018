<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Footer_setting extends MY_Controller
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
        $this->uploadPath = 'uploads/footer_setting/';
        $this->table = 'footer_setting';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  slider Section
      | -------------------------------------------------------------------------
     * 
     */

    public function index()
    {
        $data = array();
        $data['footer_setting'] = read_data($this->table); //1 : table name ,2 : order_key ,3 orderby value
        $this->load->view('common/header');
        $this->load->view('frontend/footer_setting/index', $data);
        $this->load->view('common/footer');
    }

    public function edit_footer_setting($home_setting_id)
    {
        if (empty($home_setting_id)) {
            redirect(base_url() . '/superadmin/home_page_setting');
        }
        $where = array();
        $where = array(
            'id ' => urldecrypt($home_setting_id)
        );
       $data['id'] = urldecrypt($home_setting_id);
        $data['footer_setting'] = read_data_where_row($this->table, $where);

        $this->load->view('common/header');
        $this->load->view('frontend/footer_setting/footer_setting_update', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |slider Update Section
      | -------------------------------------------------------------------------
     * 
     */

    public function footer_setting_information_update()
    {
        $table = $this->table;
        $data = $this->input->post();
        $id = $this->input->post('id');
        // pre($data);die;
        if (!empty($data['aboutus_title']) && !empty($data['description'])) {

            $where = array();
            $where = array(
                'id' => $id
            );
            $postdata = array();

            
            // pre( $postdata['logo_image']);die;
            $postdata = array(
                'aboutus_title' => $data['aboutus_title'],
                'description' => $data['description'],
                'email' => !empty($data['email'])?$data['email']:null,
                'phone' => !empty($data['phone'])?$data['phone']:null,
                'twitter' => !empty($data['twitter']) ? $data['twitter'] :null,
                'facebbok' => !empty($data['facebbok']) ? $data['facebbok'] :null,
                'instagram' => !empty($data['instagram']) ? $data['instagram'] :null,
                'dribble' => !empty($data['dribble']) ? $data['dribble'] :null,
                'updated' => date("Y-m-d h:i:s")
            );
            if (!empty($_FILES['logo_image']['name'])) {
                $profile_pic = upload_image_doc_helper($_FILES['logo_image'], $this->uploadPath); //image upload section
                if ($profile_pic['status'] == true) {
                    $fileData_res = $profile_pic['data'];
                    $postdata['logo_image'] = $fileData_res['file_name'];
                } else {
                    $statusMsg = "Sorry, there was an error uploading logo image." . $profile_pic['error'];
                    echo json_encode(array('status' => false, 'msg' => $statusMsg));
                    die;
                }
            } 
            $update = $this->Customer_model->update_data_where($postdata, $where, $table);

            if ($update) {
                $msg = 'Home Page Setting updated  Successfully!!!';
                echo json_encode(array('msg' => $msg, 'status' => true));
                die;
            } else {
                $msg = 'Something went wrong ,Please try again!!!';
                echo json_encode(array('msg' => $msg, 'status' => true));
                die;
            }
        } else {
            echo json_encode(array('msg' => 'Please Fill All Mandatory Field !!! ', 'status' => false));
            die;
        }
    }


    public function home_setting_image_delete()
    {
        $imageid = $this->input->post('imageid');
        if (!empty($imageid)) {
            $record_id["imageid"] = $imageid;
            unlink_image('upload_document', $record_id, $this->uploadPath);
            $response = delete_record('upload_document', $record_id);
            if ($response) {
                $error = 'Image deleted Successfully';
                echo json_encode(array('msg' => $error, 'status' => true));
                die;
            } else {
                $error = 'Image not deleted Successfully';
                echo json_encode(array('msg' => $error, 'status' => false));
                die;
            }
        } else {
            $error = 'something went wrong , Please try again';
            echo json_encode(array('msg' => $error, 'status' => false));
            die;
        }
    }
}
