
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Penanganan penyakit</li>
  </ol>

  <!-- DataTables Example -->
  <!-- <form action="<?= base_url(); ?>rules/lanas_update" method="post"> -->
    <?= $this->session->flashdata('message'); ?>

    <?php
    foreach ($penyakit as $item) { ?>
    
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Penanganan Penyakit <?= $item['nama_penyakit']; ?></div>
        <div class="card-body">
            <div class="card text-left thumb-post">
                    <img class="card-img-top" src="<?= base_url('assets/images/').$item['gambar'];?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Keterangan</h4>
                        <p class="card-text"><?= $item['keterangan']; ?></p>
                        <h4 class="card-title">Penanganan</h4>
                        <p class="card-text"><?= $item['penanganan']; ?></p>
                    </div>
            </div>
        </div>
    </div>

    <?php
    }
    ?>
    
    <div class="container text-center my-3">
      <a href="<?= base_url();?>dashboard" class="btn btn-success mb-2 px-5"><i class="fas fa-fw fa-backward"></i> Kembali</a>
    </div>
  <!-- </form> -->
</div>
<!-- /.container-fluid -->
