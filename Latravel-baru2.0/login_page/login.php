<?php
    session_start();
    require "../database/koneksi.php";
    if (isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql_select = mysqli_query($conn, "SELECT * FROM pengguna");

        if ($username == "admin" && $password == "admin123"){
            $_SESSION["admin"] = true;
            echo "
                <script>
                    alert('Login Berhasil, Selamat Datang Admin');
                    document.location.href = '../admin/dashboard.php';
                </script>
            ";
            exit;
        }

        $count = 0;
        while ($row = mysqli_fetch_assoc($sql_select)){
            $pengguna[] = $row;
            if ($pengguna[$count]["username"] == $username && password_verify($password, $pengguna[$count]["pw"])){
                $_SESSION["user"] = true;
                $_SESSION["username"] = $pengguna[$count]["username"];
                echo "
                    <script>
                        alert('Login Berhasil, Selamat Datang ". $pengguna[$count]["username"] ."');
                        document.location.href = '../';
                    </script>
                ";

                exit;
                
            } 
            $count ++;
        }

        echo "
            <script>
                alert('Gagal Login, username atau password salah');
                document.location.href = 'login.php?errorlog=Username atau Password salah';
            </script>
        ";
        exit;
        
    } else if (isset($_POST["signup"])) {
        $username_up = $_POST['username_up'];
        $email_up = $_POST['email_up'];
        $password_up = $_POST['password_up'];
        $conf_password_up = $_POST['conf_password_up'];

        $checkQuery = "SELECT * FROM pengguna WHERE username = '$username_up'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if ($username_up == "admin"){
            echo 
            "<script>
            alert('Username sudah digunakan');
            document.location.href = 'login.php?errorup=Username sudah digunakan';
            </script>";
        }

        if (mysqli_num_rows($checkResult) > 0) {
            echo 
            "<script>
            alert('Username sudah digunakan');
            document.location.href = 'login.php?errorup=Username sudah digunakan';
            </script>";
        
        } if ($password_up != $conf_password_up) {
            echo 
            "<script>
            alert('Pastikan konfirmasi password sudah benar');
            document.location.href = 'login.php?errorup=Pastikan konfirmasi password sudah benar';
            </script>";

        } else {
            $password_up = password_hash($password_up, PASSWORD_DEFAULT);
            $query = "INSERT INTO pengguna (username, email, pw, bio, foto) VALUES ('$username_up', '$email_up', '$password_up', '', '')";
            
            if (mysqli_query($conn, $query)) {
                echo "
                <script>
                    alert('Signup berhasil, silakan login');
                    document.location.href = 'login.php';
                </script>";
            } else {
                echo "
                <script>
                    alert('Signup gagal, coba lagi');
                    document.location.href = 'login.php';
                </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>LoginPage</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../elements/styles/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">
                    MASUK
                    <?php if (isset($_GET['errorlog'])) { ?>
                        <p class="error"><?= $_GET['errorlog']; ?></p>
                    <?php } ?>
                </div>
                <div class="title signup">
                    DAFTAR
                    <?php if (isset($_GET['errorup'])) { ?>
                        <p class="error"><?= $_GET['errorup']; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">MASUK</label>
                    <label for="signup" class="slide signup">DAFTAR</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form action="" method="POST" class="login" >
                        <div class="field">
                            <input type="text" id="username" name="username" placeholder="Username" required autocomplete="off">
                            <label for="username"><i class="fas fa-user fa-lg"></i></label>
                        </div>
                        <div class="field">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <label for="password"><i class="fas fa-lock fa-lg"></i></label>
                        </div>
                        <div class="pass-link">
                            <a href="forgotpw.php">Lupa Password?</a>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" name="login" value="MASUK">
                        </div>
                        <div class="google">
                            <a>Atau masuk dengan</a>
                        </div>
                        <div class="field btn">
                            <div class="btn-google">
                                <img src="../assets/icon/google.png" alt="google" width=25px height=25px>
                                <input id="google-login" type="submit" name="login" value="Google">
                            </div>
                        </div>
                    </form>
                    <form action="" method="POST" class="signup">
                        <div class="field">
                            <input type="text" name="username_up" id="username_up" placeholder="Username" required autocomplete="off">
                            <label for="username"><i class="fas fa-user fa-lg"></i></label>
                        </div>
                        <div class="field">
                            <input type="email" name="email_up" id="email_up" placeholder="Email" required autocomplete="off">
                            <label for="email"><i class="fas fa-envelope fa-lg"></i></label>
                        </div>
                        <div class="field">
                            <input type="password" name="password_up" id="password_up" placeholder="Password" required>
                            <label for="password"><i class="fas fa-lock fa-lg"></i></label>
                        </div>
                        <div class="field">
                            <input type="password" name="conf_password_up" id="conf_password_up" placeholder="Konfirmasi Password" required>
                            <label for="password"><i class="fas fa-lock fa-lg"></i></label>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" name="signup" value="DAFTAR">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <img src="../assets/images/logo2.png" class="logo">
    </body>
    <script src="../elements/scripts/login.js"></script>
</html>