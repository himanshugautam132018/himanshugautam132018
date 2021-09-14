<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// sanitize Function for cleaning data
function clean_variable($var)
{
    $CI = &get_instance();
    // return clean string
    return str_replace("'", "", $CI->db->escape($CI->security->xss_clean($var)));
}

function check_generator_number_already_exist($table, $key, $value)
{
    $CI = &get_instance();
    $query = $CI->db->select('*')
        ->from($table)
        ->where($key, $value)
        ->get();
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function generator($lenth, $table, $key)
{
    $CI = &get_instance();
    $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    for ($i = 0; $i < $lenth; $i++) {
        $rand_value = rand(0, 8);
        $rand_number = $number["$rand_value"];

        if (empty($con)) {
            $con = $rand_number;
        } else {
            $con = "$con" . "$rand_number";
        }
    }

    $result = check_generator_number_already_exist($table, $key, $con);

    if ($result === true) {
        generator(8, $table, $key);
    } else {
        return $con;
    }
}
function upload_image_doc_helper($image, $path)
{
    $CI = &get_instance();
    $uploadData = array();
    $strreplaced = preg_replace("/[^a-zA-Z0-9.]/", "", $image['name']);
    $new_img_name = time() . '-' . $strreplaced;
    $_FILES['file']['name'] = $new_img_name;
    $_FILES['file']['type'] = $image['type'];
    $_FILES['file']['tmp_name'] = $image['tmp_name'];
    $_FILES['file']['error'] = $image['error'];
    $_FILES['file']['size'] = $image['size'];
    $uploadPath = FCPATH . $path;
    $config['upload_path'] = $uploadPath;
    $config['allowed_types'] = '*';
    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);
    if ($CI->upload->do_upload('file')) {
        return array('status' => true, 'data' => $CI->upload->data());
    } else {
        return array('status' => false, 'error' => $CI->upload->display_errors());
    }
}

