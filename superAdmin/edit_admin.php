<?php
require 'functions.php'; // Memastikan koneksi ke database sudah ada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form yang dikirim
    $uuid = $_POST['edit_uuid'];
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];
    $role = $_POST['edit_role'];

    // Validasi: Pastikan semua field terisi
    if (empty($uuid) || empty($id) || empty($username) || empty($role)) {
        // Jika ada field yang kosong, redirect dengan pesan error
        header('Location: listadmin.php?warning=Fields cannot be empty');
        exit;
    }

    // Ambil password lama dari database
    $query = "SELECT password FROM users WHERE uuid = '$uuid'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $oldPassword = $row['password'];

        // Jika password baru diisi, gunakan password baru, jika tidak, gunakan password lama
        $hashedPassword = !empty($password) ? md5($password) : $oldPassword;

        // Query untuk memperbarui data pengguna di database
        $updateQuery = "UPDATE users SET id = '$id', username = '$username', password = '$hashedPassword', role = '$role' WHERE uuid = '$uuid'";

        // Menjalankan query
        if ($conn->query($updateQuery) === TRUE) {
            // Jika berhasil, redirect ke halaman sukses
            header('Location: listadmin.php?success=admin_updated');
        } else {
            // Jika gagal, redirect dengan pesan error
            header('Location: listadmin.php?warning=update_failed');
        }
    } else {
        // Jika tidak ada pengguna ditemukan, redirect dengan pesan error
        header('Location: listadmin.php?warning=admin_not_found');
    }
} else {
    // Jika bukan permintaan POST, redirect dengan pesan error
    header('Location: listadmin.php?error=invalid_request');
}