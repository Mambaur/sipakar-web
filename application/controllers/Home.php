<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index(){
        lanas_identification();
        // $this->fuzzy();
    }

    public function fuzzy(){
        $data =[
            5.5,
            100, 
            60,
            80,
        ];

        //Fuzzifikasi
        for ($i=0; $i < count($data) ; $i++) { 
            $fk[$i] = [
                'nogejala' => $this->fungsiKeanggotaan($data[$i],'nogejala'),
                'ringan' => $this->fungsiKeanggotaan($data[$i],'ringan'),
                'berat' => $this->fungsiKeanggotaan($data[$i],'berat')
            ];
            // echo '<hr>'.'Fungsi keanggotaan gejala ke '. $i .', dengan input = '.$data[$i].'<hr>';
            // echo 'Tanpa gejala = ' . $fk[$i]['nogejala'].'<br>';
            // echo 'Ringan = ' . $fk[$i]['ringan'] . '<br>';
            // echo 'Berat = ' . $fk[$i]['berat'] . '<br><br>';
        }

        //Deffuzifikasi
        $this->deffuzifikasi($fk);
    }

    // Menentukan fungsi keanggotaan
    public function fungsiKeanggotaan($input,$tingkat){
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
            if($input == 5){
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

    public function deffuzifikasi($fk){
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

                            if ($rule[0][$j] == 'KOSONG') {
                                $rule[0][$j] = 1;
                            }elseif ($rule[1][$k] == 'KOSONG'){
                                $rule[1][$k] = 1;
                            }elseif ($rule[2][$l] == 'KOSONG'){
                                $rule[2][$l] = 1;
                            }elseif ($rule[3][$m] == 'KOSONG'){
                                $rule[3][$m] = 1;
                            }

                            $teswoy = [
                                'rule[0]['.$j.']',
                                'rule[1]['.$k.']',
                                'rule[2]['.$l.']',
                                'rule[3]['.$m.']',
                            ];
                        
                            //Mencari nilai minimal setiap fungsikeanggotaan rule
                            $min = min($rule[0][$j], $rule[1][$k], $rule[2][$l], $rule[3][$m]);
                            
                            $cf_pakar = $this->db->get_where('rules_lanas', ['nomor_rule' => $n])->row_array();
                            
                            echo 'Data ke '. $n.  ' = '.$teswoy[0].' = '. $rule[0][$j] . ' and '. $teswoy[1].' = '.$rule[1][$k]. ' and '. $teswoy[2].' = '.$rule[2][$l]. ' and '. $teswoy[3].' = '.$rule[3][$m].'<hr>';
                            echo 'Min rule ke '.$n .' = '.$min.'<br>';
                            echo 'Ini adalah nilai CF Pakar = '. $cf_pakar['cf_pakar'].'<hr><br><br>';


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

        $z = $zdeff/$zp;
        echo $zdeff . ' / ' . $zp .' = '.$z.'<br>'; 

        //Kombinasi dengan certainty factor
        $this->certainty($z, $pakar);
    }

    public function certainty($z, $pakar){
        for ($i=0; $i < count($pakar); $i++) { 
            echo $z .' * '. $pakar[$i] .' = ';
            $CFhe[] = $z * $pakar[$i];
            echo $CFhe[$i].'<br>';
        }
        
        $CFcombine = 0; 
        for ($i=0; $i < count($CFhe); $i++) {
            echo 'nilai cf combine = '.$CFcombine.' + '.$CFhe[$i]. ' - ('.$CFcombine.' * '.$CFhe[$i].') = ';
            $CFcombine = ($CFcombine + $CFhe[$i]) - ($CFcombine * $CFhe[$i]);
            // $CFcombine = $CFcombine + 1;
            echo $CFcombine.'<br>';
        }

        // echo 'CF combine = '.$CFcombine;
    }





    //Rumus kombinasi untuk penyakit dengan 4 gejala
    public function coba(){
        $no_rule = 0;
        $data = [
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima'
        ];
        

        //Menentukan kombinasi
        for ($i=0; $i < count($data); $i++) { 
            // $rule[$i] = [
            //     'A',
            //     'B',
            //     'C',
            // ];
            $rule[$i] = [
                'Tidak ada gejala',
                'Ringan',
                'Berat',
            ];
        }

        // for ($j=0; $j < count($rule[$j]); $j++) {
        //     for ($k=0; $k <count($rule[$k]) ; $k++) { 
        //         for ($l=0; $l < count($rule[$l]); $l++) { 
        //             for ($m=0; $m < count($rule[$m]); $m++) { 
        //                 $n++;
        //                 $datainsert = [
        //                     'nomor_rule' => $n,
        //                     'fungsi_keanggotaan_1' => $rule[0][$j],
        //                     'fungsi_keanggotaan_2' => $rule[1][$k],
        //                     'fungsi_keanggotaan_3' => $rule[2][$l],
        //                     'fungsi_keanggotaan_4' => $rule[3][$m],
        //                     'cf_pakar' => 0,
        //                     'role_penyakit' => '4',
        //                 ];
        //                 $this->db->insert('rules_mosaik', $datainsert);

        //                 echo 'Data ke '. $n.  ' = '. $rule[0][$j] . ' and '.$rule[1][$k]. ' and '.$rule[2][$l]. ' and '. $rule[3][$m].'<hr>';
        //             }
        //         }
        //     }
        // }

        for ($j=0; $j < count($rule[$j]); $j++) {
            for ($k=0; $k <count($rule[$k]) ; $k++) { 
                for ($l=0; $l < count($rule[$l]); $l++) { 
                    for ($m=0; $m < count($rule[$m]); $m++) { 
                        for ($n=0; $n < count($rule[$n]); $n++) { 
                            $no_rule++;
                            $datainsert = [
                                'nomor_rule' => $no_rule,
                                'fungsi_keanggotaan_1' => $rule[0][$j],
                                'fungsi_keanggotaan_2' => $rule[1][$k],
                                'fungsi_keanggotaan_3' => $rule[2][$l],
                                'fungsi_keanggotaan_4' => $rule[3][$m],
                                'fungsi_keanggotaan_5' => $rule[4][$n],
                                'cf_pakar' => 0,
                                'role_penyakit' => '2',
                            ];
                            $this->db->insert('rules_layu', $datainsert);

                            echo 'Data ke '. $no_rule.  ' = '. $rule[0][$j] . ' and '.$rule[1][$k]. ' and '.$rule[2][$l]. ' and '. $rule[3][$m].' and '.$rule[4][$n].'<hr>';
                        }
                    }
                }
            }
        }
    }
}