<?php

class Email_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

    function sendCustomerResetMail($id, $email)
    {
        $to_email_address = $email;
        $em_path = base_url() . 'forget-password-update/' . $id . '/' . strtotime(date('Y-m-d h:i:s'));
        $subject = "User Account Recovery";

        $message = '';
        $message .= '<br>If this is a mistake just ignore this email - your password will not be changed<br/><br/>';
        $message .= 'Want to change your password? Please click on the link given below to reset the password. This Link is valid for 1 hour <br/><br/>';
        $message .= '<a href=' . $em_path . ' style="background-color:#e57574;border: 1px solid #e57574;text-decoration: none;color: #fff;padding: 5px 15px; color: white;  font-size: 16px;">Reset Password</a>';
        $message .= '<br/> <br>If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.<br/><br>';
        $message .= $em_path;
        $data['msg'] = $message;
        $mess = $this->load->view('mailer/email_template', $data, true);
        $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);

        if ($result_dfee) {
            return true;
        } else {
            return false;
        }
    }
    function sentRegistration_login_detail_client($send_data)
    {
        $to_email_address = $send_data['sender_email'];
        $em_path = base_url() . 'superadmin/superadmin-forget-password/80/' . strtotime(date('Y-m-d h:i:s'));
        $subject = "Registration Successfully ";

        $message = '';
        $message .= '<br>' . ucfirst($send_data['name']) . ', Thanks for Registration with  XCMG ARC , ';
        $message .= 'Your login details given below : <br/>';
        $message .= '<p>Name : ' . $send_data['name'] . '</p>';
        $message .= '<p>Email :' . $send_data['sender_email'] . '</p>';
        $message .= '<p>Password : ' . $send_data['sender_pass'] . '</p>';
        $data['msg'] = $message;
        $mess = $this->load->view('mailer/email_template', $data, true);
        $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);
        if ($result_dfee) {
            return true;
        } else {
            return false;
        }
    }
}
