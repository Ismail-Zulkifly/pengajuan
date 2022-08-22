<?php
// $koneksi = mysqli_connect("localhost", "root", "", "pengajuan");
include '../koneksi.php';
$query = "SELECT * FROM user ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Admin</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css" class="">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- <script src="../js/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>
  <div class="container-fluid py-5">
    <div class="container">

      <div class="" id="data"></div>

    </div>
  </div>
  </tbody>
</body>
<!-- Modal input user-->
<div class="modal fade" id="add_data_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">
          <label>Username</label>
          <input type="text" name="user" id="user" class="form-control" />
          <br />
          <label>Password</label>
          <input type="text" name="pass" id="pass" class="form-control" />
          <br />
          <label>Level</label>
          <select name="level" id="level" class="form-control">
            <option value="">...</option>
            <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>
            <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>
            <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>
            <option value="Kabupaten Bone Bolango">Kabupaten Bone Bolango</option>
            <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>
            <option value="Kota Gorontalo">Kota Gorontalo</option>
          </select>
          <br />
          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="form_edit">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- batas modal -->
<script>
  $(document).ready(function() {
    var url = 'tabel.php';
    $('#data').load(url);
    // insert form
    $('#insert_form').on("submit", function(event) {
      event.preventDefault();
      if ($('#user').val() == "") {
        alert("Mohon Isi Username ");
      } else if ($('#pass').val() == '') {
        alert("Mohon Isi Password");
      } else if ($('#level').val() == '') {
        alert("Mohon Isi Level Admin");
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
            // load_data();
          }
        });
      }
    });
    // batas insert
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
    // edit modal
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
    // batas modal
  });
</script>

</html>