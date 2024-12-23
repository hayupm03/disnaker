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
    <form action="<?= base_url('laporan/add'); ?>" method="post">
    <div class="form-group">
        <label for="nama_pihak_satu">Nama Pihak 1</label>
        <input type="text" class="form-control" name="nama_pihak_satu" value="<?= set_value('nama_pihak_satu'); ?>">
    </div>
    <div class="form-group">
        <label for="nama_pihak_dua">Nama Pihak 2</label>
        <input type="text" class="form-control" name="nama_pihak_dua" value="<?= set_value('nama_pihak_dua'); ?>">
    </div>
    <div class="form-group">
        <label for="tgl_agenda">Tanggal Agenda</label>
        <input type="date" class="form-control" name="tgl_agenda" value="<?= set_value('tgl_agenda'); ?>">
    </div>
    <div class="form-group">
        <label for="tgl_penutupan">Tanggal Penutupan</label>
        <input type="date" class="form-control" name="tgl_penutupan" value="<?= set_value('tgl_penutupan'); ?>">
    </div>
    <div class="form-group">
        <label for="jenis_kasus">Jenis Kasus</label>
        <input type="text" class="form-control" name="jenis_kasus" value="<?= set_value('jenis_kasus'); ?>">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" name="status" value="<?= set_value('status'); ?>">
    </div>
    <div class="form-group">
        <label for="hasil_mediasi">Hasil Mediasi</label>
        <input type="text" class="form-control" name="hasil_mediasi" value="<?= set_value('hasil_mediasi'); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
    </div>
</div>

</div>