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
        <img loading="lazy" class="logo-default" src="<?= base_url('assets/') ?>images/logoo.png" alt="logo" style="width: 40px; height: auto;"/>
        <img loading="lazy" class="logo-white" src="<?= base_url('assets/') ?>images/disnaker.png" alt="logo" style="width: 120px; height: auto;"/>
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
              <ul class="navbar-nav ml-auto d-flex align-items-center">
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
              
              <!-- Nav Item - Tiga Titik (Dropdown) -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v text-black"></i> <!-- Tiga titik (Ellipsis) dengan warna yang jelas -->
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item <?php echo ($this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'login') ? 'active' : ''; ?>" href="<?php echo base_url('auth/login'); ?>">Login</a>
                      <a class="dropdown-item <?php echo ($this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'register') ? 'active' : ''; ?>" href="<?php echo base_url('auth/register'); ?>">Register</a>
                  </div>
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