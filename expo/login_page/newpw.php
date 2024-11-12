<?php 
    session_start();
    require "../database/koneksi.php";
    if (isset($_POST["submit"])){
        $password_new = $_POST["password_new"];
        $conf_password_new = $_POST["conf_password_new"];
        if ($password_new == $conf_password_new){
            $email = $_SESSION["email"];
            $password = password_hash($password_new, PASSWORD_DEFAULT);
            $sql_update = mysqli_query($conn, "UPDATE pengguna SET pw = '$password' WHERE email = '$email'");
            if ($sql_update){
                echo "
                    <script>
                        alert('Password berhasil diubah');
                        document.location.href = 'login.php';
                    </script>
                ";
                exit;
            } else {
                echo "
                    <script>
                        alert('Password gagal diubah');
                        document.location.href = 'newpw.php';
                    </script>
                ";
                exit;
            }
        } else {
            echo "
                <script>
                    alert('Pastikan konfirmasi password sudah benar');
                    document.location.href = 'newpw.php';
                </script>
            ";
            exit;
        }
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
                MASUKKAN PASSWORD BARU
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="" method="POST" class="signup">
                        <div class="field">
                            <input type="password" name="password_new" id="password_new" placeholder="Password Baru" required>
                        </div>
                        <div class="field">
                            <input type="password" name="conf_password_new" id="conf_password_new" placeholder="Konfirmasi Password" required>
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
    <img src="../assets/images/Logo.png" class="logo">
</body>
</html>