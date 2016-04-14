<?php 
class Slide_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function get_slide(){
        $this->db->select('*');
        $this->db->from('slide');
        $this->db->order_by('order', 'ASC');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_slide_by_id($id){
        $this->db->select('*');
        $this->db->from('slide');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('slide',$data);
    }
    public function insert($data){
        $this->db->insert('slide',$data);
    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('slide');
    }
}

?>