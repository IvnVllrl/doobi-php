<?php
    session_start();

    include "jeep_connection.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jeepney Info</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="../img/favicon/favicon.png"
      type="image/x-icon"
    />

    <!-- External Stylesheet and Script -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/jeepney.css">
    <script src="../js/jeepney.js" defer></script>
  </head>
  <body>
    <!-- Header Content -->
    <header>
      <div class="logo">
        <a href="../index.html"><img src="../img/logo.png" alt="Logo" /></a>
      </div>
      <nav>
        <ul>
          <li><a href="../index.html">Home</a></li>
          <li><a href="jeepney.php" class="active">Jeepney Info</a></li>
          <li><a href="../terminal.php">Terminal</a></li>
          <li><a href="admin.php">Admin Panel</a></li>
        </ul>
      </nav>
    </header>
    <div class="main-content">
      <h1 class="header-jeepney">Check Jeep Information</h1>
      <p>Have a look at the Jeep Colors, Names, Seats, and Jeepney Routes</p>
      <div class="jeep-content" id="dataSection">
      </div>
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

    <div id="DetailsModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal('DetailsModal')">&times;</span>
        <h2>Jeep Details</h2>
        <form action="#" method="post" id="editJeepForm">
          <input type="hidden" name="jeepId" id="modalJeepId">
          <label for="editJeepName">Jeep Name:</label>
          <input type="text" name="editJeepName" id="editJeepName" readonly>

          <label for="editJeepColor" class="non-clickable-color">Jeep Color:</label>
          <input type="color" class="non-clickable-color" name="editJeepColor" id="editJeepColor" readonly>

          <label for="editMaxSeats">Maximum Seats:</label>
          <input type="number" name="editMaxSeats" id="editMaxSeats" min="14" value="1" readonly>
        </form>
      </div>
    </div>
  </body>
</html>
