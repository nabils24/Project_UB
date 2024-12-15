<?php
require '../config/koneksi.php';
session_start();

if ($_SESSION) {
    if ($_SESSION['role'] == 'superAdmin') {
    } else {
        header('location:../index.php');
    }
} else {
    header('location:../index.php');
}


function ambildata($conn, $query)
{
    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }

        return $hasil;
    }
}
function ambilsatubaris($conn, $query)
{
    $db = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($db);
}
