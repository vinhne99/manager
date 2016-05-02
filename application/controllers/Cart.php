<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');

	}
	public function index()
	{
		$data = array(
			'id'      => 'sku_123ABC',
			'qty'     => 1,
			'price'   => 39.95,
			'name'    => 'T-Shirt',
			'options' => array('Size' => 'L', 'Color' => 'Red')
		);

		$this->cart->insert($data);
	}
	public function add()
	{

	}
	public function update()
	{

	}
	public function delete()
	{

	}
}
