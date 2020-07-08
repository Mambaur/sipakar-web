
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengguna</li>
    <li class="breadcrumb-item active">Riwayat identifikasi</li>
  </ol>

    <!-- DataTables Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Riwayat identifikasi
        </div>
        <div class="card-body">
        <?php 
        foreach ($identifikasi as $item) { ?>
        
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?= date('l', strtotime($item['tanggal'])).', '.$item['tanggal']; ?></h4>
                    <p class="card-text"><?= $item['id_identifikasi']; ?></p>
                </div>
                <ul class="list-group list-group-flush">
                <?php
                foreach ($identifikasi_detail as $detail) { 
                    foreach ($detail as $value) { 
                        if ($item['id_identifikasi'] == $value['role_identifikasi']) {?>
                            <li class="list-group-item">
                                <?= $value['penyakit']; ?>
                                <a href="#" class="badge badge-secondary">nilai z <?= $value['z_deffuzifikasi']; ?></a>
                                <a href="#" class="badge badge-secondary">nilai cf kombinasi <?= $value['nilai_cf']; ?></a>
                                <a href="#" class="badge badge-success">persentase <?= $value['persentase']; ?>%</a>
                            </li>
                            
                <?php   }
                    }
                }
                ?>
                </ul>
            </div>

        <?php
        }
        ?>
        </div>
    </div>
    <div class="container text-center">
        <div class="container">
            <a href="<?= base_url();?>user" style="border-radius:40px;" class="btn btn-success py-2 px-5 mb-4"><i class="fas fa-fw fa-backward"></i> <strong>Kembali</strong></a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
