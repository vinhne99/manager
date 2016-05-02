<?php	
class Order_model extends CI_Model {

	function get_all_order($limit = 0, $start = 0){
		$this->db->select('*');
		$this->db->from("order");
		$this->db->order_by('date_create','DESC');
		if ( $limit==0 )
			return $this->db->get()->num_rows();
		$this->db->limit($limit, $start);
		$query = $this->db->get()->result();
		return $query;
	}
	function get_order_detail($order_id , $is_count = false ){
		$this->db->select('*');
		$this->db->from("order_detail");
		$this->db->where("order_id", $order_id);
		if ($is_count)
			return $this->db->get()->num_rows();
		$query = $this->db->get()->result();
		return $query;
	}
	public function update($data, $order_id){
		$this->db->where("id", $order_id);
		$this->db->update("order",$data);
	}
}
?>