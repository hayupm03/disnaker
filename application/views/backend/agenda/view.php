<style>
    .table th {
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }

    .status-approved {
        background-color: #28a745;
        /* green */
        color: white;
    }

    .status-rejected {
        background-color: #dc3545;
        /* red */
        color: white;
    }

    .status-processing {
        background-color: #ffc107;
        /* yellow */
        color: white;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Agenda</h1>
        <a href="<?= base_url('agenda_mediasi/add'); ?>" class="btn btn-primary">Tambah Agenda</a>
    </div>
    <!-- Card Container -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Agenda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nomor Mediasi</th>
                            <th>Nama Pihak 1</th>
                            <th>Nama Pihak 2</th>
                            <th>Nama Mediator</th>
                            <th>Tanggal Agenda</th>
                            <th>Status</th>
                            <th>Tempat</th>
                            <th>Jenis Kasus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($agendas)) : ?>
                            <?php $no = 1;
                            ?>
                            <?php foreach ($agendas as $agenda) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($agenda['nomor_mediasi']); ?></td>
                                    <td><?= htmlspecialchars($agenda['nama_pihak_satu']); ?></td>
                                    <td><?= htmlspecialchars($agenda['nama_pihak_dua']); ?></td>
                                    <td><?= htmlspecialchars($agenda['nama_mediator']); ?></td>
                                    <td><?= date('d-m-Y', strtotime($agenda['tgl_mediasi'])); ?></td>
                                    <td>
                                        <span class="badge <?php
                                                            switch ($agenda['status']) {
                                                                case 'disetujui':
                                                                    echo 'status-approved';
                                                                    break;
                                                                case 'ditolak':
                                                                    echo 'status-rejected';
                                                                    break;
                                                                case 'diproses':
                                                                    echo 'status-processing';
                                                                    break;
                                                                default:
                                                                    echo 'badge-secondary';
                                                            }
                                                            ?>">
                                            <?= htmlspecialchars($agenda['status']); ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($agenda['tempat']); ?></td>
                                    <td><?= htmlspecialchars($agenda['jenis_kasus']); ?></td>
                                    <td>
                                        <a href="<?= base_url('agenda_mediasi/edit/' . $agenda['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('agenda_mediasi/delete/' . $agenda['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
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