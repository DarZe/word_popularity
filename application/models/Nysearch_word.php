<?php

class Nysearch_word extends CI_Model  {


	function __construct(){
		parent::__construct();   
	}
	
	function get_provider() {

		$this->db->select();
		$this->db->from('api_call');
		$query = $this->db->get()->result();
		
		return $query;
	}

	function get_score($total_count, $positive_count) {

		$score = ($positive_count / $total_count) *10;
		
		return $score;
	}
	

}
