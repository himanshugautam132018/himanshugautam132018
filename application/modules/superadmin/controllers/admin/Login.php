<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('common_model');
    $this->load->model('customer_model');
    $this->load->model('email_model');
    $this->load->model('login_model');
    $this->load->model('action_api_model');
    $this->table = 'koala_nursery_superadmin';
  }
  public function index()
  {
    if (array_key_exists('superadmin_data', $_SESSION) && !empty($_SESSION['superadmin_data'])) {
      return redirect('superadmin/dashboard');
    }

    $this->load->view('login/index');
  }

  #Admin login verify and login
  public function super_admin_login()
  {

    $data = $this->input->post();
    if (!empty($data['email']) && !empty($data['email'])) {
      $validation_data = $this->login_model->validate($this->table, $data['email']);
      if ($validation_data) {
        $db_password = $this->encryption->decrypt($validation_data->sa_password);
        if ($db_password == $data['password']) {
          $this->login_model->updateLoginData($this->table, $validation_data->sa_id);
          $this->session->set_userdata('superadmin', true);
          $this->session->set_userdata('superadmin_data', $validation_data);
          echo json_encode(array("success" => true));
        } else {
          echo json_encode(array("success" => false, 'message' => 'Invalid Password'));
        }
      } else {
        echo json_encode(array("success" => false, 'message' => 'Invalid Email'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Please enter email'));
    }
  }

  public function forget_password()
  {
    $this->load->view('login/forget_password');
  }

  public function forgetpass()
  {
    $table = $this->table;
    $data = $this->input->post();
    $this->form_validation->set_rules('forget_admin_email', 'E-mail', 'required');

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
      if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-z0-9.-]+\.[a-zA-Z]{2,4}$/", $data['forget_admin_email'])) {
        $validation_data = $this->login_model->validate($table, $data['forget_admin_email']);
        if ($validation_data) {
          $this->login_model->updateTempTimeData($table, $validation_data->sa_id);

          // mail sent template add here
          $mail_res = $this->email_model->sendCustomerResetMail($validation_data->sa_id, $validation_data->sa_email);
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
        echo json_encode(array('status' => false, 'message' => '<div class="alert alert-danger">Invalid email-' . $data['customer_email'] . '</div>'));
        die;
      }
    }
  }

  #password reset form after verify 
  public function admin_password_reset($client_id = FALSE, $dtime = FALSE)
  {
    if (!empty($client_id) && !empty($dtime)) {
      $time_checker = $this->login_model->checkResetStatus($client_id, $dtime);
      $data['admin_id'] = '';
      //   $data['page']='';
      if ($time_checker) {
        $data['admin_id'] = $client_id;
          $result = $this->login_model->upadateTimerStatus($client_id);

          if($result)
          {

          $data['admin_id'] = $client_id;

         } 

      }
      $this->load->view('common/login_header');
      $this->load->view('login/reset_password_page', $data);
      $this->load->view('common/login_footer');
    } else {
      redirect(base_url('superadmin'));
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
  #Reset password from reset link
  public function update_admin_reset_password()
  {
    //   echo "test";die;
    $rest = array();
    $table = $this->table;
    $data = $this->input->post();
    $this->form_validation->set_rules('sa_password', 'Password', 'trim|required|min_length[6]|max_length[25]|callback_chk_password_expression');
    $this->form_validation->set_rules('sa_confirm_password', 'Confirm password', 'trim|required|min_length[6]|max_length[25]|matches[sa_password]|callback_chk_password_expression');

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
      if ($data['sa_password'] == $data['sa_confirm_password']) {
        $rest = array(
          'id' => $data['admin_id'],
          'password' => $this->encryption->encrypt($data['sa_password'])
        );
        $result = $this->login_model->updateCustomerPasswordData($table, $rest);
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
  }



  #Admin Logout 
  public function super_admin_Logout()
  {
    $session_data = $this->session->userdata('superadmin_data');
    if (!empty($session_data)) {
      $this->login_model->updatelogoutData($this->table, $session_data->sa_id);
      $this->session->unset_userdata('superadmin');
      $this->session->unset_userdata('superadmin_data');
      redirect(base_url('superadmin'));
    }
    redirect(base_url('superadmin'));
  }
}
