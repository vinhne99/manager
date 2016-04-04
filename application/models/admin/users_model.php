<?php 
class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function check_login($user_name)
    {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $user_name);
		$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
		    return $query->row();
		}
		return null;
    }

	function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $id);
		$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		return null;
	}

	public function update_password($data, $id){
		$this->db->where('id',$id);
		$this->db->update('user',$data);
	}
	
}

?>