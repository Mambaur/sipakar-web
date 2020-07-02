<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index(){
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }

        //form validation
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        //Ketika ada eksekusi form
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/auth-login');
		}else{
			//validasinya sukses
			$this->_login();
		}
    }

    public function _login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        // $this->db->insert('user', ['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();


        // var_dump($user);
        if ($user['email']==$email && $user['password'] == $password) {
            $data = [
                'email' => $user['email'],
            ];
            $this->session->set_userdata($data);
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email or password is wrong!</div>');
            redirect('auth/login');
        }
    }

    public function logout(){
        $this->session->unset_userdata('email');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth/login');
    }
}