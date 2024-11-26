<?php 
    session_start();
    require "koneksi.php";

    if (isset($_GET["username"])){
        $username = $_GET["username"];
        $select = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
        $pengguna = mysqli_fetch_assoc($select);
        $filePath = "../database/profil_pengguna/" . $pengguna["foto"];
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);
        }
        $result = mysqli_query($conn, "DELETE FROM pengguna WHERE username = '$username'");
    
        if ($result) {
            echo "
            <script>
            alert('Berhasil Menghapus Data Pengguna!');
            document.location.href = '../admin/pengguna.php';
            </script>
            ";
        }
    }

    if (isset($_GET["id_destinasi"])){
        $id_destinasi = $_GET["id_destinasi"];
        $select = mysqli_query($conn, "SELECT * FROM destinasi WHERE id = $id_destinasi");
        $destinasi = mysqli_fetch_assoc($select);
        $filePath = "../database/foto_destinasi/" . $destinasi["foto"];
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);
        }
        $result = mysqli_query($conn, "DELETE FROM destinasi WHERE id = $id_destinasi");
    
        if ($result) {
            echo "
            <script>
            alert('Berhasil Menghapus Data Destinasi!');
            document.location.href = '../admin/destinasi.php';
            </script>
            ";
        }
    }

    if (isset($_GET["id_panduan"])){
        $id_panduan = $_GET["id_panduan"];
        $select = mysqli_query($conn, "SELECT * FROM panduan WHERE id = $id_panduan");
        $panduan = mysqli_fetch_assoc($select);
        $filePath = "../database/foto_panduan/" . $panduan["foto"];
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);
        }
        $result = mysqli_query($conn, "DELETE FROM panduan WHERE id = $id_panduan");
    
        if ($result) {
            echo "
            <script>
            alert('Berhasil Menghapus Data Panduan!');
            document.location.href = '../admin/panduan.php';
            </script>
            ";
        }
    }

    if (isset($_GET["id_rekomendasi"])){
        $id_rekomendasi = $_GET["id_rekomendasi"];
        $select = mysqli_query($conn, "SELECT * FROM rekomendasi WHERE id = $id_rekomendasi");
        $rekomendasi = mysqli_fetch_assoc($select);
        $filePath = "../database/foto_rekomendasi/" . $rekomendasi["foto"];
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);
        }
        $result = mysqli_query($conn, "DELETE FROM rekomendasi WHERE id = $id_rekomendasi");
    
        if ($result) {
            echo "
            <script>
            alert('Berhasil Menghapus Rekomendasi!');
            document.location.href = '../user/profilPostingan.php';
            </script>
            ";
        }
    }

    if (isset($_GET["id_favorit"])){
        $id_favorit = $_GET["id_favorit"];
        $result = mysqli_query($conn, "DELETE FROM favorit WHERE fk_id_destinasi = $id_favorit");
    
        if ($result) {
            echo "
            <script>
            alert('Berhasil Menghapus dari Favorit!');
            document.location.href = '../user/profilFavorit.php';
            </script>
            ";
        }
    }
?>