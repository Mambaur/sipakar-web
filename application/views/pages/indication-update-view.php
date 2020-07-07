
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Detail gejala</li>
  </ol>
  <div class="row">
    <div class="col-sm-6">
      <!-- DataTables Example -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card mb-3">
          <div class="card-header">
          <i class="fas fa-edit"></i>
          Edit gejala
          </div>
          <!-- <form action="<?= base_url();?>tembakau?link=gejala&action=update" method="post"> -->
          <?= form_open_multipart('tembakau?link=gejala&action=update'); ?>
              <div class="card-body">
                  <div class="form-group">
                  <label for="nama_gejala">Nama gejala</label>
                  <input type="text" name="nama_gejala" class="form-control" placeholder="Nama gejala" value="<?= $gejala['nama_gejala']; ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" name="keterangan" rows="5"  required><?= $gejala['keterangan']; ?></textarea>
                  </div>
                  <img style="width:100px;" src="<?= base_url('assets/images/').$gejala['gambar'];?>" alt="Gambar gejala tembakau">
                  <div class="form-group">
                  <label for="image">Gambar</label>
                  <input type="file" class="form-control-file" name="image">
                  <small class="form-text text-muted">Unggah gambar tentang gejala tembakau</small>
                  </div>
                  <hr>
                  <input type="hidden" name="idgejala" value="<?= $gejala['idgejala']; ?>">

                  <div class="d-flex justify-content-between">
                      <a href="<?= base_url();?>tembakau?link=gejala" class="btn btn-outline-secondary px-3"><i class="fas fa-fw fa-backward"></i> Kembali</a>
                      <button type="submit" class="btn btn-outline-success px-3 ml-2"><i class="fas fa-fw fa-edit"></i> Perbarui</button>
                  </div>
              </div>
          </form>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          Gejala <?= $gejala['nama_gejala']; ?>
        </div>
        <div class="card-body thumb-post p-0">
          <img src="<?= base_url('assets/images/').$gejala['gambar'];?>">
          <div class="px-2 pb-4">
            <h4 class="card-title"><?= $gejala['nama_gejala']; ?></h4>
            <p class="card-text"><?= $gejala['keterangan']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    
</div>
<!-- /.container-fluid -->
