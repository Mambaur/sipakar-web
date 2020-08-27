
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Rule Sistem Pakar</li>
  </ol>

  <!-- DataTables Example -->
  <form action="<?= base_url(); ?>rules/rule_update" method="post">
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Data Rules Sistem Pakar Identifikasi Penyakit Tanaman Tembakau</div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th style="width:5%">Kode</th>
                <th>Gejala</th>
                <th>Cf Pakar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Kode</th>
                <th>Gejala</th>
                <th>Cf Pakar</th>
                </tr>
            </tfoot>
            <tbody>
            <?php  
                foreach ($rules as $item) {
            ?>
                <tr>
                <td><?= $item['idgejala']; ?></td>
                <td><?= $item['nama_gejala']; ?></td>
                <td><input name="<?= $item['idgejala']; ?>" type="number" min="0" step="any" value="<?= $item['cf_pakar']; ?>" required></td>
                </tr>
            <?php } ?>
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
