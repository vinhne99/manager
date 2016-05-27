<?php 
class Home_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function get_post_by_id($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('post');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

    public function get_image_by_id($id){
        $this->db->select('*');
        $this->db->where('parent_id', $id);
        $this->db->from('image');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }

    public function get_post_type1($type, $limit = '', $start = 0){
        $this->db->select('post.*, category.title as name_category, post.id as post_id');
        $this->db->where('type', $type);
        $this->db->from('post');
        $this->db->join('category','post.category_id = category.id', 'LEFT');
        $this->db->order_by('post.date_create', 'DESC');
        if ($limit != '')
            $this->db->limit($limit, $start);

        $query = $this->db->get();

        if ($limit == '')
            return $query->num_rows();

        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }

    public function get_cms_by_id($id){
        $this->db->select('*');
        $this->db->from('cms');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

    public function get_category($type){
        $this->db->select('*');
        $this->db->from('category');
        $this->db->order_by('order', 'ASC');
        $this->db->where('type', $type);
        $this->db->where('delete', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }

    public function get_post_type_category_by_cat_id_one($type, $cat = 0){
        $this->db->select('post.*, option.*, category.title as name_category, post.id as post_id');
        $this->db->from('post');
        $this->db->join('option','post.id = option.parent_id', 'LEFT');
        $this->db->join('category','post.category_id = category.id', 'LEFT');
        $this->db->where('post.type', $type);
        $this->db->where('post.category_id', $cat);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

    public function get_post_type_category($type, $limit = '', $start = 0 , $order = true, $arr_categrory = null){
        $this->db->select('post.*, option.*, category.title as name_category, post.id as post_id');
        $this->db->from('post');
        $this->db->join('option','post.id = option.parent_id', 'LEFT');
        $this->db->join('category','post.category_id = category.id', 'LEFT');
        $this->db->where('post.type', $type);
        if ($arr_categrory != null){
            $this->db->where_in('post.category_id', $arr_categrory);
        }

        if ($order)
            $this->db->order_by('post.date_create', 'DESC');
        else
            $this->db->order_by('post.date_create', 'ASC');

        if ($limit != '')
        $this->db->limit($limit, $start);

        $query = $this->db->get();

        if ($limit == '')
            return $query->num_rows();

        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }


	
}

?>