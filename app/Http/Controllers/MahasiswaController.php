<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use PDO;

class MahasiswaController
{
    public function __construct(private PDO $db) {}

    public function home(): void
    {
        view('home');
    }

    public function index(): void
    {
        view('mahasiswa.index', ['mahasiswa' => Mahasiswa::all($this->db)]);
    }

    public function create(): void
    {
        view('mahasiswa.form', ['judul' => 'Tambah Mahasiswa', 'mhs' => null, 'aksi' => '/mahasiswa']);
    }

    public function store(): void
    {
        $data = $this->validate($_POST);
        if ($data['errors']) {
            view('mahasiswa.form', ['judul' => 'Tambah Mahasiswa', 'mhs' => $data['input'], 'aksi' => '/mahasiswa', 'errors' => $data['errors']]);
            return;
        }
        Mahasiswa::create($this->db, $data['input']);
        redirect('/mahasiswa', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(int $id): void
    {
        $mhs = Mahasiswa::find($this->db, $id);
        if (!$mhs) { http_response_code(404); view('errors.404'); return; }
        view('mahasiswa.form', ['judul' => 'Ubah Mahasiswa', 'mhs' => $mhs, 'aksi' => "/mahasiswa/$id"]);
    }

    public function update(int $id): void
    {
        $mhs = Mahasiswa::find($this->db, $id);
        if (!$mhs) { http_response_code(404); view('errors.404'); return; }
        $data = $this->validate($_POST);
        if ($data['errors']) {
            view('mahasiswa.form', ['judul' => 'Ubah Mahasiswa', 'mhs' => $data['input'], 'aksi' => "/mahasiswa/$id", 'errors' => $data['errors']]);
            return;
        }
        Mahasiswa::update($this->db, $id, $data['input']);
        redirect('/mahasiswa', 'Data mahasiswa berhasil diubah.');
    }

    public function destroy(int $id): void
    {
        if (!Mahasiswa::find($this->db, $id)) { http_response_code(404); view('errors.404'); return; }
        Mahasiswa::delete($this->db, $id);
        redirect('/mahasiswa', 'Data mahasiswa berhasil dihapus.');
    }

    private function validate(array $input): array
    {
        $input = array_map('trim', array_intersect_key($input, array_flip(['nama', 'nrp', 'email', 'jurusan'])));
        $errors = [];
        foreach (['nama' => 'Nama', 'nrp' => 'NRP', 'email' => 'Email', 'jurusan' => 'Jurusan'] as $field => $label) {
            if (($input[$field] ?? '') === '') $errors[] = "$label wajib diisi.";
        }
        if (($input['nrp'] ?? '') !== '' && !ctype_digit($input['nrp'])) $errors[] = 'NRP harus berupa angka.';
        if (($input['email'] ?? '') !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
        return ['input' => $input, 'errors' => $errors];
    }
}
