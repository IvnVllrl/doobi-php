<?php
    session_start();
    if(!isset($_SESSION["usernameID"])){
        header("location: admin.php");
    }    
    // include "jeep_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jeepney Info</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="../img/favicon/favicon.png"
      type="image/x-icon"
    />

    <!-- External Stylesheet and Script -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/jeep-style.css">
    <script src="../js/admin-jeep.js" defer></script>
</head>
<body>
    <!-- Header Content -->
    <header>
        <div class="logo">
            <a href="admin-jeep.php"><img src="../img/logo.png" alt="Logo" /></a>
        </div>
        <nav>
            <ul>
                <li><a href="admin-jeep.php" class="active">Jeepney Info</a></li>
                <li><a href="admin-terminal.php">Terminal</a></li>
                <li><form method="POST">
                        <button name="Logout">Logout</button>
                        <!-- <button name="Logout" <?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'class="active"' : ''?>>Log out</button> -->
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
      <h1 class="header-jeepney">Jeep Information</h1>
      <div class="add-jeep-wrapper">
          <button class="addJeep" onclick="openModal('AddJeepModal')">ADD JEEP</button>
      </div>
      <div class="jeep-content" id="dataSection">
      </div>
    </div>

    <?php
    if(isset($_POST['Logout'])){
        session_destroy();
        header('location: ../index.html');
    }
    ?>


<div id="AddJeepModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal('AddJeepModal')">&times;</span>
        <h2>Add Jeep</h2>
      <form action="#" method="post" id="addJeepForm" enctype="multipart/form-data">
        <label for="jeepName">Jeep Name:</label>
        <input type="text" name="jeepName" id="jeepName" placeholder="[Place] TO [Place]" required>
        
        <label for="jeepColor">Jeep Color:</label>
        <input type="color" name="jeepColor" id="jeepColor" required>

        <label for="maxSeats">Maximum Seats:</label>
        <input type="number" name="maxSeats" id="maxSeats" min="14" value="1" required>

        <label for="fileUpload">Upload Route:</label>
        <input type="file" name="fileUpload" id="fileUpload" required>
        
        <button class="add-jeep" type="button" onclick="addJeep()">Add Jeep</button>
      </form>
      </div>
</div>

<div id="DetailsModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('DetailsModal')">&times;</span>
    <h2>Jeep Details</h2>
    <form action="#" method="post" id="editJeepForm" enctype="multipart/form-data">
      <input type="hidden" name="jeepId" id="modalJeepId">
      <label for="editJeepName">Jeep Name:</label>
      <input type="text" name="editJeepName" id="editJeepName" required>

      <label for="editJeepColor">Jeep Color:</label>
      <input type="color" name="editJeepColor" id="editJeepColor" required>

      <label for="editMaxSeats">Maximum Seats:</label>
      <input type="number" name="editMaxSeats" id="editMaxSeats" min="14" value="1" required>

      <input type="hidden" name="originalFilePath" id="originalFilePath">

      <label for="editFileUpload">Upload Route:</label>
      <input type="file" name="fileUpload" id="editFileUpload" required>

      <div class="button-container">
        <button type="button" class="save-jeep" onclick="saveChanges()">Save Changes</button>
        <button type="button" class="delete-jeep" onclick="deleteJeep()">Delete</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>