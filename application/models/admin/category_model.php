<?php 
class Category_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_category($parent_id, $type = ''){
        $this->db->select('*');
        $this->db->where('parent_id', $parent_id);
        $this->db->from('category');
        $this->db->where("delete", 0);
        if ($type != '')
        $this->db->where("type", $type);

        $this->db->order_by('order','ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }
    public function get_category_by_id($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('category');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('category',$data);
    }
    public function insert($data){
        $this->db->insert('category',$data);
    }
}

?>