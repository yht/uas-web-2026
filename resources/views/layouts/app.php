<?php $title = $title ?? 'Data Mahasiswa'; ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="/">Data Mahasiswa</a><div><a class="text-light mr-3" href="/">Home</a><a class="text-light" href="/mahasiswa">Mahasiswa</a></div></div></nav>
<main class="container mt-4">
<?php if (!empty($_SESSION['message'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></div><?php endif; ?>
<?= $content ?? '' ?>
</main>
</body>
</html>
