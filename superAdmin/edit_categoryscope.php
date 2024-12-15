<?php
require 'functions.php'; // Memastikan koneksi ke database sudah ada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form yang dikirim
    $id = $_POST['edit_id'];
    $category = trim($_POST['edit_category']);

    // Validasi: Pastikan semua field terisi
    if (empty($category)) {
        // Jika ada field yang kosong, redirect dengan pesan error
        header('Location: listcategoryscope.php?warning=Fields cannot be empty');
        exit;
    }

    // Check apakah ada dari database
    $query = "SELECT * FROM category_scope WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Query untuk memperbarui data pengguna di database
        $updateQuery = "UPDATE category_scope SET id = '$id', name_category = '$category'";

        // Menjalankan query
        if ($conn->query($updateQuery) === TRUE) {
            // Jika berhasil, redirect ke halaman sukses
            header('Location: listcategoryscope.php?success=category_updated');
        } else {
            // Jika gagal, redirect dengan pesan error
            header('Location: listcategoryscope.php?warning=update_failed');
        }
    } else {
        // Jika tidak ada pengguna ditemukan, redirect dengan pesan error
        header('Location: listcategoryscope.php?warning=category_not_found');
    }
} else {
    // Jika bukan permintaan POST, redirect dengan pesan error
    header('Location: listcategoryscope.php?error=invalid_request');
}
