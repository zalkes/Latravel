<?php
session_start();
require "../database/koneksi.php";

if (!isset($_SESSION['user'])) {
    header('Location: ../login_page/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;
    $destinasi_id = isset($_POST['destinasi_id']) ? $_POST['destinasi_id'] : 0;
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    $sql = "INSERT INTO komentar (fk_username, fk_id_rekomen, fk_id_destinasi, komen) VALUES ('$username', '$post_id', '$destinasi_id', '$komentar')";
    if (mysqli_query($conn, $sql)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
