<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Rekomendasi Pengguna | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>UBAH REKOMENDASI PENGGUNA - (username)</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="content-container">
            <div class="form-section">
                <form action="submit_destination.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul...">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..."></textarea>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="kirim-btn">Kirim</button>
                        <button type="button" onclick="window.history.back()" class="kembali-btn">Kembali</button>
                    </div>
                </form>
            </div>

            <div class="upload-section">
                <div class="upload-placeholder">
                    <img src="../assets/icon/unggah.png" alt="Upload Icon" class="upload-icon">
                </div>
                <label for="upload-file" class="upload-btn">Unggah File Gambar</label>
                <input type="file" id="upload-file" name="upload_file" accept="image/*" style="display: none;">
            </div>
        </div>
    </section>
</body>
</html>
