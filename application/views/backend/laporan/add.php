<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tambah Laporan Mediasi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Laporan Mediasi</h6>
    </div>
    <div class="card-body">
    <form action="<?php echo base_url('mediator/add'); ?>" method="post">
        <div class="form-group">
            <label for="id_mediator">ID Laporan</label>
            <input type="text" class="form-control" id="id_laporan" name="id_laporan" value="<?php echo set_value('id_laporan'); ?>">
            <?php echo form_error('id_laporan', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="id_mediator">ID Agenda</label>
            <input type="text" class="form-control" id="id_agenda" name="id_agenda" value="<?php echo set_value('id_agenda'); ?>">
            <?php echo form_error('id_agenda', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="nama">Nama Pihak 1</label>
            <input type="text" class="form-control" id="nama_pihak_satu" name="nama_pihak_satu" value="<?php echo set_value('nama_pihak_satu'); ?>">
            <?php echo form_error('nama_pihak_satu', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="nama">Nama Pihak 2</label>
            <input type="text" class="form-control" id="nama_pihak_dua" name="nama_pihak_dua" value="<?php echo set_value('nama_pihak_dua'); ?>">
            <?php echo form_error('nama_pihak_dua', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="telp">Tanggal Agenda</label>
            <input type="text" class="form-control" id="tgl_agenda" name="tgl_agenda" value="<?php echo set_value('tgl_agenda'); ?>">
            <?php echo form_error('tgl_agenda', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="telp">Tanggal Selesai Mediasi</label>
            <input type="text" class="form-control" id="tgl_penutupan" name="tgl_penutupan" value="<?php echo set_value('tgl_penutupan'); ?>">
            <?php echo form_error('tgl_penutupan', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="nip">Jenis Kasus</label>
            <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" value="<?php echo set_value('jenis_kasus'); ?>">
            <?php echo form_error('jenis_kasus', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="bidang">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo set_value('status'); ?>">
            <?php echo form_error('status', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
            <label for="email">Hasil Mediasi</label>
            <input type="email" class="form-control" id="hasil_mediasi" name="hasil_mediasi" value="<?php echo set_value('hasil_mediasi'); ?>">
            <?php echo form_error('hasil_mediasi', '<small class="text-danger">', '</small>'); ?>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    </div>
</div>

</div>