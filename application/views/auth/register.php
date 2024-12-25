<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/sbadmin/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/sbadmin/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Custom background color */
        .bg-gradient-primary {
            background-color: #a3d8f4; /* Soft blue background */
            background: linear-gradient(to right, #a3d8f4, #c4e2f7); /* Optional: soft gradient */
        }
    </style>

</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- Background Image Section -->
                <div class="col-lg-6 d-none d-lg-block" style="background-image: url('<?= base_url('assets/images/company/undraw.png') ?>'); background-size: contain; background-position: center center; height: 100vh; background-repeat: no-repeat;">
                    <!-- Optional Image Inside Background -->
                    <!-- <img src="<?= base_url('assets/sbadmin/your-image.jpg') ?>" alt=""> -->
                </div>

                <!-- Registration Form Section -->
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="<?= site_url('auth/register'); ?>">
                            <!-- Name Inputs -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="first_name" placeholder="First Name" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="last_name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <!-- Email Input -->
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address" required>
                            </div>
                            <!-- Password Inputs -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="confirm_password" placeholder="Konfirmasi Password" required>
                                </div>
                            </div>
                            <!-- Company Name -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleCompanyName" name="perusahaan" placeholder="Nama Perusahaan" required>
                            </div>
                            <!-- Address -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleCompanyName" name="alamat" placeholder="Alamat" required>
                            </div>
                            <!-- Register Button -->
                            <button type="submit" class="btn btn-user btn-block" style="background-color: #5bc0de; border-color: #5bc0de; color: white;">Register Account</button>
                        </form>
                        <hr>
                        <!-- Links for Forgot Password or Login -->
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/login'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/sbadmin/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/sbadmin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>
