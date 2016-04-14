<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide extends CI_Controller {
	private  $current_date = '';
	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/slide_model');
		$this->current_date = $this->config->item('current_datetime');
	}

	public function index()
	{
		$data['page'] = "admin/slide/index";
		$this->load->view('admin/layout', $data);
	}
	public function edit_image()
	{
		$id = $this->input->post('id');
		$this->session->set_userdata("slide_id", $id);
		die('1');
	}

	public function ajax_load()
	{
		$this->session->set_userdata("slide_id", '');
		$data['slides'] = $this->slide_model->get_slide();
		$this->load->view('admin/slide/ajax_load', $data);
	}

	public function order(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$order_id = $this->input->post('order');
			$array = explode(',', $order_id);
			$i = 0;
			foreach ($array as $row){
				$this->slide_model->update(array('order' => $i++ ), $row);
			}
		}
	}

	public function delete_slide(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$image = $this->slide_model->get_slide_by_id($id);
			$upload_path = 'uploads/images/slide/';
			if (!empty($image)) {
				$size_img = $this->config->item('size_img_slide');
				$name = $image->path_image;
				unlink($upload_path . $name);
				foreach ($size_img as $img) {
					$upload_path_size = $upload_path . '/' . $img[0] . '/' . $name;
					unlink($upload_path_size);
				}
			}
			$this->slide_model->delete($id);
		}
	}

	public function save_edit(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$this->slide_model->update(array('title' => $title ), $id);
		}

	}

}
