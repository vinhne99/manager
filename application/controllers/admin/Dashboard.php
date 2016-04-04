<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/users_model');
	}
	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_rules('username', 'Tên đăng nhập', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
			if ($this->form_validation->run())
			{
				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
			 	$result = 	$this->users_model->check_login($username);
				if ( !empty($result) && $result->password == md5($password)){
					// session
					$this->session->set_userdata("validated", $result);
					redirect('admin/dashboard', 'refresh');
				} else {
					$this->session->set_flashdata('message', 'Tài khoản không tồn tại, đăng nhập thất bại!');
				}
			}
		}

		$this->load->view('admin/login');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('admin', 'refresh');
	}

	public function index()
	{
		is_validated();
		$data['page'] = "admin/index";
		$this->load->view('admin/layout', $data);
	}
}
