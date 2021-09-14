<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
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
    function sendEmails($emails, $subject, $message)
    {
        $this->email->from('info@fennelinfotech.com', 'XCMG ARC');
        $this->email->to($emails);
        $this->email->set_mailtype("html");
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    public function save_insert_data($table_name, $data)
    {
        $this->db->insert($table_name, $data);
        $contract_id = $this->db->insert_id();
        return $contract_id;
    }

    public function insert_data($table_name, $data)
    {
        $response = $this->db->insert($table_name, $data);
        return $response;
    }

    public function read_data($table_name)
    {
        // $this->db->limit($limit);
        $response = $this->db->get($table_name);
        return $response->result_array();
    }

    public function read_data_where($table_name, $where)
    {
        $where = $this->db->where($where);
        $response = $this->db->get($table_name);
        return $response->result_array();
    }

    public function update_data_where($table_name, $where, $data)
    {
        $where = $this->db->where($where);
        $response = $this->db->update($table_name, $data);
        return $response;
    }

    public function update_quetion_user_review($table_name, $where, $data)
    {
        $where = $this->db->where($where);
        $response = $this->db->update($table_name, $data);
        return $response;
    }

    public function read_data_login($table_name, $where)
    {
        $where = $this->db->where($where);
        $response = $this->db->get($table_name);
        return $response->row_array();
    }

    public function delete_record($table_name, $where)
    {
        $where = $this->db->where($where);
        $response = $this->db->delete($table_name);
        return $response;
    }

    public function fetch_record_like($column, $table, $data)
    {
        $this->db->like($column, $data);
        $response = $this->db->get($table);
        return $response->result_array();
    }

    public function fetch_record_like_where($column, $table, $data, $where)
    {
        $this->db->like($column, $data);
        $this->db->where($where);
        $response = $this->db->get($table);
        return $response->result_array();
    }

    public function record_count_month_wise($tablename)
    {
        $sql = "SELECT MONTHNAME(created_at) , COUNT(created_at) FROM " . $tablename . " WHERE status=1 GROUP BY MONTHNAME(created_at)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function avg_funtion($column, $where, $table_name)
    {
        $this->db->select_avg($column);
        $this->db->where($where);
        $response = $this->db->get($table_name)->row();
        return $response;
    }
}
