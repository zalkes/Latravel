<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | LATRAVEL</title>
    <link rel="stylesheet" href="elements/styles/style.css">
    <link rel="stylesheet" href="assets/fonts/fonts.css">
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
            <div class="login">
                <a href="login_page/login.php">MASUK</a>
            </div>
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
            <h1>Kunjungi Objek</h1>
            <h1> Wisata yang </h1>
            <h1><span class="highlight">Menakjubkan</span></h1>
            <br>
            <br>
            <p>Jelajahi keindahan luar biasa dengan mengunjungi<br>
                objek wisata Nusantara yang tersembunyi dan <br> 
                menakjubkan.</p>
        </div>
        <div class="banner-image">
            <img src="assets/images/banner.jpg" alt="about">
        </div>
    </section>
    <section class="rekomendasi-section" id="rekomendasi">
        <h1>INI ADALAH REKOMENDASI</h1>
    </section>
    <section class="panduan-section">
        <h1>PANDUAN PERJALANAN</h1>
        <div class="card">
            <img src="assets/images/kakaban.jpg" alt="Destinasi 1">
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
        <div class="card">
            <img src="assets/images/kampungkutai.jpg" alt="Destinasi 2">
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
        <div class="card">
            <img src="assets/images/arungjeram.jpg" alt="Destinasi 3">
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
                terutama wilayah Kalimantan Timur yang kurang terekspos.
            </h4>
        </div>
    </section>
    <?php include 'elements/footer.php' ?>
</body>
</html>