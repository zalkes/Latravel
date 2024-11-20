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
    <section class="main-container">
        <header class="crud-header">
            <h1>Rekomendasi Pengguna</h1>
        </header>
        <?php for ($i = 0; $i < 3; $i++): ?>
          <?php 
          $post = [
              'id' => $i + 1,
              'judul' => 'ISLAMIC CENTER ' . ($i + 1), 
              'username' => 'Admin ' . ($i + 1),
              'deskripsi' => 'Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Islamic center adalah masjid terbesar yang ada di Samarinda.
                              Postingan ini adalah versi ' . ($i + 1) . '.',
              'gambar' => '../assets/images/masjid.png',
              'likes' => 999 - ($i * 10)
          ];
          ?>
          <div class="post-card">
              <div class="post-content">
                  <h3><?= htmlspecialchars($post['judul']); ?></h3>
                  <div class="post-user">
                      <img src="../assets/images/admin.png" alt="User Icon" class="user-icon">
                      <span><?= htmlspecialchars($post['username']); ?></span>
                  </div>
                  <p><?= htmlspecialchars($post['deskripsi']); ?></p>
                  <div class="post-actions">
                      <div class="likes">
                        <button class="like-btn" data-post-id="<?= htmlspecialchars($post['id']); ?>">
                            <i class="fa-regular fa-thumbs-up"></i> 
                        </button>
                        <span class="like-count"><?= htmlspecialchars($post['likes']); ?></span>
                      </div>
                      <form method="POST" action="" id="post-comments">
                          <button type="submit" class="comment-btn">
                            <i class="fa-regular fa-comment"></i> 
                          </button>
                          <textarea name="komentar" placeholder="Tulis komentar..." required></textarea>
                          <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']); ?>">
                      </form>
                  </div>
              </div>
              <div class="post-image">
                  <img src="<?= htmlspecialchars($post['gambar']); ?>" alt="<?= htmlspecialchars($post['judul']); ?>">
              </div>
          </div>
      <?php endfor; ?>
  </section>
</body>
</html>