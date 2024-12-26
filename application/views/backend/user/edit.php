<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
        </div>
        <div class="card-body">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('user/edit/' . $user['id']); ?>" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password <small>(kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($user['admin_name'] ?? $user['mediator_name'] ?? $user['pelapor_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" name="telp" class="form-control" id="telp" value="<?= htmlspecialchars($user['admin_telp'] ?? $user['mediator_telp'] ?? $user['pelapor_telp']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" <?= ($user['admin_name'] ? 'selected' : ''); ?>>Admin</option>
                        <option value="mediator" <?= ($user['mediator_name'] ? 'selected' : ''); ?>>Mediator</option>
                        <option value="pelapor" <?= ($user['pelapor_name'] ? 'selected' : ''); ?>>Pelapor</option>
                    </select>
                </div>
                <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>