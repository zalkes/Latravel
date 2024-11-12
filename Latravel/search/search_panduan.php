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
    $sql_select_panduan = mysqli_query($conn, "SELECT * FROM panduan WHERE judul LIKE '%$search%' OR deskripsi LIKE '%$search%'");

    $panduan = [];
    while ($row_panduan = mysqli_fetch_assoc($sql_select_panduan)) {
        $panduan[] = $row_panduan;
    }
?>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach($panduan as $pand) : ?>
        <?php $direktori = "../database/foto_panduan/" . $pand["foto"];?>
        <tr>
            <td><?= $i ?></td>
            <td><?php if ($pand["foto"] == "") {echo "Foto belum ada";} else {echo "<img src='$direktori' alt='Foto panduan' class='gambar'>";} ?></td>
            <td><?php echo $pand["judul"];?></td>
            <td><?php echo $pand["deskripsi"];?></td>
            <td>
                <div class='action-btn'>
                    <a href='ubahPanduan.php?id_panduan=<?= $pand['id'] ?>' class='edit-btn'><img src='../assets/icon/ubah.png'></a>
                    <a href='../database/delete.php?id_panduan=<?= $pand['id'] ?>' class='delete-btn' onclick="return confirm('Yakin ingin menghapus panduan ini?');"><img src='../assets/icon/sampah.png'></a>
                </div>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>