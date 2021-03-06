
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Penyakit tanaman tembakau</li>
  </ol>

    <!-- DataTables Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
        <div class="card-header">
        <i class="fas fa-table"></i>
        Daftar Penyakit Tanaman Tembakau
        </div>
        <div class="card-body">
            <?php
            foreach ($penyakit as $item) {
                $string = $item['penanganan'];
                if (strlen($string) > 150) {
                   $stringCut = substr($string, 0, 150);
                   $endPoint = strrpos($stringCut, ' ');
                   $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                   $string .= '...';
                }
            ?>
                <div class="card-deck mb-2">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div class="w-75">
                                <h4 class="card-title"><?= $item['nama_penyakit']; ?></h4>
                                <p class="card-text"><?= $string; ?></p>
                            </div>
                            <a href="<?= base_url('tembakau?link=penyakit&action=update&idpenyakit=').$item['idpenyakit'];?>" style="border-radius:40px;height:45%;" class="btn btn-primary">Lihat Selengkapnya</a>
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
