<?php
//select.php  
if (isset($_POST["employee_id"])) {
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "pengajuan");
    $query = "SELECT * FROM pegawai WHERE id_peg = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($connect, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
     <tr>  
            <td width="30%"><label>Nama Pegawai</label></td>  
            <td width="70%">' . $row["nama"] . '</td>  
        </tr>
        <tr>  
        <td width="30%"><label>NIP</label></td>  
        <td width="70%">' . $row["nip"] . '</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Satuan Kerja</label></td>  
    <td width="70%">' . $row["satker"] . '</td>  
</tr>
        <tr>  
            <td width="30%"><label>Jenis Kelamin</label></td>  
            <td width="70%">' . $row["jenkel"] . '</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Asal</label></td>  
            <td width="70%">' . $row["asal"] . '</td>  
        </tr>
      
        <tr>  
            <td width="30%"><label>Tanggal Lahir</label></td>  
            <td width="70%">' . $row["tgl_lhr"] . '</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
