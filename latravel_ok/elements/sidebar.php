<div class="sidebar">
    <link rel="stylesheet" href="styles/sidebar.css">
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <ul class="sidebar-menu">
        <li id="search-bar">
            <form action="Rekomendasi.php" method="POST">
                <input type="text" name="search" placeholder="Search..." />
                <button type="submit">
                    <img src="../assets/icon/cari.png" alt="Search Icon" />
                </button>
            </form>
        </li>
        <li class="<?= ($current_page == 'tambahRekomendasi.php') ? 'active' : '' ?>">
            <a href="tambahRekomendasi.php">
                <img src="../assets/icon/tambah.png" alt="Icon" width="24" height="24"> Buat Rekomendasi
            </a>
        </li>
        <li>
            <a href="profilPostingan.php">
                <img src="../assets/icon/ubah.png" alt="Icon" width="24" height="24"> Kelola Postingan
            </a>
        </li>
        <li>
            <a href="profilFavorit.php">
                <img src="../assets/icon/simpan.png" alt="Icon" width="24" height="24"> Favorit
            </a>
        </li>
    </ul>
    <div class="footer">
        <p>&copy; Copyright 2024 Latravel</p>
    </div>
</div>