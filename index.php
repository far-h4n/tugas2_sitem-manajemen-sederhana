<?php
require_once 'koneksi.php';
require_once 'lang.php';

// Proteksi halaman dengan session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <title><?= __('dashboard') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><?= __('title') ?></a>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <a href="?lang=id" class="text-light text-decoration-none <?= $_SESSION['lang']=='id'?'fw-bold text-warning':'' ?>">ID</a> | 
                    <a href="?lang=en" class="text-light text-decoration-none <?= $_SESSION['lang']=='en'?'fw-bold text-warning':'' ?>">EN</a>
                </div>
                <span class="text-light me-3">Admin: <?= $_SESSION['username'] ?></span>
                <a href="logout.php" class="btn btn-danger btn-sm"><?= __('logout') ?></a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><?= __('dashboard') ?></h2>
            <a href="create.php" class="btn btn-success"><?= __('add_data') ?></a>
        </div>

        <?php if (isset($_GET['pesan'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['pesan']) ?></div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th><?= __('nim') ?></th>
                            <th><?= __('nama') ?></th>
                            <th><?= __('jurusan') ?></th>
                            <th><?= __('email') ?></th>
                            <th><?= __('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jurusan']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><?= __('edit') ?></a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><?= __('delete') ?></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>