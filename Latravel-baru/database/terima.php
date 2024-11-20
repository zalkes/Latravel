<?php
    session_start();
    require "koneksi.php";

    if (isset($_GET["id_rekomendasi"])){
        $id_rekomendasi = $_GET["id_rekomendasi"];
        $sql = "UPDATE rekomendasi SET stat = 'Disetujui' WHERE id = $id_rekomendasi";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
            <script>
            alert('Berhasil Menyetujui Rekomendasi!');
            document.location.href = '../admin/rekomendasi.php';
            </script>
            ";
        }
    }
?>