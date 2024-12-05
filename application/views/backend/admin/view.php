    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Admin</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Petugas</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($admins)) : ?>
                    <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['id']); ?></td>
                            <td><?= htmlspecialchars($admin['nama']); ?></td>
                            <td><?= htmlspecialchars($admin['telp']); ?></td>
                            <td><?= htmlspecialchars($admin['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data admin.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
