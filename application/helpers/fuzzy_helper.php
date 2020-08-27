<?php 

function identification($input_user, $kodePenyakit){
    $instance = get_instance();
    $gejala = $instance->db->get_where('gejala', ['role_penyakit' => $kodePenyakit])->result_array();

    for ($i=0; $i < count($input_user) ; $i++) { 
        $cf_kombinasi[] = $input_user[$i] * $gejala[$i]['cf_pakar'];
    }
    $cf_gabungan = 0; 
    for ($i=0; $i < count($cf_kombinasi); $i++) {
        $cf_gabungan = $cf_gabungan + $cf_kombinasi[$i] - ($cf_gabungan * $cf_kombinasi[$i]);
    }

    $penyakit = $instance->db->get_where('penyakit', ['idpenyakit' => $kodePenyakit])->row_array();

    if($cf_gabungan <= 0){
        $status = 0;
    }else{
        $status = 1;
    }

    $data = [
        'status' => $status,
        'id_identifikasi' => get_id(),
        'penyakit' => [
            'idpenyakit' => $penyakit['idpenyakit'],
            'nama_penyakit' => $penyakit['nama_penyakit'],
        ],
        'cf_hasil' => $cf_gabungan,
        'persentase' => sprintf("%.2f%%", $cf_gabungan*100),
        'penanganan' => $penyakit['penanganan']
    ];

    if($status==1){
        insert_data($data);
    }
    return $data;
}

function insert_data($data){
    $instance = get_instance();
    $instance->db->insert('identifikasi_detail', [
        'id_identifikasi_detail' => '',
        'nilai_cf' => $data['cf_hasil'],
        'persentase' => $data['persentase'],
        'role_penyakit' => $data['penyakit']['idpenyakit'],
        'role_identifikasi' => $data['id_identifikasi']
    ]);     
}

function get_id(){
    $instance = get_instance();
    $instance->db->select('RIGHT(identifikasi.id_identifikasi, 4) as kode', FALSE);
    $instance->db->order_by('id_identifikasi','DESC');    
    $instance->db->limit(1);    
    $query = $instance->db->get('identifikasi');     
    if($query->num_rows() <> 0){      
  
     $data = $query->row();      
     $kode = intval($data->kode) + 1;    
    }
    else {      
     //jika kode belum ada      
     $kode = 1;    
    }
    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); 
    $kodejadi = "DT".$kodemax;  
    return $kodejadi;
}