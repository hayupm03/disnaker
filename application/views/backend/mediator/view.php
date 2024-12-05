    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Mediator</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Mediator</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Nip</th>
                    <th>Bidang</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mediators)) : ?>
                    <?php foreach ($mediators as $mediators) : ?>
                        <tr>
                            <td><?= htmlspecialchars($mediator['id']); ?></td>
                            <td><?= htmlspecialchars($mediator['nama']); ?></td>
                            <td><?= htmlspecialchars($mediator['telp']); ?></td>
                            <td><?= htmlspecialchars($mediator['nip']); ?></td>
                            <td><?= htmlspecialchars($mediator['bidang']); ?></td>
                            <td><?= htmlspecialchars($mediator['email']); ?></td>
                            <td><?= htmlspecialchars($mediator['password']); ?></td>
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
