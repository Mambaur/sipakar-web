<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url();?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Rules</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="<?= base_url();?>rules?indication=lanas">Lanas</a>
          <a class="dropdown-item" href="<?= base_url();?>rules?indication=layubakteri">Layu Bakteri</a>
          <a class="dropdown-item" href="<?= base_url();?>rules?indication=keriting">Keriting</a>
          <a class="dropdown-item" href="<?= base_url();?>rules?indication=mosaik">Mosaik</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>tembakau?link=gejala">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Gejala</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>tembakau?link=penyakit">
          <i class="fas fa-fw fa-table"></i>
          <span>Penyakit</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>tembakau?link=info">
          <i class="fas fa-fw fa-info"></i>
          <span>Tentang tembakau</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>user">
          <i class="fas fa-fw fa-user"></i>
          <span>Pengguna</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>account">
          <i class="fas fa-fw fa-cog"></i>
          <span>Akun</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>