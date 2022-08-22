<?php
include '../koneksi.php';
// $connect = mysqli_connect("localhost", "root", "", "pengajuan");
$query = "SELECT * FROM pegawai ORDER BY nip ASC";
$result = mysqli_query($koneksi, $query);
// $username = $_POST['user'];
// $adm = "SELECT * FROM user where user='$username'";

// session_start();
// // cek apakah yang mengakses halaman ini sudah login
// if ($_SESSION['level'] == "") {
//   header("location:index.php?pesan=gagal");
// }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tutorial Popup Input Data Dengan PHP | www.sistemit.com </title>
  <script src="../js/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>

<body>
  <!-- <p>Halo <b><?php echo $_SESSION['user']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p> -->
  <div class="container" style="width:700px;">

    <h3 align="center">Input Data Dengan Menggunakan Popup Modal Bootstrap</h3>
    <br />

    <div class="table-responsive">
      <div align="left">
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Tambah Data Karyawan</button>
        <form class="form-inline my-2 my-lg-0 pt-2 pl-3 pb-5" style="padding-top:10px ;">
          <input id="keyword" type="text" name="keyword" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" name="cari" id="btnfind" type="submit">Search</button>
        </form>
      </div>
      <br />
    </div>
    <!-- <div id="employee_table"> -->
    <div class="table-responsive" id="data"></div>

  </div>
  </div>

  </div>
</body>

</html>

<div id="add_data_Modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Input Data Dengan Menggunakan Modal Bootstrap</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">
          <label>Nama Pegawai</label>
          <input type="text" name="nama" id="nama" class="form-control" />
          <br />
          <label>NIP</label>
          <input type="text" name="nip" id="nip" class="form-control"></input>
          <br />
          <label>Satuan Kerja</label>
          <select name="satker" id="satker" class="form-control">
            <option value="">
            </option>
            <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>
            <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>
            <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>
            <option value="Kabupaten Bone Bolango">Kabupaten Bone Bolango</option>
            <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>
            <option value="Kota Gorontalo">Kota Gorontalo</option>
          </select>

          <label>Jenis Kelamin</label>
          <select name="jenkel" id="jenkel" class="form-control">
            <option value="pria">Pria</option>
            <option value="wanita">wanita</option>
          </select>
          <br />
          <label>Asal</label>
          <input type="text" name="asal" id="asal" class="form-control" />
          <br />
          <label>Tanggal Lahir</label>
          <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control" />
          <br />
          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="dataModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Data Karyawan</h4>
      </div>
      <div class="modal-body" id="detail_karyawan">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="editModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Data Karyawan</h4>
      </div>
      <div class="modal-body" id="form_edit">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  $(document).ready(function() {
    
  });
</script> -->

<script>
  $(document).ready(function() {
    load_data();

    function load_data(page) {
      $.ajax({
        url: "tabel.php",
        method: "POST",
        data: {
          page: page
        },
        success: function(data) {
          $('#data').html(data);
        }
      })
    }
    $(document).on('click', '.halaman', function() {
      var page = $(this).attr("id");
      load_data(page);
    });
    // Begin Aksi Insert
    $('#insert_form').on("submit", function(event) {
      event.preventDefault();
      if ($('#nama').val() == "") {
        alert("Mohon Isi Nama ");
      } else if ($('#nip').val() == '') {
        alert("Mohon Isi nip");
      } else {
        $.ajax({
          url: "insert.php",
          method: "POST",
          data: $('#insert_form').serialize(),
          beforeSend: function() {
            $('#insert').val("Inserting");
          },
          success: function(data) {
            $('#insert_form')[0].reset();
            $('#add_data_Modal').modal('hide');
            let timerInterval
            Swal.fire({
              title: 'Data Berhasil disimpan',
              timer: 1000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
              }
            })
            $('#data').html(data);
            load_data();
          }
        });
      }
    });

    //END Aksi Insert

    //Begin Tampil Detail Karyawan
    $(document).on('click', '.view_data', function() {
      var employee_id = $(this).attr("id");
      $.ajax({
        url: "select.php",
        method: "POST",
        data: {
          employee_id: employee_id
        },
        success: function(data) {
          $('#detail_karyawan').html(data);
          $('#dataModal').modal('show');
        }
      });
    });
    //End Tampil Detail Karyawan

    //Begin Tampil Form Edit
    $(document).on('click', '.edit_data', function() {
      var employee_id = $(this).attr("id");
      $.ajax({
        url: "edit.php",
        method: "POST",
        data: {
          employee_id: employee_id
        },
        success: function(data) {
          $('#form_edit').html(data);
          $('#editModal').modal('show');
        }
      });
    });
    //End Tampil Form Edit

    //Begin Aksi Delete Data
    $(document).on('click', '.hapus_data', function() {
      var employee_id = $(this).attr("id");
      $.ajax({
        url: "delete.php",
        method: "POST",
        data: {
          employee_id: employee_id
        },
        success: function(data) {
          let timerInterval
          Swal.fire({
            title: 'Data Berhasil Dihapus!',
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log('I was closed by the timer')
            }
          })
          $('#data').html(data);
          load_data();
        }
      });
    });
    //ajax cari
    $(document).on('click', '#btnfind', function(e) {
      e.preventDefault();
      var search = $('#keyword').val();

      $.ajax({
        url: "tabelcari.php",
        method: "POST",
        data: {
          search: search
        },
        success: function(data) {
          $('#data').html(data);

        }
      })
    });
  });
  //End Aksi Delete Data
</script>