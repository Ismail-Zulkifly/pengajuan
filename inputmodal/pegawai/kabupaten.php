<?php
$connect = mysqli_connect("localhost", "root", "", "pengajuan");
$query = "SELECT * FROM pegawai WHERE satker='kabupaten gorontalo' ORDER BY satker ASC";
$result = mysqli_query($connect, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>nip</th>
            <th>satker</th>
            <th>jenis kelamin</th>
            <th>asal</th>
            <th>aksi</th>
        </tr>
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'  . '</td>';    //menampilkan nomor urut
            echo '<td>' . $data['nama'] . '</td>';    //menampilkan data nim dari database
            echo '<td>' . $data['nip'] . '</td>';    //menampilkan data nama lengkap dari database
            echo '<td>' . $data['satker'] . '</td>';    //menampilkan data jenis kelamin dari database
            echo '<td>' . $data['jenkel'] . '</td>';    //menampilkan data alamat dari database
            echo '<td>' . $data['asal'] . '</td>';    //menampilkan data alamat dari database
            // echo '<td><a href="#edit" id="' . $data['nim'] . '" class="cedit">Edit</a> / <a href="#hapus" id="' . $data['nim'] . '" 
            // 		class = "chapus" >Hapus</a></td>';	//menampilkan link edit dan hapus dimana tiap link terdapat GET id -> ?id=siswa_id
            echo '</tr>';
        }

        ?>
    </table>
</body>

</html>