<?php

use App\Http\Controllers\MahasiswaController;

return [
    ['GET', '/', [MahasiswaController::class, 'home']],
    ['GET', '/mahasiswa', [MahasiswaController::class, 'index']],
    ['GET', '/mahasiswa/tambah', [MahasiswaController::class, 'create']],
    ['POST', '/mahasiswa', [MahasiswaController::class, 'store']],
    ['GET', '/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']],
    ['POST', '/mahasiswa/{id}', [MahasiswaController::class, 'update']],
    ['POST', '/mahasiswa/{id}/hapus', [MahasiswaController::class, 'destroy']],
];
