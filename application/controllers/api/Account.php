<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function getId(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$data = [
				'email' => $this->input->post('email')
			];
			
			if($this->db->get_where('user', $data)){
				$data = $this->db->get_where('user', $data)->row_array();
				$response = [
					'value' => 1,
					'message' => 'Register berhasil, Selamat datang!',
					'email' => $data['email'],
					'name' => $data['nama_user'],
					'address' => $data['address'],
					'password' => $data['password']
				];
				echo json_encode($response);
			}else{
				$response = [
					'value' => 0,
					'message' => 'Error saat mengambil data id user',
					'email' => $this->input->post('email')
				];
				echo json_encode($response);
			}
		}
	}

	public function updateData(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$data = [
				'nama_user' => $this->input->post('name'),
				'address' => $this->input->post('address')
			];

			$this->db->where('email', $this->input->post('email'));
			if($this->db->update('user', $data)){
				$response = [
					'value' => 1,
					'message' => 'Update data berhasil!',
					'email' => $this->input->post('email')
				];
				echo json_encode($response);
			}else{
				$response = [
					'value' => 0,
					'message' => 'Update data gagal!',
					'email' => $this->input->post('email')
				];
				echo json_encode($response);
			}
		}
	}

	public function changePassword(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){

			$this->db->where('email', $this->input->post('email'));
			if($this->db->update('user', ['password' => $this->input->post('password')])){
				$response = [
					'value' => 1,
					'message' => 'Change password berhasil!',
				];
				echo json_encode($response);
			}else{
				$response = [
					'value' => 0,
					'message' => 'Change password gagal!',
				];
				echo json_encode($response);
			}
		}
	}
}


 