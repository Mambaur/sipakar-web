
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Detail penyakit</li>
  </ol>

  <div class="row">
      <div class="col-sm-6">
        <!-- DataTables Example -->
        <?= $this->session->flashdata('message'); ?>
        <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-edit"></i>
            Edit penyakit
            </div>
            <!-- <form action="<?= base_url();?>tembakau?link=penyakit&action=update" method="post"> -->
            <?= form_open_multipart('tembakau?link=penyakit&action=update'); ?>
                <div class="card-body">
                    <div class="form-group">
                    <label for="nama_penyakit">Nama penyakit</label>
                    <input type="text" name="nama_penyakit" class="form-control" placeholder="Nama penyakit" value="<?= $penyakit['nama_penyakit']; ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="penanganan">Penanganan</label>
                    <textarea class="form-control" name="penanganan" rows="5"  required><?= $penyakit['penanganan']; ?></textarea>
                    </div>
                    <img style="width:100px;" src="<?= base_url('assets/images/').$penyakit['gambar'];?>" alt="Gambar penyakit tembakau">
                    <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control-file" name="image">
                    <small class="form-text text-muted">Unggah gambar tentang penyakit tembakau</small>
                    </div>
                    <hr>
                    <input type="hidden" name="idpenyakit" value="<?= $penyakit['idpenyakit']; ?>">

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url();?>tembakau?link=penyakit" class="btn btn-outline-secondary px-3"><i class="fas fa-fw fa-backward"></i> Kembali</a>
                        <button type="submit" class="btn btn-outline-success px-3 ml-2"><i class="fas fa-fw fa-edit"></i> Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
 
      </div>

      <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          Penyakit <?= $penyakit['nama_penyakit']; ?>
        </div>
        <div class="card-body thumb-post p-0">
          <img src="<?= base_url('assets/images/').$penyakit['gambar'];?>">
          <div class="px-2 pb-4">
            <h4 class="card-title"><?= $penyakit['nama_penyakit']; ?></h4>
            <p class="card-text"><?= $penyakit['penanganan']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
