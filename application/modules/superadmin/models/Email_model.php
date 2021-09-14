<?php 
class Email_model extends CI_Model {
  
	function __construct(){
		parent::__construct();
		$this->load->model('common_model');
	} 
function sendEmails($emails,$subject,$message){
		$this->email->from('info@fennelinfotech.com', 'XCMG ARC');
		$this->email->to($emails);
		$this->email->set_mailtype("html");
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	
#=================================== sent user profit/loss =======================================================>
function customer_email_confirmation_notification($send_data)
  {
    $to_email_address = $send_data['sender_email'];
    $subject = $send_data['subject'];
    $message =  $send_data['message'];
    $data['msg'] = $message;
    $mess = $this->load->view('mailer/email_template', $data, true);
    $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);

    if ($result_dfee) {
      return true;
    } else {
      return false;
    }
  }
#=================================== sent user profit/loss =======================================================>


#=================================== Widraw request  =======================================================>
function widraw_amount_request_mail($send_data)
  {
    $to_email_address = $send_data['sender_email'];
    $subject = $send_data['subject'];
    $message =  'Hi, '.ucfirst($send_data['sender_name']).' '.$send_data['message'];
    $data['msg'] = $message;
    $mess = $this->load->view('mailer/email_template', $data, true);
    $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);
    if ($result_dfee) {
      return true;
    } else {
      return false;
    }
  }
#=================================== end Widraw requests =======================================================>
  
#============================================== Sent user mail for update wallent balance ==========================>
  function user_update_wallent_balance_confirmation_mail($send_data)
  {
    $to_email_address = $send_data['sender_email'];
    $subject = "Update Wallet Balance Confirmation E-mail";
    $message =  'Hi, '.ucfirst($send_data['sender_name']).' <span style="font-size:24px"><b>$'.$send_data['amount'].'</b></span> '.$send_data['message'];
    $data['msg'] = $message;
    $mess = $this->load->view('mailer/email_template', $data, true);
    $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);

    if ($result_dfee) {
      return true;
    } else {
      return false;
    }
  }
#============================================== End Sent user mail for update wallent balance ==========================>

 function sendCustomerVerificationMail($send_data)
 {
 	$to_email_address = $send_data['sender_email'];
    $em_path = base_url().'login/verification/'.$send_data['customer_id'].'/'.$send_data['temp_date'];
    $subject="Verification "; 
    $logo_path = str_replace('index.php/','',base_url()).'assets/img/mail-logo.png';
    $sender_email = $send_data['sender_email'];
    $sender_pass = $send_data['sender_pass'];
    $site_path = base_url();

   /* $message = '';
    $message .= '<br>Please Verify Your Account by Clicking Below Link';
  
    $message .= '<br/><br/><a href='.$em_path.' style="background-color:#2585b2;border: 1px solid #11729e;text-decoration: none;color: #fff;background-color: #2585b2;padding: 5px 15px; color: white;  font-size: 16px;">Verify Your Account</a><br/>';
    $message .= '<br/> <br>If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.<br/><br>';
    $message .= $em_path;*/

    $message = '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="padding: 10px 0 30px 0;"><table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;"><tr><td align="center" bgcolor="#042e3e" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;"><img src="'.$logo_path.'" alt="main-logo" width="150" height="98" style="display: block;"/></td></tr><tr><td align="center" bgcolor="#042e3e" style="padding: 0px 0px 14px 0px ;color: #ffffff; font-size: 20px; font-weight: bold; font-family: Arial, sans-serif;"><b>Your account is almost ready</b></td></tr><tr><td bgcolor="#ffffff" style="padding: 40px 30px 10px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;">Thank you for registering on <a href="'.$site_path.'">hallbooking.net</a></td></tr></table></td></tr><tr><td bgcolor="#ffffff" style="padding: 0px 30px 20px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px; padding:4px 0px" width="20%">Email:</td><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px; padding:4px 0px" width="80%"><b>'.$sender_email.'</b></td></tr><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px; padding:4px 0px" width="20%">Password:</td><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px; padding:4px 0px" width="80%"><b>'.$sender_pass.'</b></td></tr></table></td></tr><tr><td bgcolor="#ffffff" style="padding: 0px 30px 40px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;">Please Verify Your Account by Clicking Below Link</td></tr></table></td></tr><tr><td bgcolor="#ffffff" style="padding: 0px 30px 10px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;"><a href="'.$em_path.'" style="text-decoration:none; color:#ffffff; background-color:#042e3e; padding:14px 20px; border-radius:5px; display:inline-block;"><span style="text-decoration:none; color:#ffffff; background-color:#042e3e; border-radius:5px; display:inline-block">Verify Your Account</span> </a></td></tr></table></td></tr><tr><td bgcolor="#ffffff" style="padding: 30px 30px 10px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;">If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.<br/><br/>'.$em_path.'</td></tr></table></td></tr><tr><td bgcolor="#ffffff" style="padding: 20px 30px 10px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;">Thanks </td></tr><tr><td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;"> Hall Booking Team</td></tr></table></td></tr><tr><td bgcolor="#efeeee" style="padding: 20px 30px 20px 30px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" align="center"><tr><td style="color: #000000; font-family: Arial, sans-serif; font-size: 13px; line-height: 1.5" width="100%" align="center"> <a href="'.$site_path.'">hallbooking.net</a> | <a href="'.$site_path.'home/about">About Us</a> | <a href="'.$site_path.'home/privacy">Privacy Policy</a></td></tr></table></td></tr></table></td></tr></table>';

   $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $message);

        if($result_dfee)
       {
         return true;
       }
       else
       {
         return false;
       }
 }


  function sendCustomerResetMail($id, $email)
 {
 	$to_email_address = $email;
    $em_path = base_url().'superadmin/superadmin-forget-password/'.$id.'/'.strtotime(date('Y-m-d h:i:s'));
    $subject="Admin Account Recovery "; 

    $message = '';
    $message .= '<br>If this is a mistake just ignore this email - your password will not be changed<br/><br/>';
    $message .= 'Want to change your password? Please click on the link given below to reset the password. This Link is valid for 1 hour <br/><br/>';
    $message .= '<a href='.$em_path.' style="background-color:#e57574;border: 1px solid #e57574;text-decoration: none;color: #fff;padding: 5px 15px; color: white;  font-size: 16px;">Reset Password</a>';
    $message .= '<br/> <br>If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.<br/><br>';
    $message .= $em_path;
    $data['msg']=$message;
    $mess = $this->load->view('mailer/email_template', $data, true);
    $result_dfee = $this->common_model->sendEmails($to_email_address, $subject, $mess);

        if($result_dfee)
       {
         return true;
       }
       else
       {
         return false;
       }
 }

}
?>