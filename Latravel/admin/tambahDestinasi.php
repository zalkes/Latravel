<?php 
    session_start();
    if (!isset($_SESSION["admin"])) {
        echo "
            <script>
                document.location.href = '../login_page/login.php';
            </script>
        ";
    }
    require "../database/koneksi.php";

    if (isset($_POST["submit"])){
        $judul = $_POST["judul"];
        $subjudul = $_POST["subjudul"];
        $deskripsi = $_POST["deskripsi"];
        
        $foto = $_FILES["upload_file"]["name"];
        $temp = $_FILES["upload_file"]["tmp_name"];

        date_default_timezone_set("Asia/Makassar");
        $ekstensi = explode('.', $foto);
        $ekstensi = strtolower(end($ekstensi));
        $namabaru = date("Y-m-d H.i.s") . "." . $ekstensi;
        $direktori = "../database/foto_destinasi/" . $namabaru;
        $support = ["jpg", "jpeg", "png"];

        if (in_array($ekstensi, $support)){
            if (move_uploaded_file($temp, $direktori)){
                
                $sql = "INSERT INTO destinasi (judul, subjudul, deskripsi, foto) VALUES ('$judul', '$subjudul', '$deskripsi', '$namabaru')";

                $result = mysqli_query($conn, $sql);

                if ($result){
                    echo "
                        <script>
                            alert('Berhasil Menambah Destinasi');
                            document.location.href = 'destinasi.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Gagal Menambah Destinasi');
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
    <title>Tambah Destinasi | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>TAMBAH DESTINASI</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="content-container">
                <div class="form-section">
                        <div class="form-group-2">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" placeholder="Masukkan judul...">
                        </div>

                        <div class="form-group-2">
                            <label for="subjudul">SubJudul</label>
                            <input type="text" name="subjudul" id="subjudul" placeholder="Masukkan subjudul...">
                        </div>

                        <div class="form-group-2">
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
    <script src="../elements/scripts/script.js"></script>
</body>
</html>
