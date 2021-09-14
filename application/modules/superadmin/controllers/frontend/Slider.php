<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {

    public function __construct() {
        parent::__construct();

        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->helper('url');
        $this->load->model('email_model');
        $this->load->model('Customer_model');
        $this->load->model('Common_model', 'cm');
        $this->uploadPath = 'uploads/slider/';
        $this->table = 'slider';
    }

    /*
      | -------------------------------------------------------------------------
      |listing  slider Section
      | -------------------------------------------------------------------------
     * 
     */

    public function index() {
        $data = array();
        $order_key = 'slider_id';
        $order_value = 'desc';
        $data['slider_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
//        pre($data['slider_listing']);die;
        $this->load->view('common/header');
        $this->load->view('frontend/slider/index', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |Create  slider page Section
      | -------------------------------------------------------------------------
     * 
     */

    public function create_slider_page() {
        $this->load->view('common/header');
        $this->load->view('frontend/slider/create_slider');
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |Create Sluder Section
      | -------------------------------------------------------------------------
     * 
     */

    public function save_slider_information() {
        $table = $this->table;
        $data = $this->input->post();
        if (!empty($data['slider_title']) && !empty($data['slider_decription']) ) {
            $page_postdata = array();
            $page_postdata = array( 
                'slider_title' => $this->input->post('slider_title'),
                'slider_description' => $this->input->post('slider_decription'),
                'slider_status' => $data['slider_status'],
                'slider_created' => date("Y-m-d h:i:s")
            );
            $this->db->insert($this->table, $page_postdata);
            $last_sliderid = $this->db->insert_id();

            if ($last_sliderid) {

                if (!empty($_FILES['slider_image']['name'])) {
                    $uploadData = array();
//                    for ($i = 0; $i < $filesCount; $i++) {
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['slider_image']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['slider_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['slider_image']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['slider_image']['error'];
                    $_FILES['file']['size'] = $_FILES['slider_image']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/slider/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $last_sliderid;
                        $uploadData['imageFor'] = 'slider';
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
                            $msg = 'Slider created Successfully!!!';
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
                    $statusMsg = "Please Upload Slider image";
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

    public function slider_view_details($slider_id) {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/slider');
        }
        $data = array();
        $where = array();
        $where = array(
            'slider_id  ' => urldecrypt($slider_id)
        );
        $data['slider_id '] = urldecrypt($slider_id);
        $data['slider_view'] = read_data_where_row($this->table, $where);
        $where_clause = array();
        $where_clause = array(
            "imageForId" => urldecrypt($slider_id),
            'imageFor' => "slider"
        );
        $data['slider_image'] = read_data_where('upload_document', $where_clause);
        $this->load->view('common/header');
        $this->load->view('frontend/slider/slider_view', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |slider Edit page  Section
      | -------------------------------------------------------------------------
     * 
     */

    public function edit_slider($slider_id) {
        if (empty($slider_id)) {
            redirect(base_url() . '/superadmin/page');
        }
        $where = array();
        $where = array(
            'slider_id ' => urldecrypt($slider_id)
        );
        $where_clause = array();
        $where_clause = array(
            "imageForId" => urldecrypt($slider_id),
            'imageFor' => "slider"
        );

        $data['slider_id'] = urldecrypt($slider_id);
        $data['slider_view'] = read_data_where_row($this->table, $where);
        $data['slider_image'] = read_data_where('upload_document', $where_clause);
//        pre($data);die;
        $this->load->view('common/header');
        $this->load->view('frontend/slider/slider_edit', $data);
        $this->load->view('common/footer');
    }

    /*
      | -------------------------------------------------------------------------
      |slider Update Section
      | -------------------------------------------------------------------------
     * 
     */

    public function slider_information_update() {
        $table = $this->table;
        $data = $this->input->post();
        $slider_id = $this->input->post('slider_id');
        if (!empty($data['slider_title']) && !empty($data['slider_decription']) ) {
            $where = array();
            $where = array(
                'slider_id' => $slider_id
            );
            $postdata = array();
            $postdata = array(
                'slider_title' => $this->input->post('slider_title'),
                'slider_description' => $this->input->post('slider_decription'),
               'slider_status' => $data['slider_status'],
                'slider_updated' => date("Y-m-d h:i:s")
            );
            $update = $this->Customer_model->update_data_where($postdata, $where, $table);

            if ($update) {
                if (!empty($_FILES['slider_image']['name'])) {
                    $image_check = $this->db->get_where('upload_document', array("imageForId" => $slider_id, "imageFor" => 'slider'))->result_array();
                    if (!empty($image_check)) {
                        $record_image["imageForId"] = $slider_id;
                        $record_image["imageFor"] = 'slider';
                        unlink_multiple_image('upload_document', $record_image, $this->uploadPath);
                        $response = delete_record('upload_document', $record_image);
                    }
                    $uploadData = array();
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['slider_image']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['slider_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['slider_image']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['slider_image']['error'];
                    $_FILES['file']['size'] = $_FILES['slider_image']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/slider/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $slider_id;
                        $uploadData['imageFor'] = 'slider';
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
                            $msg = 'Slider updated  Successfully!!!';
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
                    $filename_check = $this->db->get_where('upload_document', array("imageForId" => $slider_id, 'imageFor' => 'slider'))->result_array();
                    if (empty($filename_check)) {
                        echo json_encode(array('msg' => 'Please Upload Slider image', 'status' => false));
                        die;
                    } else {
                        $msg = 'Slider updated  Successfully!!!';
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

    /*
      | -------------------------------------------------------------------------
      |slider edit page image delete Section
      | -------------------------------------------------------------------------
     * 
     */

    public function slider_image_delete() {
        $imageid = $this->input->post('imageid');
        if (!empty($imageid)) {
            $record_id["imageid"] = $imageid;
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

    /*
      | -------------------------------------------------------------------------
      |Delete slider Section
      | -------------------------------------------------------------------------
     * 
     */

    public function delete_slider($slider_id) {
        if (!empty($slider_id)) {
            $slider["slider_id  "] = urldecrypt($slider_id);
            $record_id["imageForId"] = urldecrypt($slider_id);
            $record_id["imageFor"] = 'slider';
            $response = delete_record($this->table, $slider);
            unlink_multiple_image('upload_document', $record_id, $this->uploadPath);
            $response_image = delete_record('upload_document', $record_id);
            if ($response) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Slider Deleted Successfully</div>");
                redirect(base_url() . "superadmin/slider");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/slider");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/slider");
        }
    }

}
