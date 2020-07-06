<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }

    public function index(){
        //Routing
        if ($this->input->get('edit') == 'info') {
            $this->update();
        }else if($this->input->get('edit') == 'password'){

        }else{
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('account-view', $data);
            $this->load->view('widgets/footer-widget');
        }
    }

    public function update(){
        $data = [
            'nama_user' => $this->input->post('name'),
            'address' => $this->input->post('address'),
        ];

        $this->db->where('email', $this->input->post('email'));
        if ($this->db->update('user', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Informasi akun berhasil diubah!</div>');
            redirect ('account');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal diperbarui!</div>');
            redirect ('account');
        }
    }
}