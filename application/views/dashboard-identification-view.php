<?php
if ($hasil['status']!=1) {
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai input berat serangan gejala yang anda inputkan tidak berpengaruh terserang penyakit!</div>');
    redirect('dashboard');
}
$persentase = $hasil['hasil_kombinasi'] * 100;
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
    if ($hasil['penyakit'] == 'lanas' && $hasil['status'] == 1) {
    ?>
        <div class="card mb-3" style="border: 1px solid #218838;">
            <div class="card-header" style="background-color:#218838;">
                <strong class="text-light">Hasil identifikasi Penyakit Lanas</strong>
            </div>
            <form action="<?= base_url();?>dashboard?start=identification" method="post">
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div style="border-radius:10px;" class="col-sm-6 py-4 px-3 text-left">
                                <strong>Penyakit :</strong>
                                <p>
                                    Lanas
                                </p>
                                <hr>
                                <strong>Penanganan</strong>
                                <p>
                                    Penanaganan yang dapat dilakukan jika tembakau mengalami penyakit ini adalah dengan memberikan pupuk sesuai dengan takaran, serta hindari kelembaban yang tinggi...
                                <a href="" class="badge badge-secondary">Selengkapnya</a>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="container text-center">
                                    <div class="container">
                                        <a href="#" style="border-radius:40px;" class="btn btn-outline-success py-3 px-5 mb-4 mt-3">Persentase Berat Penyakit <strong><?= (int)$persentase; ?></strong>%</a>
                                    </div>
                                </div>
                                <div class="text-dark py-4 px-3 text-left" style="border-radius:10px;background-color:#EBEEF9;">
                                    <p>
                                        <strong>Total nilai z </strong><?= $hasil['nilai_z']; ?><hr>
                                        <strong>Hasil kombinasi cf </strong> <?= $hasil['hasil_kombinasi']; ?><hr>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="width:10%;">Nomor Rule</th>
                                <th>Gejala 1</th>
                                <th>Gejala 2</th>
                                <th>Gejala 3</th>
                                <th>Gejala 4</th>
                                <th>Min</th>
                                <th class="w-25 text-center">CF Pakar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($hasil['rule'] as $rule) {?>
                                <tr>
                                <td class="text-center"><?= $rule['nomor_rule'] ?></td>
                                <td><?= $rule['fungsi_keanggotaan_gejala_1'] ?></td>
                                <td><?= $rule['fungsi_keanggotaan_gejala_2'] ?></td>
                                <td><?= $rule['fungsi_keanggotaan_gejala_3'] ?></td>
                                <td><?= $rule['fungsi_keanggotaan_gejala_4'] ?></td>
                                <td><?= $rule['nilai_minimal'] ?></td>
                                <td class="text-center"><?= $rule['cf_pakar'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
    <div class="container text-center">
        <div class="container">
            <a href="<?= base_url();?>dashboard" style="border-radius:40px;" class="btn btn-success py-2 px-5 mb-4"><i class="fas fa-fw fa-backward"></i> <strong>Kembali</strong></a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
