<!DOCTYPE html>

<html lang="en">

<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Dinas Tenaga Kerja Kota Semarang</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="One page parallax responsive HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Bingo HTML Template v1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/') ?>images/logoo.png" />

  <!-- CSS
  ================================================== -->
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/bootstrap/bootstrap.min.css">
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/lightbox2/css/lightbox.min.css">
  <!-- animation css -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">

</head>

<body id="body">

  <!--
  Start Preloader
  ==================================== -->
  <div id="preloader">
    <div class='preloader'>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!--
  End Preloader
  ==================================== -->

  <!--
Fixed Navigation
==================================== -->
  <header class="navigation fixed-top">
    <div class="container">
      <!-- main nav -->
      <nav class="navbar navbar-expand-lg navbar-light px-0">
        <!-- logo -->
        <a class="navbar-brand logo" href="index.html">
          <img loading="lazy" class="logo-default" src="<?= base_url('assets/') ?>images/logoo.png" alt="logo" style="width: 40px; height: auto;" />
          <img loading="lazy" class="logo-white" src="<?= base_url('assets/') ?>images/disnaker.png" alt="logo" style="width: 120px; height: auto;" />
        </a>
        <!-- /logo -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item dropdown <?php echo ($this->uri->segment(1) == '') ? 'active' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="<?php echo base_url(); ?>">
                Home
              </a>
            </li>
            <ul class="navbar-nav ml-auto d-flex align-items-center">
              <!-- Nav Item - Agenda -->
              <li class="nav-item <?php echo ($this->uri->segment(1) == 'agenda') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('agenda'); ?>">Agenda</a>
              </li>

              <!-- Nav Item - Arsip -->
              <li class="nav-item <?php echo ($this->uri->segment(1) == 'arsip') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('arsip'); ?>">Arsip</a>
              </li>

              <!-- Nav Item - Kontak -->
              <li class="nav-item <?php echo ($this->uri->segment(1) == 'kontak') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('kontak'); ?>">Kontak</a>
              </li>

              <!-- Nav Item - Login/Profile -->
              <li class="nav-item">
                <?php if ($this->session->userdata('logged_in')): ?>
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?= $this->session->userdata('user_name'); ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?= base_url('profile/profile'); ?>">Profile</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                  </div>
                <?php else: ?>
                  <!-- Tampilkan Login jika belum login -->
                  <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('auth/login'); ?>'">
                    Login
                  </button>
                <?php endif; ?>
              </li>
            </ul>
          </ul>
        </div>
      </nav>
      <!-- /main nav -->
    </div>
  </header>
  <!--
End Fixed Navigation
==================================== -->

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- Header Modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Body Modal -->
        <div class="modal-body">
          Apakah Anda yakin ingin logout?
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>