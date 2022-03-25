<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?= base_url('guru'); ?>" class="navbar-brand">
            <img src="<?= base_url(); ?>assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Info Ujian</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url('guru'); ?>" class="nav-link"><i class="fas fa-home"> Home</i></a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/6283840398931" class="nav-link"> <i class="fab fa-whatsapp"> Contact</i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a id="dropdownNilai" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-clipboard-list"> Nilai</i></a>
                    <ul aria-labelledby="dropdownNilai" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url('wali/nilai'); ?>" class="dropdown-item">Nilai Ujian</a></li>
                        <li><a href="<?= base_url('wali/laporan'); ?>" class="dropdown-item">Laporan</a></li>
                        <li><a href="<?= base_url('wali/cetaksemua?email=').$user['email']; ?>" class="dropdown-item">Cetak Semua Laporan</a></li>
                        <!-- <li><a href="#" class="dropdown-item">Some other action</a></li> -->
                    </ul>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-file-alt"> Ujian Susulan</i></a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url('guru/ujian'); ?>" class="dropdown-item">USEK</a></li>
                    </ul>
                </li> -->
                <li class="nav-item dropdown ">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-user-alt"> <?= $user['nama']; ?></i></a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">LOGOUT </a></li>
                        <!-- <li><a href="#" class="dropdown-item">Some other action</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->