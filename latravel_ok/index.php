<?php
    session_start();
    if (isset($_SESSION['admin'])){
        header("Location: admin/dashboard.php");
    }
    require "database/koneksi.php";

    $user = isset($_SESSION['user']) ? $_SESSION['username'] : '';
    $sql = "
        SELECT d.id, d.judul, d.subjudul, d.deskripsi, d.foto,
        (SELECT COUNT(*) FROM suka WHERE suka.fk_id_destinasi = d.id) as jumlah_like,
        (SELECT COUNT(*) FROM suka WHERE suka.fk_id_destinasi = d.id AND suka.fk_username = ?) as disukai,
        (SELECT COUNT(*) FROM favorit WHERE favorit.fk_id_destinasi = d.id AND favorit.fk_username = ?) as favoritkan
        FROM destinasi d WHERE d.id != 0
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $destinasi = [];
    while ($row_destinasi = $result->fetch_assoc()) {
        $destinasi[] = $row_destinasi;
    }
    $count = count($destinasi);

    $sqk_select_panduan = mysqli_query($conn, "SELECT * FROM panduan");
    $panduan = [];
    $count = 0;
    while($row_panduan = mysqli_fetch_assoc($sqk_select_panduan)){
        $panduan[$count] = $row_panduan;
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

    $sql_komentar = "SELECT k.*, p.foto AS profil FROM komentar k 
                 JOIN pengguna p ON k.fk_username = p.username";
    $result_komentar = mysqli_query($conn, $sql_komentar);

    $komentar_by_destinasi = [];
    while ($komen = mysqli_fetch_assoc($result_komentar)) {
        $komentar_by_destinasi[$komen['fk_id_destinasi']][] = $komen;
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
        <navbar class="navbar-section" id="nav-menu">
            <a href="index.php" >
                <img src="assets/images/logo2.png" alt="logo latravel" width="110px" height="110px" class="img_logo">
            </a>
            <div class="hamburger-menu" id="hamburger-menu" onclick="myFunction()">
                &#9776;
            </div>
            <menu class="navbar-option" id="nav-op">
                <ul><a href="">BERANDA</a></ul>
                <ul><a href="user/Rekomendasi.php">REKOMENDASI PENGGUNA</a></ul>
                <ul><a href="#about">TENTANG KAMI</a></ul>
            </menu>
            <?php if(isset($_SESSION['user'])):?>
                <div class="navbar-profile" id="nav-pro">
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
                <div class="login" id="login">
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
            <?php foreach ($destinasi as $item): ?>
                <div class="card" data-name="p-<?php echo $item['id']; ?>">
                    <img src="database/foto_destinasi/<?php echo $item['foto']; ?>" alt="<?php echo $item['nama']; ?>">
                    <div class="title"><?php echo $item['judul']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card-preview">
            <?php foreach ($destinasi as $item): ?>
                <div class="preview-container" data-target="p-<?php echo $item['id']; ?>">
                    <div class="image-section">
                        <img src="database/foto_destinasi/<?php echo $item['foto']; ?>" alt="<?php echo $item['judul']; ?>">
                    </div>
                    <div class="content-section">
                        <div class="judul">
                            <h1><?php echo $item['judul']; ?><br><span><?php echo $item['subjudul']; ?></span></h1>
                        </div>
                        <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                        <p class="description">
                            <?php echo $item['deskripsi']; ?>
                        </p>
                        <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%;">
                        <div class="comments">
                            <?php 
                            if (isset($komentar_by_destinasi[$item['id']])) {
                                foreach ($komentar_by_destinasi[$item['id']] as $komen): ?>
                                    <div class="comment">
                                        <div class="username">
                                            <img src="database/profil_pengguna/<?php echo $komen['profil']; ?>" alt="Foto">
                                            <span><?php echo $komen['fk_username']; ?></span>
                                        </div>        
                                        <span class="text"><?php echo $komen['komen']; ?></span>
                                    </div>
                                <?php endforeach; 
                            } else { ?>
                                <div id="no-comment">Belum ada komentar</div>
                            <?php } ?>
                        </div>
                        <hr style="border: 1px solid rgba(128, 128, 128, 0.5); width: 100%; margin-top: -10px;">
                        <div class="footer-container">
                            <div class="likes">
                                <form method="POST" action="user/like2.php">
                                    <button type="button" class="like-btn" data-id="<?= $item['id']; ?>">
                                        <i class="fa-<?= $item['disukai'] ? 'solid' : 'regular'; ?> fa-thumbs-up"></i>
                                    </button>
                                    <span class="like-count"><?= $item['jumlah_like']; ?></span>
                                </form>
                            </div>
                            <div class="favorit">
                                <form method="POST" action="user/favorit.php" id="post-comment">
                                    <button type="button" class="fav-btn" data-id="<?= $item['id']; ?>">
                                        <i class="fa-<?= $item['favoritkan'] ? 'solid' : 'regular'; ?> fa-bookmark"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="add-comment">
                            <form method="POST" onsubmit="return false;" id="post-comment">
                                <button type="button" class="comment-btn" data-id="<?= $item['id']; ?>">
                                    <i class="fa-regular fa-comment"></i>
                                </button>
                                <input name="komentar" placeholder="Tambahkan komentar..." required autocomplete="off">
                                <input type="hidden" name="destinasi_id" value="<?= $item['id']; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <i class="fa-regular fa-circle-xmark" id="close"></i>
        </div>
    </section>
    <div class="view">
        <section class="panduan-section">
            <h1>PANDUAN PERJALANAN</h1>
            <?php foreach ($panduan as $item): ?>
                <div class="card-panduan">
                    <img src="database/foto_panduan/<?php echo $item['foto']; ?>" alt="<?php echo $item['judul']; ?>">
                    <div class="card-content">
                        <h3><?php echo $item['judul']; ?></h3>
                        <p>
                            <?php echo $item['deskripsi']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
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
    </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".like-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.dataset.id;
                    const icon = this.querySelector("i");
                    const countSpan = this.nextElementSibling;

                    fetch("user/like2.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `destinasi_id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert("Terjadi kesalahan: " + data.error);
                            return;
                        }

                        icon.classList.toggle("fa-solid", data.liked);
                        icon.classList.toggle("fa-regular", !data.liked);
                        countSpan.textContent = data.jumlah_like;
                    })
                    .catch(error => console.error("Error:", error));
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".comment-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const form = this.closest("form");
                    const destinasiId = form.querySelector("[name='destinasi_id']").value;
                    const komentar = form.querySelector("[name='komentar']").value.trim();
                    const commentsContainer = form.closest(".content-section").querySelector(".comments");

                    if (komentar === "") {
                        alert("Komentar tidak boleh kosong.");
                        return;
                    }

                    fetch("user/tambahkomen.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `destinasi_id=${encodeURIComponent(destinasiId)}&komentar=${encodeURIComponent(komentar)}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert("Terjadi kesalahan: " + data.error);
                            } else {
                                const noCommentElement = commentsContainer.querySelector("#no-comment");
                                if (noCommentElement) {
                                    noCommentElement.remove();
                                }

                                const newComment = `
                                    <div class="comment">
                                        <div class="username">
                                            <img src="${data.foto2}" alt="Foto">
                                            <span>${data.username}</span>
                                        </div>
                                        <span class="text">${data.komentar}</span>
                                    </div>
                                `;
                                commentsContainer.innerHTML += newComment;
                                form.querySelector("[name='komentar']").value = "";
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".fav-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.dataset.id;
                    const icon = this.querySelector("i");

                    fetch("user/favorit.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `destinasi_id=${id}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert("Terjadi kesalahan: " + data.error);
                            return;
                        }

                        icon.classList.toggle("fa-solid", data.favorited);
                        icon.classList.toggle("fa-regular", !data.favorited);
                    })
                    .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>
</body>
</html>