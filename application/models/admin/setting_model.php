<?php 
class Setting_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function get_setting($key = '')
    {

		if ($key != '') {
			$this->db->select('*');
			$this->db->from('setting');
			$this->db->where('key', $key);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} else{
			$this->db->select('*');
			$this->db->from('setting');
			$query = $this->db->get();
			if ($query->num_rows() > 0)
				return $query->result();
		}
		return array();
    }

	public function update($data, $id){
		$this->db->where('key',$id);
		$this->db->update('setting',$data);
	}
	public function insert($data){
		$this->db->insert('setting',$data);
	}
	
}

?>