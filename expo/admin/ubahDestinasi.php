<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Destinasi | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>UBAH DESTINASI</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="content-container">
            <div class="form-section">
                <form action="submit_destination.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group-2">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" placeholder="Masukkan judul...">
                    </div>

                    <div class="form-group-2">
                        <label for="subjudul">SubJudul</label>
                        <input type="text" id="subjudul" placeholder="Masukkan subjudul...">
                    </div>

                    <div class="form-group-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" placeholder="Masukkan deskripsi..."></textarea>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="kirim-btn">Kirim</button>
                        <button type="button" class="kembali-btn" onclick="window.history.back()">Kembali</button>
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
