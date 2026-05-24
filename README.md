# DISNAKER Agenda

**Sistem Informasi Mediasi** — Aplikasi manajemen agenda mediasi untuk Dinas Tenaga Kerja (DISNAKER) Kota Semarang.

Aplikasi ini memfasilitasi pengelolaan kasus mediasi hubungan industrial, mulai dari pengajuan oleh pelapor (pekerja), penjadwalan oleh mediator, hingga pelaporan hasil mediasi.

---

## Daftar Isi

- [Fitur](#fitur)
- [Tech Stack](#tech-stack)
- [Role Pengguna](#role-pengguna)
- [Alur Bisnis](#alur-bisnis)
- [Arsitektur MVC](#arsitektur-mvc)
- [Struktur Direktori](#struktur-direktori)
- [Database](#database)
- [API](#api)
- [Instalasi](#instalasi)
- [License](#license)

---

## Fitur

### Publik (Frontend)

- Landing page dengan hero slider dan informasi layanan DISNAKER
- Registrasi dan login untuk pelapor (pekerja)
- Pengajuan agenda mediasi baru oleh pelapor
- Riwayat agenda mediasi dengan status (diproses/disetujui/ditolak)
- Halaman arsip dan kontak

### Admin & Mediator (Backend)

- Dashboard statistik dengan grafik (ApexCharts)
- Manajemen agenda mediasi (CRUD) + upload file
- Manajemen laporan hasil mediasi (CRUD)
- Manajemen data mediator
- Manajemen pengguna multi-role
- Edit profil dan ganti password
- Cetak laporan PDF (Dompdf)

### API REST

- 24 endpoint JSON untuk mendukung aplikasi mobile/SPA
- CRUD agenda, laporan, profil
- Statistik per mediator dan pelapor
- Upload file profile

---

## Tech Stack

| Lapisan             | Teknologi                                      |
| ------------------- | ---------------------------------------------- |
| **Framework**       | CodeIgniter 3.x (PHP MVC)                      |
| **PHP**             | >= 5.3.7                                       |
| **Database**        | MySQL / MariaDB (MySQLi)                       |
| **Frontend Public** | Bootstrap 4, jQuery, Slick Carousel, Filterizr |
| **Admin Template**  | SB Admin 2 (Bootstrap 4)                       |
| **Chart**           | ApexCharts                                     |
| **PDF**             | Dompdf ^3.0                                    |
| **Auth**            | Session-based, bcrypt                          |
| **Server**          | Apache (mod_rewrite)                           |

---

## Role Pengguna

| Role         | Akses                                                                     |
| ------------ | ------------------------------------------------------------------------- |
| **Admin**    | Full akses — dashboard, kelola user, mediator, agenda, laporan, cetak PDF |
| **Mediator** | Dashboard, kelola agenda (ditugaskan), laporan, edit profil               |
| **Pelapor**  | Buat agenda baru, lihat riwayat agenda, edit profil                       |

---

## Alur Bisnis

```
Pelapor buat agenda           →   Admin assign mediator        →   Mediator setujui/tolak
(status: diproses)                 (via API / UI)                   (status: disetujui/ditolak)

Jika disetujui → Mediasi berlangsung → Mediator/Admin buat laporan
                                         (selesai / gagal / dilanjut ke pengadilan)
```

---

## Arsitektur MVC

### Base Controller

**`MY_Controller`** (`application/core/MY_Controller.php`) — parent class untuk semua controller backend, menyediakan:
- `_check_access($roles)` — autentikasi & otorisasi
- `_load_backend_view($view, $data)` — render halaman backend
- `_load_frontend_view($view, $data)` — render halaman frontend

### Controllers

| Controller       | Route                                           | Deskripsi                            | Extends       |
| ---------------- | ----------------------------------------------- | ------------------------------------ | ------------- |
| `Home`           | `/home`                                         | Landing page publik                  | `CI_Controller` |
| `Auth`           | `/auth/login`, `/auth/register`, `/auth/logout` | Autentikasi                          | `CI_Controller` |
| `Agenda`         | `/agenda`                                       | Frontend agenda untuk pelapor        | `CI_Controller` |
| `Agenda_Mediasi` | `/agenda_mediasi`                               | Backend CRUD agenda (admin/mediator) | `MY_Controller` |
| `Dashboard`      | `/dashboard`                                    | Dashboard statistik                  | `MY_Controller` |
| `Laporan`        | `/laporan`                                      | CRUD laporan mediasi                 | `MY_Controller` |
| `Mediator`       | `/mediator`                                     | CRUD mediator (admin)                | `MY_Controller` |
| `User`           | `/user`                                         | CRUD pengguna (admin)                | `MY_Controller` |
| `Profile`        | `/profile`                                      | Edit profil & password               | `CI_Controller` |
| `Cetak`          | `/cetak/laporan`                                | Export PDF                           | `CI_Controller` |
| `Arsip`          | `/arsip`                                        | Halaman arsip                        | `CI_Controller` |
| `Kontak`         | `/kontak`                                       | Halaman kontak                       | `CI_Controller` |

### Models

| Model             | Tabel                                   | Fungsi                    |
| ----------------- | --------------------------------------- | ------------------------- |
| `Auth_model`      | `users`, `admin`, `pelapor`, `mediator` | Login, register, cek role |
| `Agenda_model`    | `agenda_mediasi`                        | CRUD agenda               |
| `Laporan_model`   | `laporan_mediasi`                       | CRUD laporan              |
| `Mediator_model`  | `mediator`, `users`                     | CRUD mediator             |
| `User_model`      | `users` + role tables                   | CRUD user multi-role      |
| `Dashboard_model` | All tables                              | Statistik agregat         |
| `Profile_model`   | All tables                              | Ambil/update profil       |

### Views

```
views/
├── auth/              # Login, register
├── frontend/
│   ├── pages/         # home, agenda, agenda_detail, arsip, kontak, profile
│   └── partials/      # header, footer (Bingo Theme)
├── backend/
│   ├── agenda/        # view, add, edit
│   ├── laporan/       # view, add, edit
│   ├── mediator/      # view, add, edit
│   ├── user/          # view, add, edit, edit_user
│   ├── profile/       # view
│   ├── pdf/           # template laporan PDF
│   └── partials/      # header, footer (SB Admin 2)
```

---

## Struktur Direktori

```
disnaker-agenda/
├── index.php                 # Entry point CodeIgniter
├── .htaccess                 # URL rewriting (Apache)
├── composer.json             # Dependencies
├── disnaker.sql              # Database dump
├── README.md
├── system/                   # CodeIgniter system core
├── application/
│   ├── config/               # Konfigurasi (database, routes, session)
│   ├── core/                 # MY_Controller.php (base controller)
│   ├── controllers/          # 14 Controller files
│   ├── models/               # 7 Model files
│   ├── views/                # Template views
│   ├── helpers/              # Custom helpers
│   ├── libraries/            # Custom libraries
│   └── hooks/                # Hooks
├── api/                      # 24 REST API scripts (standalone PHP)
├── assets/                   # CSS, JS, images, sbadmin, plugins
├── uploads/                  # File uploads (foto profil, PDF agenda)
└── vendor/                   # Composer packages
```

---

## Database

### Entity Relationship

```
users (id, nama, email, password)
  ├── admin (id, id_user → users.id, nama, telp)
  ├── mediator (id_mediator, id_users → users.id, nama, nip, bidang, telp, email)
  └── pelapor (id_laporan, id_user → users.id, nama, perusahaan, alamat)

agenda_mediasi (id, id_mediator → mediator.id_mediator,
                id_pelapor → users.id, nomor_mediasi,
                nama_pihak1, nama_pihak2, nama_kasus, jenis_kasus,
                tgl_mediasi, waktu_mediasi, tempat,
                status [diproses|disetujui|ditolak],
                deskripsi_kasus, file_pdf)

laporan_mediasi (id_laporan, id_agenda → agenda_mediasi.id,
                  nama_pihak_satu, nama_pihak_dua, nama_mediator,
                  tgl_agenda, tgl_penutupan, jenis_kasus,
                  status [selesai|gagal|dilanjut ke pengadilan],
                  hasil_mediasi)
```

### Relasi

- `users` → `admin`: one-to-one via `id_user`
- `users` → `mediator`: one-to-one via `id_users`
- `users` → `pelapor`: one-to-one via `id_user`
- `mediator` → `agenda_mediasi`: one-to-many via `id_mediator`
- `pelapor` → `agenda_mediasi`: one-to-many via `id_pelapor`
- `agenda_mediasi` → `laporan_mediasi`: one-to-one via `id_agenda`

---

## API

Folder `api/` berisi 24 script **standalone** PHP (tidak melalui routing CI) yang menyediakan REST-like JSON endpoint.

### Endpoints

| Endpoint                      | Method | Fungsi                          |
| ----------------------------- | ------ | ------------------------------- |
| `login.php`                   | POST   | Autentikasi user                |
| `post_pelapor.php`            | POST   | Registrasi pelapor              |
| `post_agenda_mediasi.php`     | POST   | Buat agenda baru                |
| `post_laporan_mediasi.php`    | POST   | Buat laporan mediasi            |
| `get_all_agenda.php`          | GET    | Semua agenda                    |
| `get_all_agenda_mediator.php` | POST   | Agenda per mediator             |
| `get_agenda_mediator.php`     | POST   | Agenda mediator tertentu        |
| `get_agenda_pelapor.php`      | POST   | Agenda per pelapor              |
| `get_all_laporan.php`         | GET    | Semua laporan                   |
| `get_all_mediator.php`        | GET    | Semua mediator                  |
| `get_detail_pelaporan.php`    | POST   | Detail satu kasus               |
| `get_spinner_agenda.php`      | POST   | Agenda tanpa laporan (dropdown) |
| `get_profile.php`             | POST   | Profil user                     |
| `update_profile.php`          | POST   | Update profil (multipart)       |
| `update_agenda_admin.php`     | POST   | Admin assign mediator           |
| `update_agenda_mediator.php`  | POST   | Mediator update status          |
| `delete_mediasi.php`          | POST   | Hapus agenda                    |
| `delete_laporan.php`          | POST   | Hapus laporan                   |
| `get_stats_mediator.php`      | POST   | Statistik bulanan mediator      |
| `get_stats_pelapor.php`       | POST   | Statistik bulanan pelapor       |
| `get_mediator_total_data.php` | POST   | Total tahunan per mediator      |
| `get_pelapor_total_data.php`  | POST   | Total tahunan per pelapor       |

---

## Instalasi

### Prasyarat

- PHP >= 5.3.7
- MySQL / MariaDB
- Apache dengan mod_rewrite
- Composer

### Langkah Instalasi

1. **Clone atau extract project** ke `C:/laragon/www/disnaker-agenda/`

2. **Import database**

   ```sql
   mysql -u root -p < disnaker.sql
   ```

3. **Konfigurasi database**
   Edit `application/config/database.php`:

   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',
   'database' => 'disnaker_agenda',
   ```

4. **Install dependencies**

   ```bash
   composer install
   ```

5. **Akses aplikasi**
   ```
   http://localhost/disnaker-agenda/
   ```

### Default Login

| Role     | Email                     | Password |
| -------- | ------------------------- | -------- |
| Admin    | (sesuai data di database) | -        |
| Mediator | (sesuai data di database) | -        |

> Akun awal dapat dicek melalui tabel `users` di database.

---

## Code Quality

Proyek ini telah direfaktor mengikuti prinsip **clean code** dan **best practices**:

### Base Controller (`MY_Controller`)

Semua controller backend (kecuali yang publik) mewarisi `MY_Controller` yang menyediakan:

- **`_check_access(array $roles)`** — cek autentikasi dan role di satu tempat, tidak lagi diulang di tiap method
- **`_load_backend_view($view, $data)`** — load header + konten + footer backend secara konsisten

### Standar Kode

| Praktik                    | Keterangan                                                                                                                                                                                                  |
| -------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Naming convention**      | Semua method menggunakan `snake_case`                                                                                                                                                                       |
| **Return type**            | Semua method model mengembalikan `array` (`row_array`/`result_array`), tidak ada campuran object                                                                                                            |
| **DRY**                    | Tidak ada kode duplikat — logic profile disatukan di `Profile_model::get_user_profile_data()`, upload file diekstrak ke method terpisah                                                                     |
| **Separation of concerns** | Tidak ada query `$this->db` langsung di controller — semua melalui model                                                                                                                                    |
| **Access control**         | Setiap method backend memiliki pengecekan akses yang sesuai, termasuk `Agenda_Mediasi::add/edit/delete`                                                                                                     |
| **Security**               | Password di-hash dengan bcrypt (`password_hash`/`PASSWORD_BCRYPT`), nomor mediasi menggunakan timestamp (bukan random yang mudah tabrakan)                                                                  |
| **Dead code**              | Tidak ada method yang tidak terpakai — `save_agenda()`, `edit_agenda()`, `login()` (di model), `updateAdmin()`, `updateMediator()`, `updateUser()`, `getUserProfile()`, `get_profile_image()` telah dihapus |

### Struktur Controller

```
class Agenda_mediasi extends MY_Controller         # ← Base controller
{
    public function index()
    {
        $this->_check_access(['admin', 'mediator']);  # ← Cek akses 1 baris
        $data['agendas'] = $this->Agenda_model->get_agendas();
        $this->_load_backend_view('backend/agenda/view', $data); # ← Load view
    }
}
```

Perbaikan dari kode sebelumnya:

| Sebelum                                                    | Sesudah                                                               |
| ---------------------------------------------------------- | --------------------------------------------------------------------- |
| Blok `if (!$this->session...)` diulang 8+ controller       | `_check_access()` di `MY_Controller`                                  |
| `Profile::index()` dan `Profile::profile()` hampir identik | `_get_profile_data()` untuk reuse, `get_user_profile_data()` di model |
| `Laporan::add()` query langsung `$this->db`                | Semua query via `Laporan_model::get_approved_agendas()`               |
| Nomor mediasi `rand(1000, 9999)` — hanya 9000 kemungkinan  | `date('YmdHis')` — unik per detik                                     |
| Method duplikat camelCase + snake_case di `User_model`     | Hanya snake_case, tanpa duplikasi                                     |
| `Agenda_Mediasi::add/edit/delete` tanpa akses control      | `_check_access(['admin', 'mediator'])`                                |

---

## License

MIT License — lihat [license.txt](license.txt).
