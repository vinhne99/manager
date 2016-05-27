<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/setting_model');
		$this->load->model('admin/users_model');
	}
	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			foreach ($this->input->post() as $key => $val){
				$result = $this->setting_model->get_setting($key);
				if (!empty($result))
					$this->setting_model->update(array('content' => $val , 'date_update' => date_now()), $key);
				else
					$this->setting_model->insert(array('key' => $key, 'content' => $val ,  'date_update' =>date_now()));
			}

		}
		$data['page'] = "admin/setting/index";
		$this->load->view('admin/layout', $data);
	}

	public function update_password(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_rules('password_old', 'mật khẩu hiện tại', 'trim|required');
			$this->form_validation->set_rules('password_new', 'mật khẩu mới', 'trim|matches[password_new_re]|required|min_length[5]');
			$this->form_validation->set_rules('password_new_re', 'nhập lại mật khẩu', 'trim|required|min_length[5]');
			$user = $this->session->userdata('validated');
			$password_old = $this->security->xss_clean($this->input->post('password_old'));
			if (!$this->check_password_old($password_old, $user->id)){
				echo json_encode(array('status' => 0, 'error' => "Mật khẩu hiện tại không đúng!"));
				die();
			}
			$is_check = true;

			if (!$this->form_validation->run())
			{
				$is_check = false;
			}
			$error = trim((str_replace("()", "", validation_errors())));
			if (strip_tags($error) == ''){
				$is_check = true;
			}
			if ($is_check){
				$password = $this->security->xss_clean($this->input->post('password_new'));
				$this->users_model->update_password(array('password' => md5($password)), $user->id);
				echo json_encode(array('status' => 1, 'success' => 'Cập nhật mật khẩu thành công!'));
			} else {
				echo json_encode(array('status' => 0, 'error' => $error ));
			}

			die();
		}
	}

	function check_password_old($password, $id){
		$pass = $this->users_model->get_user($id)->password;
		if ($pass == md5($password))
			return true;
		return false;
	}
}
