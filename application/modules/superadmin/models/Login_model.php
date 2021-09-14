<?php

class Login_model extends CI_model
{
     function __construct()
     {
     	parent::__construct();
     	$this->table='koala_nursery_superadmin';
     }


     function validate($table,$customeremail)
     {
     	$this->db->where('sa_email', $customeremail);
     	$result = $this->db->get($table);
    //  	print_r($result->row());die('test');
     	if($result->num_rows()>0)
     	{
           return $result->row();
     	}
     	else
     	{
     		return false;
     	}
     }

    function updateLoginData($table, $id)
     {
     	$this->db->where('sa_id', $id);
     	$this->db->set('login_date_time', date('Y-m-d h:i:s'));
     	$this->db->set('ip_address', $this->input->ip_address());
     	$this->db->set('is_login', 1);
     	$this->db->update($table);
     	return true;
     }
    function updatelogoutData($table, $id)
     {
     	$this->db->where('sa_id', $id);
        $this->db->set('is_login', 0);
     	$this->db->update($table);
     	return true;
     }
   
     function updateTempTimeData($table, $customer_id)
     {
          $this->db->where('sa_id', $customer_id);
          $this->db->set('temp_time', strtotime(date('Y-m-d h:i:s')));
          $this->db->set('temp_time_status','1');
          $this->db->update($table);
          return true;
     }


     function checkResetStatus($client_id, $dtime)
     {
          $this->db->where('sa_id', $client_id);
          $this->db->where('temp_time_status', '1');
          $result = $this->db->get($this->table);
        
          if($result->num_rows()>0)
          {
             $prev_time = $result->row('temp_time');
            
             if(!empty($prev_time))
             {
                 
             $current_time = strtotime(date('Y-m-d h:i:s'));
              if(($current_time - $prev_time) <= 3600)
                  {
                     
                   return true;
                  } 
                  else
                  {
                   return false;
                  }
             }
             else
             {
                return false;
             }
          }
          else
          {
               return false;
          }
     }


     function upadateTimerStatus($client_id)
     {
          $this->db->where('sa_id', $client_id);
          $this->db->set('temp_time_status','0');
          $this->db->set('sa_update', date('Y-m-d h:i:s'));
          $this->db->update($this->table);
          if($this->db->affected_rows() == true)
          {
             return true;
          }
          else
          {
               return false; 
          }
     }


     function updateCustomerPasswordData($table, $rest)
     {
          $this->db->where('sa_id', $rest['id']);
          $this->db->set('sa_password', $rest['password']);
          $this->db->set('sa_update', date('Y-m-d h:i:s'));
          $this->db->update($table);
          if($this->db->affected_rows() == true)
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