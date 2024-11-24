<?php
    session_start();
    if (isset($_SESSION['admin'])){
        header("Location: admin/dashboard.php");
    }
    require "database/koneksi.php";
    $sql_select_destinasi = mysqli_query($conn, "SELECT * FROM destinasi");
    $destinasi = [];
    $count = 0;
    while($row_destinasi = mysqli_fetch_assoc($sql_select_destinasi)){
        $destinasi[$count] = $row_destinasi;
        $count++;
    }

    $pengguna;
    if (isset($_SESSION["user"])){
        $select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
        if (mysqli_num_rows ($select_pengguna) == 0 && isset($_SESSION["user"])) {
            echo 
            "<script>
            document.location.href = 'login_page/logout.php?logout=true';
            </script>";
        }
    }
    
    if (isset($_SESSION["user"])) {
        $sql_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
        while ($row = mysqli_fetch_assoc($sql_pengguna)) {
            $pengguna[] = $row;
        }
        $pengguna = $pengguna[0];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | LATRAVEL</title>
    <link rel="stylesheet" href="elements/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header class="header-section">
        <navbar class="navbar-section">
            <a href="index.php" >
                <img src="assets/images/logo2.png" alt="logo latravel" width="110px" height="110px" class="img_logo">
            </a>
            <menu class="navbar-option">
                    <ul><a href="">BERANDA</a></ul>
                    <ul><a href="user/Rekomendasi.php">REKOMENDASI PENGGUNA</a></ul>
                    <ul><a href="#about">TENTANG KAMI</a></ul>
            </menu>
            <?php if(isset($_SESSION['user'])):?>
                <div class="navbar-profile">
                    <?php $direktori = "database/profil_pengguna/".$pengguna['foto'];?>
                    <?php if ($pengguna['foto'] == ""){
                    echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' class='user-pic' alt='Foto Profil' onclick='toggleMenu()'>";
                    }else{
                    echo "<img src='$direktori' class='user-pic' alt='Foto Profil' onclick='toggleMenu()'>";
                    }
                    ?>
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <?php if ($pengguna["foto"] == "") {
                                    echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' alt='Foto Profil'>";
                                } else {
                                    echo "<img src='$direktori' alt='Foto Profil'>";
                                } ?>
                                <h3><?php echo $_SESSION["username"]?></h3>
                            </div>
                            <hr>

                            <a href="user/profilPostingan.php" class="sub-menu-link">
                                <i class="fa-solid fa-user"></i>
                                <p>Profil</p>
                                <span>></span>
                            </a>

                            <a href="akun/keluar.php?logout=true" class="sub-menu-link">
                                <i class="fa-solid fa-sign-out"></i>
                                <p>Keluar</p>
                                <span>></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="login">
                    <a href="login_page/login.php">MASUK</a>
                </div>
            <?php endif; ?>
        </navbar>
        <div class="header-text">
            <h1>
                JELAJAHI <br> NUSANTARA
            </h1>
            <a href="#rekomendasi">LIHAT REKOMENDASI</a>
        </div>
    </header>
    <section class="banner-container">
        <div class="text-section">
            <h1>Cari Tempat Travel?</h1>
            <h1><span class="highlight">Ya di Latravel</span></h1>
            <br>
            <br>
            <p>Ayo jelajahi keindahan luar biasa dengan mengunjungi<br>
                objek wisata Nusantara yang tersembunyi dan <br> 
                menakjubkan bersama kami.</p>
        </div>
        <div class="banner-image">
            <img src="assets/images/banner.jpg" alt="about">
        </div>
    </section>
    <section class="rekomendasi-section" id="rekomendasi">
        <div class="header">
            <h1>REKOMENDASI KAMI</h1>
        </div>

    <div class="container">
        <div class="card" data-name="p-1">
            <img src="assets/images/islamic.jpg" alt="Islamic Center">
            <div class="title">Islamic Center</div>
        </div>
        <div class="card" data-name="p-2">
            <img src="assets/images/manggar.jpg" alt="Pantai Manggar">
            <div class="title">Pantai Manggar</div>
        </div>
        <div class="card" data-name="p-3">
            <img src="assets/images/derawan.jpg" alt="Pulau Derawan">
            <div class="title">Pulau Derawan</div>
        </div>
        <div class="card" data-name="p-4">
            <img src="assets/images/kakaban.jpeg" alt="Pulau Kakaban">
            <div class="title">Pulau Kakaban</div>
        </div>
        <div class="card" data-name="p-5">
            <img src="assets/images/kutai.jpeg" alt="Kampung Kutai">
            <div class="title">Kampung Kutai</div>
        </div>
        <div class="card" data-name="p-6">
            <img src="assets/images/loksado.jpeg" alt="Arung Jeram Loksado">
            <div class="title">Arung Jeram Loksado</div>
        </div>
    </div>

    <div class="card-preview">
        <div class="preview-container" data-target="p-1">
            <div class="image-section">
                <img src="assets/images/islamic.jpg" alt="Islamic Center">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Islamic Center<br><span>Samarinda</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto"> 
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto"> 
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>
        
        <div class="preview-container" data-target="p-2">
            <div class="image-section">
                <img src="assets/images/manggar.jpg" alt="Pantai Manggar">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Pantai Manggar<br><span>Balikpapan</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto"> 
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>

        <div class="preview-container" data-target="p-3">
            <div class="image-section">
                <img src="assets/images/derawan.jpg" alt="Pulau Derawan">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Pulau Derawan<br><span>Berau</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>

        <div class="preview-container" data-target="p-4">
            <div class="image-section">
                <img src="assets/images/kakaban.jpeg" alt="Pulau Kakaban">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Pulau Kakaban<br><span>Berau</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>

        <div class="preview-container" data-target="p-5">
            <div class="image-section">
                <img src="assets/images/kutai.jpeg" alt="Kampung Kutai">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Kampung Kutai<br><span>Kutai Kartanegara</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto"> 
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>

        <div class="preview-container" data-target="p-6">
            <div class="image-section">
                <img src="assets/images/loksado.jpeg" alt="Arung Jeram Loksado">
            </div>
            <div class="content-section">
                <div class="judul">
                    <h1>Arung Jeram Loksado<br><span>Hulu Sungai Selatan</span></h1>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <p class="description">
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. 
                    Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.
                </p>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                <div class="comments">
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Afrizal</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                    <div class="comment">
                        <div class="username">
                            <img src="assets/images/admin.png" alt="Foto">
                            <span>Arya</span>
                        </div>        
                        <span class="text">Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda. Islamic center adalah masjid terbesar yang ada di Samarinda.</span>
                    </div>
                </div>
                <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                <div class="footer-container">
                    <div class="like">
                        <i class="fa-regular fa-thumbs-up" id="like-button"></i>
                        <span id="jumlah_like">1278</span>
                    </div>
                    <i class="fa-regular fa-bookmark" id="fav"></i>
                </div>
                <div class="add-comment">
                    <label for="comment"><i class="fa-regular fa-comment"></i></label>
                    <input type="text" placeholder="Tambahkan komentar...">
                </div>
            </div>
        </div>
        <i class="fa-regular fa-circle-xmark" id="close"></i>
    </div>
    </section>
    <section class="panduan-section">
        <h1>PANDUAN PERJALANAN</h1>
        <div class="card-panduan">
            <img src="assets/images/kakaban.jpeg" alt="Destinasi 1">
            <div class="card-content">
                <h3>Jelajahi Pulau Kakaban yang Menakjubkan</h3>
                <p>
                    Pulau Kakaban, terletak di Kepulauan Derawan, Kalimantan Timur, 
                    adalah salah satu destinasi wisata unik di Indonesia yang menawarkan 
                    keindahan alam bawah laut dan pengalaman yang tak terlupakan. 
                    Waktu terbaik untuk mengunjungi Kakaban adalah antara April hingga Oktober 
                    saat cuaca cenderung cerah dan ombak lebih tenang. 
                    Anda bisa snorkeling atau menyelam di perairan sekitar Kakaban 
                    untuk melihat terumbu karang dan ikan tropis yang beraneka ragam.
                </p>
            </div>
        </div>
        <div class="card-panduan">
            <img src="assets/images/kutai.jpeg" alt="Destinasi 2">
            <div class="card-content">
                <h3>Santai dan Nikmati Keindahan Alami Kampung Kutai</h3>
                <p>
                    Kampung Kutai adalah salah satu kawasan di Kalimantan Timur yang terkena dampak abrasi laut. 
                    Meskipun tantangan abrasi menjadi masalah lingkungan yang serius, 
                    kawasan ini tetap menarik untuk dikunjungi karena kearifan lokal masyarakat, sejarahnya, dan keindahan pesisirnya. 
                    Waktu terbaik untuk berkunjung adalah pada musim kemarau agar kondisi cuaca lebih bersahabat. 
                    Pastikan anda memakai pakaian outdoor, menggunakan sunblock dan alas kaki yang tahan air.
                </p>
            </div>
        </div>
        <div class="card-panduan">
            <img src="assets/images/loksado.jpeg" alt="Destinasi 3">
            <div class="card-content">
                <h3>Kunjungi Wisata Arung Jeram Loksado yang Menarik</h3>
                <p>
                    Arung Jeram Laksadao, yang terletak di Kalimantan Selatan, menawarkan pengalaman arung jeram mendebarkan di aliran Sungai Amandit. 
                    Waktu terbaik untuk berkunjung adalah antara April hingga Oktober saat kondisi sungai optimal untuk petualangan ini. 
                    Cocok bagi pemula hingga ahli, Laksadao menyuguhkan jeram-jeram yang beragam, lengkap dengan pemandangan hutan tropis yang lebat. 
                    Dilengkapi peralatan keselamatan dan dipandu oleh instruktur berpengalaman.
                </p>
            </div>
        </div>
    </section>
    <section class="about-section" id="about">
        <div class="about-image">
            <img src="assets/images/pantai.png" alt="Pantai" class="main-image">
        </div>
        <div class="about-text">
            <img src="assets/images/logo2.png" alt="Logo Latravel" class="logo">      
            <h4>
                Latravel adalah sebuah website yang dibangun untuk memperkenalkan destinasi wisata Nusantara,
                terutama pada wilayah Kalimantan Timur yang kurang terekspos.
                <br><br>
                Bersama Latravel, temukan destinasi wisata menakjubkan yang mungkin belum pernah kamu ketahui. 
                Nikmati pesona alam dan tempat-tempat unik yang siap membuat liburanmu penuh cerita seru.
            </h4>
        </div>
    </section>
    <footer class="footer-section">
        <div class="left-footer">
            <img src="assets/images/logo2.png" alt="Logo">
        </div>
        <div class="middle-footer">
            <h3>&copy;Copyright 2024 Latravel</h3>
        </div>
        <div class="right-footer">
            <p>HUBUNGI<br>KAMI</p>
            <div class="footer-icon">
                <a href=""><i class="fab fa-instagram fa-xl"></i></a>
                <a href=""><i class="fab fa-facebook fa-xl"></i></a>
            </div>
        </div>
    </footer>
    <script src="elements/scripts/script.js"></script>
</body>
</html>