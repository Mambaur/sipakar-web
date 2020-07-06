<?php 

function lanas_identification(){
    $instance = get_instance();
    $data =[
        60,
        75, 
        90,
        0,
    ];

    //Fuzzifikasi
    for ($i=0; $i < count($data) ; $i++) { 
        $fk[$i] = [
            'nogejala' => lanas_fungsiKeanggotaan($data[$i],'nogejala'),
            'ringan' => lanas_fungsiKeanggotaan($data[$i],'ringan'),
            'berat' => lanas_fungsiKeanggotaan($data[$i],'berat')
        ];
    }

    //Deffuzifikasi
    echo json_encode(lanas_deffuzifikasi($fk));
}

// Menentukan fungsi keanggotaan
function lanas_fungsiKeanggotaan($input,$tingkat){
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

function lanas_deffuzifikasi($fk){
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
                        
                        $cf_pakar = $instance->db->get_where('rules_lanas', ['nomor_rule' => $n])->row_array();

                        $resultRule[] = [
                            'nomor_rule' => $n,
                            'fungsi_keanggotaan_gejala 1' => $rule[0][$j],
                            'fungsi_keanggotaan_gejala 2' => $rule[1][$k],
                            'fungsi_keanggotaan_gejala 3' => $rule[2][$l],
                            'fungsi_keanggotaan_gejala 4' => $rule[3][$m],
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
    //Menghitung rumus deffuzifikasi
    $zdeff = array_sum($zi);
    $zp = array_sum($pakar);

    
    if ($zp != 0) {
        $z = $zdeff/$zp;
        //Kombinasi dengan certainty factor
        return lanas_certainty($z, $pakar, $resultRule);
    }else{
        return $mesage = [
            'status' => 0,
            'message' => 'Total gejala tembakau yang anda inputkan tidak memicu sebuah penyakit'
        ];
    }
}

function lanas_certainty($z, $pakar, $resultRule){
    for ($i=0; $i < count($pakar); $i++) { 
        $CFhe[] = $z * $pakar[$i];
    }
    
    $CFcombine = 0; 
    for ($i=0; $i < count($CFhe); $i++) {
        $CFcombine = ($CFcombine + $CFhe[$i]) - ($CFcombine * $CFhe[$i]);
    }

    $result =[
        'status' => 1,
        'rule' =>$resultRule,
        'nilai_z' => $z,
        'cf_he' => $CFhe,
        'hasil_kombinasi' => $CFcombine      
    ];
    return $result;
}