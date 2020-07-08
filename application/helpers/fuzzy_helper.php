<?php 

function identification($data, $penyakit){

    //Fuzzifikasi
    for ($i=0; $i < count($data) ; $i++) { 
        $fk[$i] = [
            'nogejala' => fungsiKeanggotaan($data[$i],'nogejala'),
            'ringan' => fungsiKeanggotaan($data[$i],'ringan'),
            'berat' => fungsiKeanggotaan($data[$i],'berat')
        ];
    }

    //Deffuzifikasi
    return json_encode(deffuzifikasi($fk, $penyakit));
}

// Menentukan fungsi keanggotaan
function fungsiKeanggotaan($input,$tingkat){
    if ($tingkat == 'nogejala') {
        if ($input <= 5) {
            return 1;
        }elseif(5 < $input && $input <= 6){
            return (6-$input)/(6-5);
        }else{
            //tidak ada gejala
            return 'KOSONG';
        }
    }elseif ($tingkat == 'ringan'){
        if($input <= 5){
            return 0;
        }elseif(5 < $input && $input < 6){
            return ($input-5)/(6-5);
        }elseif(6 <= $input && $input<=25){
            return 1;
        }elseif(25 < $input && $input<=70){
            return (70-$input)/(70-25);
        }else{
            //tidak ada gejala
            return 'KOSONG';
        }
    }elseif($tingkat == 'berat'){
        if($input == 25){
            return 0;
        }elseif(25< $input && $input<70){
            return ($input-25)/(70-25);
        }elseif(70<=$input){
            return 1;
        }else{
            //tidak ada gejala
            return 'KOSONG';
        }
    }
}

function deffuzifikasi($fk, $penyakit){


    // for ($j=0; $j < 3; $j++) {
    //     for ($k=0; $k <3 ; $k++) { 
    //         for ($l=0; $l < 3; $l++) { 
    //             for ($m=0; $m < 3; $m++) { 
    //                 $n++;
                    
    //                 if (!(($rule[0][$j] == 'KOSONG') || ($rule[1][$k] == 'KOSONG') || ($rule[2][$l] == 'KOSONG') || ($rule[3][$m] == 'KOSONG'))) {
                    
    //                     //Mencari nilai minimal setiap fungsikeanggotaan rule
    //                     $min = min($rule[0][$j], $rule[1][$k], $rule[2][$l], $rule[3][$m]);
                        
    //                     $cf_pakar = $instance->db->get_where('rules_lanas', ['nomor_rule' => $n])->row_array();

    //                     $resultRule[] = [
    //                         'nomor_rule' => $n,
    //                         'fungsi_keanggotaan_gejala_1' => $rule[0][$j],
    //                         'fungsi_keanggotaan_gejala_2' => $rule[1][$k],
    //                         'fungsi_keanggotaan_gejala_3' => $rule[2][$l],
    //                         'fungsi_keanggotaan_gejala_4' => $rule[3][$m],
    //                         'nilai_minimal' => $min,
    //                         'cf_pakar' => (double)$cf_pakar['cf_pakar']
    //                     ];
                        
    //                     $zi[] = $min * $cf_pakar['cf_pakar'];
    //                     $pakar[]= $cf_pakar['cf_pakar'];
    //                 }

    //             }
    //         }
    //     }
    // }
    if ($penyakit != 'layu') {
        $combination= combination_four_rules($fk, $penyakit);
    }else{
        $combination= combination_five_rules($fk, $penyakit);
    }
    // echo json_encode($combination);
    // die; 
    //Menghitung rumus deffuzifikasi
    // $zdeff = array_sum($zi);
    // $zp = array_sum($pakar);
    
    $zdeff = array_sum($combination['zi']);
    $zp = array_sum($combination['pakar']);

    
    if ($zp != 0) {
        $z = $zdeff/$zp;
        //Kombinasi dengan certainty factor
        return certainty($z, $combination['pakar'], $combination['result'], $combination['penyakit']);
    }else{
        return $mesage = [
            'status' => 0,
            'message' => 'Total gejala tembakau yang anda inputkan tidak memicu sebuah penyakit'
        ];
    }
}

function certainty($z, $pakar, $resultRule, $penyakit){
    for ($i=0; $i < count($pakar); $i++) { 
        $CFhe[] = $z * $pakar[$i];
    }
    
    $CFcombine = 0; 
    for ($i=0; $i < count($CFhe); $i++) {
        $CFcombine = ($CFcombine + $CFhe[$i]) - ($CFcombine * $CFhe[$i]);
    }

    if ($penyakit == 'rules_lanas') {
        $penyakit = 'lanas';
    }else if($penyakit == 'rules_layu'){
        $penyakit = 'layu';
    }else if($penyakit == 'rules_keriting'){
        $penyakit = 'keriting';
    }else if($penyakit == 'rules_mosaik'){
        $penyakit = 'mosaik';
    }

    $result =[
        'status' => 1,
        'penyakit' => $penyakit,
        'rule' =>$resultRule,
        'nilai_z' => $z,
        'cf_he' => $CFhe,
        'hasil_kombinasi' => $CFcombine      
    ];
    return $result;
}

