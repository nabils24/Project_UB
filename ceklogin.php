<?php
require './config/koneksi.php';
session_start();


$nim = stripslashes($_POST['nim']);
$password = md5($_POST['password']);
$query = "SELECT * FROM users where id='$nim' AND password = '$password'";
$row = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($row);
$cek = mysqli_num_rows($row);


if ($cek > 0) {
    if ($data['role'] == 'admin') {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        header('location:admin');
    } else if ($data['role'] == 'kasir') {
        $_SESSION['role'] = 'kasir';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        header('location:kasir/transaksi.php');
    } else if ($data['role'] == 'superAdmin') {
        $_SESSION['role'] = 'superAdmin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        header('location:superAdmin');
    }
} else {
    $msg = 'Username Atau Password Salah';
    header('location:index.php?msg=' . $msg);
}
