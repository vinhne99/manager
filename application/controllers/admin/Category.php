<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	private $tree_ul = '';
	private $tree_select = '';
	private $serent = 0;
	private $type = "0";
	private  $current_date = '';
	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/category_model');
		$this->current_date = date_now();
	}

	public function index()
	{
		$this->dequymenu(0);
		$data['tree'] = $this->tree_ul;
		$data['page'] = "admin/category/index";
		$this->load->view('admin/layout', $data);
	}

	public function order_category(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$order_id = $this->input->post('order');
			$parent = $this->input->post('parent');
			$id = $this->input->post('id');
			$array = explode(',', $order_id);
			$i = 0;
			foreach ($array as $row){
				$this->category_model->update(array('order' => $i++ ), $row);
			}
			$this->category_model->update(array('parent_id' => $parent ), $id);
		}

	}

	public function delete_category(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$this->category_model->update(array('delete' => 1 ), $id);
			echo 1;
			die();
		}
	}
	public function edit($id){
		$data['category'] = $this->category_model->get_category_by_id($id);
		if ($data['category'])
			$this->dequyselect(0, $data['category']->parent_id, $id);
		else
			$this->dequyselect(0, 0, $id);
		$data['tree'] = $this->tree_select;

		echo json_encode($data);
	}
	public function dequymenu($parent_id){
		$data = $this->category_model->get_category($parent_id, $this->type);
		$this->tree_ul .= '<ul id="' . $parent_id . '">';
		if (!empty($data)) {
			foreach ($data as $row) {
				$this->tree_ul .= '<li id="' . $row->id . '"><span class="title-category"><strong>' . $row->title. '</strong><span class="action"><a onclick="edit_category(' . $row->id . ');" href="javascript:;" title="Sửa" ><i class="fa fa-edit"></i></a> <a onclick="delete_category(' . $row->id . ');" href="javascript:;" title="Xóa" ><i class="fa fa-remove"></i></a></span></span>';
				$this->dequymenu($row->id);
				$this->tree_ul .= '</li>';
			}
		}
		$this->tree_ul .= '</ul>';
	}
	public function update_category(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$parent_id = $this->input->post('parent_id');
			$image = $this->input->post('image');
			if ($id == 0){
				$plug_url = covert_url($title, '');
				$this->category_model->insert(array('title' => $title,'type' => $this->type, 'description' => $description,'image' => $image, 'parent_id' => $parent_id, 'order' => 9999, 'plug_url' => $plug_url, 'date_create' => $this->current_date));
				$this->dequymenu(0);
				echo json_encode(array('status' => 1, 'success' => 'Thêm danh mục ' . $title . ' thành công!', 'tree' => $this->tree_ul));
			} else {
				$plug_url = covert_url($title, $id);
				$this->category_model->update(array('title' => $title, 'description' => $description, 'image' => $image,  'parent_id' => $parent_id, 'plug_url' => $plug_url , 'date_update' => $this->current_date), $id);
				$this->dequymenu(0);
				echo json_encode(array('status' => 1, 'success' => 'Cập nhật danh mục ' . $title . ' thành công!', 'tree' => $this->tree_ul));
			}
		}
	}


	public function dequyselect($parent_id, $curent_id, $id){
		$this->serent++;
		$data = $this->category_model->get_category($parent_id, $this->type);
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
