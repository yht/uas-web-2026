<?php

namespace App\Models;

use PDO;

class Mahasiswa
{
    public static function all(PDO $db): array
    {
        return $db->query('SELECT * FROM mahasiswa ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(PDO $db, int $id): ?array
    {
        $query = $db->prepare('SELECT * FROM mahasiswa WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function create(PDO $db, array $data): void
    {
        $query = $db->prepare('INSERT INTO mahasiswa (nama, nrp, email, jurusan) VALUES (?, ?, ?, ?)');
        $query->execute([$data['nama'], $data['nrp'], $data['email'], $data['jurusan']]);
    }

    public static function update(PDO $db, int $id, array $data): void
    {
        $query = $db->prepare('UPDATE mahasiswa SET nama = ?, nrp = ?, email = ?, jurusan = ? WHERE id = ?');
        $query->execute([$data['nama'], $data['nrp'], $data['email'], $data['jurusan'], $id]);
    }

    public static function delete(PDO $db, int $id): void
    {
        $query = $db->prepare('DELETE FROM mahasiswa WHERE id = ?');
        $query->execute([$id]);
    }
}
