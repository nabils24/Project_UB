<?php
// Koneksi database db_inventory dengan user root dan password kosong
$conn = mysqli_connect('localhost', 'root', '', 'db_inventory');
// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
