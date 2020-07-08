
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Pengguna</li>
  </ol>

    <!-- DataTables Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Daftar Pengguna
        </div>
        <div class="card-body">
            <?php
            foreach ($user as $item) { ?>
                <div class="card-deck mb-2">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div class="w-75">
                                <h4 class="card-title"><?= $item['nama_user']; ?></h4>
                            </div>
                            <div class="w-25">
                                <a href="<?= base_url('user?action=update&id=').$item['iduser'];?>" class="badge badge-danger"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('user?show=history&email=').$item['email'];?>" class="badge badge-danger"><i class="fas fa-fw fa-eye"></i> Lihat riwayat identifikasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
 
</div>
<!-- /.container-fluid -->
