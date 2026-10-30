<?php
require_once 'koneksi.php';
require_once 'lang.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
$data = mysqli_fetch_assoc($result);
if (!$data) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = trim(htmlspecialchars($_POST['nim']));
    $nama    = trim(htmlspecialchars($_POST['nama']));
    $jurusan = trim(htmlspecialchars($_POST['jurusan']));
    $email   = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    if (empty($nim) || empty($nama) || empty($jurusan) || empty($email)) {
        $error = __('err_empty');
    } else {
        $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan', email='$email' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?pesan=" . urlencode(__('success_update')));
            exit;
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <title><?= __('edit') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4"><?= __('edit') ?> Data Mahasiswa</h3>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><?= __('nim') ?></label>
                        <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= __('nama') ?></label>
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= __('jurusan') ?></label>
                        <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($data['jurusan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= __('email') ?></label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= __('update') ?></button>
                    <a href="index.php" class="btn btn-secondary"><?= __('back') ?></a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>