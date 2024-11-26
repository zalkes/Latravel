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

if (!isset($_POST['destinasi_id']) || empty($_POST['destinasi_id'])) {
    header("Location: ../index.php");
    exit();
}

$destinasi_id = $_POST['destinasi_id'];
$username = $_SESSION['username'];

$sql_check = "SELECT id FROM favorit WHERE fk_id_destinasi = ? AND fk_username = ?";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    die("Error preparing statement (CHECK): " . $conn->error);
}
$stmt_check->bind_param("is", $destinasi_id, $username);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $sql_delete = "DELETE FROM favorit WHERE fk_id_destinasi = ? AND fk_username = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if (!$stmt_delete) {
        die("Error preparing statement (DELETE): " . $conn->error);
    }
    $stmt_delete->bind_param("is", $destinasi_id, $username);
    $stmt_delete->execute();
} else {
    $sql_insert = "INSERT INTO favorit (fk_id_destinasi, fk_username, favoritkan) VALUES (?, ?, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Error preparing statement (INSERT): " . $conn->error);
    }
    $stmt_insert->bind_param("is", $destinasi_id, $username);
    $stmt_insert->execute();
}

echo json_encode(["success" => true]);
?>