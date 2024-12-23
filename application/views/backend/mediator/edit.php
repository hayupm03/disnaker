<div class="container">
    <h2>Edit Mediator</h2>
    <form method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $mediator['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telp" class="form-control" value="<?= $mediator['telp']; ?>" required>
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= $mediator['nip']; ?>" required>
        </div>
        <div class="form-group">
            <label>Bidang</label>
            <input type="text" name="bidang" class="form-control" value="<?= $mediator['bidang']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $mediator['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('mediator'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
