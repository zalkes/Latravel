<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latravel - Profil User</title>
    <link rel="stylesheet" href="../elements/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php include '../elements/navbar.php'; ?>
    <main class="profile-container">
    <aside class="sidebar-profile">
            <div>
                <div class="profil">
                    <h1>PROFIL USER</h1>
                    <img src="../assets/images/admin.png" alt="foto user" class="profile-img">
                    <h3>Username</h3>
                </div>
                <div class="bio">
                    <p>ini adalah bio dari user.ini adalah bio dari user.ini adalah bio dari user.</p>
                </div>
                <div class="aksi">
                    <div class="ubah">
                        <a href="ubahProfil.php">Ubah Profil</a>
                    </div>
                    <div class="keluar">
                        <img src="../assets/icon/keluar.png" alt="logout icon">
                        <a href="../akun/keluar.php">Keluar</a>
                    </div>
                </div>
            </div>
            <p class="copyright">&copy; Copyright 2024 Latravel</p> 
        </aside>
        <section class="profile-content">
            <div class="tabs">
                <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <div class="<?= ($current_page == 'profilPostingan.php') ? 'active' : '' ?>">
                    <a href="profilPostingan.php">
                        <img src="../assets/icon/postingan.png" alt="Postingan" class="tab-icon">
                        Postingan
                    </a>
                </div>
                <div class="<?= ($current_page == 'profilFavorit.php') ? 'active' : '' ?>">
                    <a href="profilFavorit.php">
                        <img src="../assets/icon/simpan.png" alt="Favorit" class="tab-icon">
                        Favorit
                    </a>
                </div>
            </div>
            <div class="posts">
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/simpan.svg" alt="Simpan" class="icon-simpan"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/simpan.svg" alt="Simpan" class="icon-simpan"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/simpan.svg" alt="Simpan" class="icon-simpan"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="card-add">
                    <a href="tambahRekomendasi.php">
                        <img src="../assets/icon/tambah.png" alt="" class="img-add">
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>