CREATE TABLE IF NOT EXISTS mahasiswa (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    nrp TEXT NOT NULL,
    email TEXT NOT NULL,
    jurusan TEXT NOT NULL
);

INSERT INTO mahasiswa (nama, nrp, email, jurusan)
SELECT 'Andi Wijaya', '2021001', 'andi@example.com', 'Sistem Informasi'
WHERE NOT EXISTS (SELECT 1 FROM mahasiswa);

INSERT INTO mahasiswa (nama, nrp, email, jurusan)
SELECT 'Budi Santoso', '2021002', 'budi@example.com', 'Sistem Informasi'
WHERE (SELECT COUNT(*) FROM mahasiswa) = 1;

INSERT INTO mahasiswa (nama, nrp, email, jurusan)
SELECT 'Citra Lestari', '2021003', 'citra@example.com', 'Teknik Informatika'
WHERE (SELECT COUNT(*) FROM mahasiswa) = 2;

INSERT INTO mahasiswa (nama, nrp, email, jurusan)
SELECT 'Dewi Anggraini', '2021004', 'dewi@example.com', 'Sistem Informasi'
WHERE (SELECT COUNT(*) FROM mahasiswa) = 3;
