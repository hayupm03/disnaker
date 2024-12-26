<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

    <!-- DataTales Example -->
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
                    <select class="form-control" id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="pelapor">Pelapor</option>
                        <option value="mediator">Mediator</option>
                    </select>
                </div>
                
                <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>