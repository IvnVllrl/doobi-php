<?php
  require("jeep_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
      const preventBack = () => {
        window.history.forward();
      };
      setTimeout("preventBack()", 0);
      window.onunload = function () {
        null;
      };
    </script>
    <title>Admin Panel</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="../img/favicon/favicon.png"
      type="image/x-icon"
    />

    <!-- External Stylesheet and Script -->
    <link rel="stylesheet" href="../css/admin-style.css" />
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <!-- Header Content -->
    <header>
      <div class="logo">
        <a href="index.html"><img src="../img/logo.png" alt="Logo" /></a>
      </div>
      <nav>
        <ul>
          <li><a href="../index.html">Home</a></li>
          <li><a href="jeepney.php">Jeepney Info</a></li>
          <li><a href="../terminal.php">Terminal</a></li>
          <li><a href="php/admin.php" class="active">Admin Panel</a></li>
        </ul>
      </nav>
    </header>
    <div class="main-content">    
          <h1>Sign in as an Admin</h1>
          <form method="POST">
            <input
              type="text"
              id="username"
              name="username"
              required
              aria-labelledby="username"
              placeholder="Username"
            />
            <div class="password-container">
              <input
                type="password"
                id="password"
                name="password"
                required
                aria-labelledby="password"
                placeholder="Password"
              />
              <button id="togglePassword" type="button">&#128065;</button>
            </div>
            <div id="errorMessage"></div>
            <input id="button" type="submit" name="Login" value="Sign In">
          </form>
    </div>
    <footer>
      <div class="footer-container">
        <div class="footer-left">
          <img src="../img/logo.png" alt="Logo" />
          <p>
            Discover passenger counts and explore detailed routes for a
            hassle-free commute. Empowering you with accurate data, Doobi is
            your guide to seamless travel in the world of jeepneys.
          </p>
        </div>
        <div class="footer-middle">
          <h2>Contact Us</h2>
          <p>Email: genesis@gmail.com</p>
          <p>Phone: +63-949-643-1915</p>
        </div>
        <div class="footer-right">
          <h2>Follow Us</h2>
          <div class="social-icons">
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="../img/logo-footer/facebook.png"
                alt="Facebook"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="../img/logo-footer/twitter.png"
                alt="Twitter"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="../img/logo-footer/instagram.png"
                alt="Instagram"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="../img/logo-footer/youtube.png"
                alt="YouTube"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="../img/logo-footer/github.png"
                alt="GitHub"
            /></a>
          </div>
          <p>&copy; 2023 Doobi. All rights reserved.</p>
        </div>
      </div>
    </footer>


    <?php
    
    if(isset($_POST["Login"])){
      $query = "SELECT * FROM `admin` WHERE `username` = '$_POST[username]' AND `password` = '$_POST[password]'";
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) == 1){
        session_start();
        $_SESSION['usernameID'] = $_POST['username'];
        header('location: admin-jeep.php');
      }else{
        echo '<script>
                const errorDiv = document.getElementById("errorMessage");
                errorDiv.textContent = "Incorrect Username/Password. Please try again!";
                errorDiv.style.display = "block";
              </script>';
      }
    }

    ?>

    <script>
      // Function to toggle password visibility
      const togglePasswordVisibility = () => {
      const passwordInput = document.getElementById("password");
      const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
    };
      // Attach event listener for the toggle password button
      document.getElementById("togglePassword").addEventListener("click", togglePasswordVisibility);
    </script>
  </body>
</html>
