 <script>
     $('#update_form').on("submit", function(event) {
         event.preventDefault();
         if ($('#enama').val() == "") {
             alert("Mohon Isi Nama ");
         } else if ($('#enip').val() == '') {
             alert("Mohon Isi NIP");
         } else if ($('#esatker').val() == '') {
             alert("Mohon Isi Satuan Kerja");
         } else if ($('#ejenkel').val() == '') {
             alert("Mohon Isi Jenis Kelamin");
         } else if ($('#easal').val() == '') {
             alert("Mohon Isi Asal Daerah");
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
        $query = "SELECT * FROM pegawai WHERE id_peg = '" . $_POST["employee_id"] . "'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result);
        $output .= '
         <form method="post" id="update_form">
     <label>Nama Pegawai</label>
     <input type="hidden" name="id" id="id" value="' . $_POST["employee_id"] . '" class="form-control" />
     <input type="text" name="nama" id="enama" value="' . $row['nama'] . '" class="form-control" />
     <br />
     <label>NIP Pegawai</label>
     <textarea name="nip" id="enip" class="form-control">' . $row['nip'] . '</textarea>
     <br />
     <label>Satuan Kerja</label>
     <select name="satker" id="esatker" class="form-control">';
        if ($row['satker'] == "Kota Gorontalo") {
            $output .= '<option value="Kota Gorontalo" selected>Kota Gorontalo</option>  
      <option value="Kab. Gorontalo">Kab. Gorontalo</option>
      <option value="Kab. Gorontalo Utara">Kab. Gorontalo Utara</option>
      <option value="Kab. Boalemo">Kab. Boalemo</option>
      <option value="Kab. Bonebolango">Kab. Bonebolango</option>
      <option value="Kab. Pohuwato">Kab. Pohuwato</option>';
        } elseif ($row['satker'] == "Kab. Boalemo") {
            $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
      <option value="Kab. Gorontalo">Kab. Gorontalo</option>  
      <option value="Kab. Gorontalo Utara">Kab. Gorontalo Utara</option>  
      <option value="Kab. Bonebolango">Kab. Bonebolango</option>  
      <option value="Kab. Pohuwato">Kab. Pohuwato</option>  
      <option value="Kab. Boalemo" selected>Kab. Boalemo</option>';
        } elseif ($row['satker'] == "Kab. Pohuwato") {
            $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kab. Gorontalo">Kab. Gorontalo</option>  
     <option value="Kab. Gorontalo Utara">Kab. Gorontalo Utara</option>  
     <option value="Kab. Bonebolango">Kab. Bonebolango</option>  
     <option value="Kab. Boalemo">Kab. Boalemo</option>  
     <option value="Kab. Pohuwato" selected>Kab. Pohuwato</option>';
        } elseif ($row['satker'] == "Kab. Gorontalo Utara") {
            $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kab. Gorontalo">Kab. Gorontalo</option>  
     <option value="Kab. Pohuwato">Kab. Pohuwato</option>  
     <option value="Kab. Bonebolango">Kab. Bonebolango</option>  
     <option value="Kab. Boalemo">Kab. Boalemo</option>  
     <option value="Kab. Gorontalo Utara" selected>Kab. Gorontalo Utara</option>';
        } elseif ($row['satker'] == "Kab. Bonebolango") {
            $output .= '<option value="Kota Gorontalo">Kota Gorontalo</option>  
     <option value="Kab. Gorontalo">Kab. Gorontalo</option>  
     <option value="Kab. Gorontalo Utara">Kab. Gorontalo Utara</option>  
     <option value="Kab. Bonebolango">Kab. Bonebolango</option>  
     <option value="Kab. Boalemo">Kab. Boalemo</option>  
     <option value="Kab. Bonebolango" selected>Kab. Bonebolango</option>';
        } else {
            $output .= '<option value="Kab. Gorontalo">Kab. Gorontalo</option>
            <option value="Kota Gorontalo">Kota Gorontalo</option>  
            <option value="Kab. Gorontalo Utara">Kab. Gorontalo Utara</option>  
            <option value="Kab. Boalemo">Kab. Boalemo</option>  
            <option value="Kab. Bonebolango">Kab. Bonebolango</option>  
            <option value="Kab. Pohuwato">Kab. Pohuwato</option>';
        }
        $output .= '</select>
     <br />
     <label>Jenis Kelamin</label>
     <select name="jenkel" id="ejenkel" class="form-control">';
        if ($row['jenkel'] == "Pria") {
            $output .= '<option value="pria" selected>Pria</option>  
      <option value="wanita">Wanita</option>';
        } elseif ($row['jenkel'] == "wanita") {
            $output .= '<option value="pria">Pria</option>  
      <option value="wanita" selected>Wanita</option>';
        } else {
            $output .= '<option value="pria">Pria</option>  
      <option value="wanita">Wanita</option>';
        }
        $output .= '</select>
     <br />  
     <label>Asal</label>
     <input type="text" name="asal" id="easal" value="' . $row['asal'] . '" class="form-control" />
     <br />
     <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />

    </form>
     ';
        echo $output;
    }
    ?>