<?php
$koneksi = mysqli_connect("localhost", "root", "", "laundry");

if (mysqli_connect_error()){
    echo "Gagal Koneksi Databasee". mysqli_connect_error();
}
?>