<style>
    .form-group label {
        font-weight: bold;
    }
    .btn-submit {
        margin-top: 20px;
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Laporan</h1>
    </div>

    <!-- Form Edit Laporan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Laporan</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('laporan/update/' . $laporan['id_laporan']); ?>" method="post">
                <div class="form-group">
                    <label for="id_agenda">ID Agenda</label>
                    <input type="number" class="form-control" id="id_agenda" name="id_agenda" value="<?= htmlspecialchars($laporan['id_agenda']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_pihak_satu">Pihak Satu</label>
                    <input type="text" class="form-control" id="nama_pihak_satu" name="nama_pihak_satu" value="<?= htmlspecialchars($laporan['nama_pihak_satu']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_pihak_dua">Pihak Dua</label>
                    <input type="text" class="form-control" id="nama_pihak_dua" name="nama_pihak_dua" value="<?= htmlspecialchars($laporan['nama_pihak_dua']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_mediator">Nama Mediator</label>
                    <input type="text" class="form-control" id="nama_mediator" name="nama_mediator" value="<?= htmlspecialchars($laporan['nama_mediator']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_agenda">Tanggal Agenda</label>
                    <input type="date" class="form-control" id="tgl_agenda" name="tgl_agenda" value="<?= htmlspecialchars($laporan['tgl_agenda']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_penutupan">Tanggal Penutupan</label>
                    <input type="date" class="form-control" id="tgl_penutupan" name="tgl_penutupan" value="<?= htmlspecialchars($laporan['tgl_penutupan']); ?>">
                </div>
                <div class="form-group">
                    <label for="jenis_kasus">Jenis Kasus</label>
                    <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" value="<?= htmlspecialchars($laporan['jenis_kasus']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="selesai" <?= $laporan['status'] === 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="gagal" <?= $laporan['status'] === 'gagal' ? 'selected' : ''; ?>>Gagal</option>
                        <option value="dilanjut ke pengadilan" <?= $laporan['status'] === 'dilanjut ke pengadilan' ? 'selected' : ''; ?>>Dilanjut ke Pengadilan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hasil_mediasi">Hasil Mediasi</label>
                    <textarea class="form-control" id="hasil_mediasi" name="hasil_mediasi" rows="3" required><?= htmlspecialchars($laporan['hasil_mediasi']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-submit">Simpan Perubahan</button>
                <a href="<?= base_url('laporan'); ?>" class="btn btn-secondary btn-submit">Batal</a>
            </form>
        </div>
    </div>
</div>
