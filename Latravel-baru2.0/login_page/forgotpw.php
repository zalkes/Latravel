<?php
session_start();
require "../database/koneksi.php";

if (isset($_POST["submit"])){
    $email = $_POST["email"];

    $sql_select = mysqli_query($conn, "SELECT * FROM pengguna");

    $count = 0;
    while ($row = mysqli_fetch_assoc($sql_select)){
        $pengguna[] = $row;
        if ($pengguna[$count]["email"] == $email){
            $_SESSION["email"] = $pengguna[$count]["email"];
            echo "
                <script>
                    document.location.href = 'newpw.php';
                </script>
            ";
            exit;
        }
        $count ++;
    }

    echo "
        <script>
            alert('Email tidak ditemukan');
            document.location.href = 'forgotpw.php';
        </script>
    ";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../elements/styles/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title signup">
                GANTI <br>PASSWORD
            </div>
        </div>
        <div class="title-text">
            <div id ="sub" class="title signup">
                KONFIRMASI EMAIL
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="" method="POST" class="signup">
                    <div class="field">
                        <input type="email" name="email" id="email"  placeholder="Email" required autocomplete="off">
                        <label for="email"><i class="fas fa-envelope fa-lg"></i></label>
                    </div>
                    <br><br>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="submit" value="Kirim">
                    </div>
                </form>
            </div>
        </div>
    </div>  
    <img src="../assets/images/logo2.png" class="logo">
</body>
</html>