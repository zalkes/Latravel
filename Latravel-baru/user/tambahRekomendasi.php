<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekomendasi | Latravel</title>
    <link rel="stylesheet" href="../elements/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php include '../elements/navbar.php'; include '../elements/sidebar.php'; ?>
    <section class="main-content">
        <header class="crud-header">
            <h1>Buat Rekomendasi</h1>
        </header>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="content-container">
                <div class="form-section">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul...">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..."></textarea>
                    </div>
                    <div class="buttons">
                        <button type="submit" name="submit" class="kirim-btn">Kirim</button>
                        <button type="button" class="kembali-btn" onclick="window.history.back()">Kembali</button>
                    </div>
                </div>
                <div class="upload-section">
                    <div class="upload-placeholder">
                        <img src="../assets/icon/unggah.png" alt="Upload Icon" class="upload-icon" id="title-img">
                        <img id="up-img" alt="preview" class="gambar-preview">
                    </div>
                    <label for="upload-file" class="upload-btn">Unggah File Gambar</label>
                    <input type="file" id="upload-file" name="upload_file" accept="image/*" style="display: none;" onchange="limit_size(event)">
                </div>
            </div>
        </form>
    </section>
</body>
</html>