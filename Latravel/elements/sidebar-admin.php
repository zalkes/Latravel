<div class="sidebar">
    <link rel="stylesheet" href="styles/admin.css">
    <div class="logo">
        <img src="../assets/images/logo.png" alt="LA TRAVEL Logo">
    </div>
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <ul class="sidebar-menu">
        <li class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
            <a href="../admin/dashboard.php">
                <img src="../assets/icon/rumah.png" alt="Icon" width="24" height="24"> Dashboard
            </a>
        </li>
        <li class="<?= ($current_page == 'pengguna.php') ? 'active' : '' ?>">
            <a href="../admin/pengguna.php">
                <img src="../assets/icon/person.svg" alt="Icon" width="24" height="24"> Pengguna
            </a>
        </li>
        <li class="<?= ($current_page == 'rekomendasi.php') ? 'active' : '' ?>">
            <a href="../admin/rekomendasi.php">
                <img src="../assets/icon/ubah2.png" alt="Icon" width="24" height="24"> Rekomendasi Pengguna
            </a>
        </li>
        <li class="<?= ($current_page == 'destinasi.php') ? 'active' : '' ?>">
            <a href="../admin/destinasi.php">
                <img src="../assets/icon/lokasi.png" alt="Icon" width="24" height="24"> Destinasi
            </a>
        </li>
        <li class="<?= ($current_page == 'panduan.php') ? 'active' : '' ?>">
            <a href="../admin/panduan.php">
                <img src="../assets/icon/panduan.png" alt="Icon" width="24" height="24"> Panduan Perjalanan
            </a>
        </li>
        <li class="<?= ($current_page == 'keluar.php') ? 'active' : '' ?>">
            <a href="../akun/keluar.php">
                <img src="../assets/icon/keluar.png" alt="Icon" width="24" height="24"> Keluar
            </a>
        </li>
    </ul>
    <p class="copyright">&copy; Copyright 2024 Latravel</p>
</div>
