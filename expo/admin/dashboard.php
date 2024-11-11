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
                <div class="card-satu">
                    <div class="detail-pengguna">
                        <img src="../assets/icon/profil.png" width="75px" height="75px" alt="">
                        <h1>15<br>Pengguna</h1>
                    </div>

                    <div class="lihat-detail">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
                
                <div class="card-satu">
                    <div class="detail-destinasi">
                        <img src="../assets/icon/lokasi.png" width="75px" height="75px" alt="">
                        <h1>6<br>Destinasi</h1>
                    </div>
                    
                    <div class="lihat-detail">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
                
                <div class="card-dua">
                    <div class="detail-detail">
                        <div class="detail-detail-kiri">
                            <img src="../assets/icon/ubah.png" width="75px" height="75px" alt="">
                            <h1>21<br>Rekomendasi Pengguna</h1>
                            
                        </div>
                        <div class="detail-detail-kanan">
                            <h1>8<br>Menunggu Verifikasi</h1>
                            <img src="../assets/icon/waktu.png" width="75px" height="75px" alt="">

                        </div>
                    </div>
                    
                    <div class="lihat-detail">
                        <img src="../assets/icon/pengaturan.png" width="22px" height="22px" alt="">
                        <p>Lihat detail</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="script.js"></script>
</html>
