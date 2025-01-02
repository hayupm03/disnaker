<section class="single-page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Agenda Mediasi</h2>
                <ol class="breadcrumb header-bradcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="about-shot-info section-sm">
    <div class="container">
        <div class="row">
            <!-- Form Agenda -->
            <div class="col-lg-12">
                <h2 class="mb-3">Form Agenda Mediasi</h2>
                <form action="<?php echo base_url('agenda/add'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama_pihak_satu">Nama Pihak 1</label>
                        <input type="text" class="form-control" id="nama_pihak_satu" name="nama_pihak_satu" value="<?php echo set_value('nama_pihak_satu'); ?>">
                        <?php echo form_error('nama_pihak_satu', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_pihak_dua">Nama Pihak 2</label>
                        <input type="text" class="form-control" id="nama_pihak_dua" name="nama_pihak_dua" value="<?php echo set_value('nama_pihak_dua'); ?>">
                        <?php echo form_error('nama_pihak_dua', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_kasus">Nama Kasus</label>
                        <input type="text" class="form-control" id="nama_kasus" name="nama_kasus" value="<?php echo set_value('nama_kasus'); ?>">
                        <?php echo form_error('nama_kasus', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_mediator">Nama Mediator</label>
                        <select class="form-control" id="id_mediator" name="id_mediator">
                            <option value="">-- Pilih Mediator --</option>
                            <?php foreach ($mediators as $mediator): ?>
                                <option value="<?= $mediator['id_mediator']; ?>" <?= set_select('id_mediator', $mediator['id_mediator']); ?>>
                                    <?= htmlspecialchars($mediator['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_mediator', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tgl_mediasi">Tanggal Mediasi</label>
                        <input type="date" class="form-control" id="tgl_mediasi" name="tgl_mediasi" value="<?php echo set_value('tgl_mediasi'); ?>">
                        <?php echo form_error('tgl_mediasi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="waktu_mediasi">Waktu Mediasi</label>
                        <input type="time" class="form-control" id="waktu_mediasi" name="waktu_mediasi" value="<?php echo set_value('waktu_mediasi'); ?>">
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
</section>



<!--
Start Blog Section
=========================================== -->
<section class="blog" id="blog">
    <div class="container">
        <!-- Section Title -->
        <div class="row justify-content-center mb-5">
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Riwayat <span class="text-primary">Mediasi</span></h2>
                    <div class="border mb-3"></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus facere accusamus, reprehenderit libero inventore nam.</p>
                </div>
            </div>
        </div>
        <!-- /Section Title -->

        <!-- Agenda Cards -->
        <div class="row">
            <?php if (!empty($agendas)) : ?>
                <?php foreach ($agendas as $agenda) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-3 text-primary"><?= htmlspecialchars($agenda['nama_kasus']); ?></h5>
                                <p class="mb-2"><strong>Pihak 1:</strong> <?= htmlspecialchars($agenda['nama_pihak_satu']); ?></p>
                                <p class="mb-2"><strong>Pihak 2:</strong> <?= htmlspecialchars($agenda['nama_pihak_dua']); ?></p>
                                <p class="mb-2"><strong>Tanggal:</strong> <?= htmlspecialchars(date("d-m-Y", strtotime($agenda['tgl_mediasi']))); ?></p>
                                <p class="mb-3"><strong>Status:</strong>
                                    <span class="badge <?= $agenda['status'] === 'disetujui' ? 'badge-success' : ($agenda['status'] === 'ditolak' ? 'badge-danger' : 'badge-warning'); ?>">
                                        <?= ucfirst(htmlspecialchars($agenda['status'])); ?>
                                    </span>
                                </p>
                                <a href="<?= site_url('agenda/detail/' . $agenda['id']); ?>" class="btn btn-primary mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-md-12">
                    <p class="text-center">Tidak ada agenda yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
        <!-- /Agenda Cards -->
    </div>
</section>