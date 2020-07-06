<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }
    
    public function index(){
        if ($this->input->get('start') == 'identification') {
            $idgejala = $this->db->get('gejala')->result_array();
            $data = [
                $this->input->post('G001'),
                $this->input->post('G002'),
                $this->input->post('G003'),
                $this->input->post('G004'),
            ];
            // echo lanas_identification($data);
            $result['hasil'] = json_decode(lanas_identification($data), TRUE);

            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-identification-view', $result);
            $this->load->view('widgets/footer-widget');
        }else{
            $data['gejala'] = $this->db->get('gejala')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-view', $data);
            $this->load->view('widgets/footer-widget');
        }
    }
}