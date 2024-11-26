<?php
session_start();
require "../database/koneksi.php";

if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "Anda harus login untuk memberikan komentar."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $destinasi_id = isset($_POST['destinasi_id']) ? intval($_POST['destinasi_id']) : 0;
    $komentar = mysqli_real_escape_string($conn, trim($_POST['komentar']));

    if (empty($komentar)) {
        echo json_encode(["error" => "Komentar tidak valid atau tidak ada post ID."]);
        exit;
    }

    $sql = "INSERT INTO komentar (fk_username, fk_id_rekomen, fk_id_destinasi, komen) 
            VALUES ('$username', '$post_id', '$destinasi_id', '$komentar')";

    if (mysqli_query($conn, $sql)) {

        $sql_user = "SELECT foto FROM pengguna WHERE username = ?";
        $stmt = $conn->prepare($sql_user);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $foto = !empty($user['foto']) 
            ? "../database/profil_pengguna/" . $user['foto'] 
            : "https://gravatar.com/avatar/00000000000000000000000000000000?d=mp";

        $foto2 = !empty($user['foto']) 
            ? "database/profil_pengguna/" . $user['foto'] 
            : "https://gravatar.com/avatar/00000000000000000000000000000000?d=mp";


        echo json_encode([
            "success" => true,
            "username" => $username,
            "komentar" => $komentar,
            "foto" => $foto,
            "foto2" => $foto2
        ]);
    } else {
        echo json_encode(["error" => "Gagal menambahkan komentar: " . mysqli_error($conn)]);
    }
    exit;
} else {
    echo json_encode(["error" => "Metode HTTP tidak valid."]);
    exit;
}
?>
