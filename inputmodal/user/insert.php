<?php
include '../koneksi.php';
if (!empty($_POST)) {
    $output = '';
    $user = mysqli_real_escape_string($koneksi, $_POST["user"]);
    $pass = mysqli_real_escape_string($koneksi, $_POST["pass"]);
    $level = mysqli_real_escape_string($koneksi, $_POST["level"]);
    $query = "
    INSERT INTO user (user, pass, level)  
     VALUES('$user', '$pass', '$level')
    ";
    if (mysqli_query($koneksi, $query)) {
        $output .= '<label class="text-success">Data Berhasil Masuk</label>';
        $select_query = "SELECT * FROM user ORDER BY id ASC";
        $result = mysqli_query($koneksi, $select_query);
        include 'tabel.php';
    } else {
        $output .= mysqli_error($koneksi);
    }
    echo $output;
}
