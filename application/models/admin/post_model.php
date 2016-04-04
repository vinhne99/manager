<?php 
class Post_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('post',$data);
    }
    public function insert($data){
        $this->db->insert('post',$data);
        return $this->db->insert_id();
    }
    public function update_option($data, $id){
        $this->db->where('product_id',$id);
        $this->db->update('option',$data);
    }
    public function insert_option($data){
        $this->db->insert('option',$data);
        return $this->db->insert_id();
    }
	
}

?>