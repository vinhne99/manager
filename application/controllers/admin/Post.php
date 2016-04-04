<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/post_model');
	}
	public function index()
	{
		$data['page'] = "admin/setting/index";
		$this->load->view('admin/layout', $data);
	}
}
