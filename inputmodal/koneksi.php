<?php
//index.php
$koneksi = mysqli_connect("localhost", "root", "", "pengajuan");
// $query = "SELECT * FROM pegawai ORDER BY nip ASC";
// $result = mysqli_query($connect, $query);

// cek koneksi
if (mysqli_connect_errno()) {
    echo "koneksi gagal : " . mysqli_connect_error();
}
