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

    $sql_select_destinasi = mysqli_query($conn, "SELECT * FROM destinasi");

    $destinasi = [];
    while ($row_destinasi = mysqli_fetch_assoc($sql_select_destinasi)) {
        $destinasi[] = $row_destinasi;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>DAFTAR DESTINASI</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="table-header">
            <button class="add-button" onclick="window.location.href='tambahDestinasi.php';">Tambah Destinasi</button>
            <div class="search-container">
                <input type="text" placeholder="Pencarian..." id="search">
                <button id="searchButton"><img src="../assets/icon/cari.png" alt="Icon" width="16" height="16"></i></button>
            </div>
        </div>
        <div class="table-section" id="table-section">
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
        </div>
        <div class="pagination-section">
            <div class="pagination" id="pagination"></div>
        </div>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
<script src="../livesearch/livesearch.js"></script>
</html>