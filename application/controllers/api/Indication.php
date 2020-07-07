<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indication extends CI_Controller {

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'GET'){

			if ($this->db->get('gejala')->result_array()) {
				$response = $this->db->get('gejala')->result_array();
				echo json_encode($response);
			}
		}
	}

	public function getById(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){

			if ($this->db->get_where('gejala', ['idgejala' => $this->input->post('idgejala')])->row_array()) {
				$response = $this->db->get_where('gejala', ['idgejala' => $this->input->post('idgejala')])->row_array();
				echo json_encode($response);
			}else{

			}
		}
	}
}


 