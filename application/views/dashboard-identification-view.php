<?php
if ($hasil[0]['status']!=1 && $hasil[1]['status']!=1 && $hasil[2]['status']!=1 && $hasil[3]['status']!=1) {
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai input berat serangan gejala yang anda inputkan tidak berpengaruh terserang penyakit!</div>');
    redirect('dashboard');
}
?>

<div id="content-wrapper">
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Hasil Identifikasi</li>
    </ol>

    <!-- Identifikasi penyakit lanas -->
    <?php 
    foreach ($hasil as $item) {
        if ($item['status'] == 1) {             
            $id_identifikasi = $item['id_identifikasi'];
        ?>
            <div class="card mb-3" style="border: 1px solid #218838;">
                <div class="card-header" style="background-color:#218838;">
                    <strong class="text-light">Hasil identifikasi Penyakit <?= $item['penyakit']['nama_penyakit'] ?></strong>
                </div>
                    <div class="card-body">
                        <div class="container text-center">
                            <div class="row">
                                <div style="border-radius:10px;" class="col-sm-6 py-4 px-3 text-left">
                                    <strong>Penyakit :</strong>
                                    <p>
                                        <?= $item['penyakit']['nama_penyakit'] ?>
                                    </p>
                                    <hr>
                                    <strong>Penanganan</strong>
                                    <p>
                                        <?php
                                            $string = $item['penanganan'];
                                            if (strlen($string) > 150) {
                                            $stringCut = substr($string, 0, 150);
                                            $endPoint = strrpos($stringCut, ' ');
                                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                                            $string .= '...';
                                            }    
                                            echo $string;
                                        ?>
                                    <a href="<?= base_url('dashboard?detail=penanganan&identifikasi='. $item['id_identifikasi'].'&penyakit='.$item['penyakit']['nama_penyakit'])?>" class="badge badge-secondary">Selengkapnya</a>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="container text-center">
                                        <div class="container">
                                            <a href="#" style="border-radius:40px;" class="btn btn-outline-success py-3 px-5 mb-4 mt-3">Persentase Berat Penyakit <strong><?= $item['persentase']; ?></strong></a>
                                        </div>
                                    </div>
                                    <div class="py-4 px-3 text-left" style="border-radius:10px;background-color:#EBEEF9;">
                                        <p>
                                            <strong>Hasil CF </strong> <span class="badge badge-success text-light px-3 ml-2"><?= $item['cf_hasil']; ?></span><hr>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
            </div>
     <?php
        }
    }
    ?>
        
    <div class="container text-center">
        <div class="container">
            <a href="<?= base_url();?>dashboard" style="border-radius:40px;" class="btn btn-success py-2 px-5 mb-4"><i class="fas fa-fw fa-backward"></i> <strong>Kembali</strong></a>
            <a href="<?= base_url('dashboard?detail=penanganan&identifikasi='. $id_identifikasi)?>" style="border-radius:40px;" class="btn btn-success py-2 px-5 mb-4"><strong>Penanganan</strong> <i class="fas fa-fw fa-forward"></i></a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
