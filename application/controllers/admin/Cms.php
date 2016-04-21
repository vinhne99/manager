<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {
	private  $current_date = '';
	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/cms_model');
	}

	public function index()
	{
		$data['cms'] = $this->cms_model->get_list();
		$data['page'] = "admin/cms/index";
		$this->load->view('admin/layout', $data);
	}

	public function update(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$description = $this->input->post('description');
			$id = $this->input->post('id');
			$data = array(
				'description' => $description
			);
			$this->cms_model->update($data,$id );
		}
	}

}
