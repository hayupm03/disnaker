<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Agenda Mediasi</h1>

    <!-- Card for adding agenda -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Agenda Mediasi</h6>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('agenda/add'); ?>" method="post">
                <div class="form-group">
                    <label for="nama_pihak1">Nama Pihak 1</label>
                    <input type="text" class="form-control" id="nama_pihak1" name="nama_pihak1" value="<?php echo set_value('nama_pihak1'); ?>">
                    <?php echo form_error('nama_pihak1', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_pihak2">Nama Pihak 2</label>
                    <input type="text" class="form-control" id="nama_pihak2" name="nama_pihak2" value="<?php echo set_value('nama_pihak2'); ?>">
                    <?php echo form_error('nama_pihak2', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_kasus">Nama Kasus</label>
                    <input type="text" class="form-control" id="nama_kasus" name="nama_kasus" value="<?php echo set_value('nama_kasus'); ?>">
                    <?php echo form_error('nama_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tujuan">Tujuan</label>
                    <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo set_value('tujuan'); ?>">
                    <?php echo form_error('tujuan', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_mediator">Nama Mediator</label>
                    <input type="text" class="form-control" id="nama_mediator" name="nama_mediator" value="<?php echo set_value('nama_mediator'); ?>">
                    <?php echo form_error('nama_mediator', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tgl_mediasi">Tanggal Mediasi</label>
                    <input type="date" class="form-control" id="tgl_mediasi" name="tgl_mediasi" value="<?php echo set_value('tgl_mediasi'); ?>">
                    <?php echo form_error('tgl_mediasi', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="waktu_mediasi">Waktu Mediasi</label>
                    <input type="text" class="form-control" id="waktu_mediasi" name="waktu_mediasi" value="<?php echo set_value('waktu_mediasi'); ?>">
                    <?php echo form_error('waktu_mediasi', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="disetujui" <?php echo set_select('status', 'disetujui'); ?>>Disetujui</option>
                        <option value="ditolak" <?php echo set_select('status', 'ditolak'); ?>>Ditolak</option>
                        <option value="diproses" <?php echo set_select('status', 'diproses'); ?>>Diproses</option>
                    </select>
                    <?php echo form_error('status', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo set_value('tempat'); ?>">
                    <?php echo form_error('tempat', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="jenis_kasus">Jenis Kasus</label>
                    <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" value="<?php echo set_value('jenis_kasus'); ?>">
                    <?php echo form_error('jenis_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="deskripsi_kasus">Deskripsi Kasus</label>
                    <input type="text" class="form-control" id="deskripsi_kasus" name="deskripsi_kasus" value="<?php echo set_value('deskripsi_kasus'); ?>">
                    <?php echo form_error('deskripsi_kasus', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Agenda</button>
            </form>
        </div>
    </div>
</div>
<!-- End Page Content -->
