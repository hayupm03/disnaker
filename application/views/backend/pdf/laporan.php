<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <style>
        /* Styling untuk kop surat */
        .header {
            text-align: center;
        }

        .header::after {
            content: "";
            display: table;
            clear: both;
        }

        .header img,
        .header .text-container {
            display: inline-block;
            vertical-align: middle;
        }

        .header img {
            max-height: 80px;
            margin-right: 20px;
        }

        .sub-header {
            text-align: center;
            font-weight: bold;
        }

        .no-border td {
            border: none;
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <table style="width: 100%;" style="border: none;">
            <tr style="border: none;">
                <td style="width: 10%; border: none;">
                    <?php
                    $path = base_url('assets/images/logodisnaker.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    if (!isset($base64)) {
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                    ?>
                    <img src="<?= $base64 ?>" alt="Logo" />
                </td style="border: none;">
                <td style="text-align: center; border: none;">
                    <h3 style="font-size: 20px; margin: 0;">
                        PEMERINTAH KOTA SEMARANG <br>
                        DINAS TENAGA KERJA
                    </h3>
                    Jalan Ki Mangunsarkoro Nomor 21, Karangkidul, Semarang Tengah 50136 <br>
                    Telepon: (024) 8440335, 8440339 | Email: disnaker.semarangkota.go.id
                </td>
            </tr>
        </table>
    </div>

    <h1><?= $title; ?></h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasus</th>
                <th>Nama Mediator</th>
                <th>Nama Pihak Satu</th>
                <th>Nama Pihak Dua</th>
                <th>Status</th>
                <th>Hasil Mediasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($media as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_kasus']; ?></td>
                    <td><?= $row['nama_mediator']; ?></td>
                    <td><?= $row['nama_pihak_satu']; ?></td>
                    <td><?= $row['nama_pihak_dua']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['hasil_mediasi']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>