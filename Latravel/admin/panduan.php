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

    $sql_select_panduan = mysqli_query($conn, "SELECT * FROM panduan");

    $panduan = [];
    while ($row_panduan = mysqli_fetch_assoc($sql_select_panduan)) {
        $panduan[] = $row_panduan;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Perjalanan | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>REKOMENDASI PENGGUNA</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="search-container">
            <input type="text" placeholder="Pencarian..." id="search">
            <button id="searchButton"><img src="../assets/icon/cari.png" alt="Icon" width="16" height="16"></i></button>
        </div>
        <button class="add-button" onclick="window.location.href='tambahPanduan.php';">Tambah Panduan</button>
        <div id="container">
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
        </div>
        <div class="pagination">
            <div class="pagination" id="pagination"></div>
        </div>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
<script src="../livesearch/livesearch.js"></script>
</html>
