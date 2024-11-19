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
    $sql_select_rekomendasi = mysqli_query($conn, "SELECT * FROM rekomendasi");
    $rekomendasi = [];
    while ($row_rekomendasi = mysqli_fetch_assoc($sql_select_rekomendasi)) {
        $rekomendasi[] = $row_rekomendasi;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Pengguna | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
        <div class="table-header1">
            <div class="search-container">
                <input type="text" placeholder="Pencarian..." id="search">
                <button id="searchButton"><img src="../assets/icon/cari.png" alt="Icon" width="16" height="16"></i></button>
            </div>
        </div>
        <div class="table-section">
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
        </div>
        <div class="pagination-section">
            <div class="pagination" id="pagination"></div>
        </div>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
</html>
