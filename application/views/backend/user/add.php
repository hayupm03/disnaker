<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
        </div>
        <div class="card-body">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('user/add'); ?>" method="post">
                <!-- Input for Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>">
                    <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Telepon -->
                <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" class="form-control" id="telp" name="telp" value="<?php echo set_value('telp'); ?>">
                    <?php echo form_error('telp', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Select Role (Admin, Pelapor, Mediator) -->
                <div class="form-group">
                    <label for="role">Pilih Peran</label>
                    <select class="form-control" id="role" name="role" onchange="toggleAdditionalFields()">
                        <option value="admin">Admin</option>
                        <option value="pelapor">Pelapor</option>
                        <option value="mediator">Mediator</option>
                    </select>
                </div>

                <!-- Input for NIP (Not Admin) -->
                <div class="form-group" id="nipDiv" style="display: none;">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?php echo set_value('nip'); ?>">
                    <?php echo form_error('nip', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Bidang (Mediators only) -->
                <div class="form-group" id="bidangDiv" style="display: none;">
                    <label for="bidang">Bidang</label>
                    <input type="text" class="form-control" id="bidang" name="bidang" value="<?php echo set_value('bidang'); ?>">
                    <?php echo form_error('bidang', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Perusahaan (Pelapor only) -->
                <div class="form-group" id="perusahaanDiv" style="display: none;">
                    <label for="perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="<?php echo set_value('perusahaan'); ?>">
                    <?php echo form_error('perusahaan', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Input for Alamat (Not Admin) -->
                <div class="form-group" id="alamatDiv" style="display: none;">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo set_value('alamat'); ?>">
                    <?php echo form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>

                <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleAdditionalFields() {
        var role = document.getElementById("role").value;

        document.getElementById("bidangDiv").style.display = "none";
        document.getElementById("perusahaanDiv").style.display = "none";
        document.getElementById("alamatDiv").style.display = "none";
        document.getElementById("nipDiv").style.display = "none";

        if (role === "mediator") {
            document.getElementById("bidangDiv").style.display = "block";
            document.getElementById("nipDiv").style.display = "block";
            document.getElementById("alamatDiv").style.display = "block";
        } else if (role === "pelapor") {
            document.getElementById("perusahaanDiv").style.display = "block";
            document.getElementById("alamatDiv").style.display = "block";
        } else if (role == "admin") {
            document.getElementById("alamatDiv").style.display = "block";
        }
    }

    window.onload = toggleAdditionalFields;
</script>