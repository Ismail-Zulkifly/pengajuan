<?php
include '../koneksi.php';
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_data_Modal">
    Tambah Data +
</button>

<table id="example" class="table table-striped text-center">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level Admin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM user where id";
        $no = 1;
        $tabel1 = $koneksi->prepare($query);
        $tabel1->execute();
        $res1 = $tabel1->get_result();
        while ($row = $res1->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['user']; ?></td>
                <td><?php echo $row['pass']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_data" />
                    <input type="button" name="delete" value="Hapus" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs hapus_data" /></input>
                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>