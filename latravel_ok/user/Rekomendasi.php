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

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "
            SELECT r.id, p.username, p.foto as profil, r.judul, r.deskripsi, r.foto,
            (SELECT COUNT(*) FROM suka WHERE suka.fk_id_rekomen = r.id) as jumlah_like,
            (SELECT COUNT(*) FROM suka WHERE suka.fk_id_rekomen = r.id AND suka.fk_username = ?) as disukai
            FROM rekomendasi r 
            JOIN pengguna p ON r.fk_username = p.username 
            WHERE r.stat = 'Disetujui' 
            AND r.judul LIKE ?
        ";
        $searchTerm = "%" . $search . "%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $rekomendasi = [];
        while ($row_rekom = $result->fetch_assoc()) {
            $rekomendasi[] = $row_rekom;
        }
        $count = count($rekomendasi);
    }       
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
        <section class="main-container">
            <header class="crud-header">
                <h1>Rekomendasi Pengguna</h1>
            </header>
            <br><p>Rekomendasi dengan kata kunci "<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" tidak ditemukan.</p>
        </section>
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
                                <div class="comment" id="no-comment">
                                    <span class="no-comment">Belum ada komentar</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="post-actions">
                            <div class="likes">
                                <form  method="POST" action="like.php">
                                    <button type="button" class="like-btn" data-id="<?= $rekom['id']; ?>">
                                        <i class="fa-<?= $rekom['disukai'] ? 'solid' : 'regular'; ?> fa-thumbs-up"></i>
                                    </button>
                                    <span class="like-count"><?= $rekom['jumlah_like']; ?></span>
                                </form>
                            </div>
                            <form method="POST" onsubmit="return false;" id="post-comments">
                                <button type="button" class="comment-btn" data-id="<?= $rekom['id']; ?>">
                                    <i class="fa-regular fa-comment"></i>
                                </button>
                                <input name="komentar" placeholder="Tambahkan komentar..." required>
                                <input type="hidden" name="post_id" value="<?= $rekom['id']; ?>">
                            </form>
                        </div>
                    </div>
                    <div class="post-image">
                        <?php echo "<img src='$direktori2' alt='gambar'>"; ?>
                    </div>
                </div>
        <?php $i++; endforeach?>
        <p>© Copyright 2024 Latravel</p>
    </section>
    <?php endif; ?>
    <script src="../elements/scripts/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".like-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.dataset.id;
                    const icon = this.querySelector("i");
                    const countSpan = this.nextElementSibling;

                    fetch("like.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id_post=${id}`
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
                    const postId = form.querySelector("[name='post_id']").value;
                    const komentar = form.querySelector("[name='komentar']").value;
                    const commentsContainer = form.closest(".post-content").querySelector(".comments");

                    if (!komentar.trim()) {
                        alert("Komentar tidak boleh kosong.");
                        return;
                    }

                    fetch("tambahkomen.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `post_id=${postId}&komentar=${encodeURIComponent(komentar)}`
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
                                    <div class="comment-username">
                                        <img src="${data.foto}" alt="Foto">
                                        <span>${data.username}</span>
                                    </div>
                                    <span class="comment-text">${data.komentar}</span>
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
    </script>
</body>
</html>