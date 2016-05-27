<?php 
class Post_model extends CI_Model {

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

    public function get_post_type($type, $limit = '', $start = 0){
        $this->db->select('post.*, option.*, category.title as name_category, post.id as post_id');
        $this->db->where('post.type', $type);
        $this->db->from('post');
        $this->db->join('option','post.id = option.parent_id', 'LEFT');
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

    public function get_option_by_id($id){
        $this->db->select('*');
        $this->db->where('parent_id', $id);
        $this->db->from('option');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('post',$data);
    }
    public function insert($data){
        $this->db->insert('post',$data);
        return $this->db->insert_id();
    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('post');
    }
    public function update_option($data, $id){
        $this->db->where('parent_id',$id);
        $this->db->update('option',$data);
    }
    public function insert_option($data){
        $this->db->insert('option',$data);
        return $this->db->insert_id();
    }
	
}

?>