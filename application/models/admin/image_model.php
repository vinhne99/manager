<?php 
class Image_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_image($parent_id){
        $this->db->select('*');
        $this->db->where('parent_id', $parent_id);
        $this->db->from('image');
        $this->db->order_by('default', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }

    public function get_image_by_id($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('image');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

	public function insert($data){
		$this->db->insert('image',$data);
		return $this->db->insert_id();
	}
    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('image',$data);
    }
    public function update_parent_id($data, $id){
        $this->db->where('parent_id',$id);
        $this->db->update('image',$data);
    }

    public function delete($data, $id){
        $this->db->where('parent_id',$id);
        $this->db->delete('image',$data);
    }

    public function delete_by_id($id){
        $this->db->where('id',$id);
        $this->db->delete('image');
    }
}

?>