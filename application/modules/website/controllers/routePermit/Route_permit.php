<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Route_permit extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index()
    {
        $data = array();
        $data['title'] = "Can I Get Permits";
        $this->load->view('include/header');
        $this->load->view('routePermit/index', $data);
        $this->load->view('include/footer');
    }
    public function xcmg_route_permit_form_append()
    {
        $data = array();
        $postdata = $this->input->post();
        $data['tab'] = $postdata['tabId'];
        $this->load->view('include/ajax_permit_form', $data);
    }

    #==================================== Search route by address======================================>
    public function search_route_by_address()
    {
        $postdata = $this->input->post();
        pre($postdata);
    }
    #====================================End Search route by address======================================>

    public function test()
    {
        $state_code = [];
        $from = str_replace(" ", "%20", "Himachal Pradesh, India");  //first remove param 
        $to = str_replace(" ", "%20", "Prem Mandir Vrindavan, Vrindavan, Uttar Pradesh, India");  //first remove param,second paras add param
        $result = json_decode(get_location_by_address($from, $to), true); //convert json to array 
        $start_point_coordinates = $result['resourceSets'][0]['resources'][0]['routeLegs'][0]['actualStart']['coordinates']; //get start point coordinates
        $end_point_coordinates = $result['resourceSets'][0]['resources'][0]['routeLegs'][0]['actualEnd']['coordinates']; //get end point coordinates
        $get_maneuverPoint = array_column($result['resourceSets'][0]['resources'][0]['routeLegs'][0]['itineraryItems'], 'maneuverPoint'); //find all Latitude or Langitude between two place
        $get_coordinates = array_column($get_maneuverPoint, 'coordinates'); //get all coordinates between two place
        foreach ($get_coordinates as $coordinates) {
            $state = (array) get_address_by_lat_or_long($coordinates[0], $coordinates[1]); //get address by Latitude or Longitude
            if (!in_array($state[0], $state_code)) {  //check state not exist in array
                $state_code[] = $state[0]; //stored state in array 
            }
        }
        pre($state_code);
    }
}
