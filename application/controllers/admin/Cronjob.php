<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$xml = new SimpleXMLElement("http://vnexpress.net/rss/tin-moi-nhat.rss");
		print_r($xml);

		die();
		$dom = new DOMDocument();
		$dom->load('http://vnexpress.net/rss/tin-moi-nhat.rss');
		$items = $dom->getElementsByTagName("item");
		foreach ($items as $item)//lap
		{
			echo $item->getElementsByTagName('title');
		}
	}
}
