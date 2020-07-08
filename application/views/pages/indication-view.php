
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Gejala</li>
  </ol>

    <!-- DataTables Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
        <div class="card-header">
        <i class="fas fa-table"></i>
        Gejala Penyakit Tanaman Tembakau
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-around">
            <?php
            foreach ($gejala as $item) {
                $string = $item['keterangan'];
                if (strlen($string) > 100) {
                   $stringCut = substr($string, 0, 100);
                   $endPoint = strrpos($stringCut, ' ');
                   $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                   $string .= '...';
                }    
            ?>
                <div class="col-sm-4 thumb-post p-1">

                    <img class="card-img-top" src="<?= base_url('assets/images/').$item['gambar'];?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?= $item['nama_gejala']; ?></h4>
                        <p class="card-text">
                        <?= $string; ?>
                            <br>
                            <a href="<?= base_url('tembakau?link=gejala&action=update&idgejala=').$item['idgejala'];?>" class="badge badge-secondary">Lihat selengkapnya</a>
                        </p>
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
