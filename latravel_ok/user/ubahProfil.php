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

    // $sql_postingan = mysqli_query($conn, "SELECT * FROM rekomendasi WHERE fk_username = '$_SESSION[username]'")
    // $postingan = [];
    // while ($row = mysqli_fetch_assoc($sql_postingan)) {
    //     $postingan[] = $row;
    // }

    // $sql_favorit = mysqli_query($conn, "SELECT * FROM favorit WHERE fk_username = '$_SESSION[username]'")
    // $favorit = [];
    // while ($row = mysqli_fetch_assoc($sql_favorit)) {
    //     $favorit[] = $row;
    // }

    if (isset($_POST["profil"])) {
        $bio = $_POST["bio"];
    
        $foto = $_FILES["profile-img"]["name"];
        $temp = $_FILES["profile-img"]["tmp_name"];
    
        if ($foto == "") {
            $sql = "UPDATE pengguna SET bio = '$bio' WHERE username = '$_SESSION[username]'";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                echo "
                <script>
                alert('Berhasil Mengubah Profil!');
                document.location.href = 'profilPostingan.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Gagal Mengubah Profil!');
                </script>
                ";
            }
        } else {
            date_default_timezone_set("Asia/Makassar");
            $ekstensi = explode('.', $foto);
            $ekstensi = strtolower(end($ekstensi));
            $namabaru = date("Y-m-d H.i.s") . "." . $ekstensi;
            $direktori = "../database/profil_pengguna/" . $namabaru;
            $support = ["jpg", "jepg", "png"];
    
            if (in_array($ekstensi, $support)) {
                if (move_uploaded_file($temp, $direktori)) {
                    $sql = "UPDATE pengguna SET bio = '$bio', foto = '$namabaru' WHERE username = '$_SESSION[username]'";
    
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        echo "
                        <script>
                        alert('Berhasil Mengubah Profil!');
                        document.location.href = 'profilPostingan.php';
                        </script>
                        ";
                    } else {
                        echo "
                        <script>
                        alert('Gagal Mengubah Profil!');
                        </script>
                        ";
                    }
                }
            }
        }
    }
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
                <form action="" method="POST" enctype="multipart/form-data" id="profil">
                    <div class="profil">
                        <h1>PROFIL ANDA</h1>
                        <div class="profile-img">
                            <!-- Gambar Default -->
                            <?php $direktori = "../database/profil_pengguna/".$pengguna["foto"]; ?>
                            <?php if ($pengguna["foto"] == "") {
                                echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' alt='Foto Profil' class='profile-img' id='foto-preview'>";
                            } else {
                                echo "<img src='$direktori' alt='Foto Profil' class='profile-img' id='foto-preview'>";
                            } ?>

                            <!-- Ikon Kamera -->
                            <div id="icon-kamera" onclick="document.getElementById('profile-img').click()">
                                <i class="fa-solid fa-camera" style="color: #ffffff;"></i>
                                
                                <!-- Input File -->
                                <input type="file" id="profile-img" name="profile-img" accept="image/*" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="username-section">
                            <h3>
                                <?= $pengguna["username"] ?>
                                <!-- <input type="text" id="username" name="username" value=<?= $pengguna["username"] ?>> -->
                            </h3>
                        </div>
                    </div>
                    <textarea id="bio" name="bio"><?= $pengguna["bio"] ?></textarea>
                    <div class="aksi">
                        <div class="selesai">
                            <button type="submit" name="profil">Selesai</button>
                        </div>
                        <div class="batal">
                            <a href="profilPostingan.php">Batal</a>
                            <!-- <button type="reset">Batal</button> -->
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
    <script src="../elements/scripts/script.js"></script>
</body>
</html>