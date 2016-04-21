<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	private $tree_select = '';
	private $serent = 0;
	private  $current_date = '';
	private $type = "PRODUCT";
	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/category_model');
		$this->load->model('admin/post_model');
		$this->load->model('admin/image_model');
		$this->current_date = $this->config->item('current_datetime');
	}
	public function index()
	{
		$data['page'] = "admin/product/index";
		$this->load->view('admin/layout' , $data);
	}

	public function ajax_product(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->library("page_ajax");
			$total_row = $this->post_model->get_post_type($this->type);
			$page = $this->input->post('page');
			$limit = 20;
			$total = (int)round( $total_row / $limit);
			if ($page >= $total){
				$page = $total;
			}
			$this->session->set_userdata("page_product", $page);

			$start = $page*$limit;

			$config['page_total'] = $total;
			$config['page_current'] = $page;
			$config['function'] = "load_product";
			$data['pagination'] = $this->page_ajax->initialize($config);
			$data['products'] = $this->post_model->get_post_type($this->type, $limit, $start);
			$this->load->view('admin/product/ajax_list' , $data);
		}
	}

	public function create()
	{
		$this->dequyselect(0, 0, 0);
		$data['tree'] = $this->tree_select;
		$data['page'] = "admin/product/create";
		$this->load->view('admin/layout' , $data);
	}
	public function edit($id)
	{
		$product = $this->post_model->get_post_by_id($id);
		$this->dequyselect(0, $product->category_id, $id);
		$data['product'] = $product;
		$data['option'] =  $this->post_model->get_option_by_id($id);
		$data['image'] =  $this->image_model->get_image($id);

		$data['tree'] = $this->tree_select;
		$data['page'] = "admin/product/edit";
		$this->load->view('admin/layout' , $data);
	}

	public function delete(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$product = $this->post_model->get_post_by_id($id);
			$this->post_model->delete($id);
			echo json_encode(array('status' => 1, 'success' => 'Xóa sản phẩm ' . $product->title . ' thành công!'));
		}
	}

	public function update_product(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$parent_id = $this->input->post('parent_id');
			$image = $this->input->post('image');
			$image_default = $this->input->post('image_default');
			$arr_image =  explode(",", $image);
			unset($arr_image[0]);
			$price_seo = $this->input->post('price_seo');
			$price = $this->input->post('price');
			if ($id == 0){
				$plug_url = covert_url($title, '');
				$p_id = $this->post_model->insert(array('title' => $title, 'description' => $description, 'category_id' => $parent_id, 'type' => 'PRODUCT' , 'plug_url' => $plug_url, 'date_create' => $this->current_date));
				$this->post_model->insert_option(array('parent_id' => $p_id, 'price' => $price , 'price_seo' => $price_seo));
				if (!empty($arr_image)){
					foreach($arr_image as $row){
						if ($row != '') {
							if ($image_default == ''){
								$this->image_model->update(array('parent_id' => $p_id, 'default' => 1), $row);
								$image_default = 'insert';
							} else {
								if ($image_default == $row)
									$this->image_model->update(array('parent_id' => $p_id, 'default' => 1), $row);
								else
									$this->image_model->update(array('parent_id' => $p_id), $row);
							}
						}
					}
				}
				echo json_encode(array('status' => 1, 'success' => 'Thêm sản phẩm ' . $title . ' thành công!'));
			} else {
				$plug_url = covert_url($title, $id);
				$this->post_model->update(array('title' => $title, 'description' => $description, 'category_id' => $parent_id, 'plug_url' => $plug_url , 'date_update' => $this->current_date), $id);
				$this->post_model->update_option(array( 'price' => $price , 'price_seo' => $price_seo), $id);
				echo json_encode(array('status' => 1, 'success' => 'Cập nhật sản phẩm ' . $title . ' thành công!'));
			}

		}
	}


	public function dequyselect($parent_id, $curent_id, $id){
		$this->serent++;
		$data = $this->category_model->get_category($parent_id);
		if (!empty($data)) {
			foreach ($data as $row) {
				$selected = '';
				if($curent_id ==  $row->id )
					$selected = 'selected="selected"';
				$disable = '';
				if ($id == $row->id)
					$disable = ' disabled';
				if ($row->parent_id == 0) {
					$this->serent = 0;
					$this->tree_select .= '<option ' . $selected . $disable . ' value="' . $row->id. '" >' . $row->title . '</option>';
				}
				else
					$this->tree_select .= '<option ' . $selected . $disable . ' value="' . $row->id. '">' . $this->gach(). $row->title. '</option>';
				$this->dequyselect($row->id, $curent_id, $id);
			}
		}
	}
	function gach(){
		$html = '';
		for($i = 0; $i<$this->serent ; $i++){
			$html .= '- ';
		}
		return $html;
	}
}
