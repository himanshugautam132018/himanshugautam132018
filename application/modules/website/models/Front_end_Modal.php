<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_end_Modal extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->blog_category = 'blog_category';
        $this->blog = 'blog';
    }
    
   /*
| -------------------------------------------------------------------------
| Get Blog Category with count blog 
| -------------------------------------------------------------------------
 * 
 */     
    public function get_blog_category_with_count() {
        $blog_category = read_data($this->blog_category, $order_key = 'blog_category_id', $order_value = 'desc');
        $i = 0;
        foreach ($blog_category as $blog) {
           $blog_category[$i]['countall'] = count_all_results_where($this->blog,array("blog_category_id"=>$blog['blog_category_id']));
           $i++;
        }
        
        
        
        
        return $blog_category;
    }
    
    #Count all Blog month wise 
     public function count_total_blog_month_wise(){
     $this->db->select('count(blog_id) as count,MONTHNAME(blog_created) as monthname') ->from('blog')->group_by('MONTH(blog_created)');
     $result = $this->db->get();
     return $result->result_array();
    }
    
  /*
| -------------------------------------------------------------------------
| Most popular blogs list 
| -------------------------------------------------------------------------
 * 
 */    
//   
   
    public function most_popular_blog(){
        $this->db->select('blog.* , blog_view.blog_id')
                ->from('blog')
                ->order_by("blog.blog_id", "DESC")
                ->join('blog_view', 'blog.blog_id = blog_view.blog_id')
                ->group_by('blog.blog_id')
                ->where(array("blog.blog_status" => 1));
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_popular_blog_with_image(){
        $popular_blog= $this->most_popular_blog();
        $i=0;
        foreach ($popular_blog as $pb) {
            $where=array("imageFor"=>'blog',"imageForId"=>$pb['blog_id']);
             $popular_blog[$i]['blog_image']=read_data_where('upload_document', $where);
             $i++;
        }
        return $popular_blog;
    }
/*
| -------------------------------------------------------------------------
|Event List section with image   
| -------------------------------------------------------------------------
 * 
 */
    public function event_list() {
         $where=array("e_status"=>1);
        $events= read_data_where('events',$where);
        $i=0;
        foreach ($events as $e) {
             $where=array("imageFor"=>'event',"imageForId"=>$e['e_id']);
             $events[$i]['event_image']=read_data_where('upload_document', $where);
             $i++;
        } 
        return $events;
    }
    
      public function event_list_where($eventid) {
        $where=array("e_id" => $eventid);
        $events= read_data_where('events',$where);
        $i=0;
        foreach ($events as $e) {
             $where=array("imageFor"=>'event',"imageForId"=>$e['e_id']);
             $events[$i]['event_image']=read_data_where('upload_document', $where);
             $i++;
        } 
        return $events;
    }
    
   public function get_slider(){
       $slider= read_data('slider');
        $i = 0;
        foreach ($slider as $s) {
            $this->db->where('imageForId', $s['slider_id']);
            $this->db->where('imageFor', 'slider');
            $slider[$i]['image'] = $this->db->get('upload_document')->result_array();
            $i++;
        }
        return $slider;
    }
     public function Homepage_block() {
        $home_setting = read_data('home_page_setting');
        $j = 0;
        foreach ($home_setting as $hs) {
            $this->db->where('imageForId', $hs['id']);
            $this->db->where('imageFor', 'homesetting');
            $home_setting[$j]['image'] = $this->db->get('upload_document')->result_array();
            $j++;
        }
        return $home_setting[0];
    }
   public function video_gallery_list() {
        $video=read_data('video');
        $i=0;
        foreach ($video as $v) {
             $where=array("imageFor"=>'video',"imageForId"=>$v['v_id']);
             $video[$i]['gallery_image']=read_data_where('upload_document', $where);
             $i++;
        } 
        return $video;
    }
    
    public function get_gallery_category_wise(){
       $category_where=read_data('gallery_category');
        $i=0;
        foreach ($category_where as $c) {
             $where=array("imageFor"=>'gallery',"imageForId"=>$c['gc_id']);
             $category_where[$i]['gallery_image']=read_data_where('upload_document', $where);
             $i++;
        } 
        return $category_where;
    }
    public function ip_exists($post_id, $ip_add) {
        $this->db->select('ip_add');
        $this->db->from('blog_view');
        $this->db->where('blog_id', $post_id);
        $query = $this->db->get();
        $i_add = $query->row('ip_add');
        $p_id = $query->row('blog_id');
        pre($i_add);
        if ($i_add == $ip_add or $p_id == $post_id) {
            return true;
        } else {
            return false;
        }
    }

    public function post_view($post_id, $ip_add) {
    $data = array('blog_id' => $post_id, 'ip_add' => $ip_add);
        $query = $this->db->insert('blog_view', $data);
        if ($query) {
            echo $post_id;
        } else {
            echo $ip_add;
        }
    }

    public function save_insert_data($table_name, $data) {
        $this->db->insert($table_name, $data);
        $contract_id = $this->db->insert_id();
        return $contract_id;
    }

    public function insert_data($table_name, $data) {
        $response = $this->db->insert($table_name, $data);
        return $response;
    }

    public function read_data($table_name) {
        // $this->db->limit($limit);
        $response = $this->db->get($table_name);
        return $response->result_array();
    }

    public function read_data_where($table_name, $where) {
        $where = $this->db->where($where);
        $response = $this->db->get($table_name);
        return $response->result_array();
    }

    public function update_data_where($table_name, $where, $data) {
        $where = $this->db->where($where);
        $response = $this->db->update($table_name, $data);
        return $response;
    }

    public function update_quetion_user_review($table_name, $where, $data) {
        $where = $this->db->where($where);
        $response = $this->db->update($table_name, $data);
        return $response;
    }

    public function read_data_login($table_name, $where) {
        $where = $this->db->where($where);
        $response = $this->db->get($table_name);
        return $response->row_array();
    }

    public function delete_record($table_name, $where) {
        $where = $this->db->where($where);
        $response = $this->db->delete($table_name);
        return $response;
    }

    public function fetch_record_like($column, $table, $data) {
        $this->db->like($column, $data);
        $response = $this->db->get($table);
        return $response->result_array();
    }

    public function fetch_record_like_where($column, $table, $data, $where) {
        $this->db->like($column, $data);
        $this->db->where($where);
        $response = $this->db->get($table);
        return $response->result_array();
    }

    public function record_count_month_wise($tablename) {
        $sql = "SELECT MONTHNAME(created_at) , COUNT(created_at) FROM " . $tablename . " WHERE status=1 GROUP BY MONTHNAME(created_at)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function avg_funtion($column, $where, $table_name) {
        $this->db->select_avg($column);
        $this->db->where($where);
        $response = $this->db->get($table_name)->row();
        return $response;
    }

}
