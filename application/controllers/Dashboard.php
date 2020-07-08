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
            $data_lanas = [
                $this->input->post('G001'),
                $this->input->post('G002'),
                $this->input->post('G003'),
                $this->input->post('G004'),
            ];
            $data_layu = [
                $this->input->post('G005'),
                $this->input->post('G006'),
                $this->input->post('G007'),
                $this->input->post('G008'),
                $this->input->post('G009'),
            ];
            $data_keriting = [
                $this->input->post('G010'),
                $this->input->post('G011'),
                $this->input->post('G012'),
                $this->input->post('G013'),
                $this->input->post('G014'),
            ];
            $data_mosaik = [
                $this->input->post('G015'),
                $this->input->post('G016'),
                $this->input->post('G017'),
                $this->input->post('G018'),
                $this->input->post('G019'),
            ];
            // echo lanas_identification($data);
            $result['hasil'] = [
                json_decode(identification($data_lanas,'rules_lanas'), TRUE),
                json_decode(identification($data_layu,'rules_layu'), TRUE),
                json_decode(identification($data_keriting,'rules_keriting'), TRUE),
                json_decode(identification($data_mosaik,'rules_mosaik'), TRUE),
            ];
            // echo json_encode($result);
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