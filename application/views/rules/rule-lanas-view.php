

  

    <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Rule Lanas</li>
  </ol>

  

  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Data Table Example</div>
    <div class="card-body">
        <form action="<?= base_url(); ?>rules/lanas/update" method="post">
            <button type="submit" class="btn btn-primary my-3 px-4">Perbarui</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Nomor Rules</th>
                    <th>Gejala 1</th>
                    <th>Gejala 2</th>
                    <th>Gejala 3</th>
                    <th>Gejala 4</th>
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
                    <td><input name="<?= $item['nomor_rule']; ?>" type="text" value="<?= $item['cf_pakar']; ?>"></td>
                    </tr>
                <?php } ?>
                
                </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>

</div>
<!-- /.container-fluid -->
