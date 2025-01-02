<!-- frontend/pages/profile.php -->
<div class="container mt-5">
    <h1>Profile</h1>
    <div class="row">
        <div class="col-md-6">
            <h4>Informasi Pengguna</h4>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> <?= $user['user_name']; ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= $user['email']; ?></li>
                <li class="list-group-item"><strong>Nomor Telepon:</strong> <?= $user['phone']; ?></li>
                <li class="list-group-item"><strong>Alamat:</strong> <?= $user['address']; ?></li>
            </ul>
        </div>
    </div>
</div>