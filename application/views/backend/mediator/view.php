<style>
    .table th, .table td {
        vertical-align: middle; /* Menyelaraskan konten ke tengah secara vertikal */
        text-align: center; /* Konten berada di tengah secara horizontal */
        white-space: nowrap; /* Mencegah teks terpotong */
    }
    .table tbody tr:hover {
        background-color: #f8f9fa; /* Warna latar saat hover */
    }
    .aksi-icons {
        display: flex;
        justify-content: center;
        gap: 10px; /* Memberikan jarak antar ikon */
    }
    .aksi-icons a {
        font-size: 1.2em; /* Menyesuaikan ukuran ikon */
        text-decoration: none; /* Menghapus garis bawah */
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mediator</h1>
        <a href="<?= base_url('mediator/add'); ?>" class="btn btn-primary">Tambah Mediator</a>
    </div>

    <!-- Card Container -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mediator</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>NIP</th>
                            <th>Bidang</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mediators)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($mediators as $media): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($media['nama']); ?></td>
                                    <td><?= htmlspecialchars($media['telp']); ?></td>
                                    <td><?= htmlspecialchars($media['nip']); ?></td>
                                    <td><?= htmlspecialchars($media['bidang']); ?></td>
                                    <td><?= htmlspecialchars($media['email']); ?></td>
                                    <td>
                                        <div class="aksi-icons">
                                            <a href="<?= base_url('mediator/edit/' . $media['id_mediator']); ?>" class="btn btn-warning btn-sm" title="Edit">
                                                ✏️
                                            </a>
                                            <a href="<?= base_url('mediator/delete/' . $media['id_mediator']); ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                🗑️
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data mediator.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
