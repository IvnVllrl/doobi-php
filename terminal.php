<?php
    session_start();

    include "php/jeep_connection.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Terminal</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="img/favicon/favicon.png"
      type="image/x-icon"
    />

    <!-- External Stylesheet and Script -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/terminal.css" />
    <script src="js/terminal.js" defer></script>
  </head>
  <body>
    <!-- Header Content -->
    <header>
      <div class="logo">
        <a href="index.html"><img src="img/logo.png" alt="Logo" /></a>
      </div>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="php/jeepney.php">Jeepney Info</a></li>
          <li><a href="terminal.php" class="active">Terminal</a></li>
          <li><a href="php/admin.php">Admin Panel</a></li>
        </ul>
      </nav>
    </header>
    <div class="main-content2">
      <div class="left-section">
        <h1>Explore Jeep Terminals</h1>
        <p>
          Discover real-time information about jeep availability at various
          terminals. Plan your journey with accurate and up-to-date data on
          terminal routes and jeep schedules.
        </p>
      </div>
      <div class="right-section">
        <div class="shape">
          <h1>MBLCT</h1>
          <p>AVAILABLE JEEPS</p>
          <div class="shape2" id="MBLCT-section">
          </div>
        </div>
        <div class="shape">
          <h1>MARQUEE</h1>
          <p>AVAILABLE JEEPS</p>
          <div class="shape2" id="MARQUEE-section">
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="footer-container">
        <div class="footer-left">
          <img src="img/logo.png" alt="Logo" />
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
                src="img/logo-footer/facebook.png"
                alt="Facebook"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="img/logo-footer/twitter.png"
                alt="Twitter"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="img/logo-footer/instagram.png"
                alt="Instagram"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="img/logo-footer/youtube.png"
                alt="YouTube"
            /></a>
            <a href="#" class="icon"
              ><img
                class="iconLogo"
                src="img/logo-footer/github.png"
                alt="GitHub"
            /></a>
          </div>
          <p>&copy; 2023 Doobi. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
