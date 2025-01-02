<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('user/edit/' . $user['id']); ?>" method="post">
                <!-- Input for Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>

                <!-- Input for Password -->
                <div class="form-group">
                    <label for="password">Password <small>(kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <!-- Input for Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($user['admin_name'] ?? $user['mediator_name'] ?? $user['pelapor_name']); ?>" required>
                </div>

                <!-- Input for Telepon -->
                <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" name="telp" class="form-control" id="telp" value="<?= htmlspecialchars($user['admin_telp'] ?? $user['mediator_telp'] ?? $user['pelapor_telp']); ?>" required>
                </div>

                <!-- Select Role -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" <?= ($user['admin_name'] ? 'selected' : ''); ?>>Admin</option>
                        <option value="mediator" <?= ($user['mediator_name'] ? 'selected' : ''); ?>>Mediator</option>
                        <option value="pelapor" <?= ($user['pelapor_name'] ? 'selected' : ''); ?>>Pelapor</option>
                    </select>
                </div>

                <!-- Optional Fields for Different Roles -->
                <div class="form-group" id="bidangDiv" style="display: none;">
                    <label for="bidang">Bidang</label>
                    <input type="text" class="form-control" id="bidang" name="bidang" value="<?= htmlspecialchars($user['mediator_bidang'] ?? ''); ?>">
                </div>

                <div class="form-group" id="perusahaanDiv" style="display: none;">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="<?= htmlspecialchars($user['pelapor_perusahaan'] ?? ''); ?>">
                </div>

                <div class="form-group" id="alamatDiv" style="display: none;">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($user['admin_alamat'] ?? $user['mediator_alamat'] ?? $user['pelapor_alamat'] ?? ''); ?>">
                </div>

                <div class="form-group" id="nipDiv" style="display: none;">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?= htmlspecialchars($user['mediator_nip'] ?? ''); ?>">
                </div>

                <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleAdditionalFields() {
        var role = document.getElementById("role").value;

        document.getElementById("bidangDiv").style.display = "none";
        document.getElementById("perusahaanDiv").style.display = "none";
        document.getElementById("alamatDiv").style.display = "none";
        document.getElementById("nipDiv").style.display = "none";

        if (role === "mediator") {
            document.getElementById("bidangDiv").style.display = "block";
            document.getElementById("nipDiv").style.display = "block";
            document.getElementById("alamatDiv").style.display = "block";
        } else if (role === "pelapor") {
            document.getElementById("perusahaanDiv").style.display = "block";
            document.getElementById("alamatDiv").style.display = "block";
        } else if (role == "admin") {
            document.getElementById("alamatDiv").style.display = "block";
        }
    }

    window.onload = toggleAdditionalFields;
</script>