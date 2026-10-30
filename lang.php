<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'id';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['id', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
    $redirect = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $redirect);
    exit;
}

$translations = [
    'id' => [
        'title' => 'Sistem Informasi Mahasiswa',
        'login' => 'Login Admin',
        'username' => 'Nama Pengguna',
        'password' => 'Sandi',
        'btn_login' => 'Masuk',
        'logout' => 'Keluar',
        'dashboard' => 'Dashboard Data Mahasiswa',
        'add_data' => 'Tambah Data Mahasiswa',
        'nim' => 'NIM',
        'nama' => 'Nama Lengkap',
        'jurusan' => 'Jurusan',
        'email' => 'Email',
        'action' => 'Aksi',
        'save' => 'Simpan',
        'update' => 'Perbarui',
        'edit' => 'Edit',
        'delete' => 'Hapus',
        'back' => 'Kembali',
        'success_add' => 'Data mahasiswa berhasil ditambahkan!',
        'success_update' => 'Data mahasiswa berhasil diperbarui!',
        'success_delete' => 'Data mahasiswa berhasil dihapus!',
        'err_empty' => 'Semua kolom form wajib diisi!',
        'err_login' => 'Username atau password salah!'
    ],
    'en' => [
        'title' => 'Student Information System',
        'login' => 'Admin Login',
        'username' => 'Username',
        'password' => 'Password',
        'btn_login' => 'Login',
        'logout' => 'Logout',
        'dashboard' => 'Student Data Dashboard',
        'add_data' => 'Add Student Data',
        'nim' => 'Student ID (NIM)',
        'nama' => 'Full Name',
        'jurusan' => 'Major',
        'email' => 'Email',
        'action' => 'Action',
        'save' => 'Save',
        'update' => 'Update',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'back' => 'Back',
        'success_add' => 'Student data successfully added!',
        'success_update' => 'Student data successfully updated!',
        'success_delete' => 'Student data successfully deleted!',
        'err_empty' => 'All form fields must be filled!',
        'err_login' => 'Invalid username or password!'
    ]
];

function __($key) {
    global $translations;
    $lang = $_SESSION['lang'];
    return $translations[$lang][$key] ?? $key;
}
?>