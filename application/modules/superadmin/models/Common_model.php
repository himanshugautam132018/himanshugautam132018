<?php

class Common_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'localhost',
            'smtp_port' => '25',
            'smtp_auth' => false,
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
    }

   public function get_transaction_list($where = array(),$limit='')
    {
        $this->db->select('t1.*, t2.gmc_id, t2.gmc_registration_number,t2.gmc_u_first_name')
            ->from('gmc_transaction as t1')
            ->join('gmc_user as t2', 't1.user_id = t2.gmc_id', 'LEFT');
        if (!empty($where)) {
            $this->db->where($where);
        }
        if($limit!=''){
            $this->db->limit($limit);
         }
        $result = $this->db->order_by("t1.transaction_id", "DESC")
            ->get();
        return $result->result_array();
    }
    
    public function get_withdrawal_list($where = array(),$limit='')
    {
        $this->db->select('t1.*, t2.gmc_id, t2.gmc_registration_number,t2.gmc_u_first_name')
            ->from('gmc_withdrawal as t1')
            ->join('gmc_user as t2', 't1.w_user_id = t2.gmc_id');
        if (!empty($where)) {
            $this->db->where($where);
        }
        if($limit!=''){
            $this->db->limit($limit);
         }
        $result = $this->db->order_by("t1.w_id", "DESC")
            ->get();
        return $result->result_array();
    }
    #======================================= get user currency stock =====================================================#
    
    public function currency_wise_user_currency_stock($userID)
    {
        $result = $this->db->select('t1.currency_total_amount as stock_total,t1.id, t2.gmc_currency_id, t2.currecny_code,t2.gmc_currency_name')
            ->from('user_currency_stock as t1')
            ->join('gmc_currency as t2', 't1.currency_id = t2.gmc_currency_id')
            ->where(array("t1.user_id" => $userID, "t1.currency_id !=" => '',"t1.currency_total_amount!=" => 0))->get()->result_array();
        return $result;
    }
    // public function currency_wise_user_currency_stock($userID)
    // {
    //     $result = $this->db->select('SUM(t1.transaction_amount) as stock_total,t1.transaction_id, t2.gmc_currency_id, t2.currecny_code,t2.gmc_currency_name')
    //         ->from('gmc_transaction as t1')
    //         ->join('gmc_currency as t2', 't1.currency = t2.gmc_currency_id')->group_by("t1.currency")
    //         ->where(array("t1.user_id" => $userID, "t1.currency !=" => '',"t1.trade_currency_stock" => 1))->get()->result_array();
    //     return $result;
    // }
    #=======================================End get user currency stock =====================================================#

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        $last_projectid = $this->db->insert_id();
        if ($last_projectid) {
            return $last_projectid;
        } else {
            return false;
        }
    }

    function validateEmail($where, $table)
    {
        $this->db->where($where);
        $admin = $this->db->get($table);
        if ($admin->num_rows() > 0) {
            $data = $admin->row();
            return $data;
        } else {
            return false;
        }
    }

    function sendEmails($emails, $subject, $message)
    {
        $this->email->from('support@globalexchangecentre.net', 'GLOBAL EXCHANGE CENTRE');
        // $this->email->from('info@koalanursery.com.qa', 'Koala Nursery');
        $this->email->to($emails);
        $this->email->set_mailtype("html");
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
