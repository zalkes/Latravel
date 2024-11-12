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
        <div class="search-container">
            <input type="text" placeholder="Pencarian..." id="search">
            <button id="searchButton"><img src="../assets/icon/cari.png" alt="Icon" width="16" height="16"></i></button>
        </div>
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
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    $status = $i % 2 == 0 ? "Belum Disetujui" : "Disetujui";
                    $statusClass = $i % 2 == 0 ? "rejected" : "approved";

                    echo "<tr>
                            <td>$i</td>
                            <td><img src='../assets/images/masjid.png' alt='Image' class='gambar'></td>
                            <td>Islamic Center</td>
                            <td>Islamic center adalah masjid terbesar yang ada di Samarinda.</td>
                            <td>Username</td>
                            <td class='status $statusClass'>$status</td>
                            <td>";
                    if ($status == "Disetujui") {
                        echo "<div class='action-btn'>
                                <a href='ubah.php?id=$i' class='edit-btn' title='Ubah'><img src='../assets/icon/ubah.png'></a>
                                <a href='hapus.php?id=$i' class='delete-btn' title='Hapus'><img src='../assets/icon/sampah.png'></a>
                            </div>";
                    } else {
                        echo "<div class='action-btn'>
                                <a href='terima.php?id=$i' class='approve-btn' title='Setuju'><i class='fa-solid fa-circle-check fa-xl'></i></a>
                                <a href='tolak.php?id=$i' class='reject-btn' title='Tolak'><i class='fa-solid fa-circle-xmark fa-xl'></i></a>
                            </div>";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <span>&lt;</span>
            <span class="page-number active">1</span>
            <span class="page-number">2</span>
            <span class="page-number">3</span>
            <span class="page-number">10</span>
            <span>&gt;</span>
        </div>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
</html>
