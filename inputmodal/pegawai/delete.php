<?php
include '../koneksi.php';
if (isset($_POST["employee_id"])) {
    $output = '';
    $query = "
    DELETE from pegawai where id_peg = '" . $_POST["employee_id"] . "'
    ";
    if (mysqli_query($koneksi, $query)) {
        $output .= '<label class="text-success">Data Berhasil Dihapus</label>';
        $select_query = "SELECT * FROM pegawai ORDER BY id_peg ASC";
        $result = mysqli_query($koneksi, $select_query);
        include 'tabel.php';
    } else {
        $output .= mysqli_error($koneksi);
    }
    echo $output;
}
