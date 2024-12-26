<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        <a href="<?= base_url('user/add'); ?>" class="btn btn-primary">Tambah User</a>
    </div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($user['admin_name'] ?? $user['pelapor_name'] ?? $user['mediator_name']); ?></td>
                                    <td>
                                        <?php
                                        if (!empty($user['admin_name'])) {
                                            echo 'Admin';
                                        } elseif (!empty($user['pelapor_name'])) {
                                            echo 'Pelapor';
                                        } elseif (!empty($user['mediator_name'])) {
                                            echo 'Mediator';
                                        } else {
                                            echo 'Unknown';
                                        }
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($user['admin_telp'] ?? $user['pelapor_telp'] ?? $user['mediator_telp']); ?></td>
                                    <td><?= htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <a href="<?= base_url('user/edit/' . $user['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('user/delete/' . $user['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data user.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>