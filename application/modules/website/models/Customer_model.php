<?php 
class Customer_model extends CI_Model {
  
	function __construct(){
		parent::__construct();
		  $this->load->model('common_model');
	} 

function insert_data($table, $store_result)
	{
		$result = $this->db->insert($table, $store_result);
		if($result)
		{
         return $this->db->insert_id();
		}
		else
		{
        return false;
		}
	}

	function CustomerRegisrtation($table, $store_result)
	{
		$result = $this->db->insert($table, $store_result);
		if($result)
		{
         return $this->db->insert_id();
		}
		else
		{
        return false;
		}
	}
public function update_admin($data, $id,$table) { 
        if(!empty($data) && !empty($id)){ 
           $update = $this->db->update($table, $data, array('sa_id' => $id)); 
            return $update?true:false; 
        } 
        return false; 
    } 
public function update($data, $id,$table) { 
        if(!empty($data) && !empty($id)){ 
            // Add modified date if not included 
            if(!array_key_exists("am_modified", $data)){ 
                $data['am_modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Update member data 
            $update = $this->db->update($table, $data, array('am_id' => $id)); 
             
            // Return the status 
            return $update?true:false; 
        } 
        return false; 
    } 
	function updateVerificationStatus($table, $data4)
	{
		$this->db->where('id', $data4['id']);
		$this->db->where('temp', $data4['temp']);
		$this->db->set('status', '1');
		$this->db->set('updated', date('Y-m-d h:i:s'));
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

	function getCustomerDetail($id)
	{
	    
		$this->db->where('gmc_id', $id);
		return $this->db->get('gmc_user')->row();
	}

	function updateCustProfilePic($table, $upload_img_name, $id)
	{
		$this->db->where('id', $id);
		$this->db->set('profile_pic', $upload_img_name);
		$this->db->set('updated', date('Y-m-d h:i:s'));
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

	function updateClientPersonalInfo($table, $data)
	{
		$this->db->where('id', $data['id']);
		$this->db->set('updated', date('Y-m-d h:i:s'));
		$this->db->update($table, $data);
		if($this->db->affected_rows() == true)
		{
         return true;
		}
		else
		{
         return false;
		}
	}

	function updateClientPass($table, $data2)
	{
		$this->db->where('gmc_id', $data2['gmc_id']);
		$this->db->update($table, $data2);
		if($this->db->affected_rows() == true)
		{
  		return true;
		}
		else
		{
		return false;
		}
	}


	function getName($id, $table, $colname)
   {
    $this->db->where('id',$id);
    return $this->db->get($table)->row($colname);
   }


public function delete_record($table_name,$where)
	{
		$where= $this->db->where($where);
		$response=$this->db->delete($table_name);
		return $response;
	}
	public function update_data_where($data,$where,$table_name)
	{
		$where= $this->db->where($where);
		$response=$this->db->update($table_name,$data);
		return $response;
	}

 


   





function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
	
	
}
?>
