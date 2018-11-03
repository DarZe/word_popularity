<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'GitHubRequest.php';
require_once 'DataBase.php';
class Search_word extends CI_Controller {
private $CI;

	function __construct(){
		parent::__construct();
 		$this->load->model('Nysearch_word');
 		$this->load->helper('url'); 
 		$this->load->database();
    	$this->CI =& get_instance();
    	$this->CI->load->helper('form');   
	}
	
	public function index(){	
		
		$data['provider'] = $this->CI->Nysearch_word->get_provider();
		$this->load->view('form_search',$data);
	}

	public function get_word(){
		$word = $this->CI->input->get('term');
		$provider_name = $this->CI->input->get('provider');

		header('Content-Type: application/json');
		$status = 'success';
		$message = [];

		if (trim($word) == '') {
			header("HTTP/1.1 404 Not found");
			$status = 'error';
			$message['term'] = 'Term cannot be empty!';
		}

		$database = new DataBase();
		$github = new GitHubRequest();

		if (trim($provider_name) == '') {
			header("HTTP/1.1 404 Not found");
			$status = 'error';
			$message['term'] = 'Provider cannot be empty!';
		}else{
			$api = $github->get_api($provider_name);
			if(empty($api)) {
				header("HTTP/1.1 404 Not found");
				$status = 'error';
				$message['provider'] = 'Unsupported provider!';
			}	
		}
		
		if($status == 'error') {
			$arr = array(
				'message' => $message
            );
    		echo json_encode($arr);
    		return;
		}

		$query = $database->get_word($word);
		$score;
		if(empty($query['words'])) {

			$total_count = $github->get_total_count($word,$provider_name);
			$positive_count = $github->get_positive_count($word,$provider_name);
			$score = $this->CI->Nysearch_word->get_score($total_count, $positive_count);
			$database->insert_score($word, $score);
			
		} else {
			$score = $query['score'];		
		}

		$arr = array(
            'term' => $word,
            'score' => $score
        );
    	echo json_encode($arr);
	}
	

}
