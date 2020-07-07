<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){

			$data = [
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			];

			if ($this->db->get_where('user', $data)->row_array()) {
				$response = [
					'value' => 1,
					'message' => 'Login berhasil',
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password')
				];
				echo json_encode($response);
			} else{
				$response = [
					'value' => 0,
					'message' => 'Login gagal'
				];
				echo json_encode($response);
			}
		}
	}

	public function register(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$data = [
				'nama_user' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'address' => $this->input->post('address'),
				'role' => 'user'
			];

			$check = $this->db->get_where('user', ['email' => $this->input->post('email')])->row_array();
			if ($check >= 1) {
				$response = [
						'value' => 2,
						'message' => 'Email Sudah terdaftar',
						'email' => $this->input->post('email')
					];
				echo json_encode($response);
				
			}else{
				if($this->db->insert('user', $data)){
					$response = [
						'value' => 1,
						'message' => 'Register berhasil, Selamat datang!',
						'email' => $this->input->post('email')
					];
					echo json_encode($response);
				}else{
					$response = [
						'value' => 0,
						'message' => 'Gagal didaftarkan',
						'email' => $this->input->post('email')
					];
					echo json_encode($response);
				}
			}
		}
	}

	public function tes(){
		$check = $this->db->get_where('user', ['email' => 'admin'])->row_array();
			if ($check >= 1) {
				echo "hore";
			}else{
				echo 'gagal';
			}
	}
}



 