<?php
    require "../database/koneksi.php";
    $pengguna;
    if (isset($_SESSION["user"])){
        $select_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
        if (mysqli_num_rows ($select_pengguna) == 0 && isset($_SESSION["user"])) {
            echo 
            "<script>
            document.location.href = 'login_page/logout.php?logout=true';
            </script>";
        }
    }
    
    if (isset($_SESSION["user"])) {
        $sql_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$_SESSION[username]'");
        while ($row = mysqli_fetch_assoc($sql_pengguna)) {
            $pengguna[] = $row;
        }
        $pengguna = $pengguna[0];
    }
?>

<link rel="stylesheet" href="../elements/styles/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<nav class="navbar">
  <div class="navbar-logo">
    <img src="../assets/images/logo2.png" alt="LATRAVEL Logo">
  </div>
  <div class="hamburger-menu" id="hamburger-menu" onclick="myFunction()">
    &#9776;
  </div>
  <ul class="navbar-menu" id="nav-op">
    <li><a href="../index.php">BERANDA</a></li>
    <li><a href="../user/rekomendasi.php">REKOMENDASI PENGGUNA</a></li>
    <li><a href="../index.php#about">TENTANG KAMI</a></li>
  </ul>
  <?php if(isset($_SESSION['user'])):?>
    <div class="navbar-profile" id="nav-pro">
      <?php $direktori = "../database/profil_pengguna/".$pengguna['foto'];?>
      <?php if ($pengguna['foto'] == ""){
      echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' class='user-pic' alt='Foto Profil' onclick='toggleMenu()'>";
      }else{
      echo "<img src='$direktori' class='user-pic' alt='Foto Profil' onclick='toggleMenu()'>";
      }
      ?>
      <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
              <div class="user-info">
                  <?php if ($pengguna["foto"] == "") {
                      echo "<img src='https://gravatar.com/avatar/00000000000000000000000000000000?d=mp' alt='Foto Profil'>";
                  } else {
                      echo "<img src='$direktori' alt='Foto Profil'>";
                  } ?>
                  <h3><?php echo $_SESSION["username"]?></h3>
              </div>
              <hr>

              <a href="../user/profilPostingan.php" class="sub-menu-link">
                  <i class="fa-solid fa-user"></i>
                  <p>Profil</p>
                  <span>></span>
              </a>

              <a href="../akun/keluar.php?logout=true" class="sub-menu-link">
                  <i class="fa-solid fa-sign-out"></i>
                  <p>Keluar</p>
                  <span>></span>
              </a>
          </div>
      </div>
    </div>
  <?php else: ?>
    <div class="login">
        <a href="login_page/login.php">MASUK</a>
    </div>
  <?php endif; ?>
</nav>