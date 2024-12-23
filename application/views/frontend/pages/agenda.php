
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
                <form action="<?= site_url('agenda/save'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_pihak1">Nama Pihak 1</label>
                            <input type="text" class="form-control" id="nama_pihak1" name="nama_pihak1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_pihak2">Nama Pihak 2</label>
                            <input type="text" class="form-control" id="nama_pihak2" name="nama_pihak2" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_kasus">Nama Kasus</label>
                            <input type="text" class="form-control" id="nama_kasus" name="nama_kasus" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jenis_kasus">Jenis Kasus</label>
                            <input type="text" class="form-control" id="jenis_kasus" name="jenis_kasus" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_mediator">Nama Mediator</label>
                            <input type="text" class="form-control" id="nama_mediator" name="nama_mediator" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_mediasi">Tanggal Mediasi</label>
                            <input type="date" class="form-control" id="tgl_mediasi" name="tgl_mediasi" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="waktu_mediasi">Waktu Mediasi</label>
                            <input type="time" class="form-control" id="waktu_mediasi" name="waktu_mediasi" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tempat">Tempat Mediasi</label>
                            <input type="text" class="form-control" id="tempat" name="tempat" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_kasus">Deskripsi Kasus</label>
                        <textarea class="form-control" id="deskripsi_kasus" name="deskripsi_kasus" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file_pdf">Upload File PDF</label>
                        <input type="file" class="form-control-file" id="file_pdf" name="file_pdf" accept="application/pdf" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Simpan Agenda Mediasi</button>
                    </div>
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
                                <p class="mb-2"><strong>Pihak 1:</strong> <?= htmlspecialchars($agenda['nama_pihak1']); ?></p>
                                <p class="mb-2"><strong>Pihak 2:</strong> <?= htmlspecialchars($agenda['nama_pihak2']); ?></p>
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