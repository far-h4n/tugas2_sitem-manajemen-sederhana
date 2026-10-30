<?php
require_once 'koneksi.php';
require_once 'lang.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = __('err_login');
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <title><?= __('login') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 400px;">
        <div class="d-flex justify-content-end mb-3">
            <a href="?lang=id" class="btn btn-sm btn-outline-primary me-1 <?= $_SESSION['lang']=='id'?'active':'' ?>">ID</a>
            <a href="?lang=en" class="btn btn-sm btn-outline-secondary <?= $_SESSION['lang']=='en'?'active':'' ?>">EN</a>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4"><?= __('login') ?></h3>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><?= __('username') ?></label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= __('password') ?></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><?= __('btn_login') ?></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>