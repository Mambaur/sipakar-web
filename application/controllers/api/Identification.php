<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identification extends CI_Controller {

    public function index(){
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
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

            echo json_encode($result);
        }
    }
}