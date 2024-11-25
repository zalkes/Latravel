<?php
    session_start();
    require "../database/koneksi.php";

    // Mengecek apakah pengguna sudah login
    if (!isset($_SESSION["user"])) {
        echo "
            <script>
                document.location.href = '../login_page/login.php';
            </script>
        ";
        exit();
    }

    // Mendapatkan username dari session
    $user = $_SESSION["username"];

    // Query untuk mendapatkan rekomendasi
    $sql = "
        SELECT r.id, p.username, p.foto as profil, r.judul, r.deskripsi, r.foto,
        (SELECT COUNT(*) FROM suka WHERE suka.fk_id_rekomen = r.id) as jumlah_like,
        (SELECT COUNT(*) FROM suka WHERE suka.fk_id_rekomen = r.id AND suka.fk_username = ?) as disukai
        FROM rekomendasi r 
        JOIN pengguna p ON r.fk_username = p.username 
        WHERE r.stat = 'Disetujui'
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $rekomendasi = [];
    while ($row_rekom = $result->fetch_assoc()) {
        $rekomendasi[] = $row_rekom;
    }
    $count = count($rekomendasi);
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
    <?php if ($count == 0) : ?>
        <section class="main-container">
            <header class="crud-header">
                <h1>Tidak ada rekomendasi yang disetujui</h1>
            </header>
        </section>
    <?php else: ?>
    <section class="main-container">
        <header class="crud-header">
            <h1>Rekomendasi Pengguna</h1>
        </header>
        <?php foreach ($rekomendasi as $rekom) : ?>
            <?php 
                $direktori = "../database/profil_pengguna/" . htmlspecialchars($rekom["profil"]);
                $direktori2 = "../database/foto_rekomendasi/" . htmlspecialchars($rekom["foto"]);
            ?>
            <div class="post-card">
                <div class="post-content">
                    <h3><?= htmlspecialchars($rekom["judul"]); ?></h3>
                    <div class="post-user">
                        <?php if (!empty($rekom["profil"])): ?>
                            <img src="<?= $direktori ?>" alt="profil" class="user-icon">
                        <?php else: ?>
                            <img src="https://gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="profil" class="user-icon">
                        <?php endif; ?>
                        <span><?= htmlspecialchars($rekom["username"]); ?></span>
                    </div>
                    <p><?= htmlspecialchars($rekom['deskripsi']); ?></p>
                    <div class="comments">
                        <div class="comment">
                            <div class="comment-username">
                                <img src="../assets/images/admin.png" alt="Foto">
                                <span>Afrizal</span>
                            </div>        
                            <span class="comment-text">
                                Islamic center adalah masjid terbesar yang ada di Samarinda.
                            </span>
                        </div>
                    </div>
                    <div class="post-actions">
                        <div class="likes">
                            <form action="config/like.php" method="POST">
                                <input type="hidden" name="id_post" value="<?= $rekom['id']; ?>">
                                <button type="submit" class="like-btn">
                                    <i class="fa-<?= $rekom['disukai'] ? 'solid' : 'regular'; ?> fa-thumbs-up"></i>
                                </button>
                                <span class="like-count"><?= $rekom['jumlah_like']; ?></span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="post-image">
                    <img src="<?= $direktori2 ?>" alt="gambar">
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
    <script src="../elements/scripts/script.js"></script>
</body>
</html>