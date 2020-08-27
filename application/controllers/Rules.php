<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }
    
    public function index(){
        //Routing
        if($this->input->get('indication') == 'rule'){
            $data['rules'] = $this->db->get('gejala')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('rules/rule-view', $data);
            $this->load->view('widgets/footer-widget');
        }else{
            redirect('nopage');
        }       
    }

    public function rule_update(){
        $data = $this->db->get('gejala')->result_array();
        for ($i=0; $i < count($data); $i++) { 
            $cf_pakar = $this->input->post($data[$i]['idgejala']);
            if ($cf_pakar == $data[$i]['cf_pakar']){
                //do nothing
            }else{
                $this->db->where('idgejala', $data[$i]['idgejala']);
                $this->db->update('gejala', ['cf_pakar' => $cf_pakar]);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rule penyakit mosaik bakteri berhasil diperbarui!</div>');
        redirect ('rules?indication=rule');
    }
}