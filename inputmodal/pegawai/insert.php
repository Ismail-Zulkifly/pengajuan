<?php
include '../koneksi.php';
if (!empty($_POST)) {
    $output = '';
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $nip = mysqli_real_escape_string($koneksi, $_POST["nip"]);
    $satker = mysqli_real_escape_string($koneksi, $_POST["satker"]);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST["jenkel"]);
    $asal = mysqli_real_escape_string($koneksi, $_POST["asal"]);
    $tgl_lhr = mysqli_real_escape_string($koneksi, $_POST["tgl_lhr"]);
    $query = "
    INSERT INTO pegawai(nama, nip, satker, jenkel, asal, tgl_lhr)  
     VALUES('$nama', '$nip', '$satker', '$jenkel', '$asal', '$tgl_lhr')
    ";
    if (mysqli_query($koneksi, $query)) {
        $output .= '<label class="text-success">Data Berhasil Masuk</label>';
        $select_query = "SELECT * FROM pegawai ORDER BY id_peg ASC";
        $result = mysqli_query($koneksi, $select_query);
        include 'tabel.php';
    } else {
        $output .= mysqli_error($koneksi);
    }
    echo $output;
}
