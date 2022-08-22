<?php
include '../koneksi.php';
if (!empty($_POST)) {
    $output = '';
    $user = mysqli_real_escape_string($koneksi, $_POST["user"]);
    $pass = mysqli_real_escape_string($koneksi, $_POST["pass"]);
    $level = mysqli_real_escape_string($koneksi, $_POST["level"]);
    $query = "
    update user set user = '$user', pass = '$pass', level ='$level' where id = '$_POST[id]'
    ";

    if (mysqli_query($koneksi, $query)) {
        $output .= '<label class="text-success">Data Berhasil Diupdate</label>';
        $select_query = "SELECT * FROM user ORDER BY id ASC";
        $result = mysqli_query($koneksi, $select_query);
        //memanggil tabel.php
        $tb = include 'tabel.php';
    } else {
        $output .= mysqli_error($koneksi);
    }
    echo $output;
}
