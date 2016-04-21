<?php 
class Cms_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_list(){
        $this->db->select('*');
        $this->db->from('cms');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        return array();
    }

    public function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('cms',$data);
    }

}

?>