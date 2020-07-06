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
        if($this->input->get('indication') == 'lanas'){
            $this->lanas();
        }else if($this->input->get('indication') == 'layubakteri'){
            $this->layubakteri();
        }else if($this->input->get('indication') == 'keriting'){
            $this->keriting();
        }else if($this->input->get('indication') == 'mosaik'){
            $this->mosaik();
        }else{
            redirect('nopage');
        }       
    }

    //Lanas Indication rules
    public function lanas(){
        $data['rules'] = $this->db->get('rules_lanas')->result_array();

        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('rules/rule-lanas-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function lanas_update(){
        $data = $this->db->get('rules_lanas')->result_array();
        for ($i=0; $i < count($data); $i++) { 
            $cf_pakar = $this->input->post($i+1);
            if ($cf_pakar == $data[$i]['cf_pakar']){
                //do nothing
            }else{
                $this->db->where('nomor_rule', $i+1);
                $this->db->update('rules_lanas', ['cf_pakar' => $cf_pakar]);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rule penyaki lanas berhasil diperbarui!</div>');
        redirect ('rules?indication=lanas');
    }

    //Layu Bakteri Indication rules
    public function layubakteri(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('rules/rule-layu-view');
        $this->load->view('widgets/footer-widget');
    }
    
    //Keriting Indication rules
    public function keriting(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('rules/rule-keriting-view');
        $this->load->view('widgets/footer-widget');
    }

    //Keriting Indication rules
    public function mosaik(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('rules/rule-mosaik-view');
        $this->load->view('widgets/footer-widget');
    }
}