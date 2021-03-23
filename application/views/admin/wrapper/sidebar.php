 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="#" class="brand-link">
         <img src="<?= base_url(); ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= base_url(); ?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $user['nama']; ?></a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="<?= base_url('admin'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chalkboard-teacher"></i>
                         <p>
                             Data Nilai
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('admin/nilai'); ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Hasil Ujian</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('admin/input_nilai'); ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Input Nilai</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('admin/master'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-table"></i>
                         <p>Master Data</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                         <i class="nav-icon fas fa-sign-out-alt"></i>
                         <p>Logout</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0"><?= $title; ?></h1>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->