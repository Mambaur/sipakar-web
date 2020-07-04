<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lanas extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }
    
    public function index(){
        $data['rules'] = $this->db->get('rules_lanas')->result_array();

        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('rules/rule-lanas-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function update(){
        $data = $this->db->get('rules_lanas')->result_array();
        // echo $data[0]['id_rules_detail_lanas'];
        for ($i=0; $i < count($data); $i++) { 
            // $data[] = [$i => $this->input->post($i)];
            $this->db->where('id_rules_detail_lanas', $data[$i]['id_rules_detail_lanas']);
            $this->db->update('rules_lanas', ['cf_pakar' =>$this->input->post($i+1)]);
        }
        redirect ('rules/lanas');
    //    var_dump($data);
    }
}