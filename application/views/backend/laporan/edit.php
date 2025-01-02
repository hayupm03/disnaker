<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Laporan Mediasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Laporan Mediasi</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('laporan/edit/' . $laporan['id_laporan']); ?>" method="post">
                <!-- Menampilkan informasi agenda mediasi yang sudah dipilih -->
                <div class="form-group">
                    <label for="agenda_mediasi_id">Agenda Mediasi</label>
                    <input type="text" class="form-control" name="agenda_mediasi_id" id="agenda_mediasi_id" readonly value="<?= $laporan['nama_pihak_satu'] ?> dan <?= $laporan['nama_pihak_dua'] ?> - <?= $laporan['nama_kasus'] ?>">
                    <input type="hidden" name="agenda_mediasi_id" value="<?= $laporan['id_agenda'] ?>">
                </div>

                <div class="form-group">
                    <label for="nama_kasus">Nama Kasus</label>
                    <input type="text" class="form-control" name="nama_kasus" id="nama_kasus" readonly value="<?= set_value('nama_kasus', $laporan['nama_kasus']); ?>">
                    <?php echo form_error('nama_kasus', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="nama_pihak_satu">Pihak 1</label>
                    <input type="text" class="form-control" name="nama_pihak_satu" id="nama_pihak_satu" readonly value="<?= set_value('nama_pihak_satu', $laporan['nama_pihak_satu']); ?>">
                    <?php echo form_error('nama_pihak_satu', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="nama_pihak_dua">Pihak 2</label>
                    <input type="text" class="form-control" name="nama_pihak_dua" id="nama_pihak_dua" readonly value="<?= set_value('nama_pihak_dua', $laporan['nama_pihak_dua']); ?>">
                    <?php echo form_error('nama_pihak_dua', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="jenis_kasus">Jenis Kasus</label>
                    <input type="text" class="form-control" name="jenis_kasus" id="jenis_kasus" value="<?= set_value('jenis_kasus', $laporan['jenis_kasus']); ?>" readonly>
                    <?php echo form_error('jenis_kasus', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="tanggal_mediasi">Tanggal Agenda</label>
                    <input type="text" class="form-control" name="tanggal_mediasi" id="tanggal_mediasi" value="<?= set_value('tgl_mediasi', $laporan['tgl_mediasi']); ?> <?= set_value('waktu_mediasi', $laporan['waktu_mediasi']); ?>" readonly>
                    <?php echo form_error('tanggal_mediasi', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="tgl_penutupan">Tanggal Penutupan</label>
                    <input type="date" class="form-control" name="tgl_penutupan" value="<?= set_value('tgl_penutupan', $laporan['tgl_penutupan']); ?>" required>
                    <?php echo form_error('tgl_penutupan', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">- Pilih Status -</option>
                        <option value="selesai" <?= set_select('status', 'selesai', $laporan['status'] == 'selesai'); ?>>Selesai</option>
                        <option value="gagal" <?= set_select('status', 'gagal', $laporan['status'] == 'gagal'); ?>>Gagal</option>
                        <option value="dilanjut ke pengadilan" <?= set_select('status', 'dilanjut ke pengadilan', $laporan['status'] == 'dilanjut ke pengadilan'); ?>>Dilanjut ke Pengadilan</option>
                    </select>
                    <?php echo form_error('status', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="hasil_mediasi">Hasil Mediasi</label>
                    <input type="text" class="form-control" name="hasil_mediasi" value="<?= set_value('hasil_mediasi', $laporan['hasil_mediasi']); ?>" required>
                    <?php echo form_error('hasil_mediasi', '<div class="text-danger">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======


<script>
    function updateJenisKasus() {
        var agendaId = document.getElementById("agenda_mediasi_id").value;
        var namaPihakSatuField = document.getElementById("nama_pihak_satu");
        var namaPihakDuaField = document.getElementById("nama_pihak_dua");
        var jenisKasusField = document.getElementById("jenis_kasus");
        var namaKasusField = document.getElementById("nama_kasus");
        var tanggalMediasiField = document.getElementById("tanggal_mediasi");

        if (agendaId) {
            var agendaData = <?php echo json_encode($agenda_mediasi); ?>;
            var selectedAgenda = agendaData.find(function(agenda) {
                return agenda.id == agendaId;
            });

            if (selectedAgenda) {
                namaPihakSatuField.value = selectedAgenda.nama_pihak_satu;
                namaPihakDuaField.value = selectedAgenda.nama_pihak_dua;
                jenisKasusField.value = selectedAgenda.jenis_kasus;
                namaKasusField.value = selectedAgenda.nama_kasus;
                tanggalMediasiField.value = selectedAgenda.tgl_mediasi + ' - ' + selectedAgenda.waktu_mediasi;
            }
        } else {
            namaPihakSatuField.value = "";
            namaPihakDuaField.value = "";
            jenisKasusField.value = "";
            namaKasusField.value = "";
            tanggalMediasiField.value = "";
        }
    }
</script>
>>>>>>> 97b43e7a9c77bc6159ccb2717c5bb5820149637a
