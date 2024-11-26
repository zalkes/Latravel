<?php
session_start();
require "../database/koneksi.php";

if (!isset($_SESSION["user"])) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$username = $_SESSION["username"];
$id_post = $_POST["id_post"];

$sql_check = "SELECT * FROM suka WHERE fk_id_rekomen = ? AND fk_username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("is", $id_post, $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $sql_unlike = "DELETE FROM suka WHERE fk_id_rekomen = ? AND fk_username = ?";
    $stmt_unlike = $conn->prepare($sql_unlike);
    $stmt_unlike->bind_param("is", $id_post, $username);
    $stmt_unlike->execute();
    $liked = false;
} else {
    $sql_like = "INSERT INTO suka (fk_id_rekomen, fk_username) VALUES (?, ?)";
    $stmt_like = $conn->prepare($sql_like);
    $stmt_like->bind_param("is", $id_post, $username);
    $stmt_like->execute();
    $liked = true;
}

$sql_count = "SELECT COUNT(*) AS jumlah_like FROM suka WHERE fk_id_rekomen = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("i", $id_post);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$data = $result_count->fetch_assoc();

echo json_encode([
    "liked" => $liked,
    "jumlah_like" => $data["jumlah_like"]
]);
?>