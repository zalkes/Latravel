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
    $sql_select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna");
    $sql_select_destinasi = mysqli_query($conn, "SELECT * FROM destinasi");
    $sql_select_rekomendasi = mysqli_query($conn, "SELECT * FROM rekomendasi");
    $sql_select_rekomendasi_verif = mysqli_query($conn, "SELECT * FROM rekomendasi WHERE stat = 'Belum Disetujui'");

    $jumlah_pengguna = mysqli_num_rows($sql_select_pengguna);
    $jumlah_destinasi = mysqli_num_rows($sql_select_destinasi);
    $jumlah_rekomendasi = mysqli_num_rows($sql_select_rekomendasi);
    $jumlah_rekomendasi_verif = mysqli_num_rows($sql_select_rekomendasi_verif);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>     
    <section class="main-content">  
        <header>
            <h3>DASHBOARD</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="welcome">
            <h3>Selamat Datang, <span>Admin LATRAVEL</span></h3>
        </div>
        <div class="dashboard-container">
            <div class="card">
                <div class="card-satu" onclick="location.href='pengguna.php'">
                    <div class="detail-pengguna">
                        <img src="../assets/icon/profil.png" width="75px" height="75px" alt="">
                        <h1><?php echo $jumlah_pengguna?><br>Pengguna</h1>
                    </div>

                    <div class="lihat-detail" onclick="location.href='pengguna.php'">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
                
                <div class="card-satu" onclick="location.href='destinasi.php'">
                    <div class="detail-destinasi">
                        <img src="../assets/icon/lokasi.png" width="75px" height="75px" alt="">
                        <h1><?php echo $jumlah_destinasi?><br>Destinasi</h1>
                    </div>
                    
                    <div class="lihat-detail" onclick="location.href='destinasi.php'">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
                
                <div class="card-dua" onclick="location.href='rekomendasi.php'">
                    <div class="detail-detail">
                        <div class="detail-detail-kiri">
                            <img src="../assets/icon/ubah.png" width="75px" height="75px" alt="">
                            <h1><?php echo $jumlah_rekomendasi?><br>Rekomendasi Pengguna</h1>
                            
                        </div>
                        <div class="detail-detail-kanan">
                            <h1><?php echo $jumlah_rekomendasi_verif?><br>Menunggu Verifikasi</h1>
                            <img src="../assets/icon/waktu.png" width="75px" height="75px" alt="">

                        </div>
                    </div>
                    
                    <div class="lihat-detail" onclick="location.href='rekomendasi.php'">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
</html>
