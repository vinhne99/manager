<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/new_model');
	}

	public function index(){
		$results = simplexml_load_file("http://vnexpress.net/rss/tin-moi-nhat.rss");
		$doc = new DOMDocument();
		foreach ($results->channel->item as $result){
			$url = (string)$result->guid;
			$doc->loadHTMLFile($url);
			$xpath = new DOMXPath($doc);
			$nlist1 = $xpath->query('//div[@id="left_calculator"]//div');
			if ($nlist1->length > 0){
				if (strlen(strip_tags($doc->saveHTML($nlist1->item(0)))) > 200) {
					$nlist = $xpath->query('//meta[@itemprop="thumbnailUrl"]');
					$nlist2 = $xpath->query('//meta[@itemprop="description"]');
					$image = '';
					if (strstr($nlist->item(0)->attributes->item(0)->value, "img.")) {
						$image = $nlist->item(0)->attributes->item(0)->value;
					} elseif (strstr($nlist->item(0)->attributes->item(1)->value, "img.")) {
						$image = $nlist->item(0)->attributes->item(1)->value;
					} else {
						$image = $nlist->item(0)->attributes->item(2)->value;
					}
					$short_description = '';
					if ($nlist2->item(0)->attributes->item(0)->value != "og:description" && $nlist2->item(0)->attributes->item(0)->value != "description"){
						$short_description = $nlist2->item(0)->attributes->item(0)->value;
					} elseif ($nlist2->item(0)->attributes->item(1)->value != "og:description" && $nlist2->item(0)->attributes->item(1)->value != "description"){
						$short_description = $nlist2->item(0)->attributes->item(1)->value;
					}elseif ($nlist2->item(0)->attributes->item(2)->value != "og:description" && $nlist2->item(0)->attributes->item(2)->value != "description"){
						$short_description = $nlist2->item(0)->attributes->item(2)->value;
					}
					$data = array(
						'title' => (string)$result->title,
						'short_description' => $short_description,
						'description' => $doc->saveHTML($nlist1->item(0)),
						'pubDate' => date_format(date_create((string)$result->pubDate), "Y-m-d H:i:s"),
						'image' => $image,
						'guid' => (string)$result->guid
					);
					$is = $this->new_model->get_new_by_title($data['title']);
					if (empty($is)){
						$this->new_model->insert($data);
					}

					// Insert data news
				}
			}

		}
		die("DONE");
	}
}
