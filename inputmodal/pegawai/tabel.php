<?php include '../koneksi.php'; ?>

<div id="employee_table">
    <table id="table_peg" class="table table-bordered text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Pegawai</th>
            <th class="text-center">Satuan Kerja</th>
            <th class="text-center">Lihat Detail</th>
            <th class="text-center">aksi</th>
        </tr>
        <tbody>

            <?php
            $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
            $limit = 6;
            $limit_start = ($page - 1) * $limit;
            $no = $limit_start + 1;

            $query = "SELECT * FROM pegawai ORDER BY id_peg ASC LIMIT $limit_start, $limit";
            $tabel1 = $koneksi->prepare($query);
            $tabel1->execute();
            $res1 = $tabel1->get_result();
            while ($row = $res1->fetch_assoc()) {

            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["satker"]; ?></td>
                    <td><input type="button" name="view" value="Lihat Detail" id="<?php echo $row["id_peg"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id_peg"]; ?>" class="btn btn-warning btn-xs edit_data" />
                        <input type="button" name="delete" value="Hapus" id="<?php echo $row["id_peg"]; ?>" class="btn btn-danger btn-xs hapus_data" />
                    </td>
                </tr>
            <?php
                $no++;
            }

            ?>
        </tbody>
    </table>

    <?php
    $query_jumlah = "SELECT count(*) AS jumlah FROM pegawai";
    $tabel1 = $koneksi->prepare($query_jumlah);
    $tabel1->execute();
    $res1 = $tabel1->get_result();
    $row = $res1->fetch_assoc();
    $total_records = $row['jumlah'];
    ?>
    <p>Total Pegawai : <?php echo $total_records; ?></p>
    <nav class="mb-5">
        <ul class="pagination justify-content-end">
            <?php
            $jumlah_page = ceil($total_records / $limit);
            $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;



            if ($page == 1) {
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $link_prev = ($page > 1) ? $page - 1 : 1;
                echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? ' active' : '';
                echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
            }

            if ($page == $jumlah_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
                $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
            }
            ?>
        </ul>
    </nav>