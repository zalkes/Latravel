<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        echo "
            <script>
                document.location.href = '../login_page/login.php';
            </script>
        ";
    }
    require "../database/koneksi.php";
    $search = $_GET['search'];
    $sql_select_destinasi = mysqli_query($conn, "SELECT * FROM destinasi WHERE judul LIKE '%$search%' OR subjudul LIKE '%$search%' OR deskripsi LIKE '%$search%'");

    $destinasi = [];
    while ($row_destinasi = mysqli_fetch_assoc($sql_select_destinasi)) {
        $destinasi[] = $row_destinasi;
    }

?>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Subjudul</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach($destinasi as $dest) : ?>
        <?php $direktori = "../database/foto_destinasi/" . $dest["foto"];?>
        <tr>
            <td><?= $i ?></td>
            <td><?php if ($dest["foto"] == "") {echo "Foto belum ada";} else {echo "<img src='$direktori' alt='Foto destinasi' class='gambar'>";} ?></td>
            <td><?php echo $dest["judul"];?></td>
            <td><?php echo $dest["subjudul"];?></td>
            <td><?php echo $dest["deskripsi"];?></td>
            <td>
                <div class='action-btn'>
                    <a href='ubahDestinasi.php?id_destinasi=<?= $dest['id'] ?>' class='edit-btn'><img src='../assets/icon/ubah.png'></a>
                    <a href='../database/delete.php?id_destinasi=<?= $dest['id'] ?>' class='delete-btn' onclick="return confirm('Yakin ingin menghapus destinasi ini?');"><img src='../assets/icon/sampah.svg'></a>
                </div>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>