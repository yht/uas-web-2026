# Laravel App UAS

Implementasi aplikasi `ci-app` dengan pola dan struktur Laravel untuk
website data mahasiswa. Aplikasi ini menyediakan halaman Home serta CRUD data
mahasiswa menggunakan SQLite.

## Teknologi dan konfigurasi

- PHP `8.2.34` (Dev)
- Lokasi PHP: `C:\Appz\php-8.2.34-Win32-vs16-x64\php.exe` (Dev)
- Database: SQLite
- Driver: `PDO SQLite` dan `SQLite3`
- Server: PHP Built-in Server
- Port lokal: `8001`
- Tampilan: Bootstrap `4.6.2` melalui CDN
- Konfigurasi PHP: `..\php.ini`

```ini
extension=sqlite3
extension=pdo_sqlite
```

## Struktur aplikasi

```text
laravel-app-uas/
├── app/
│   ├── Http/Controllers/MahasiswaController.php
│   └── Models/Mahasiswa.php
├── database/
│   ├── database.sqlite
│   └── schema.sql
├── public/index.php
├── resources/views/
│   ├── layouts/app.php
│   ├── home.php
│   ├── mahasiswa/index.php
│   ├── mahasiswa/form.php
│   └── errors/404.php
├── routes/web.php
├── composer.json
└── start.bat
```

## Database

Database berada di `database/database.sqlite`. File dan tabel `mahasiswa`
dibuat otomatis saat aplikasi pertama kali dijalankan.

Struktur tabel:

| Kolom | Keterangan |
|---|---|
| `id` | Primary key autoincrement |
| `nama` | Nama mahasiswa |
| `nrp` | Nomor registrasi, berupa teks numerik |
| `email` | Alamat email |
| `jurusan` | Program studi |

Data awal berisi empat mahasiswa yang diambil dari proyek CodeIgniter.

## Route aplikasi

| Metode | URL | Fungsi |
|---|---|---|
| GET | `/` | Halaman Home |
| GET | `/mahasiswa` | Daftar mahasiswa |
| GET | `/mahasiswa/tambah` | Form tambah data |
| POST | `/mahasiswa` | Menyimpan data baru |
| GET | `/mahasiswa/{id}/edit` | Form ubah data |
| POST | `/mahasiswa/{id}` | Menyimpan perubahan |
| POST | `/mahasiswa/{id}/hapus` | Menghapus data |

## Fitur

- Menampilkan data mahasiswa.
- Menambah, mengubah, dan menghapus data.
- Validasi semua field wajib diisi.
- Validasi NRP harus numerik.
- Validasi email harus valid.
- Pesan sukses menggunakan session flash message.
- Halaman 404 untuk route atau data yang tidak ditemukan.
- Query database menggunakan prepared statement PDO.

## Menjalankan aplikasi

Cara termudah adalah membuka `start.bat`.

Aplikasi dapat diakses melalui `http://localhost:8001/`.

Yang perlu disesuaikan:

- set PHP_DIR
- set APP_DIR

