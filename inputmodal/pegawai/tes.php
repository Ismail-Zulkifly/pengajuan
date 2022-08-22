<?php
include '../koneksi.php';
// $connect = mysqli_connect("localhost", "root", "", "pengajuan");
$query = "SELECT * FROM pegawai ORDER BY nip ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
</head>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_data_Modal">Tambah Data +</button>
            <form class="d-flex" style="margin-bottom: 10px ;" role="search">
                <input id="keyword" type="text" name="keyword" class="form-control me-2" style="margin-left: 70%;" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" name="cari" id="btnfind" type="submit">Search</button>
            </form>

            <!-- panggil tabel -->
            <div class="" id="data"></div>
            <!-- batas -->
        </div>
    </div>
</body>
<!-- Modal input data -->
<div class="modal fade" id="add_data_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- batas input -->

<!-- Modal view -->
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detail_karyawan">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="form_edit">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>

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
</script>