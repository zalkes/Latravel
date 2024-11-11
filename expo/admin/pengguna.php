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
                <?php
                // Sample Data
                for ($i = 1; $i <= 7; $i++) {
                    echo "<tr>
                            <td>$i</td>
                            <td><img src='../assets/images/sample.jpg' alt='Photo'></td>
                            <td>Abdul</td>
                            <td>Abdulganter@$i@mail.com</td>
                            <td><a href='' class='delete-btn'><img src='../assets/icon/sampah.png'></a></td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <span>&lt;</span>
            <span class="page-number active">1</span>
            <span class="page-number">2</span>
            <span class="page-number">3</span>
            <span class="page-number">10</span>
            <span>&gt;</span>
        </div>
    </section>
</body>
<script src="script.js"></script>
</html>
