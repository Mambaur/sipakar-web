<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tembakau extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }

    public function index(){
        //Routing
        if ($this->input->get('link') == 'info') {
            $this->info();
        }else if($this->input->get('link') == 'penyakit'){
            $this->penyakit();
        }else if($this->input->get('link') == 'gejala'){
            $this->gejala();
        }
    }

    public function info(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        // $this->load->view('account-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function penyakit(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        // $this->load->view('account-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function gejala(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        // $this->load->view('account-view', $data);
        $this->load->view('widgets/footer-widget');
    }
}