<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_validated();
		$this->load->model('admin/image_model');
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
	public function upload_product()
	{
		$upload_path = 'uploads/images/sanpham/';
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
					echo $img_id . "-::-" . $upload_path . $filename;
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



}
