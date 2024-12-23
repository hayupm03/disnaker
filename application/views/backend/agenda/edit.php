<style>
    .table th {
    white-space: nowrap;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Agenda Mediasi</h1>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Agenda Mediasi</h6>
        </div>
        <div class="card-body">
        <form action="<?= site_url('agenda_mediasi/update/' . $agenda['id']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_pihak1">Nama Pihak 1</label>
                            <input type="text" class="form-control" id="nama_pihak1" name="nama_pihak1" value="<?= $agenda['nama_pihak1']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_pihak2">Nama Pihak 2</label>
                            <input type="text" class="form-control" id="nama_pihak2" name="nama_pihak2" value="<?= $agenda['nama_pihak2']; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_kasus">Nama Kasus</label>
                            <input type="text" class="form-control" id="nama_kasus" name="nama_kasus" value="<?= $agenda['nama_kasus']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jenis_kasus">Jenis Kasus</label>
                            <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" value="<?= $agenda['jenis_kasus']; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_mediator">Nama Mediator</label>
                            <input type="text" class="form-control" id="nama_mediator" name="nama_mediator" value="<?= $agenda['nama_mediator']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_mediasi">Tanggal Mediasi</label>
                            <input type="date" class="form-control" id="tgl_mediasi" name="tgl_mediasi" value="<?= $agenda['tgl_mediasi']; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="waktu_mediasi">Waktu Mediasi</label>
                            <input type="time" class="form-control" id="waktu_mediasi" name="waktu_mediasi" value="<?= $agenda['waktu_mediasi']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tempat">Tempat Mediasi</label>
                            <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $agenda['tempat']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_kasus">Deskripsi Kasus</label>
                        <textarea class="form-control" id="deskripsi_kasus" name="deskripsi_kasus" rows="4" required><?= $agenda['deskripsi_kasus']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file_pdf">Upload File PDF (optional)</label>
                        <input type="file" class="form-control-file" id="file_pdf" name="file_pdf" accept="application/pdf">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning">Update Agenda Mediasi</button>
                    </div>
                </form>
    </div>
</div>