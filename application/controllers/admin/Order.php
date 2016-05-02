<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/order_model');
	}
	public function index()
	{
		$data['page'] = "admin/order/index";
		$this->load->view('admin/layout', $data);
	}

	public function ajax_order(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->library("page_ajax");
			$total_row = $this->order_model->get_all_order(0, 0);
			$page = $this->input->post('page');
			$limit = 20;
			$total = (int)round( $total_row / $limit);
			if ($page >= $total){
				$page = $total;
			}
			$this->session->set_userdata("page_order", $page);

			$start = $page*$limit;

			$config['page_total'] = $total;
			$config['page_current'] = $page;
			$config['function'] = "load_order";
			$data['pagination'] = $this->page_ajax->initialize($config);
			$data['orders'] = $this->order_model->get_all_order($limit, $start);
			$this->load->view('admin/order/ajax_list' , $data);
		}

	}

	public function get_detail_order($id){
		$data['detail_orders'] = $this->order_model->get_order_detail($id);
		$this->load->view('admin/order/get_detail_order' , $data);

	}

	public function ajax_status(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			$this->order_model->update(array('status' => $status), $id);
		}
	}


}
