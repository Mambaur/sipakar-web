

  

<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Rule Layu Bakteri</li>
  </ol>

  <!-- DataTables Example -->
  <form action="<?= base_url(); ?>rules/layu_update" method="post">
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Data Rules Penyakit Layu Bakteri</div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th style="width:5%">Nomor Rules</th>
                <th>Gejala 1</th>
                <th>Gejala 2</th>
                <th>Gejala 3</th>
                <th>Gejala 4</th>
                <th>Gejala 5</th>
                <th>Cf Pakar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Nomor Rules</th>
                <th>Gejala 1</th>
                <th>Gejala 2</th>
                <th>Gejala 3</th>
                <th>Gejala 4</th>
                <th>Gejala 5</th>
                <th>Cf Pakar</th>
                </tr>
            </tfoot>
            <tbody>
            <?php  
                foreach ($rules as $item) {
            ?>
                <tr>
                <td><?= $item['nomor_rule']; ?></td>
                <td><?= $item['fungsi_keanggotaan_1']; ?></td>
                <td><?= $item['fungsi_keanggotaan_2']; ?></td>
                <td><?= $item['fungsi_keanggotaan_3']; ?></td>
                <td><?= $item['fungsi_keanggotaan_4']; ?></td>
                <td><?= $item['fungsi_keanggotaan_5']; ?></td>
                <td><input name="<?= $item['nomor_rule']; ?>" type="number" min="0" step="any" value="<?= $item['cf_pakar']; ?>" required></td>
                </tr>
            <?php 
            } 
            ?>
            <a href="<?= base_url();?>rules?indication=lanas" class="btn btn-outline-secondary ml-1 mb-2">Lanas</a>
            <a href="<?= base_url();?>rules?indication=layubakteri" class="btn btn-success ml-1 mb-2">Layu Bakteri</a>
            <a href="<?= base_url();?>rules?indication=keriting" class="btn btn-outline-secondary ml-1 mb-2">Keriting</a>
            <a href="<?= base_url();?>rules?indication=mosaik" class="btn btn-outline-secondary ml-1 mb-2">Mosaik</a>
          </tbody>
            </table>
        </div>
      </div>
    </div>
    <div class="container text-center my-3">
      <button type="submit" class="btn btn-success mb-2 px-5"><i class="fas fa-fw fa-edit"></i> Perbarui</button>
    </div>
  </form>
</div>
<!-- /.container-fluid -->
