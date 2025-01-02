<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('profile/update'); ?>" method="POST">
                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="<?= isset($user_details['nama']) ? $user_details['nama'] : ''; ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= $user['email']; ?>" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="<?= isset($user_details['telp']) ? $user_details['telp'] : ''; ?>" required>
                </div>

                <!-- Deskripsi Opsional -->
                <p class="text-danger">*Jika Anda tidak ingin mengganti password, biarkan semua kolom ini kosong.</p>

                <!-- Password Lama -->
                <div class="form-group">
                    <label for="current_password">Password Lama</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>

                <!-- Password Baru -->
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Perbarui Profil</button>
            </form>
        </div>
    </div>
</div>