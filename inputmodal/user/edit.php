<script>
    $('#update_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#euser').val() == "") {
            alert("Mohon Isi Username ");
        } else if ($('#epass').val() == '') {
            alert("Mohon Isi Password");
        } else if ($('#elevel').val() == '') {
            alert("Mohon Isi Level Admin");
        } else {
            $.ajax({
                url: "update.php",
                method: "POST",
                data: $('#update_form').serialize(),
                beforeSend: function() {
                    $('#update').val("Updating");
                },
                success: function(data) {
                    $('#update_form')[0].reset();
                    $('#editModal').modal('hide');
                    let timerInterval
                    Swal.fire({
                        title: 'Data Berhasil Update!',
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
                },
                and: function(data) {
                    load_data();
                }
            });
        }
    });
</script>
<?php
if (isset($_POST["employee_id"])) {
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "pengajuan");
    $query = "SELECT * FROM user WHERE id = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $output .= '
         <form method="post" id="update_form">
     <label>Username Pegawai</label>
     <input type="hidden" name="id" id="id" value="' . $_POST["employee_id"] . '" class="form-control" />
     <input type="text" name="user" id="euser" value="' . $row['user'] . '" class="form-control" />
     <br />
     <label>Password Pegawai</label>
     <textarea name="pass" id="epass" class="form-control">' . $row['pass'] . '</textarea>
     <br />
     <label>Level Admin</label>
     <select name="level" id="elevel" class="form-control">';
    if ($row['level'] == "Kota Gorontalo") {
        $output .= '<option value="Kota Gorontalo" selected>Kota Gorontalo</option>  
      <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>
      <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>
      <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>
      <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>
      <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>';
    } elseif ($row['level'] == "Kabupaten Boalemo") {
        $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
      <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>  
      <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>  
      <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>  
      <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>  
      <option value="Kabupaten Boalemo" selected>Kabupaten Boalemo</option>';
    } elseif ($row['level'] == "Kabupaten Pohuwato") {
        $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>  
     <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>  
     <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>  
     <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>  
     <option value="Kabupaten Pohuwato" selected>Kabupaten Pohuwato</option>';
    } elseif ($row['level'] == "Kabupaten Gorontalo Utara") {
        $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>  
     <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>  
     <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>  
     <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>  
     <option value="Kabupaten Gorontalo Utara" selected>Kabupaten Gorontalo Utara</option>';
    } elseif ($row['level'] == "Kabupaten Bonebolango") {
        $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>  
     <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>  
     <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>  
     <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>  
     <option value="Kabupaten Bonebolango" selected>Kabupaten Bonebolango</option>';
    } else {
        $output .= '<option value="Kabupaten Gorontalo">Kabupaten Gorontalo</option>
            <option value="Kota Gorontalo">Kota Gorontalo</option>  
            <option value="Kabupaten Gorontalo Utara">Kabupaten Gorontalo Utara</option>  
            <option value="Kabupaten Boalemo">Kabupaten Boalemo</option>  
            <option value="Kabupaten Bonebolango">Kabupaten Bonebolango</option>  
            <option value="Kabupaten Pohuwato">Kabupaten Pohuwato</option>';
    }
    $output .= '</select>
     <br />
     <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />
    </form>
     ';
    echo $output;
}
?>