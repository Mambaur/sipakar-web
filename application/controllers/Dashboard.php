<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//last fuzzy commit
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth/login');
		}
    }
    
    public function index(){
        if ($this->input->get('start') == 'identification') {
            $data_lanas = [
                $this->input->post('G001')/100,
                $this->input->post('G002')/100,
                $this->input->post('G003')/100,
                $this->input->post('G004')/100,
            ];
            $data_layu = [
                $this->input->post('G005')/100,
                $this->input->post('G006')/100,
                $this->input->post('G007')/100,
                $this->input->post('G008')/100,
                $this->input->post('G009')/100,
            ];
            $data_keriting = [
                $this->input->post('G010')/100,
                $this->input->post('G011')/100,
                $this->input->post('G012')/100,
                $this->input->post('G013')/100,
            ];
            $data_mosaik = [
                $this->input->post('G014')/100,
                $this->input->post('G015')/100,
                $this->input->post('G016')/100,
                $this->input->post('G017')/100,
            ];

            $result['hasil'] = [
                identification($data_lanas,1),
                identification($data_layu,2),
                identification($data_keriting,3),
                identification($data_mosaik,4),
            ];

            if ($result['hasil'][0]['status']!=1 && $result['hasil'][1]['status']!=1 && $result['hasil'][2]['status']!=1 && $result['hasil'][3]['status']!=1) {
                //do nothing
            }else{
                $insertdb = [
                    'id_identifikasi' => get_id(),
                    'tanggal' => date('d-m-Y'),
                    'role_user' => $this->session->userdata('email')
                ];
                $this->db->insert('identifikasi', $insertdb);
            }
            
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-identification-view', $result);
            $this->load->view('widgets/footer-widget');
        }else if($this->input->get('detail') == 'penanganan'){
            $this->penanganan();
        }else{
            $data['gejala'] = $this->db->get('gejala')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-view', $data);
            $this->load->view('widgets/footer-widget');
        }
    }

    public function penanganan(){
        if($this->input->get('identifikasi') && $this->input->get('penyakit')){
            $this->db->join('identifikasi_detail', 'penyakit.idpenyakit = identifikasi_detail.role_penyakit');
            $this->db->join('identifikasi', 'identifikasi.id_identifikasi = identifikasi_detail.role_identifikasi');
            $this->db->join('user', 'identifikasi.role_user = user.email');
            $this->db->where('nama_penyakit', $this->input->get('penyakit'));
            $this->db->where('id_identifikasi', $this->input->get('identifikasi'));
            $this->db->where('email', $this->session->userdata('email'));
            $data['penyakit'] = $this->db->get('penyakit')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-penanganan-view', $data);
            $this->load->view('widgets/footer-widget');
        }else if($this->input->get('identifikasi') && $this->input->get('user')){
            $this->db->join('identifikasi_detail', 'penyakit.idpenyakit = identifikasi_detail.role_penyakit');
            $this->db->join('identifikasi', 'identifikasi.id_identifikasi = identifikasi_detail.role_identifikasi');
            $this->db->join('user', 'identifikasi.role_user = user.email');
            $this->db->where('role_user', $this->input->get('user'));
            $this->db->where('id_identifikasi', $this->input->get('identifikasi'));
            $data['penyakit'] = $this->db->get('penyakit')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-penanganan-view', $data);
            $this->load->view('widgets/footer-widget');

        }else if($this->input->get('identifikasi')){
            $this->db->join('identifikasi_detail', 'penyakit.idpenyakit = identifikasi_detail.role_penyakit');
            $this->db->join('identifikasi', 'identifikasi.id_identifikasi = identifikasi_detail.role_identifikasi');
            $this->db->join('user', 'identifikasi.role_user = user.email');
            $this->db->where('id_identifikasi', $this->input->get('identifikasi'));
            $this->db->where('email', $this->session->userdata('email'));
            $data['penyakit'] = $this->db->get('penyakit')->result_array();
            $this->load->view('widgets/header-widget');
            $this->load->view('widgets/navbar-widget');
            $this->load->view('widgets/sidebar-widget');
            $this->load->view('dashboard-penanganan-view', $data);
            $this->load->view('widgets/footer-widget');
        }else{
            return('dashboard');
        }
    }
}