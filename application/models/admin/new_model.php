<?php	
class New_model extends CI_Model {

	function get_new_by_title($title){
		$this->db->select('*');
		$this->db->from("news");
		$this->db->where('title', $title);
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	public function insert($data){
		$this->db->insert("news",$data);
	}
}
?>