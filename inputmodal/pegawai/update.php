<?php
include '../koneksi.php';
if (!empty($_POST)) {
    $output = '';
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $nip = mysqli_real_escape_string($koneksi, $_POST["nip"]);
    $satker = mysqli_real_escape_string($koneksi, $_POST["satker"]);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST["jenkel"]);
    $asal = mysqli_real_escape_string($koneksi, $_POST["asal"]);
    $query = "
    update pegawai set nama = '$nama', nip = '$nip', satker ='$satker', jenkel ='$jenkel', asal='$asal' where id_peg = '$_POST[id]'
    ";

    if (mysqli_query($koneksi, $query)) {
        $output .= '<label class="text-success">Data Berhasil Diupdate</label>';
        $select_query = "SELECT * FROM pegawai ORDER BY id_peg ASC";
        $result = mysqli_query($koneksi, $select_query);
        //memanggil tabel.php
        $tb = include 'tabel.php';
    } else {
        $output .= mysqli_error($koneksi);
    }
    echo $output;
}
