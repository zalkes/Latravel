<?php
include '../database/koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "
        <script>
            document.location.href = '../login_page/login.php';
        </script>
    ";
    exit();
}

if (!isset($_POST['id_post']) || empty($_POST['id_post'])) {
    header("Location: Rekomendasi.php");
    exit();
}

$id_rekomen = $_POST['id_post'];
$username = $_SESSION['username'];


$sql_check = "SELECT id FROM suka WHERE fk_id_rekomen = ? AND fk_username = ?";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    die("Error preparing statement (CHECK): " . $conn->error);
}
$stmt_check->bind_param("is", $id_rekomen, $username);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $sql_delete = "DELETE FROM suka WHERE fk_id_rekomen = ? AND fk_username = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if (!$stmt_delete) {
        die("Error preparing statement (DELETE): " . $conn->error);
    }
    $stmt_delete->bind_param("is", $id_rekomen, $username);
    $stmt_delete->execute();
} else {
    $sql_insert = "INSERT INTO suka (fk_id_rekomen, fk_username, fk_id_destinasi, disukai) VALUES (?, ?, 0, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Error preparing statement (INSERT): " . $conn->error);
    }
    $stmt_insert->bind_param("is", $id_rekomen, $username);
    $stmt_insert->execute();
}

header("Location: Rekomendasi.php");
exit();