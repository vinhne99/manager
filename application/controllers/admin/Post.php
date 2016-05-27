<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	private $tree_select = '';
	private $serent = 0;
	private  $current_date = '';
	private $type = "POST";
	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/category_model');
		$this->load->model('admin/post_model');
		$this->load->model('admin/image_model');
		$this->current_date = date_now();
	}
	public function index()
	{
		$data['page'] = "admin/post/index";
		$this->load->view('admin/layout' , $data);
	}

	public function ajax_post(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->library("page_ajax");
			$total_row = $this->post_model->get_post_type($this->type);
			$page = $this->input->post('page');
			$limit = 20;
			$total = (int)round( $total_row / $limit);
			if ($page >= $total){
				$page = $total;
			}
			$this->session->set_userdata("page_post", $page);

			$start = $page*$limit;

			$config['page_total'] = $total;
			$config['page_current'] = $page;
			$config['function'] = "load_post";
			$data['pagination'] = $this->page_ajax->initialize($config);
			$data['posts'] = $this->post_model->get_post_type($this->type, $limit, $start);
			$this->load->view('admin/post/ajax_list' , $data);
		}
	}

	public function create()
	{
		$this->dequyselect(0, 0, 0);
		$data['tree'] = $this->tree_select;
		$data['page'] = "admin/post/create";
		$this->load->view('admin/layout' , $data);
	}
	public function edit($id)
	{
		$product = $this->post_model->get_post_by_id($id);
		$this->dequyselect(0, $product->category_id, $id);
		$data['post'] = $product;
		$data['option'] =  $this->post_model->get_option_by_id($id);
		$data['image'] =  $this->image_model->get_image($id);

		$data['tree'] = $this->tree_select;
		$data['page'] = "admin/post/edit";
		$this->load->view('admin/layout' , $data);
	}

	public function delete(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$product = $this->post_model->get_post_by_id($id);
			$this->post_model->delete($id);
			echo json_encode(array('status' => 1, 'success' => 'Xóa bài viết ' . $product->title . ' thành công!'));
		}
	}

	public function update_post(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$parent_id = $this->input->post('parent_id');
			$image = $this->input->post('image');
			$image_default = $this->input->post('image_default');
			$arr_image =  explode(",", $image);
			unset($arr_image[0]);
			if ($id == 0){
				$plug_url = covert_url($title, '');
				$p_id = $this->post_model->insert(array('title' => $title, 'description' => $description, 'category_id' => $parent_id, 'type' => $this->type , 'plug_url' => $plug_url, 'date_create' => $this->current_date));
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
				echo json_encode(array('status' => 1, 'success' => 'Thêm bài viết' . $title . ' thành công!'));
			} else {
				$plug_url = covert_url($title, $id);
				$this->post_model->update(array('title' => $title, 'description' => $description, 'category_id' => $parent_id, 'plug_url' => $plug_url , 'date_update' => $this->current_date), $id);
				echo json_encode(array('status' => 1, 'success' => 'Cập nhật bài viết' . $title . ' thành công!'));
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
