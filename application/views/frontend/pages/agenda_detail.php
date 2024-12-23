
<section class="single-page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>About Us</h2>
				<ol class="breadcrumb header-bradcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.html" class="text-white">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">About Us</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="about-shot-info section-sm">
	<!-- File: application/views/frontend/pages/agenda_detail.php -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Detail Agenda Mediasi</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php if (!empty($agenda)) : ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($agenda['nama_kasus']); ?></h5>
                        <p><strong>Nomor Mediasi:</strong> <?= htmlspecialchars($agenda['nomor_mediasi']); ?></p>
                        <p><strong>Pihak 1:</strong> <?= htmlspecialchars($agenda['nama_pihak1']); ?></p>
                        <p><strong>Pihak 2:</strong> <?= htmlspecialchars($agenda['nama_pihak2']); ?></p>
                        <p><strong>Nama Mediator:</strong> <?= htmlspecialchars($agenda['nama_mediator']); ?></p>
                        <p><strong>Tanggal Mediasi:</strong> <?= htmlspecialchars($agenda['tgl_mediasi']); ?></p>
                        <p><strong>Waktu Mediasi:</strong> <?= htmlspecialchars($agenda['waktu_mediasi']); ?></p>
                        <p><strong>Tempat:</strong> <?= htmlspecialchars($agenda['tempat']); ?></p>
                        <p><strong>Jenis Kasus:</strong> <?= htmlspecialchars($agenda['jenis_kasus']); ?></p>
                        <p><strong>Deskripsi Kasus:</strong> <?= htmlspecialchars($agenda['deskripsi_kasus']); ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars(ucfirst($agenda['status'])); ?></p>
                        <a href="<?= site_url('agenda'); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="col-md-12">
                <p class="text-center">Detail agenda tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</section>  