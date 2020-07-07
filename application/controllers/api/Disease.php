<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disease extends CI_Controller {

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'GET'){

			if ($this->db->get('penyakit')->result_array()) {
				$response = $this->db->get('penyakit')->result_array();
				echo json_encode($response);
			}
		}
	}

	public function getById(){
		if  ($this->input->server('REQUEST_METHOD') == 'POST'){
			if ($this->db->get_where('penyakit',['idpenyakit' => $this->input->post('idpenyakit')])->row_array()) {
				$response = $this->db->get_where('penyakit',['idpenyakit' => $this->input->post('idpenyakit')])->row_array();
				echo json_encode($response);
			}
		}
	}
}


 