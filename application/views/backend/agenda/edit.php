<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Agenda Mediasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Agenda Mediasi</h6>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('agenda_mediasi/edit/' . $agenda['id']); ?>" method="post">
                <div class="form-group">
                    <label for="nama_pihak_satu">Nama Pihak 1</label>
                    <input type="text" class="form-control" id="nama_pihak_satu" name="nama_pihak_satu" value="<?php echo set_value('nama_pihak_satu', $agenda['nama_pihak_satu']); ?>">
                    <?php echo form_error('nama_pihak_satu', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_pihak_dua">Nama Pihak 2</label>
                    <input type="text" class="form-control" id="nama_pihak_dua" name="nama_pihak_dua" value="<?php echo set_value('nama_pihak_dua', $agenda['nama_pihak_dua']); ?>">
                    <?php echo form_error('nama_pihak_dua', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_kasus">Nama Kasus</label>
                    <input type="text" class="form-control" id="nama_kasus" name="nama_kasus" value="<?php echo set_value('nama_kasus', $agenda['nama_kasus']); ?>">
                    <?php echo form_error('nama_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="id_mediator">Nama Mediator</label>
                    <select class="form-control" id="id_mediator" name="id_mediator">
                        <option value="">-- Pilih Mediator --</option>
                        <?php foreach ($mediators as $mediator): ?>
                            <option value="<?= $mediator['id_mediator']; ?>" <?= set_select('id_mediator', $agenda['id_mediator'], $mediator['id_mediator'] == $agenda['id_mediator']); ?>>
                                <?= htmlspecialchars($mediator['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_mediator', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tgl_mediasi">Tanggal Mediasi</label>
                    <input type="date" class="form-control" id="tgl_mediasi" name="tgl_mediasi" value="<?php echo set_value('tgl_mediasi', $agenda['tgl_mediasi']); ?>">
                    <?php echo form_error('tgl_mediasi', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="waktu_mediasi">Waktu Mediasi</label>
                    <input type="time" class="form-control" id="waktu_mediasi" name="waktu_mediasi" value="<?php echo set_value('waktu_mediasi', $agenda['waktu_mediasi']); ?>">
                    <?php echo form_error('waktu_mediasi', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="disetujui" <?php echo set_select('status', 'disetujui', ($agenda['status'] == 'disetujui') ? TRUE : FALSE); ?>>Disetujui</option>
                        <option value="ditolak" <?php echo set_select('status', 'ditolak', ($agenda['status'] == 'ditolak') ? TRUE : FALSE); ?>>Ditolak</option>
                        <option value="diproses" <?php echo set_select('status', 'diproses', ($agenda['status'] == 'diproses') ? TRUE : FALSE); ?>>Diproses</option>
                    </select>
                    <?php echo form_error('status', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo set_value('tempat', $agenda['tempat']); ?>">
                    <?php echo form_error('tempat', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="jenis_kasus">Jenis Kasus</label>
                    <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" value="<?php echo set_value('jenis_kasus', $agenda['jenis_kasus']); ?>">
                    <?php echo form_error('jenis_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="deskripsi_kasus">Deskripsi Kasus</label>
                    <input type="text" class="form-control" id="deskripsi_kasus" name="deskripsi_kasus" value="<?php echo set_value('deskripsi_kasus', $agenda['deskripsi_kasus']); ?>">
                    <?php echo form_error('deskripsi_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Update Agenda</button>
            </form>
        </div>
    </div>
</div>