<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identification extends CI_Controller {

    public function index(){
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $data_lanas = [
                $this->input->post('gejala1'),
                $this->input->post('gejala2'),
                $this->input->post('gejala3'),
                $this->input->post('gejala4'),
            ];
            $data_layu = [
                $this->input->post('gejala5'),
                $this->input->post('gejala6'),
                $this->input->post('gejala7'),
                $this->input->post('gejala8'),
                $this->input->post('gejala9'),
            ];
            $data_keriting = [
                $this->input->post('gejala10'),
                $this->input->post('gejala11'),
                $this->input->post('gejala12'),
                $this->input->post('gejala13'),
            ];
            $data_mosaik = [
                $this->input->post('gejala14'),
                $this->input->post('gejala15'),
                $this->input->post('gejala16'),
                $this->input->post('gejala17'),
            ];

            // echo json_encode($data);

            // echo lanas_identification($data);
            $result['hasil'] = [
                json_decode(identification($data_lanas,1), TRUE),
                json_decode(identification($data_layu,2), TRUE),
                json_decode(identification($data_keriting,3), TRUE),
                json_decode(identification($data_mosaik,4), TRUE),
            ];

            if ($result['hasil'][0]['status']!=1 && $result['hasil'][1]['status']!=1 && $result['hasil'][2]['status']!=1 && $result['hasil'][3]['status']!=1) {
                //do nothing
            }else{
                $insertdb = [
                    'id_identifikasi' => get_id(),
                    'tanggal' => date('d-m-Y'),
                    'role_user' => $this->input->post('email')
                ];
                $this->db->insert('identifikasi', $insertdb);
            }

            echo json_encode($result);
        }
    }
}