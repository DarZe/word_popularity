<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GitHubRequest  {

	private $CI;

	function __construct() {
	       $this->CI =& get_instance();
	       $this->CI->load->database();
	}

	function get_api($provider_name) {
		$this->CI->db->select('url, search_key,filter');
		$this->CI->db->from('api_call');
		$this->CI->db->where('name',$provider_name);
		$query = $this->CI->db->get();
		if($query->num_rows() > 0) {
			$url = $query->result_array();
		} else {
			$url = '';
		}
		return $url;
	}

	function get_total_count($word,$provider_name) {
	
		$api = $this->get_api($provider_name);
		return $this->_get_total_count($api, $word);

	}

	function get_positive_count($word,$provider_name) {
	
		$api = $this->get_api($provider_name);
		return $this->_get_positive_count($api, $word);
	}

	private function _get_total_count($api, $word) {
		
		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', $api[0]['url'].'?'.$api[0]['search_key'].'='.$word);
		$body = (string) $res->getBody();
		$json = json_decode($body); 
		$total_count = $json->total_count;

		return $total_count;
	}

	private function _get_positive_count($api, $word){

		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', $api[0]['url'].'?'.$api[0]['search_key'].'='.$word.$api[0]['filter']);
		$body = (string) $res->getBody();
		$json = json_decode($body);
		$positive_count = $json->total_count;

		return $positive_count;
	}
}