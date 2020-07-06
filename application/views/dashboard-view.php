

  

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><?= count($this->db->get('gejala')->result_array()); ?> Total Gejala!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url();?>tembakau?link=gejala">
                <span class="float-left">Lihat Detail</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?= count($this->db->get('penyakit')->result_array()); ?> Jumlah Penyakit!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url();?>tembakau?link=penyakit">
                <span class="float-left">Lihat Detail</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?= count($this->db->get_where('user', ['role' => 'user'])->result_array()); ?> User aktif!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Lihat Detail</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?= count($this->db->get('rules_lanas')->result_array()); ?> Total Rule!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url();?>rules?indication=lanas">
                <span class="float-left">Lihat Detail</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        

        <!-- DataTables Example -->
        <?= $this->session->flashdata('message'); ?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Ayo mulai identifikasi penyakit tembakau sekarang!
          </div>
          <form action="<?= base_url();?>dashboard?start=identification" method="post">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width:5%;"></th>
                      <th>Nama gejala</th>
                      <th class="w-25 text-center">Berat serangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($gejala as $item) {?>
                      <tr>
                        <td class="text-center"><input name='check' type="checkbox"></td>
                        <td><?= $item['nama_gejala']; ?></td>
                        <td class="text-center"><input class="w-75" type="number" name="<?= $item['idgejala']; ?>" min="0" max="100" value="0"> %</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="container text-center">
                  <button type="submit" style="border-radius:40px;" class="btn btn-success py-3 px-5"><i class="fas fa-fw fa-hourglass-start"></i> Mulai Identifikasi</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.container-fluid -->
