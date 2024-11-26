<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        echo "
            <script>
                document.location.href = '../login_page/login.php';
            </script>
        ";
    }
    require "../database/koneksi.php";

    if (isset($_POST["submit"])){
        $judul = $_POST["judul"];
        $deskripsi = $_POST["deskripsi"];
        $user = $_SESSION["username"];
        $foto = $_FILES["upload_file"]["name"];
        $temp = $_FILES["upload_file"]["tmp_name"];

        date_default_timezone_set("Asia/Makassar");
        $ekstensi = explode('.', $foto);
        $ekstensi = strtolower(end($ekstensi));
        $namabaru = date("Y-m-d H.i.s") . "." . $ekstensi;
        $direktori = "../database/foto_rekomendasi/" . $namabaru;
        $support = ["jpg", "jpeg", "png"];

        if (in_array($ekstensi, $support)){
            if (move_uploaded_file($temp, $direktori)){
                
                $sql = "INSERT INTO rekomendasi (judul, deskripsi, foto, stat, fk_username) VALUES ('$judul', '$deskripsi', '$namabaru', 'Belum Disetujui', '$user')";

                $result = mysqli_query($conn, $sql);

                if ($result){
                    echo "
                        <script> 
                            alert ('Berhasil Membuat Rekomendasi');
                            document.location.href = 'profilPostingan.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert ('Gagal Membuat Rekomendasi');
                        </script>
                    ";
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
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul..." required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..." required></textarea>
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
                    <input type="file" id="upload-file" name="upload_file" accept="image/*" style="display: none;" onchange="limit_size(event)" required>
                </div>
            </div>
        </form>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
</html>