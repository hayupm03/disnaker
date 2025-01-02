<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Laporan Mediasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Laporan Mediasi</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('laporan/add'); ?>" method="post">
                <!-- Select untuk memilih agenda mediasi -->
                <div class="form-group">
                    <label for="agenda_mediasi_id">Pilih Agenda Mediasi</label>
                    <select name="agenda_mediasi_id" class="form-control" id="agenda_mediasi_id" onchange="updateJenisKasus()">
                        <option value="">- Pilih Agenda Mediasi -</option>
                        <?php foreach ($agenda_mediasi as $agenda): ?>
                            <option value="<?= $agenda->id ?>" <?= set_select('agenda_mediasi_id', $agenda->id); ?>>
                                <?= $agenda->nama_pihak_satu ?> dan <?= $agenda->nama_pihak_dua ?> - <?= $agenda->nama_kasus ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('agenda_mediasi_id', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="nama_kasus">Nama Kasus</label>
                    <input type="text" class="form-control" name="nama_kasus" id="nama_kasus" readonly value="<?= set_value('nama_kasus'); ?>">
                    <?php echo form_error('nama_kasus', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="nama_pihak_satu">Pihak 1</label>
                    <input type="text" class="form-control" name="nama_pihak_satu" id="nama_pihak_satu" readonly value="<?= set_value('nama_pihak_satu'); ?>">
                    <?php echo form_error('nama_pihak_satu', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="nama_pihak_dua">Pihak 2</label>
                    <input type="text" class="form-control" name="nama_pihak_dua" id="nama_pihak_dua" readonly value="<?= set_value('nama_pihak_dua'); ?>">
                    <?php echo form_error('nama_pihak_dua', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="jenis_kasus">Jenis Kasus</label>
                    <input type="text" class="form-control" name="jenis_kasus" id="jenis_kasus" value="<?= set_value('jenis_kasus'); ?>" readonly>
                    <?php echo form_error('jenis_kasus', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="tanggal_mediasi">Tanggal Agenda</label>
                    <input type="text" class="form-control" name="tanggal_mediasi" id="tanggal_mediasi" value="<?= set_value('tgl_mediasi'); ?> <?= set_value('waktu_mediasi'); ?>" readonly>
                    <?php echo form_error('tanggal_mediasi', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="tgl_penutupan">Tanggal Penutupan</label>
                    <input type="date" class="form-control" name="tgl_penutupan" value="<?= set_value('tgl_penutupan'); ?>" required>
                    <?php echo form_error('tgl_penutupan', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">- Pilih Status -</option>
                        <option value="selesai" <?= set_select('status', 'selesai'); ?>>Selesai</option>
                        <option value="gagal" <?= set_select('status', 'gagal'); ?>>Gagal</option>
                        <option value="dilanjut ke pengadilan" <?= set_select('status', 'dilanjut ke pengadilan'); ?>>Dilanjut ke Pengadilan</option>
                    </select>
                    <?php echo form_error('status', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="hasil_mediasi">Hasil Mediasi</label>
                    <input type="text" class="form-control" name="hasil_mediasi" value="<?= set_value('hasil_mediasi'); ?>" required>
                    <?php echo form_error('hasil_mediasi', '<div class="text-danger">', '</div>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

</div>

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