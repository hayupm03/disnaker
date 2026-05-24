<section class="single-page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Profile</h2>
                <ol class="breadcrumb header-bradcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="contact-us" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (!empty($profile_image)): ?>
                    <div class="text-center mb-4">
                        <img src="<?= base_url('uploads/' . htmlspecialchars($profile_image)); ?>" alt="Profile Image" class="img-thumbnail" width="200">
                    </div>
                <?php else: ?>
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/img/default-profile.png'); ?>" alt="Default Profile" class="img-thumbnail" width="200">
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('profile/update'); ?>" method="POST" enctype="multipart/form-data">
                    <!-- Gambar Profile -->
                    <div class="form-group">
                        <label for="profile_image">Gambar Profile</label>
                        <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF (Maksimal 2MB)</small>
                    </div>

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?= isset($user_details['nama']) ? htmlspecialchars($user_details['nama'], ENT_QUOTES) : ''; ?>"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlspecialchars($user['email'], ENT_QUOTES); ?>" required>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?= isset($user_details['telp']) ? htmlspecialchars($user_details['telp'], ENT_QUOTES) : ''; ?>"
                            required>
                    </div>

                    <!-- Informasi Password -->
                    <p class="text-danger">*Jika Anda tidak ingin mengganti password, biarkan semua kolom ini kosong.</p>

                    <!-- Password Lama -->
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="6">
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="form-row">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>