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
    $sql_select_rekomendasi = mysqli_query($conn, "SELECT * FROM rekomendasi WHERE judul LIKE '%$search%' OR deskripsi LIKE '%$search%' OR fk_username LIKE '%$search%'");
    $rekomendasi = [];
    while ($row_rekomendasi = mysqli_fetch_assoc($sql_select_rekomendasi)) {
        $rekomendasi[] = $row_rekomendasi;
    }
?>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Username</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach($rekomendasi as $rekom) : ?>
        <?php $direktori = "../database/foto_rekomendasi/" . $rekom["foto"];?>
        <tr>
            <td><?= $i ?></td>
            <td><?php if ($rekom["foto"] == "") {echo "Foto belum ada";} else {echo "<img src='$direktori' alt='Foto rekomendasi' class='gambar'>";} ?></td>
            <td><?php echo $rekom["judul"];?></td>
            <td><?php echo $rekom["deskripsi"];?></td>
            <td><?php echo $rekom["fk_username"];?></td>
            <td class='status <?php if ($rekom["stat"] == "Belum Disetujui") {echo "rejected";} else {echo "approved";} ?>'><?php echo $rekom["stat"];?></td>
            <td>
                <?php if ($rekom["stat"] == "Disetujui") { ?>
                    <div class='action-btn'>
                        <a href='ubahRekomendasi.php?id_rekomendasi=<?= $rekom['id'] ?>' class='edit-btn' title='Ubah'><img src='../assets/icon/ubah.png'></a>
                        <a href='../database/delete.php?id_rekomendasi=<?= $rekom['id'] ?>' class='delete-btn' title='Hapus' onclick="return confirm('Yakin ingin menghapus rekomendasi ini?');"><img src='../assets/icon/sampah.svg'></a>
                    </div>
                <?php } else { ?>
                    <div class='action-btn'>
                        <a href='../database/terima.php?id_rekomendasi=<?= $rekom['id'] ?>' class='approve-btn' title='Setuju'><i class='fa-solid fa-circle-check fa-xl'></i></a>
                        <a href='../database/delete.php?id_rekomendasi=<?= $rekom['id'] ?>' class='reject-btn' title='Tolak' onclick="return confirm('Yakin ingin menolak rekomendasi ini?');"><i class='fa-solid fa-circle-xmark fa-xl'></i></a>
                    </div>
                <?php } ?>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>