function combination_four_rules($fk, $penyakit){
    $instance = get_instance();
    $n = 0;
    for ($i=0; $i < 4; $i++) { 
        $rule[$i] = [
            $fk[$i]['nogejala'],
            $fk[$i]['ringan'],
            $fk[$i]['berat'],
        ];
    }

    for ($j=0; $j < 3; $j++) {
        for ($k=0; $k <3 ; $k++) { 
            for ($l=0; $l < 3; $l++) { 
                for ($m=0; $m < 3; $m++) { 
                    $n++;
                    
                    if (!(($rule[0][$j] == 'KOSONG') || ($rule[1][$k] == 'KOSONG') || ($rule[2][$l] == 'KOSONG') || ($rule[3][$m] == 'KOSONG'))) {
                    
                        //Mencari nilai minimal setiap fungsikeanggotaan rule
                        $min = min($rule[0][$j], $rule[1][$k], $rule[2][$l], $rule[3][$m]);
                        
                        $cf_pakar = $instance->db->get_where($penyakit, ['nomor_rule' => $n])->row_array();

                        $resultRule[] = [
                            'nomor_rule' => $n,
                            'fungsi_keanggotaan_gejala_1' => $rule[0][$j],
                            'fungsi_keanggotaan_gejala_2' => $rule[1][$k],
                            'fungsi_keanggotaan_gejala_3' => $rule[2][$l],
                            'fungsi_keanggotaan_gejala_4' => $rule[3][$m],
                            'nilai_minimal' => $min,
                            'cf_pakar' => (double)$cf_pakar['cf_pakar']
                        ];
                        
                        $zi[] = $min * $cf_pakar['cf_pakar'];
                        $pakar[]= $cf_pakar['cf_pakar'];
                    }

                }
            }
        }
    }
    $data = [
        'result' => $resultRule,
        'zi' => $zi,
        'pakar' => $pakar,
        'penyakit' => $penyakit
    ];
    return $data;
}

function combination_five_rules($fk, $penyakit){
    $instance = get_instance();
    $no_rule = 0;
    for ($i=0; $i < 5; $i++) { 
        $rule[$i] = [
            $fk[$i]['nogejala'],
            $fk[$i]['ringan'],
            $fk[$i]['berat'],
        ];
    }

    for ($j=0; $j < 3; $j++) {
        for ($k=0; $k <3 ; $k++) { 
            for ($l=0; $l < 3; $l++) { 
                for ($m=0; $m < 3; $m++) { 
                    for ($n=0; $n < 3; $n++) { 
                        $no_rule++;
                    
                        if (!(($rule[0][$j] == 'KOSONG') || ($rule[1][$k] == 'KOSONG') || ($rule[2][$l] == 'KOSONG') || ($rule[3][$m] == 'KOSONG') || ($rule[4][$n] == 'KOSONG'))) {
                        
                            //Mencari nilai minimal setiap fungsikeanggotaan rule
                            $min = min($rule[0][$j], $rule[1][$k], $rule[2][$l], $rule[3][$m], $rule[4][$n]);
                            
                            $cf_pakar = $instance->db->get_where($penyakit, ['nomor_rule' => $no_rule])->row_array();

                            $resultRule[] = [
                                'nomor_rule' => $no_rule,
                                'fungsi_keanggotaan_gejala_1' => $rule[0][$j],
                                'fungsi_keanggotaan_gejala_2' => $rule[1][$k],
                                'fungsi_keanggotaan_gejala_3' => $rule[2][$l],
                                'fungsi_keanggotaan_gejala_4' => $rule[3][$m],
                                'fungsi_keanggotaan_gejala_5' => $rule[4][$n],
                                'nilai_minimal' => $min,
                                'cf_pakar' => (double)$cf_pakar['cf_pakar']
                            ];
                            
                            $zi[] = $min * $cf_pakar['cf_pakar'];
                            $pakar[]= $cf_pakar['cf_pakar'];
                        }
                    }
                }
            }
        }
    }
    $data = [
        'result' => $resultRule,
        'zi' => $zi,
        'pakar' => $pakar,
        'penyakit' => $penyakit
    ];
    return $data;
}