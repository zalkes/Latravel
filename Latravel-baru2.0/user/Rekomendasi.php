<?php
    session_start();
    require "../database/koneksi.php";
    if (!isset($_SESSION["user"])) {
        echo "
            <script>
                document.location.href = '../login_page/login.php';
            </script>
        ";
    }
    $sql = "SELECT p.username, p.foto as profil, r.judul, r.deskripsi, r.foto FROM rekomendasi r join pengguna p on r.fk_username = p.username where r.stat = 'Disetujui'";
    $sql_select_rekomendasi = mysqli_query($conn, $sql);
    $rekomendasi = [];
    $count = 0;
    while ($row_rekom = mysqli_fetch_assoc($sql_select_rekomendasi)) {
        $rekomendasi[] = $row_rekom;
        $count++;
    }

    $sql_komen = "SELECT * FROM komentar";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Pengguna | Latravel</title>
    <link rel="stylesheet" href="../elements/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php include '../elements/navbar.php'; include '../elements/sidebar.php'; ?>
    <?php if ($count == 0) :?>
    <?php echo""?>
    <?php else: ?>
    <section class="main-container">
        <header class="crud-header">
            <h1>Rekomendasi Pengguna</h1>
        </header>
        <?php $i = 1; foreach ($rekomendasi as $rekom) : ?>
            <?php $direktori = "../database/profil_pengguna/".$rekom["profil"]; ?>
            <?php $direktori2 = "../database/foto_rekomendasi/".$rekom["foto"]; ?>
                <div class="post-card">
                    <div class="post-content">
                        <h3><?php echo $rekom["judul"];?></h3>
                        <div class="post-user">
                            <?php 
                                if (!empty($rekom["profil"])) {
                                    echo "<img src='$direktori' alt='profil' class='user-icon'>";
                                } else {
                                    echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' alt='profil' class='user-icon'>";
                                }
                            ?>
                            <span><?php echo $rekom["username"];?></span>
                        </div>
                        <p><?= $rekom['deskripsi'] ?></p>
                        <div class="comments">
                            <div class="comment">
                                <div class="comment-username">
                                    <img src="../assets/images/admin.png" alt="Foto">
                                    <span>Afrizal</span>
                                </div>        
                                <span class="comment-text">
                                    Islamic center adalah masjid terbesar yang ada di Samarinda.
                                    Islamic center adalah masjid terbesar yang ada di Samarinda.
                                </span>
                            </div>
                            <div class="comment">
                                <div class="comment-username">
                                    <img src="../assets/images/admin.png" alt="Foto">
                                    <span>Afrizal</span>
                                </div>        
                                <span class="comment-text">
                                    Islamic center adalah masjid terbesar yang ada di Samarinda.
                                    Islamic center adalah masjid terbesar yang ada di Samarinda.
                                </span>
                            </div>
                        </div>
                        <div class="post-actions">
                            <div class="likes">
                                <button class="like-btn" data-post-id="">
                                    <i class="fa-regular fa-thumbs-up"></i> 
                                </button>
                                <span class="like-count">999</span>
                            </div>
                            <form method="POST" action="" id="post-comments">
                                <button type="submit" class="comment-btn">
                                    <i class="fa-regular fa-comment"></i> 
                                </button>
                                <textarea name="komentar" placeholder="Tulis komentar..." required></textarea>
                                <input type="hidden" name="post_id" value="">
                            </form>
                        </div>
                    </div>
                    <div class="post-image">
                        <?php echo "<img src='$direktori2' alt='gambar'>"; ?>
                    </div>
                </div>
        <?php $i++; endforeach?>
    </section>
    <?php endif; ?>
    <script src="../elements/scripts/script.js"></script>
</body>
</html>