if (!function_exists('validate')) {
    function validate($table, $where)
    {
        $CI = &get_instance();
        $CI->db->where($where);
        $result = $CI->db->get($table);
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

if (!function_exists('get_menu_list')) {

    function get_menu_list($position = '')
    {
        $CI = &get_instance();
        $data = array();
        //1=Left Position , 2 =Right Position
        if (!empty($position)) {
            $menuPosition = $position;
        } else {
            $menuPosition = 2;
        }
        $data = $CI->db->order_by('menu_order', 'ASC')->get_where("menu_items", array("parent_menu_id" => 1, "menu_item_status" => 1, 'menu_position' => $menuPosition))->result_array();

        $i = 0;
        foreach ($data as $hm) {
            $CI->db->where('menu_itom_id', $hm['menu_item_id']);
            $CI->db->where('parent_menu_id', 1);
            $data[$i]['sub_menu'] = $CI->db->get('sub_menu_items')->result_array();
            $i++;
        }
        return $data;
    }
}

if (!function_exists('get_footer_menu_list')) {

    function get_footer_menu_list()
    {
        $CI = &get_instance();
        $data = array();
        $data = $CI->db->order_by('menu_order', 'ASC')->get_where("menu_items", array("parent_menu_id" => 2, "menu_item_status" => 1))->result_array();
        $i = 0;
        foreach ($data as $hm) {
            $CI->db->where('menu_itom_id', $hm['menu_item_id']);
            $CI->db->where('parent_menu_id', 1);
            $data[$i]['sub_menu'] = $CI->db->get('sub_menu_items')->result_array();
            $i++;
        }
        return $data;
    }
}

if (!function_exists('videoType')) {

    function videoType($url)
    {
        if (strpos($url, 'youtube') > 0 || strpos($url, 'youtu') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } elseif (strpos($url, 'mp4') > 0) {
            return 'mp4';
        } else {
            return 'unknown';
        }
    }
}
if (!function_exists('get_video_url')) {

    function get_video_url($v_url)
    {
        $videoType = videoType($v_url);
        if ($videoType == 'youtube') {
            $arrayurl = explode("watch?v=", $v_url);
            $vid[0] = "";
            if (isset($arrayurl[1])) {
                $vid = explode("&", $arrayurl[1]);
            }
            return $url = $arrayurl[0] . "embed/" . $vid[0];
        } else if ($videoType == 'vimeo') {
            if (strpos($v_url, '.com/video/') > 0) {
                $arrayurl = explode(".com/video/", $v_url);
                $a = $arrayurl[1];
            } else if (strpos($v_url, '.com/') > 0) {
                $arrayurl = explode(".com/", $v_url);
                $b = explode('/', $arrayurl[1]);
                $a = $b[0];
            }
            return $url = 'https://player.vimeo.com/video/' . $a;
        } else {
            return $url = $v_url;
        }
    }
}


if (!function_exists('count_all_result')) {

    function count_all_result($table, $where = null)
    {
        $CI = &get_instance();
        if (!empty($where)) {
            return $usercount = $CI->db->where($where)->count_all_results($table);
        } else {
            return $usercount = $CI->db->count_all_results($table);
        }
    }
}
#Return all row of table
if (!function_exists('read_data')) {

    function read_data($table_name, $orderkey = '', $orderValue = '')
    {
        $CI = &get_instance();
        if (!empty($orderkey) && $orderValue) {
            $CI->db->order_by($orderkey, $orderValue);
        }
        $response = $CI->db->get($table_name);
        return $response->result_array();
    }
}



//Image Resize 
if (!function_exists('resize_image')) {

    function resize_image($path, $imagename, $image_width, $image_height)
    {
        $CI = &get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $imagename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $image_width;
        $config['height'] = $image_height;
        $CI->image_lib->clear();
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
    }
}

//remove single image fro folder
if (!function_exists('unlink_image')) {

    function unlink_image($table, $where, $path)
    {
        $CI = &get_instance();
        $image_data = read_data_where_row($table, $where);
        return @unlink($path . $image_data->imageUrl);
    }
}

#Remove Multiple image from folder 
if (!function_exists('unlink_multiple_image')) {

    function unlink_multiple_image($table, $where, $path)
    {
        $CI = &get_instance();
        $image_data = read_data_where($table, $where);
        //        pre($image_data);die;
        foreach ($image_data as $deletRow) {
            @unlink($path . $deletRow['imageUrl']);
        }
    }
}
#Return data basis on where clause 
if (!function_exists('read_data_where')) {

    function read_data_where($table_name, $where, $orderkey = '', $orderValue = '')
    {
        $CI = &get_instance();
        $CI->db->where($where);
        if (!empty($orderkey) && !empty($orderValue)) {
            $CI->db->order_by($orderkey, $orderValue);
        }
        $response = $CI->db->get($table_name);
        return $response->result_array();
    }
}
#Return data basis on where clause 
if (!function_exists('read_data_where_row')) {

    function read_data_where_row($table_name, $where)
    {
        $CI = &get_instance();
        $where = $CI->db->where($where);
        $response = $CI->db->get($table_name);
        return $response->row();
    }
}
if (!function_exists('getDetail')) {
    function getDetail($table, $where)
    {
        $CI = &get_instance();
        $CI->db->where($where);
        return $CI->db->get($table)->row();
    }
}

// check condition by dynmic operator greater than ,leass than ,grater than equal ,less than equal
if (!function_exists('num_condition_operator')) {
    function num_condition_operator($var1, $op, $var2)
    {
        switch ($op) {
            case "=":
                return $var1 == $var2;
            case "!=":
                return $var1 != $var2;
            case ">=":
                return $var1 >= $var2;
            case "<=":
                return $var1 <= $var2;
            case ">":
                return $var1 >  $var2;
            case "<":
                return $var1 <  $var2;
            default:
                return true;
        }
    }
}
#=========================== Get truck location by FROM to TO address =================================>
if (!function_exists('get_location_by_address')) {
    function get_location_by_address($from, $to)
    {
        $CI = &get_instance();
        $CI->load->library('curl');
        $key = BING_MAP_KEY; //google map api key
        $result = $CI->curl->simple_get(
            // 'http://dev.virtualearth.net/REST/V1/Routes/Driving?wp.0=' . $from . '&wp.1=' . $to . '&avoid=minimizeTolls&key=' . $key
            // 'http://dev.virtualearth.net/REST/V1/Routes/Driving?wp.0=' . $from . 'a&wp.1=' . $to . '&avoid=minimizeTolls&key=' . $key
            'https://dev.virtualearth.net/REST/v1/Routes/Truck?wp.0=' . $from . '&wp.1=' . $to . '&key=' . $key

        );
        return $result;
    }
}

#=========================== END Get truck location by FROM to TO address =================================>



#=================== Get address by lat or long using Microsoft Bing Map API===============================>
if (!function_exists('get_address_by_lat_or_long')) {
    function get_address_by_lat_or_long($latitude, $longitude)
    {
        $key = BING_MAP_KEY; //google map api key
        $baseURL = "http://dev.virtualearth.net/REST/v1/Locations";
        $revGeocodeURL = $baseURL . "/" . $latitude . "," . $longitude . "?output=xml&key=" . $key;
        $rgOutput = file_get_contents($revGeocodeURL);
        $rgResponse = new SimpleXMLElement($rgOutput);
        $address = $rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->AdminDistrict;
        // $address = $rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;
        return $address;
    }
}
#=================== End Get address by lat or long using Microsoft Bing Map API===============================>


#update data
if (!function_exists('update_data_where')) {

    function update_data_where($table_name, $where, $data)
    {
        $CI = &get_instance();
        $where = $CI->db->where($where);
        $response = $CI->db->update($table_name, $data);
        return $response;
    }
}
#Delete Record
if (!function_exists('delete_record')) {

    function delete_record($table_name, $where)
    {
        $CI = &get_instance();
        $CI->db->where($where);
        $response = $CI->db->delete($table_name);
        return $response;
    }
}
if (!function_exists('insert_data')) {
    function insert_data($table, $store_result)
    {
        $CI = &get_instance();
        $result =  $CI->db->insert($table, $store_result);
        if ($result) {
            return  $CI->db->insert_id();
        } else {
            return false;
        }
    }
}
//Check value already exist or not 
if (!function_exists('value_Exist')) {

    function value_Exist($table, $where)
    {
        $CI = &get_instance();
        $check_user = $CI->db->get_where($table, $where);
        if ($check_user->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
#fetch record using like query
if (!function_exists('fetch_record_like')) {

    function fetch_record_like($column, $table, $data)
    {
        $CI = &get_instance();
        $CI->db->like($column, $data);
        $response = $CI->db->get($table);
        return $response->result_array();
    }
}
#fetch recored like using where clause
if (!function_exists('fetch_record_like_where')) {

    function fetch_record_like_where($column, $table, $data, $where)
    {
        $CI = &get_instance();
        $CI->db->like($column, $data);
        $CI->db->where($where);
        $response = $CI->db->get($table);
        return $response->result_array();
    }
}
if (!function_exists('record_count_month_wise')) {

    function record_count_month_wise($tablename)
    {
        $CI = &get_instance();
        $sql = "SELECT MONTHNAME(created_at) , COUNT(created_at) FROM " . $tablename . " WHERE status=1 GROUP BY MONTHNAME(created_at)";
        $query = $CI->db->query($sql);
        return $query->result_array();
    }
}
if (!function_exists('avg_funtion')) {

    function avg_funtion($column, $where, $table_name)
    {
        $CI = &get_instance();
        $CI->db->select_avg($column);
        $CI->db->where($where);
        $response = $CI->db->get($table_name)->row();
        return $response;
    }
}

function count_all_results($where = array(), $table_name = array())
{
    $CI = &get_instance();
    if (!empty($where) && count($where) > 0) {
        $CI->db->where($where);
    }
    return $CI->db->count_all_results($table_name[0]); //table_name array sub 0
}

function count_all_results_where($table_name, $where)
{
    $CI = &get_instance();
    if (!empty($where) && count($where) > 0) {
        $CI->db->where($where);
    }
    return $CI->db->count_all_results($table_name); //table_name array sub 0
}

function check_login()
{
    // Create instance of current page
    $CI = &get_instance();
    if (empty($CI->session->userdata('userid')) || empty($CI->session->userdata('roleid')) || $CI->session->userdata('roleid') != '1') {
        if (!empty($_SERVER['REDIRECT_QUERY_STRING'])) {
            $CI->session->set_userdata('last_request_url', $_SERVER['REDIRECT_QUERY_STRING']);
        }
        return false;
    }
    return true;
}

function pre($var)
{
?>
    <pre>
     <?php print_r($var); ?>
     </pre>
<?php
}

function h($data)
{
    return htmlspecialchars($data);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function urlencrypt($string)
{
    $output = false;
    // hash
    $key = hash('sha256', SECRET_KEY);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    //do the encyption given text/string/number
    $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}

function urldecrypt($string)
{
    $output = false;
    // hash
    $key = hash('sha256', SECRET_KEY);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    //decrypt the given text/string/number
    $output = openssl_decrypt(base64_decode($string), ENCRYPT_METHOD, $key, 0, $iv);
    return $output;
}

function get_images($for, $forid)
{
    $CI = &get_instance();
    $burl = base_url("uploads/$for");
    $CI->db->select("imageid as imageId, imageUrl");
    return $CI->db->get_where('images', array('imageFor' => $for, 'imageForId' => $forid, 'deletedAt' => 0))->result_array();
}

# upload docts

function upload_doc($name, $path)
{
    $CI = &get_instance();
    $config = array(
        'upload_path' => realpath("uploads/$path"),
        'allowed_types' => "txt|xls|xlsx|doc|docx|pdf|pps|ppsx",
        'overwrite' => FALSE,
        'max_size' => "2048000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
    );
    $CI->load->library('upload', $config);
    if ($CI->upload->do_upload($name)) {
        return array('status' => TRUE, 'data' => $CI->upload->data());
    } else {
        return array('status' => FALSE, 'error' => $CI->upload->display_errors());
    }
}

function remove_special_char($str)
{
    $char_arr = array(",", ".", "{", "}", "(", ")", "[", "]", "?", "'", "/", "-", "&", "$", '"', "–");
    foreach ($char_arr as $val) {
        if (strpos($str, $val)) {
            $str = str_replace($val, '', $str);
        }
    }
    return $str;
}

# function for getting title for URL

function title_for_url($title)
{
    return str_replace(' ', '-', remove_special_char($title));
}

function reverse_title_for_url($title)
{
    return str_replace('-', '&nbsp;', $title);
}

function remove_underscore($title)
{
    $new_title = str_replace('_', '&nbsp;', $title);
    return ucfirst($new_title);
}
