<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Profile Admin</h1>
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                Detail Profil Admin
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID Petugas</th>
                        <td><?= htmlspecialchars($profile['id_petugas']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?= htmlspecialchars($profile['nama']); ?></td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td><?= htmlspecialchars($profile['telp']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($profile['email']); ?></td>
                    </tr>
                </table>
                <a href="<?= base_url('admin'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
