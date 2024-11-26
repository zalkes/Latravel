<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        echo "<script>document.location.href = '../login_page/login.php';</script>";
    }
    require "../database/koneksi.php";

    $search = $_GET['search'];
    $sql_select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username LIKE '%$search%' OR email LIKE '%$search%'");

    $pengguna = [];
    while ($row_pengguna = mysqli_fetch_assoc($sql_select_pengguna)) {
        $pengguna[] = $row_pengguna;
    }
?>

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
            <td><a href="../database/delete.php?username=<?= $user['username'] ?>" onclick="return confirm('Yakin ingin menghapus akun pengguna ini?');" class='delete-btn'><img src='../assets/icon/sampah.svg'></a></td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>