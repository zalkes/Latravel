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
    $id_panduan;
    if (isset($_GET["id_panduan"])){
        $id_panduan = $_GET["id_panduan"];
        $select = mysqli_query($conn, "SELECT * FROM panduan WHERE id = $id_panduan");
        $panduan = mysqli_fetch_assoc($select);
    }

    if (isset($_POST["submit"])){
        $judul = $_POST["judul"];
        $deskripsi = $_POST["deskripsi"];
        
        $foto = isset($_FILES["upload_file"]["name"]) ? $_FILES["upload_file"]["name"] : "";
        $temp = isset($_FILES["upload_file"]["tmp_name"]) ? $_FILES["upload_file"]["tmp_name"] : "";

        if ($foto == ""){
            $sql = "UPDATE panduan SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id_panduan";

            $result = mysqli_query($conn, $sql);

            if ($result){
                echo "
                    <script>
                        alert('Berhasil Mengubah Panduan');
                        document.location.href = 'panduan.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal Mengubah Panduan');
                    </script>
                ";
            }
        }

        date_default_timezone_set("Asia/Makassar");
        $ekstensi = explode('.', $foto);
        $ekstensi = strtolower(end($ekstensi));
        $namabaru = date("Y-m-d H.i.s") . "." . $ekstensi;
        $direktori = "../database/foto_panduan/" . $namabaru;
        $support = ["jpg", "jpeg", "png"];

        if (in_array($ekstensi, $support)){
            if (move_uploaded_file($temp, $direktori)){
                
                $sql = "UPDATE panduan SET judul = '$judul', deskripsi = '$deskripsi', foto = '$namabaru' WHERE id_panduan = $id_panduan";

                $result = mysqli_query($conn, $sql);

                if ($result){
                    echo "
                        <script>
                            alert('Berhasil Mengubah Panduan');
                            document.location.href = 'panduan.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Gagal Mengubah Panduan');
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
    <title>Ubah Panduan - LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>UBAH PANDUAN PERJALANAN</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="content-container">
                <div class="form-section">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" id="judul" name="judul" placeholder="Masukkan judul..." value="<?php echo $panduan['judul']?>">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi..."><?php echo $panduan['deskripsi']?></textarea>
                        </div>
                        <div class="buttons">
                            <button type="submit" name="submit" class="kirim-btn">Kirim</button>
                            <button type="button" class="kembali-btn" onclick="window.history.back()">Kembali</button>
                        </div>
                </div>

                <div class="upload-section">
                    <div class="upload-placeholder">
                        <?php $direktori = "../database/foto_panduan/" . $panduan["foto"];?>
                        <?php echo "<img src='$direktori' alt='Foto panduan' class='gambar-update' id='title-img'>";?>
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
