<style>
    .table th {
    white-space: nowrap;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Laporan Mediasi</h1>
    </div>
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>ID laporan</th>
                <th>ID Agenda</th>
                <th>Nama pihak1</th>
                <th>Nama pihak2</th>
                <th>Tanggal agenda</th>
                <th>Tanggal penutupan</th>
                <th>Status</th>
                <th>Tempat</th>
                <th>Jenis Kasus</th>
                <th>hasil Mediasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($admins)) : ?>
                <?php foreach ($admins as $admin) : ?>
                    <tr>
                        <td><?= htmlspecialchars($laporan['id']); ?></td>
                        <td><?= htmlspecialchars($laporan['id']); ?></td>
                        <td><?= htmlspecialchars($laporan['nama_pihak1']); ?></td>
                        <td><?= htmlspecialchars($laporan['nama_pihak2']); ?></td>
                        <td><?= htmlspecialchars($laporan['tgl_agenda']); ?></td>
                        <td><?= htmlspecialchars($laporan['tgl_penutupan']); ?></td>
                        <td><?= htmlspecialchars($laporan['nama_mediator']); ?></td>
                        <td><?= htmlspecialchars($laporan['status']); ?></td>
                        <td><?= htmlspecialchars($laporan['jenis_kasus']); ?></td>
                        <td><?= htmlspecialchars($laporan['hasil_mediasi']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="12" class="text-center">Tidak ada data Mediasi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
