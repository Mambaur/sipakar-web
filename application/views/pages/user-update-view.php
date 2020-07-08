
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">User</li>
    <li class="breadcrumb-item active"><?= $user['nama_user']; ?></li>
  </ol>
  <div class="row">
    <div class="col-sm-6">
      <!-- DataTables Example -->
      <?= $this->session->flashdata('message'); ?>
      <div class="card mb-3">
          <div class="card-header">
          <i class="fas fa-edit"></i>
          Edit user
          </div>
          <?= form_open_multipart('user/update_action'); ?>
              <div class="card-body">
                  <div class="form-group">
                    <label for="nama_user">Nama Pengguna</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Nama user" value="<?= $user['nama_user']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="nama_user">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $user['email']; ?>" required <?php if($user['email']=='admin'){echo 'readonly';} ?>>
                  </div>
                  <div class="form-group">
                    <label for="nama_user">Alamat</label>
                    <input type="text" name="address" class="form-control" placeholder="Nama user" value="<?= $user['address']; ?>" required>
                  </div>
                  <hr>
                  <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">

                  <div class="d-flex justify-content-between">
                      <a href="<?= base_url();?>user" class="btn btn-outline-secondary px-3"><i class="fas fa-fw fa-backward"></i> Kembali</a>
                      <button type="submit" class="btn btn-outline-success px-3 ml-2"><i class="fas fa-fw fa-edit"></i> Perbarui</button>
                  </div>
              </div>
          </form>
      </div>
    </div>
  </div>
    
</div>
<!-- /.container-fluid -->
