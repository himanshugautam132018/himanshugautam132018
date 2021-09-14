<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index()
    {
        $data = array();
        $this->load->view('include/header');
        $this->load->view('home/index', $data);
        $this->load->view('include/footer');
    }
}
