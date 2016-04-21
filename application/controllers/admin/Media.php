<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/image_model');
		$this->load->model('admin/slide_model');
		$this->load->model('admin/post_model');
		$this->load->model('simpleimage');
	}

	public function upload()
	{
		$upload_path = 'uploads/images/';
		if (
		(
			($_FILES["uploadfile"]["type"] == "image/gif") ||
			($_FILES["uploadfile"]["type"] == "image/jpeg") ||
			($_FILES["uploadfile"]["type"] == "image/png") ||
			($_FILES["uploadfile"]["type"] == "image/pjpeg")
		)
		)
		{
			$name = $_FILES["uploadfile"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$arr = explode('.', $name);
			unset($arr[count($arr) - 1]);

			$name = implode("-", $arr);
			$filename= strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $name). "-" .time());
			$filename = $filename.".".$ext;
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],$upload_path.$filename))
			{
				echo $upload_path.$filename;
			}
			else
			{
				echo 'error';
			}
		}
		else
		{
			echo 'error';
		}
	}
	public function upload_tour()
	{
		$upload_path = 'uploads/images/tour/';
		if(!is_dir($upload_path)){ mkdir($upload_path); }
		if (
		(
			($_FILES["uploadfile"]["type"] == "image/gif") ||
			($_FILES["uploadfile"]["type"] == "image/jpeg") ||
			($_FILES["uploadfile"]["type"] == "image/png") ||
			($_FILES["uploadfile"]["type"] == "image/pjpeg")
		)
		)
		{
			$id = '';
			if (isset($_POST['id']))
				$id = $_POST['id'];

			$name = $_FILES["uploadfile"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$arr = explode('.', $name);
			unset($arr[count($arr) - 1]);

			$name = implode("-", $arr);
			$filename= strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $name). "-" .time());
			$filename = $filename.".".$ext;
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],$upload_path.$filename))
			{

				$img_id = $this->image_model->insert(array('parent_id' => $id , 'image_path' => $filename , 'date_create' => $this->config->item('current_datetime')));
				$size_img = $this->config->item('size_img_tour');
				foreach ($size_img as $img){
					$upload_path_size = $upload_path.'/' .  $img[0] . '/';
					if(!is_dir($upload_path_size)){ mkdir($upload_path_size); }
					if (isset($img[2])){
						$this->simpleimage->load($upload_path.$filename)->best_fit($img[0], $img[1])->save($upload_path_size.$filename);
					} else {
						$this->simpleimage->load($upload_path.$filename)->resize($img[0], $img[1])->save($upload_path_size.$filename);
					}
				}
				if ($id == '')
					echo $img_id . "-::-". $upload_path.$filename;
				else {
					$results = $this->image_model->get_image($id);
					foreach ($results as $row){
						$id .= "," . $row->id;
					}
					echo $img_id . "-::-" . $upload_path ."50/". $filename;
				}
			}
			else
			{
				echo 'error';
			}
		}
		else
		{
			echo 'error';
		}
	}

	public function upload_product()
	{
		$upload_path = 'uploads/images/sanpham/';
		if(!is_dir($upload_path)){ mkdir($upload_path); }
		if (
		(
			($_FILES["uploadfile"]["type"] == "image/gif") ||
			($_FILES["uploadfile"]["type"] == "image/jpeg") ||
			($_FILES["uploadfile"]["type"] == "image/png") ||
			($_FILES["uploadfile"]["type"] == "image/pjpeg")
		)
		)
		{
			$id = '';
			if (isset($_POST['id']))
			$id = $_POST['id'];

			$name = $_FILES["uploadfile"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$arr = explode('.', $name);
			unset($arr[count($arr) - 1]);

			$name = implode("-", $arr);
			$filename= strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $name). "-" .time());
			$filename = $filename.".".$ext;
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],$upload_path.$filename))
			{

				$img_id = $this->image_model->insert(array('parent_id' => $id , 'image_path' => $filename , 'date_create' => $this->config->item('current_datetime')));
				$size_img = $this->config->item('size_img_product');
				foreach ($size_img as $img){
					$upload_path_size = $upload_path.'/' .  $img[0] . '/';
					if(!is_dir($upload_path_size)){ mkdir($upload_path_size); }
					if (isset($img[2])){
						$this->simpleimage->load($upload_path.$filename)->best_fit($img[0], $img[1])->save($upload_path_size.$filename);
					} else {
						$this->simpleimage->load($upload_path.$filename)->resize($img[0], $img[1])->save($upload_path_size.$filename);
					}
				}
				if ($id == '')
					echo $img_id . "-::-". $upload_path.$filename;
				else {
					$results = $this->image_model->get_image($id);
					foreach ($results as $row){
						$id .= "," . $row->id;
					}
					echo $img_id . "-::-" . $upload_path ."50/". $filename;
				}
			}
			else
			{
				echo 'error';
			}
		}
		else
		{
			echo 'error';
		}
	}

	public function upload_slide(){
		$upload_path = 'uploads/images/slide/';
		if(!is_dir($upload_path)){ mkdir($upload_path); }
		if (
		(
			($_FILES["uploadfile"]["type"] == "image/gif") ||
			($_FILES["uploadfile"]["type"] == "image/jpeg") ||
			($_FILES["uploadfile"]["type"] == "image/png") ||
			($_FILES["uploadfile"]["type"] == "image/pjpeg")
		)
		)
		{
			$id = '';
			if ($this->session->userdata('slide_id') && $this->session->userdata('slide_id') != '')
				$id = $this->session->userdata('slide_id');
			if(!is_dir($upload_path)){ mkdir($upload_path); }

			$name = $_FILES["uploadfile"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$arr = explode('.', $name);
			unset($arr[count($arr) - 1]);

			$name = implode("-", $arr);
			$filename= strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $name). "-" .time());
			$filename = $filename.".".$ext;
			if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],$upload_path.$filename))
			{
				if ($id == '') {
					$result = $this->slide_model->get_slide();
					$this->slide_model->insert(array('title' => "Slide ". count($result), 'path_image' => $filename, 'order' => 999));
				}else
					$this->slide_model->update(array('path_image' => $filename ), $id);

				$size_img = $this->config->item('size_img_slide');
				foreach ($size_img as $img){
					$upload_path_size = $upload_path.'/' .  $img[0] . '/';
					if(!is_dir($upload_path_size)){ mkdir($upload_path_size); }
					if (isset($img[2])){
						$this->simpleimage->load($upload_path.$filename)->best_fit($img[0], $img[1])->save($upload_path_size.$filename);
					} else {
						$this->simpleimage->load($upload_path.$filename)->resize($img[0], $img[1])->save($upload_path_size.$filename);
					}
				}
				echo base_url().$upload_path.$size_img[0][0]."/".$filename;

			}
			else
			{
				echo 'error';
			}
		}
		else
		{
			echo 'error';
		}
	}


	public function delete_image(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			$folder = '';
			if ($this->input->post('product_id')){
				$folder = "sanpham";
				$arr = $this->config->item('size_img_product');
			}
			elseif ($this->input->post('tour_id')){
				$folder = "tour";
				$arr = $this->config->item('size_img_tour');
			}
				$image = $this->image_model->get_image_by_id($id);
			$upload_path = "uploads/images/" . $folder . "/";
			if (!empty($image)){
				$size_img =$arr;
				$name = $image->image_path;
				unlink($upload_path.$name);
				foreach ($size_img as $img){
					$upload_path_size = $upload_path.'/' .  $img[0] . '/'.$name;
					unlink($upload_path_size);
				}
				$this->image_model->delete_by_id($id);
			}
			echo 1;
			die();
		}
	}
	public function update_default_image(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$parent_id = $this->input->post('parent_id');
			$img_id = $this->input->post('img_id');
			$this->image_model->update_parent_id(array( 'default' => 0), $parent_id);
			$this->image_model->update(array( 'default' => 1), $img_id);
		}
	}

	public function getimage($post_id){
		$data['image'] = $this->image_model->get_image($post_id);
		$tour = $this->post_model->get_post_by_id($post_id);
		$data['tour'] = $tour;
		$this->load->view('admin/media/getimagetour' , $data);
	}
	public function getimageproduct($post_id){
		$data['image'] = $this->image_model->get_image($post_id);
		$product = $this->post_model->get_post_by_id($post_id);
		$data['product'] = $product;
		$this->load->view('admin/media/getimageproduct' , $data);
	}

}
