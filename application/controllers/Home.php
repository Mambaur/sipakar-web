<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index(){
        $this->fuzzy();
    }

    public function fuzzy(){
        $data =[
            100,
            100, 
            100,
            100,
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

            for ($j=0; $j < count($rule[$i]); $j++) {
                for ($k=0; $k <3 ; $k++) { 
                    for ($l=0; $l < 3; $l++) { 
                        for ($m=0; $m < 3; $m++) { 
                            
                            if ($rule[$i][$j] == 'KOSONG') {
                                $rule[$i][$j] = 1;
                            }elseif ($rule[$i][$k] == 'KOSONG'){
                                $rule[$i][$k] = 1;
                            }elseif ($rule[$i][$l] == 'KOSONG'){
                                $rule[$i][$l] = 1;
                            }elseif ($rule[$i][$m] == 'KOSONG'){
                                $rule[$i][$m] = 1;
                            }

                            // untuk mencari total rule dengan membuat array di $aturan
                            $aturan[] = 'Data ke '. $n++.  ' = ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<hr>';
                            
                            //Mencari nilai minimal setiap fungsikeanggotaan rule
                            $min = min($rule[$i][$j], $rule[$i][$k], $rule[$i][$l], $rule[$i][$m]);
                            
                            $cf_pakar = $this->db->get_where('rules_lanas', ['nomor_rule' => $n])->row_array();
                            
                            // echo 'Data ke '. $n.  ' = ' . $rule[$i][$j] . ' and '. $rule[$i][$k]. ' and '. $rule[$i][$l]. ' and '. $rule[$i][$m].'<br>';
                            // echo 'Min rule ke '.$n .' = '.$min.'<br>';
                            // echo 'Ini adalah nilai CF Pakar = '. $cf_pakar['cf_pakar'].'<hr><br><br>';

                            $zi[] = $min * $cf_pakar['cf_pakar'];
                            $pakar[]= $cf_pakar['cf_pakar'];

                        }
                    }
                }
            }
        }

        //menampilkan nilai minimal dan total rule
        // echo count($aturan) . '<hr>';
        $zdeff = array_sum($zi);
        $zp = array_sum($pakar);

        $z = $zdeff/$zp;
        echo $zdeff . ' / ' . $zp .' = '.$z.'<br>'; 
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