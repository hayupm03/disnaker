    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Agenda Mediasi</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Agenda</th>
                    <th>Nama pihak1</th>
                    <th>Nama pihak2</th>
                    <th>Nama kasus</th>
                    <th>Tujuan</th>
                    <th>Nama Mediator</th>
                    <th>Tanggal Mediasi</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Tempat</th>
                    <th>Jenis Kasus</th>
                    <th>Deskripsi Kasus</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($admins)) : ?>
                    <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <td><?= htmlspecialchars($agenda['id']); ?></td>
                            <td><?= htmlspecialchars($agenda['nama_pihak1']); ?></td>
                            <td><?= htmlspecialchars($agenda['nama_pihak2']); ?></td>
                            <td><?= htmlspecialchars($agenda['nama_kasus']); ?></td>
                            <td><?= htmlspecialchars($agenda['tujuan']); ?></td>
                            <td><?= htmlspecialchars($agenda['nama_mediator']); ?></td>
                            <td><?= htmlspecialchars($agenda['tgl_mediasi']); ?></td>
                            <td><?= htmlspecialchars($agenda['waktu_mediasi']); ?></td>
                            <td><?= htmlspecialchars($agenda['status']); ?></td>
                            <td><?= htmlspecialchars($agenda['tempat']); ?></td>
                            <td><?= htmlspecialchars($agenda['jenis_kasus']); ?></td>
                            <td><?= htmlspecialchars($agenda['deskripsi_kasus']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data agenda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
