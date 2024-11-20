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
                <form action="proses_profil.php" method="POST" enctype="multipart/form-data" id="profil">
                    <div class="profil">
                        <h1>PROFIL USER</h1>
                        <div class="profile-img">
                            <!-- Gambar Default -->
                            <img src="../assets/images/admin.png" alt="foto user" id="foto-preview">

                            <!-- Ikon Kamera -->
                            <div id="icon-kamera" onclick="document.getElementById('profile-img').click()">
                                <i class="fa-solid fa-camera" style="color: #ffffff;"></i>
                                
                                <!-- Input File -->
                                <input type="file" id="profile-img" name="profile-img" accept="image/*" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="username-section">
                            <h3>
                                <input type="text" id="username" name="username" value="Username">
                            </h3>
                        </div>
                    </div>
                    <textarea id="bio" name="bio">ini adalah bio dari user.ini adalah bio dari user.ini adalah bio dari user.</textarea>
                    <div class="aksi">
                        <div class="selesai">
                            <button type="submit">Selesai</button>
                        </div>
                        <div class="batal">
                            <button type="reset">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="copyright">&copy; Copyright 2024 Latravel</p>
        </aside>
        <section class="profile-content">
            <div class="tabs">
                <div class="tab">
                    <a href="profilPostingan.php">
                        <img src="../assets/icon/postingan.png" alt="Postingan" class="tab-icon">
                        Postingan
                    </a>
                </div>
                <div class="tab">
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
                            <a href=""><img src="../assets/icon/ubah.png" alt="Edit" class="icon-edit"></a>
                            <a href=""><img src="../assets/icon/sampah.svg" alt="Hapus" class="icon-delete"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/ubah.png" alt="Edit" class="icon-edit"></a>
                            <a href=""><img src="../assets/icon/sampah.svg" alt="Hapus" class="icon-delete"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/ubah.png" alt="Edit" class="icon-edit"></a>
                            <a href=""><img src="../assets/icon/sampah.svg" alt="Hapus" class="icon-delete"></a>
                        </div>
                        <img class="cimage" src="../assets/images/masjid.png" alt="Samarinda">
                        <h4>Samarinda</h4>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="overlay">
                            <a href=""><img src="../assets/icon/ubah.png" alt="Edit" class="icon-edit"></a>
                            <a href=""><img src="../assets/icon/sampah.svg" alt="Hapus" class="icon-delete"></a>
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
    <script>
        
    </script>
</body>
</html>