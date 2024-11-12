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

    $sql_select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna");

    $pengguna = [];
    while ($row_pengguna = mysqli_fetch_assoc($sql_select_pengguna)) {
        $pengguna[] = $row_pengguna;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna | LATRAVEL</title>
    <link rel="stylesheet" href="../elements/styles/admin.css">
</head>
<body>
    <?php include '../elements/sidebar-admin.php'; ?>
    <section class="main-content">
        <header>
            <h3>DAFTAR PENGGUNA</h3>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="../assets/images/admin.png" alt="Admin Icon" class="profile-icon">
            </div>
        </header>
        <div class="search-container">
            <input type="text" placeholder="Pencarian..." id="search">
            <button id="searchButton"><img src="../assets/icon/cari.png" alt="Icon" width="16" height="16"></i></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($pengguna as $user) : ?>
                <?php $direktori = "../database/profil_pengguna/" . $user["foto"];?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?php if ($user["foto"] == "") {echo "Foto belum ada";} else {echo "<img src='$direktori' alt='Foto pengguna' width='80px' heigth='80px'>";} ?></td>
                    <td><?php echo $user["username"];?></td>
                    <td><?php echo $user["email"];?></td>
                    <td><a href="../database/delete.php?username=<?= $user['username'] ?>" onclick="return confirm('Yakin ingin menghapus akun pengguna ini?');" class='delete-btn'><img src='../assets/icon/sampah.png'></a></td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <div class="pagination" id="pagination"></div>
        </div>
    </section>
    <script src="../elements/scripts/script.js"></script>
</body>
</html>
