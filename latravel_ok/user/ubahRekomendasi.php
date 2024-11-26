<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../admin/dashboard.php');
        exit();
    }
    require "../database/koneksi.php";
    $id_rekomendasi;
    if (isset($_GET["id_rekomendasi"])) {
        $id_rekomendasi = $_GET["id_rekomendasi"];

        $sql_select_rekomendasi = mysqli_query($conn, "SELECT * FROM rekomendasi WHERE id = $id_rekomendasi");
        $rekomendasi = mysqli_fetch_assoc($sql_select_rekomendasi);
    }

    if (isset($_POST["submit"])){
        $judul = $_POST["judul"];
        $deskripsi = $_POST["deskripsi"];
        
        $foto = $_FILES["upload_file"]["name"];
        $temp = $_FILES["upload_file"]["tmp_name"];

        if ($foto == ""){
            $sql = "UPDATE rekomendasi SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id_rekomendasi";

            $result = mysqli_query($conn, $sql);

            if ($result){
                echo "
                    <script>
                        alert('Berhasil Mengubah Rekomendasi');
                        document.location.href = 'profilPostingan.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal Mengubah Rekomendasi');
                    </script>
                ";
            }
        }

        date_default_timezone_set("Asia/Makassar");
        $ekstensi = explode('.', $foto);
        $ekstensi = strtolower(end($ekstensi));
        $namabaru = date("Y-m-d H.i.s") . "." . $ekstensi;
        $direktori = "../database/foto_rekomendasi/" . $namabaru;
        $support = ["jpg", "jpeg", "png"];

        if (in_array($ekstensi, $support)){
            if (move_uploaded_file($temp, $direktori)){
                
                $sql = "UPDATE rekomendasi SET judul = '$judul', deskripsi = '$deskripsi', foto = '$namabaru' WHERE id = $id_rekomendasi";

                $result = mysqli_query($conn, $sql);

                if ($result){
                    echo "
                        <script>
                            alert('Berhasil Mengubah Rekomendasi');
                            document.location.href = 'profilPostingan.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Gagal Mengubah Rekomendasi');
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
    <title>Ubah Rekomendasi | Latravel</title>
    <link rel="stylesheet" href="../elements/styles/user.css">
</head>
<body>
    <?php include '../elements/navbar.php'; include '../elements/sidebar.php'; ?>
    <section class="main-content">
        <header class="crud-header">
            <h1>Ubah Rekomendasi</h1>
        </header>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="content-container">
                <div class="form-section">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul..." value="<?php echo $rekomendasi['judul']?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..."><?php echo $rekomendasi['deskripsi']?></textarea>
                    </div>
                    <div class="buttons">
                        <button type="submit" name="submit" class="kirim-btn">Kirim</button>
                        <button type="button" class="kembali-btn" onclick="window.history.back()">Kembali</button>
                    </div>
                </div>
                <div class="upload-section">
                    <div class="upload-placeholder">
                        <?php $direktori = "../database/foto_rekomendasi/" . $rekomendasi["foto"];?>
                        <?php echo "<img src='$direktori' alt='Foto destinasi' class='gambar-update' id='title-img'>";?>
                        <img id="up-img" alt="preview" class="gambar-preview">
                    </div>
                    <label for="upload-file" class="upload-btn">Unggah File Gambar</label>
                    <input type="file" id="upload-file" name="upload_file" accept="image/*" style="display: none;" onchange="limit_size(event)">
                </div>
            </div>
        </form>
    </section>
</body>
<script src="../elements/scripts/script.js"></script>
</html>