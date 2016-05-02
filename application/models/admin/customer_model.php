<?php
class Customer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_customer($id){
        $this->db->select('*');
        $this->db->from('custormer');
        $this->db->where("id", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row();
        return array();
    }

}

?>