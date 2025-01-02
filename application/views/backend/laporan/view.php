<style>
    .table th {
        white-space: nowrap;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Laporan</h1>
        <a href="<?= base_url('laporan/add'); ?>" class="btn btn-primary">Tambah Laporan</a>
    </div>
    <!-- Card Container -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Mediasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Laporan</th>
                            <th>ID Agenda</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Tanggal Agenda</th>
                            <th>Tanggal Penutupan</th>
                            <th>Status</th>
                            <th>Tempat</th>
                            <th>Jenis Kasus</th>
                            <th>Hasil Mediasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporans)) : ?>
                            <?php $no = 1; // Inisialisasi nomor urut ?>
                            <?php foreach ($laporans as $laporan) : ?>
                                <tr>
                                    <td><?= $no++; ?></td> <!-- Nomor Urut -->
                                    <td><?= htmlspecialchars($laporan['id_laporan']); ?></td>
                                    <td><?= htmlspecialchars($laporan['id_agenda']); ?></td>
                                    <td><?= htmlspecialchars($laporan['nama_pihak_satu']); ?></td>
                                    <td><?= htmlspecialchars($laporan['nama_pihak_dua']); ?></td>
                                    <td><?= htmlspecialchars($laporan['tgl_agenda']); ?></td>
                                    <td><?= htmlspecialchars($laporan['tgl_penutupan']); ?></td>
                                    <td><?= htmlspecialchars($laporan['status']); ?></td>
                                    <td><?= htmlspecialchars($laporan['tempat']); ?></td>
                                    <td><?= htmlspecialchars($laporan['jenis_kasus']); ?></td>
                                    <td><?= htmlspecialchars($laporan['hasil_mediasi']); ?></td>
                                    <td>
                                    <a href="<?= base_url('laporan/edit/' . $laporan['id_laporan']); ?>" class="btn btn-warning btn-sm">
                                        ✏️ <!-- Emoji untuk edit -->
                                    </a>
                                    <a href="<?= base_url('laporan/delete/' . $laporan['id_laporan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        🗑️ <!-- Emoji untuk hapus -->
                                    </a>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data mediasi.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
