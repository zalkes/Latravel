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

    $sql_komen = "SELECT k.komen, k.fk_username, k.fk_id_rekomen, p.foto as profil 
                FROM komentar k 
                JOIN pengguna p ON k.fk_username = p.username";
    $komentar_data = mysqli_query($conn, $sql_komen);

    $komentar_by_post = [];
    while ($komen = mysqli_fetch_assoc($komentar_data)) {
        $komentar_by_post[$komen['fk_id_rekomen']][] = $komen;
    }

    $user = $_SESSION["username"];
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
                            <?php if (isset($komentar_by_post[$rekom['id']])) : ?>
                                <?php foreach ($komentar_by_post[$rekom['id']] as $komen) : ?>
                                    <div class="comment">
                                        <div class="comment-username">
                                            <?php 
                                                $user_image = !empty($komen['profil']) 
                                                    ? "../database/profil_pengguna/".$komen['profil'] 
                                                    : "https://gravatar.com/avatar/00000000000000000000000000000000?d=mp";
                                            ?>
                                            <img src="<?= $user_image ?>" alt="Foto">
                                            <span><?= htmlspecialchars($komen['fk_username']); ?></span>
                                        </div>        
                                        <span class="comment-text"><?= htmlspecialchars($komen['komen']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="comment">
                                    <span class="no-comment">Belum ada komentar</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="post-actions">
                            <div class="likes">
                                <form action="like.php" method="POST">
                                    <input type="hidden" name="id_post" value="<?= $rekom['id']; ?>">
                                    <button type="submit" class="like-btn">
                                        <i class="fa-<?= $rekom['disukai'] ? 'solid' : 'regular'; ?> fa-thumbs-up"></i>
                                    </button>
                                    <span class="like-count"><?= $rekom['jumlah_like']; ?></span>
                                </form>
                            </div>
                            <form method="POST" action="tambahkomen.php" id="post-comments">
                                <button type="submit" class="comment-btn">
                                    <i class="fa-regular fa-comment"></i> 
                                </button>
                                <textarea name="komentar" placeholder="Tulis komentar..." required></textarea>
                                <input type="hidden" name="post_id" value="<?= $rekom['id']; ?>">
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