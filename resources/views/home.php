<?php ob_start(); ?>
<div class="jumbotron"><h1 class="display-4">Website Data Mahasiswa</h1><p class="lead">Implementasi Laravel dengan SQLite.</p><a class="btn btn-primary btn-lg" href="/mahasiswa">Lihat Data Mahasiswa</a></div>
<?php $content = ob_get_clean(); $title = 'Home'; require __DIR__ . '/layouts/app.php'; ?>
