<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../admin/dashboard.php');
        exit();
    }
    require "../database/koneksi.php";

    if (isset($_SESSION['user'])){
        $select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
        if (mysqli_num_rows ($select_pengguna) == 0 && isset($_SESSION["user"])) {
            echo 
            "<script>
            document.location.href = '../akun/keluar.php?logout=true';
            </script>";
        }
    }

    $sql_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
    while ($row = mysqli_fetch_assoc($sql_pengguna)) {
        $pengguna[] = $row;
    }

    $pengguna = $pengguna[0];
?>

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
                    <h1>PROFIL ANDA</h1>
                    <?php $direktori = "../database/profil_pengguna/".$pengguna["foto"]; ?>
                    <?php if ($pengguna["foto"] == "") {
                        echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' alt='Foto Profil' class='profile-img'>";
                    } else {
                        echo "<img src='$direktori' alt='Foto Profil' class='profile-img'>";
                    } ?>
                    <h3><?= $pengguna["username"] ?></h3>
                </div>
                <div class="bio">
                    <p><?= !empty($pengguna["bio"]) ? $pengguna["bio"] : "Belum ada bio" ?></p>
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
    <script src="../elements/scripts/script.js"></script>
</body>
</html>