<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBase  {

	 private $CI;

	   function __construct() {
	       $this->CI =& get_instance();
	       $this->CI->load->database();
	   }

	private function _get_word($word){

		$this->CI->db->select('words,score');
		$this->CI->db->where('words', $word);
		$this->CI->db->from('words_score');
		$query =  $this->CI->db->get();
		if($query->num_rows() > 0){
			$query = $query->result_array();
			$query = $query[0];
		
		}else{
			$query = array('words' => '', 'score' => '');
		}

		return $query;
	}

	function get_word($word)
	{
		return $this->_get_word($word);

	}

	function insert_score($word, $score){
		$this->CI->db->set('score',$score);
		$this->CI->db->set('words',$word);
		$this->CI->db->insert('words_score');
	}

}