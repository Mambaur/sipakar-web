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
        }else if ($this->input->get('link') == 'penyakit' && $this->input->get('action') == 'update') {
            $this->update_penyakit();
        }else if($this->input->get('link') == 'penyakit'){
            $this->penyakit();
        }else if ($this->input->get('link') == 'gejala' && $this->input->get('action') == 'update') {
            $this->update_gejala();
        }else if($this->input->get('link') == 'gejala'){
            $this->gejala();
        }
    }

    public function info(){
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('pages/info-view');
        $this->load->view('widgets/footer-widget');
    }

    public function penyakit(){
        $data['penyakit'] = $this->db->get('penyakit')->result_array();
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('pages/disease-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function update_penyakit(){
        if ($this->input->post('idpenyakit')) {
            $idpenyakit = $this->input->post('idpenyakit');
            $data['penyakit'] = $this->db->get_where('penyakit', ['idpenyakit' => $idpenyakit])->row_array();

            //Upload gambar
			$upload_image = $_FILES['image']['name'];
			//cek jika ada gambar yang akan diupload
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048'; // max ukuran 2MB
				$config['upload_path'] = './assets/images/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					// Menghapus gambar lama agar tidak memenuhi memori
					$old_image = $data['penyakit']['gambar'];
					if ($old_image != 'a.png') {
						unlink(FCPATH . 'assets/images/' . $old_image);
					}

                    $new_image = $this->upload->data('file_name');
					$this->db->set('gambar',$new_image);
				}else{
					echo $this->upload->display_errors();
				}
			}
            
            $this->db->set('nama_penyakit', $this->input->post('nama_penyakit'));
            $this->db->set('penanganan', $this->input->post('penanganan'));
            $this->db->where('idpenyakit', $idpenyakit);
            if ($this->db->update('penyakit')) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penyakit berhasil diperbarui!</div>');
                redirect ('tembakau?link=penyakit&action=update&idpenyakit='.$idpenyakit);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Penyakit gagal diperbarui!</div>');
                redirect ('tembakau?link=penyakit&action=update&idpenyakit='.$idpenyakit);
            }
        }else{
            if ($this->input->get('idpenyakit')) {
                $data['penyakit'] = $this->db->get_where('penyakit', ['idpenyakit' => $this->input->get('idpenyakit')])->row_array();
                $this->load->view('widgets/header-widget');
                $this->load->view('widgets/navbar-widget');
                $this->load->view('widgets/sidebar-widget');
                $this->load->view('pages/disease-update-view', $data);
                $this->load->view('widgets/footer-widget');
            }else{
                redirect ('tembakau?link=penyakit');
            }
        }
    }

    public function gejala(){
        $data['gejala'] = $this->db->get('gejala')->result_array();
        $this->load->view('widgets/header-widget');
        $this->load->view('widgets/navbar-widget');
        $this->load->view('widgets/sidebar-widget');
        $this->load->view('pages/indication-view', $data);
        $this->load->view('widgets/footer-widget');
    }

    public function update_gejala(){
        if ($this->input->post('idgejala')) {
            $idgejala = $this->input->post('idgejala');
            $data['gejala'] = $this->db->get_where('gejala', ['idgejala' => $idgejala])->row_array();

            //Upload gambar
			$upload_image = $_FILES['image']['name'];
			//cek jika ada gambar yang akan diupload
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048'; // max ukuran 2MB
				$config['upload_path'] = './assets/images/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					// Menghapus gambar lama agar tidak memenuhi memori
					$old_image = $data['gejala']['gambar'];
					if ($old_image != 'a.png') {
						unlink(FCPATH . 'assets/images/' . $old_image);
					}

                    $new_image = $this->upload->data('file_name');
					$this->db->set('gambar',$new_image);
				}else{
					echo $this->upload->display_errors();
				}
			}
            
            $this->db->set('nama_gejala', $this->input->post('nama_gejala'));
            $this->db->set('keterangan', $this->input->post('keterangan'));
            $this->db->where('idgejala', $idgejala);
            if ($this->db->update('gejala')) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gejala berhasil diperbarui!</div>');
                redirect ('tembakau?link=gejala&action=update&idgejala='.$idgejala);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gejala gagal diperbarui!</div>');
                redirect ('tembakau?link=gejala&action=update&idgejala='.$idgejala);
            }
        }else{
            if ($this->input->get('idgejala')) {
                $data['gejala'] = $this->db->get_where('gejala', ['idgejala' => $this->input->get('idgejala')])->row_array();
                $this->load->view('widgets/header-widget');
                $this->load->view('widgets/navbar-widget');
                $this->load->view('widgets/sidebar-widget');
                $this->load->view('pages/indication-update-view', $data);
                $this->load->view('widgets/footer-widget');
            }else{
                redirect ('tembakau?link=gejala');
            }
        }
    }
}