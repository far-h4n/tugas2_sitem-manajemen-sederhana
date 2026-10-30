<?php
require_once 'koneksi.php';
require_once 'lang.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    header("Location: index.php?pesan=" . urlencode(__('success_delete')));
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>