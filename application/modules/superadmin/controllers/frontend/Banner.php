<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

    public function __construct() {
        parent::__construct();

        if (!array_key_exists('superadmin_data', $_SESSION) && empty($_SESSION['superadmin_data'])) {
            return redirect(base_url('superadmin'));
        }
        $this->load->helper('url');
        $this->load->model('email_model');
        $this->load->model('Customer_model');
        $this->load->model('Common_model', 'cm');
        $this->uploadPath = 'uploads/page/';
        $this->table = 'pages';
    }

    #Page Listing 

    public function index() {
        $data = array();
        $orderby = array(
            'key' => 'page_id',
            'value' => 'desc'
        );
        $order_key = 'page_id';
        $order_value = 'desc';
        $data['page_listing'] = read_data($this->table, $order_key, $order_value); //1 : table name ,2 : order_key ,3 orderby value
        $this->load->view('common/header');
        $this->load->view('page/index', $data);
        $this->load->view('common/footer');
    }

    #Creae page 

    public function create_page() {
        $this->load->view('common/header');
        $this->load->view('page/create_page');
        $this->load->view('common/footer');
    }

    #page createdinformation stored in database

    public function save_page_information() {
        $table = $this->table;
        $data = $this->input->post();
        if (!empty($data['page_name']) && !empty($data['short_desc']) && !empty($data['detail_desc']) && !empty($data['meta_title']) && !empty($data['meta_desc']) && !empty($data['page_status'])) {
            $title = strip_tags($this->input->post('page_name'));
            $where = array();
            $where = array(
                "page_name" => $title
            );
            $validate_page_title = value_Exist($table, $where);
            if ($validate_page_title) {
                $statusMsg = 'This page name already exist , please use different page name.';
                echo json_encode(array('msg' => $statusMsg, 'status' => false));
                die;
            }
            $titleURL = strtolower(url_title($title));
            $page_postdata = array();
            $page_postdata = array(
                'page_name' => $this->input->post('page_name'),
                'page_short_description' => $this->input->post('short_desc'),
                'page_detailed_description' => $this->input->post('detail_desc'),
                'page_meta_title' => $this->input->post('meta_title'),
                'page_meta_description' => $data['meta_desc'],
                'page_url_slug' => $titleURL,
                'page_status' => $data['page_status'],
                'page_created' => date("Y-m-d h:i:s")
            );
            $this->db->insert($this->table, $page_postdata);
            $last_pageid = $this->db->insert_id();

            if ($last_pageid) {

                if (!empty($_FILES['page_banner']['name'])) {
                    $uploadData = array();
//                    for ($i = 0; $i < $filesCount; $i++) {
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['page_banner']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['page_banner']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['page_banner']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['page_banner']['error'];
                    $_FILES['file']['size'] = $_FILES['page_banner']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/page/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $last_pageid;
                        $uploadData['imageFor'] = 'page';
                        $uploadData['createdAt'] = date("Y-m-d H:i:s");
                    } else {
                        // echo  $this->upload->display_errors();
                        $errorUploadType .= $_FILES['file']['name'] . ' | ';
                    }
//                    }

                    $errorUploadType = !empty($errorUploadType) ? '<br/>File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    if (!empty($uploadData)) {
                        $insert = $this->db->insert('upload_document', $uploadData);
                        if ($insert) {
                            $msg = 'Page created Successfully!!!';
                            echo json_encode(array('msg' => $msg, 'status' => true));
                            die;
                        } else {
                            $statusMsg = 'Some problem occurred, please try again.';
                            echo json_encode(array('msg' => $statusMsg, 'status' => false));
                            die;
                        }
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file." . $errorUploadType;
                        echo json_encode(array('msg' => $statusMsg, 'status' => false));
                        die;
                    }
                } else {
                    $statusMsg = "Please Upload ImAGE";
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

    #view Page 

    public function view_page($page_id) {
        if (empty($page_id)) {
            redirect(base_url() . '/superadmin/page');
        }
        $data = array();
        $where = array();
        $where = array(
            'page_id ' => urldecrypt($page_id)
        );
        $data['page_id'] = urldecrypt($page_id);
        $data['page_view'] = read_data_where_row($this->table, $where);
        $where_clause = array();
        $where_clause = array(
            "imageForId" => urldecrypt($page_id),
            'imageFor' => "page"
        );
        $data['page_image'] = read_data_where('upload_document', $where_clause);
        $this->load->view('common/header');
        $this->load->view('page/page_view', $data);
        $this->load->view('common/footer');
    }

    #edit page

    public function edit_page($page_id) {
        if (empty($page_id)) {
            redirect(base_url() . '/superadmin/page');
        }
        $where = array();
        $where = array(
            'page_id ' => urldecrypt($page_id)
        );
        $where_clause = array();
        $where_clause = array(
            "imageForId" => urldecrypt($page_id),
            'imageFor' => "page"
        );

        $data['page_id'] = urldecrypt($page_id);
        $data['page_view'] = read_data_where_row($this->table, $where);
        $data['page_image'] = read_data_where('upload_document', $where_clause);
//        pre($data);die;
        $this->load->view('common/header');
        $this->load->view('page/page_edit', $data);
        $this->load->view('common/footer');
    }

    public function update_page_information() {
        $table = $this->table;
        $data = $this->input->post();
        $page_id = $this->input->post('page_id');
        if (!empty($data['page_name']) && !empty($data['short_desc']) && !empty($data['detail_desc']) && !empty($data['meta_title']) && !empty($data['meta_desc'])) {
            $where = array();
            $where = array(
                'page_id' => $page_id
            );
            $page_postdata = array();
            $page_postdata = array(
                'page_name' => $this->input->post('page_name'),
                'page_short_description' => $this->input->post('short_desc'),
                'page_detailed_description' => $this->input->post('detail_desc'),
                'page_meta_title' => $this->input->post('meta_title'),
                'page_meta_description' => $data['meta_desc'],
                'page_status' => $data['page_status'],
                'page_updated' => date("Y-m-d h:i:s")
            );
            $update = $this->Customer_model->update_data_where($page_postdata, $where, $table);

            if ($update) {

                if (!empty($_FILES['page_banner']['name'])) {
                    $image_check = $this->db->get_where('upload_document', array("imageForId" => $page_id, "imageFor" => 'page'))->result_array();
                    if (!empty($image_check)) {
                         $record_image["imageForId"] = $page_id;
                        $record_image["imageFor"] = 'page';
                        unlink_multiple_image('upload_document', $record_image, $this->uploadPath);
                        $response = delete_record('upload_document', $record_image);
                     }
                    $uploadData = array();
//                    for ($i = 0; $i < $filesCount; $i++) {
                    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['page_banner']['name']);
                    $new_img_name = time() . '-' . $strreplaced;
                    $_FILES['file']['name'] = $new_img_name;
                    $_FILES['file']['type'] = $_FILES['page_banner']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['page_banner']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['page_banner']['error'];
                    $_FILES['file']['size'] = $_FILES['page_banner']['size'];

                    // File upload configuration 
                    $uploadPath = FCPATH . 'uploads/page/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData['imageUrl'] = $fileData['file_name'];
                        $uploadData['imageForId'] = $page_id;
                        $uploadData['imageFor'] = 'page';
                        $uploadData['createdAt'] = date("Y-m-d H:i:s");
                    } else {
                        // echo  $this->upload->display_errors();
                        $errorUploadType .= $_FILES['file']['name'] . ' | ';
                    }
//                    }

                    $errorUploadType = !empty($errorUploadType) ? '<br/>File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    if (!empty($uploadData)) {
                        $insert = $this->db->insert('upload_document', $uploadData);
                        if ($insert) {
                            $msg = 'Page updated  Successfully!!!';
                            echo json_encode(array('msg' => $msg, 'status' => true));
                            die;
                        } else {
                            $statusMsg = 'Some problem occurred, please try again.';
                            echo json_encode(array('msg' => $statusMsg, 'status' => false));
                            die;
                        }
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file." . $errorUploadType;
                        echo json_encode(array('msg' => $statusMsg, 'status' => false));
                        die;
                    }
                } else {
                    $filename_check = $this->db->get_where('upload_document', array("imageForId" => $page_id))->result_array();
                    if (empty($filename_check)) {
                        echo json_encode(array('msg' => 'Please Upload banner image', 'status' => false));
                        die;
                    } else {
                        $msg = 'Page updated  Successfully!!!';
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

    public function page_Image_deleted() {
        $imageid = $this->input->post('imageid');
//         pre($imageid);die;
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

    public function page_deleted($id) {
//        pre($id);die;
        if (!empty($id)) {
            $page["page_id"] = $id;
            $record_id["imageForId"] = $id;
            $record_id["imageFor"] = 'page';
            $image_data = read_data_where_row('upload_document', $record_id);
            $response = delete_record($this->table, $page);
            $response_image = delete_record('upload_document', $record_id);
            @unlink($this->uploadPath . $image_data->imageUrl);
            if ($response && $response_image) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Page Deleted Successfully</div>");
                redirect(base_url() . "superadmin/page");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
                redirect(base_url() . "superadmin/page");
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Something went wrong please try again.</div>");
            redirect(base_url() . "superadmin/page");
        }
    }

}
