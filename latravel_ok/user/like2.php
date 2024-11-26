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

$username = $_SESSION['username'];
$destinasi_id = $_POST['destinasi_id'];

$sql_check = "SELECT id FROM suka WHERE fk_id_destinasi = ? AND fk_username = ?";
$stmt_check = $conn->prepare($sql_check);
if (!$stmt_check) {
    die("Error preparing statement (CHECK): " . $conn->error);
}
$stmt_check->bind_param("is", $destinasi_id, $username);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $sql_delete = "DELETE FROM suka WHERE fk_id_destinasi = ? AND fk_username = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if (!$stmt_delete) {
        die("Error preparing statement (DELETE): " . $conn->error);
    }
    $stmt_delete->bind_param("is", $destinasi_id, $username);
    $stmt_delete->execute();
    $liked = false;
} else {
    $sql_insert = "INSERT INTO suka (fk_id_destinasi, fk_username, fk_id_rekomen, disukai) VALUES (?, ?, 0, 1)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Error preparing statement (INSERT): " . $conn->error);
    }
    $stmt_insert->bind_param("is", $destinasi_id, $username);
    $stmt_insert->execute();
    $liked = true;
}

$sql_count = "SELECT COUNT(*) AS jumlah_like FROM suka WHERE fk_id_destinasi = ?";
$stmt_count = $conn->prepare($sql_count);
if (!$stmt_count) {
    die("Error preparing statement (COUNT): " . $conn->error);
}
$stmt_count->bind_param("i", $destinasi_id);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$data = $result_count->fetch_assoc();

echo json_encode([
    "liked" => $liked,
    "jumlah_like" => $data["jumlah_like"]
]);
?>