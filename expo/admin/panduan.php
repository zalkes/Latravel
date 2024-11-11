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
                <?php
                // Sample Data
                for ($i = 1; $i <= 6; $i++) {
                    echo "<tr>
                            <td>$i</td>
                            <td><img src='../assets/images/masjid.png' alt='Image' class='gambar'></td>
                            <td>Jelajahi</td>
                            <td>Ini deskripsi panduan</td>
                            <td>
                                <div class='action-btn'>
                                    <a href='ubahPanduan.php' class='edit-btn'><img src='../assets/icon/ubah.png'></a>
                                    <a href='' class='delete-btn'><img src='../assets/icon/sampah.png'></a>
                                </div>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <div class="pagination" id="pagination"></div>
        </div>
    </section>
    <script src="../elements/scripts/script.js"></script>
</body>
</html>
