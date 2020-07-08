<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }

    public function index(){
        if ($this->input->get('action') == 'update') {
            $this->update();
        }else if ($this->input->get('show') == 'history'){
            $this->history();
        }else{
            $data['user'] = $this->db->get_where('user', ['role' => 'user'])->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('pages/user-view', $data);
            $this->load->view('widgets/footer-widget');
        }
    }

    public function update(){
        $data['user'] = $this->db->get_where('user', ['iduser' => $this->input->get('id')])->row_array();
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('pages/user-update-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function update_action(){
        $data = [
            'nama_user' => $this->input->post('nama_user'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
        ];
        $this->db->where('iduser', $this->input->post('iduser'));
        if ($this->db->update('user', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengguna berhasil diperbarui!</div>');
            redirect ('user?action=update&id='.$this->input->post('iduser'));
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengguna gagal diperbarui!</div>');
            redirect ('user?action=update&id='.$this->input->post('iduser'));
        }
    }

    public function history(){
        $this->db->order_by('id_identifikasi', 'desc');
        $identifikasi = $this->db->get_where('identifikasi', ['role_user' => $this->input->get('email')])->result_array();
        foreach ($identifikasi as $item) {
            $identifikasi_detail[] = $this->db->get_where('identifikasi_detail', ['role_identifikasi' => $item['id_identifikasi']])->result_array();

            $data = [
                'identifikasi' => $identifikasi,
                'identifikasi_detail' => $identifikasi_detail
            ];
        }

        // echo json_encode($data);
        // die;

        if ($data) {
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('pages/user-show-history-view', $data);
            $this->load->view('widgets/footer-widget');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengguna belum pernah melakukan identifikasi!</div>');
            redirect ('user');
        }

    }
}