<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index(){
        echo 'i am home';
    }

    public function fuzzy(){
        $data =[
            21,
            5, 
            6,
            30,
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
                return 'KOSONG';
            }
        }
    }

    public function deffuzifikasi($fk){
        for ($i=0; $i < 4; $i++) { 
            $rule[$i] = [
                $fk[$i]['nogejala'],
                $fk[$i]['ringan'],
                $fk[$i]['berat'],
            ];

            for ($j=0; $j < count($rule[$i]); $j++) {
                for ($k=0; $k <3 ; $k++) { 
                    for ($l=0; $l < 3; $l++) { 
                        for ($m=0; $m < 3; $m++) { 
                            // $aturan[] = 'Data ke = '. $rule[$i]. ' Yaitu ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<hr>';
                            // if ($rule[$i][$j] == 'KOSONG') {
                            //     $rule[$i][$j] = 999;
                            // }elseif ($rule[$i][$k] == 'KOSONG'){
                            //     $rule[$i][$k] = 999;
                            // }elseif ($rule[$i][$l] == 'KOSONG'){
                            //     $rule[$i][$l] = 999;
                            // }elseif ($rule[$i][$m] == 'KOSONG'){
                            //     $rule[$i][$m] = 999;
                            // }
                            
                            // $aturan[] = min($rule[$i][$j], $rule[$i][$k], $rule[$i][$l], $rule[$i][$m]);
                            
                            
                            // echo 'Data ke '. $i.  ' = ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<hr>';

                        }
                    }
                }
            }
        }
        // echo count($aturan) . '<hr>';
        // for ($i=0; $i < count($aturan); $i++) { 
        //     echo $aturan[$i].'<br>';
        // }
        // return $fk[3]['ringan'];
    }

    public function coba(){
        $data = [
            'satu',
            'dua',
            'tiga',
            'empat',
        ];
        

        //Menentukan kombinasi
        for ($i=0; $i < count($data); $i++) { 
            $rule[$i] = [
                'A',
                'B',
                'C',
            ];

            // $rule[$i] = [
            //     'Tidak ada gejala',
            //     'Ringan',
            //     'Berat',
            // ];

            for ($j=0; $j < count($rule[$i]); $j++) {
                for ($k=0; $k <3 ; $k++) { 
                    for ($l=0; $l < 3; $l++) { 
                        for ($m=0; $m < 3; $m++) { 

                            $datainsert = [
                                'nomor_rule' => $n++,
                                'fungsi_keanggotaan_1' => $rule[$i][$j],
                                'fungsi_keanggotaan_2' => $rule[$i][$k],
                                'fungsi_keanggotaan_3' => $rule[$i][$l],
                                'fungsi_keanggotaan_4' => $rule[$i][$m],
                                'cf_pakar' => 0,
                                'role_penyakit' => '1',
                            ];
                            $this->db->insert('rules_lanas', $datainsert);

                            $aturan[] = 'Data ke = '. $data[$i]. ' Yaitu ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<hr>';
                            echo 'Data ke '. $data[$i]. ' = ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<hr>';
                        }
                    }
                }
            }
        }
        echo count($aturan);
        // for ($i=0; $i < count($aturan); $i++) { 
        //     echo $aturan[$i].'<br>';
        // }
        // var_dump($rule);
    }
}