<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$data['posts'] = $this->home_model->get_post_type_category("POST", 7, 0, FALSE);
		$data['categorys'] = $this->home_model->get_category(0);
		$arr = array();
		foreach ($data['categorys'] as $row) {
			$arr[] = $row->id;
		}
		$data['designs'] = $this->home_model->get_post_type_category("PRODUCT", 50, 0, TRUE, $arr);
		$data['category_camera'] = $this->home_model->get_category(1);
		$data['page'] = "home/home";
		$this->load->view('layout', $data);
	}

	public function banggia()
	{
		$data['cms'] = $this->home_model->get_cms_by_id(2);
		$data['page'] = "home/price";
		$this->load->view('layout', $data);
	}
	public function contact()
	{
		$data['cms'] = $this->home_model->get_cms_by_id(3);
		$data['page'] = "home/contact";
		$this->load->view('layout', $data);
	}

	public function view($id){
		$data['post'] = $this->home_model->get_post_by_id($id);
		$data['image'] = $this->home_model->get_image_by_id($id);
		$this->load->view('home/view_camera', $data);
	}
}
