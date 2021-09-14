<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_block_setting extends MY_Controller {

    public function __construct() {
        parent::__construct();

        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->helper('url');
        $this->load->model('email_model');
        $this->load->model('Customer_model');
        $this->load->model('Common_model', 'cm');
        $this->uploadPath = 'uploads/homepagesetting/';
        $this->table = 'home_page_setting';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  slider Section
      | -------------------------------------------------------------------------
     * 
     */

    public function index() {
        $data = array();
        $data['home_setting'] = read_data($this->table); //1 : table name ,2 : order_key ,3 orderby value
//        pre($data['slider_listing']);die;
        $this->load->view('common/header');
        $this->load->view('frontend/home_page_setting/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |Create  Home Page Setting  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function create_home_page_setting() {
        $this->load->view('common/header');
        $this->load->view('frontend/home_page_setting/create_home_page_setting');
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |Create home page seting Section
      | -------------------------------------------------------------------------
     * 
     */

    public function save_home_page_setting() {
        $table = $this->table;
        $data = $this->input->post();
        if (!empty($data['aboutus_title']) && !empty($data['aboutus_description'])) {
            $page_postdata = array();
            $page_postdata = array(
                'aboutus_title' => $data['aboutus_title'],
                'aboutus_description' => $data['aboutus_description'],
               
                'created' => date("Y-m-d h:i:s")
            );
            $this->db->insert($this->table, $page_postdata);
            $last_sliderid = $this->db->insert_id();

            if ($last_sliderid) {

                if (!empty($_FILES['about_us_thumbnail']['name'])) {
                    $uploadData = array();
//                    for ($i = 0; $i < $filesCount; $i++) {
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['about_us_thumbnail']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['about_us_thumbnail']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['about_us_thumbnail']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['about_us_thumbnail']['error'];
                    $_FILES['file']['size'] = $_FILES['about_us_thumbnail']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/homepagesetting/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $last_sliderid;
                        $uploadData['imageFor'] = 'homesetting';
                        $uploadData['image_full_path'] = base_url() . '/' . $this->uploadPath . $fileData['file_name'];
                        $uploadData['createdAt'] = date("Y-m-d H:i:s");
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(array('msg' => $error['error'], 'status' => false));
                        die;
                    }
                    if (!empty($uploadData)) {
                        $insert = $this->db->insert('upload_document', $uploadData);
                        if ($insert) {
                            $msg = 'Home Page Setting  created Successfully!!!';
                            echo json_encode(array('msg' => $msg, 'status' => true));
                            die;
                        } else {
                            $statusMsg = 'Some problem occurred, please try again.';
                            echo json_encode(array('msg' => $statusMsg, 'status' => false));
                            die;
                        }
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(array('msg' => $error['error'], 'status' => false));
                        die;
                    }
                } else {
                    $statusMsg = "Please Upload  About Us Thumbnail Image";
                    echo json_encode(array('msg' => $statusMsg, 'status' => false));
                    die;
                }
            } else {
                $msg = 'Something went wrong ,Please try again!!!';
                echo json_encode(array('msg' => $msg, 'status' => false));
                die;
            }
        } else {
            echo json_encode(array('msg' => 'Please Fill All Mandatory Field !!! ', 'status' => false));
            die;
        }
    }

    /*
      | -------------------------------------------------------------------------
      |slider View Section
      | -------------------------------------------------------------------------
     * 
     */



    /*
      | -------------------------------------------------------------------------
      |slider Edit page  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function edit_home_page_setting($home_setting_id) {
        if (empty($home_setting_id)) {
            redirect(base_url() . '/superadmin/home_page_setting');
        }
        $where = array();
        $where = array(
            'id ' => urldecrypt($home_setting_id)
        );
        $where_clause = array();
        $where_clause = array(
            "imageForId" => urldecrypt($home_setting_id),
            'imageFor' => "homesetting"
        );

        $data['id'] = urldecrypt($home_setting_id);
        $data['home_page_setting'] = read_data_where_row($this->table, $where);
        $data['home_page_seeting_image'] = read_data_where('upload_document', $where_clause);
       
        $this->load->view('common/header');
        $this->load->view('frontend/home_page_setting/home_page_setting_edit', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |slider Update Section
      | -------------------------------------------------------------------------
     * 
     */

    public function home_page_setting_information_update() {
        $table = $this->table;
        $data = $this->input->post();
        $id = $this->input->post('id');
       if (!empty($data['aboutus_title'])&& !empty($data['aboutus_description']) ) {
         
            $where = array();
            $where = array(
                'id' => $id
            );
            $postdata = array();
            $postdata = array(
                'aboutus_title' => $data['aboutus_title'],
                'aboutus_description' => $data['aboutus_description'],
                'created' => date("Y-m-d h:i:s")
            );
            $update = $this->Customer_model->update_data_where($postdata, $where, $table);

            if ($update) {
                if (!empty($_FILES['about_us_thumbnail']['name'])) {
                    $image_check = $this->db->get_where('upload_document', array("imageForId" => $id, "imageFor" => 'homesetting'))->result_array();
                    if (!empty($image_check)) {
                        $record_image["imageForId"] = $id;
                        $record_image["imageFor"] = 'homesetting';
                        unlink_multiple_image('upload_document', $record_image, $this->uploadPath);
                        $response = delete_record('upload_document', $record_image);
                    }
                    $uploadData = array();
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['about_us_thumbnail']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['about_us_thumbnail']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['about_us_thumbnail']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['about_us_thumbnail']['error'];
                    $_FILES['file']['size'] = $_FILES['about_us_thumbnail']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/homepagesetting/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $id;
                        $uploadData['imageFor'] = 'homesetting';
                        $uploadData['image_full_path'] = base_url() . '/' . $this->uploadPath . $fileData['file_name'];
                        $uploadData['createdAt'] = date("Y-m-d H:i:s");
                    } else {
                        // echo  $this->upload->display_errors();
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(array('msg' => $error['error'], 'status' => false));
                        die;
                    }
                    if (!empty($uploadData)) {
                        $insert = $this->db->insert('upload_document', $uploadData);
                        if ($insert) {
                            $msg = 'Home Setting  updated  Successfully!!!';
                            echo json_encode(array('msg' => $msg, 'status' => true));
                            die;
                        } else {
                            $statusMsg = 'Some problem occurred, please try again.';
                            echo json_encode(array('msg' => $statusMsg, 'status' => false));
                            die;
                        }
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(array('msg' => $error['error'], 'status' => false));
                        die;
                    }
                } else {
                    $filename_check = $this->db->get_where('upload_document', array("imageForId" => $id, 'imageFor' => 'homesetting'))->result_array();
                    if (empty($filename_check)) {
                        echo json_encode(array('msg' => 'Please Upload Slider image', 'status' => false));
                        die;
                    } else {
                        $msg = 'Home Page Setting updated  Successfully!!!';
                        echo json_encode(array('msg' => $msg, 'status' => true));
                        die;
                    }
                }
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
    
    
    public function home_setting_image_delete() {
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
