<style>
    .table th {
    white-space: nowrap;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mediasi</h1>
        <a href="<?= base_url('agenda_mediasi/add'); ?>" class="btn btn-primary">Tambah Agenda</a>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Agenda Mediasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Nomor Agenda</th>
            <th>Nama pihak1</th>
            <th>Nama pihak2</th>
            <th>Nama kasus</th>
            <th>Nama Mediator</th>
            <th>Tanggal Mediasi</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Tempat</th>
            <th>Jenis Kasus</th>
            <th>Deskripsi Kasus</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($agendas)) : ?>
            <?php $no = 1; // Inisialisasi nomor urut ?>
            <?php foreach ($agendas as $agenda) : ?>
                <tr>
                    <td><?= $no++; ?></td> <!-- Menampilkan nomor urut -->
                    <td><?= htmlspecialchars($agenda['nomor_mediasi']); ?></td>
                    <td><?= htmlspecialchars($agenda['nama_pihak1']); ?></td>
                    <td><?= htmlspecialchars($agenda['nama_pihak2']); ?></td>
                    <td><?= htmlspecialchars($agenda['nama_kasus']); ?></td>
                    <td><?= htmlspecialchars($agenda['nama_mediator']); ?></td>
                    <td><?= htmlspecialchars($agenda['tgl_mediasi']); ?></td>
                    <td><?= htmlspecialchars($agenda['waktu_mediasi']); ?></td>
                    <td><?= htmlspecialchars($agenda['status']); ?></td>
                    <td><?= htmlspecialchars($agenda['tempat']); ?></td>
                    <td><?= htmlspecialchars($agenda['jenis_kasus']); ?></td>
                    <td><?= htmlspecialchars($agenda['deskripsi_kasus']); ?></td>
                    <td style="white-space: nowrap;">
                        <a href="<?= base_url('agenda_mediasi/edit/' . $agenda['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('agenda_mediasi/delete/' . $agenda['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="13" class="text-center">Tidak ada data agenda.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>
</div>
