<!-- <?php
//mengaktifkan sesi pada php
session_start();
include 'koneksi.php';


// menangkap data yg dari form
$username = $_POST['user'];
$password = $_POST['pass'];

// seleksi data user dengan username dan password
$login = mysqli_query($koneksi, "select * from user where user='$username' and pass='$password'");
//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
// cek apakah user login sebagai admin
if ($data['level'] == "admin provinsi") {
    // buat session login dengan username
    $_SESSION['user'] = $username;
    $_SESSION['level'] = "admin provinsi";
    // alihkan ke halaman admin provinsi
    header("location:pegawai/index.php");

    // cek user login sebagai admin kabupaten
} else if ($data['level'] == "admin kabupaten") {
    // buat session login dengan username
    $_SESSION['user'] = $username;
    $_SESSION['level'] = "admin kabupaten";
    // alihkan ke halaman kabupaten
    header("location:kabupaten/index.php");
} else {
    // alihkan ke halaman login kembali
    header("location:index.php?pesan=gagal");
} -->
