
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Informasi Akun</li>
  </ol>

  <!-- DataTables Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-fw fa-user"></i>
                    Informasi Akun Anda
                </div>
                <form action="<?= base_url();?>account?edit=info" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $user['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama" value="<?= $user['nama_user']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Alamat" value="<?= $user['address']; ?>">
                        </div>
                    </div>
                    <div class="container text-right my-1">
                        <button type="submit" class="btn btn-success mb-2 px-5"><i class="fas fa-fw fa-edit"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
       

        <!-- <div class="col-sm-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-fw fa-lock"></i>
                    Password
                </div>
                <form action="<?= base_url();?>account?edit=password" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Password lama</label>
                            <input type="text" name="old-password" class="form-control" placeholder="Password Lama">
                        </div>
                        <div class="form-group">
                            <label for="">Password baru</label>
                            <input type="text" name="new-password" class="form-control" placeholder="Password Baru">
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi password baru</label>
                            <input type="text" name="confirm-password" class="form-control" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <div class="container text-right my-1">
                        <button type="submit" class="btn btn-success mb-2 px-5"><i class="fas fa-fw fa-unlock"></i> Ganti Password</button>
                    </div>
                </form>
            </div>
        </div> -->
        
    </div>
 
</div>
<!-- /.container-fluid -->
