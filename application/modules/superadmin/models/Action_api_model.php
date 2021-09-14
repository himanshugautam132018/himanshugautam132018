<?php 
class Action_api_model extends CI_Model {
  
	function __construct(){
		parent::__construct();
	}

 public function check_mobile_number($phone)
    {
            $this->db->select('phone');
            $this->db->from('customer'); 
            $this->db->where('phone', $phone); 
            $query=$this->db->get();
            $row = $query->row();
            // print_r($row->phone);die;
            if ($query->num_rows()>0 ) {
                return $row->phone ;
            }else{
                return false;
            }
            //return ($query->num_rows()===1 && $row->email) ? $row->name : false;
    }

	
   function saveData($table,$data){
   		if($this->db->insert($table,$data)){
   			return $this->db->insert_id();
   		}else{
   			return false;
   		}
	}

   

	function conditional_search($table,$key=false,$value=false){
		$this->db->where($key,$value);
		return $this->db->get($table);
	}

  function conditional_search_flag($table,$key=false,$value=false){
    $this->db->where($key,$value);
    return $this->db->get($table);
  }

	function multiple_search($table,$data){
		foreach ($data as $key => $value) {
			$this->db->where($key,$value);
		}

	 return $this->db->get($table);
	}

	function deleteRecord($table,$key,$value){
		$this->db->where($key,$value);
		$res=$this->db->delete($table);
		if($res){
			return true;
		}else{
			return false;
		}
	}
   

    
	 function validate($table,$data) {
     	$this->db->where('email',$data['email']);
     	$result = $this->db->get($table);
     	if($result->num_rows()>0){
           $details =  $result->row();
           if($this->encryption->decrypt($details->password)==$data['password']){
           		return $details ;
           }else{
           		return false;
           }
     	}else{
     		return false;
     	}
     }

   

 
} 
	