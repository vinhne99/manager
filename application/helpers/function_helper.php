<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

function is_validated(){
	$CI =& get_instance();
	if(! $CI->session->userdata('validated')){
		redirect('admin', 'refresh');
	}
}
function setting_value($key){
	$CI =& get_instance();
	$CI->load->model('admin/setting_model');
	$result = $CI->setting_model->get_setting($key);
	if (!empty($result))
		return $result->content;
	return '';
}
function get_image($path){
	if (file_exists($path)){
		return base_url().$path;
	}
	return base_url(). 'assets/images/no_image.jpg';
}

function get_image_post_by_id($size, $path){
	if (file_exists("uploads/images/sanpham/".$size."/".$path)){
		return base_url()."uploads/images/sanpham/".$size."/".$path;
	}
	return base_url(). 'assets/images/no_image.jpg';
}


function get_image_product($type = "sanpham",$product_id, $size = NULL){
	$CI =& get_instance();
	$CI->load->model('admin/image_model');
	$result = $CI->image_model->get_image($product_id);
	$path = '';
	if (!empty($result)){
		$path = 'uploads/images/' . $type .'/' . $size . '/'. $result[0]->image_path;
	}
	if ($size == NULL ){
		$path = 'uploads/images/' . $type .'/'. $result[0]->image_path;
	}
	if (file_exists($path)){
		return base_url().$path;
	}
	return base_url(). 'assets/images/no_image.jpg';
}

function get_post($post_id){
	$CI =& get_instance();
	$CI->load->model('admin/post_model');
	return $CI->post_model->get_post_by_id($post_id);

}


function get_image_slide($id, $size){
	$CI =& get_instance();
	$CI->load->model('admin/slide_model');
	$result = $CI->slide_model->get_slide_by_id($id);
	$path = '';
	if (!empty($result)){
		$path = 'uploads/images/slide/' . $size . '/'. $result->path_image;
	}
	if (file_exists($path)){
		return base_url().$path;
	}
	return base_url(). 'assets/images/no_image.jpg';
}

function get_slide(){
	$CI =& get_instance();
	$CI->load->model('admin/slide_model');
	return $CI->slide_model->get_slide();
}

function get_custormer($id){
	$CI =& get_instance();
	$CI->load->model('admin/customer_model');
	return $CI->customer_model->get_customer($id);
}
function sub_str($str, $k){
	$arr = explode(" ", $str);
	$str_t = '';
	for ($i = 0; $i < count($arr); $i++){
		if ($i == ($k-1))
			$str_t .= $arr[$i] . "<br/>";
		else
			$str_t .= $arr[$i]  . " ";
	}
	return $str_t;
}
function sub_str_description($get_the_content , $lenght = 10){
	$author_desc = strip_tags(nl2br($get_the_content));
	$arr = explode(' ', strip_tags($author_desc));
	$str = '';
	$i = 0;
	if(count($arr) <= $lenght){
		return $get_the_content;
	}
	foreach($arr as $row){
		$str .= $row . " ";
		$i++;
		if($i == $lenght) break;
	}
	return $str . " ...";
}
function covert_url($inputString, $id = '')
{
	$trans = array (
		'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
		'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A',

		'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
		'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A',

		'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
		'Ă' => 'A', 'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A',

		'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
		'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E',

		'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
		'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E',

		'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
		'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I',

		'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
		'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O',

		'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
		'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',

		'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
		'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O',

		'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
		'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U',

		'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
		'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U',

		'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
		'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y',

		'đ' => 'd',
		'Đ' => 'D',

		' ' => '-'
	);

	$string = strtr ( $inputString, $trans );
	$string = strtolower($string);
	$string = preg_replace('/[^a-z0-9]+/i',' ', $string);
	$string = trim($string);
	$string = preg_replace('/ /', '-', $string);
	if ($id == '')
		return $string;

	return $string . "-" . $id;
}


function date_now(){
	return date("Y-m-d H:i:s");
}