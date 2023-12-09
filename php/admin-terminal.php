<?php
    session_start();
    if(!isset($_SESSION["usernameID"])){
        header("location: admin.php");
    }

    include "jeep_connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Terminal</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      href="../img/favicon/favicon.png"
      type="image/x-icon"
    />

    <!-- External Stylesheet and Script -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/terminal-style.css">
    <script src="../js/admin-terminal.js" defer></script>
</head>
<body>
    <!-- Header Content -->
    <header>
        <div class="logo">
            <a href="admin-jeep.php"><img src="../img/logo.png" alt="Logo" /></a>
        </div>
        <nav>
            <ul>
                <li><a href="admin-jeep.php">Jeepney Info</a></li>
                <li><a href="admin-terminal.php" class="active">Terminal</a></li>
                <li><form method="POST">
                        <button name="Logout">Logout</button>
                        <!-- <button name="Logout" <?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'class="active"' : ''?>>Log out</button> -->
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
      <!-- <div class="left-section"> -->
        <div class="explore-jeep">
          <h1>Explore Jeep Terminals</h1>
        </div>
        <div class="add-jeep-wrapper">
          <button class="addJeep" onclick="openModal('AddJeepModal')">ADD JEEP</button>
        </div>
      <!-- </div> -->
      <div class="jeep-data">
        <div class="shape">
          <h1>MBLCT</h1>
          <p>AVAILABLE JEEPS</p>
          <div class="shape2" id="MBLCT-section">
            <!-- display data -->
          </div>
        </div>
        <div class="shape">
          <h1>MARQEE</h1>
          <p>AVAILABLE JEEPS</p>
          <div class="shape2" id="MARQUEE-section">
            <!-- display data -->
          </div>
        </div>
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
      <form action="#" method="post" id="addJeepForm">
        <label for="jeepName">Jeep Name:</label>
        <!-- <input type="text" name="jeepName" id="jeepName" placeholder="[Place] TO [Place]" required> -->
        <select name="jeepName" id="jeepName" required>
          <!-- Fetch and display jeep names dynamically -->
          <?php
            $query = "SELECT * FROM `jeepney-info`";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)){
              echo "<option value='{$row['jeepney_name']}'>{$row['jeepney_name']}</option>";
            }
          ?>
        </select>

        <label for="counter">Counter:</label>
        <input type="number" name="counter" id="counter" min="0" value="0" required>

        <label for="terminal">Terminal:</label>
        <select name="terminal" id="terminal" required>
          <option value="MBLCT">MBLCT</option>
          <option value="MARQUEE">MARQUEE</option>
        </select>

        <button class="add-jeep" type="button" onclick="addJeep()">Add Jeep</button>
      </form>
      </div>
    </div>

    <div id="EditJeepModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal('EditJeepModal')">&times;</span>
        <h2>Edit Jeep</h2>
        <form action="#" method="post" id="editJeepForm">
          <!-- Display the current name -->
          <p id="currentJeepName"></p>
          <!-- Input for the new name -->
          <label for="editJeepName">Edit Jeep Name:</label>
          <!-- <input type="text" name="newJeepName" id="newJeepName" required> -->
          <select name="editJeepName" id="editJeepName" required>
          <!-- Fetch and display jeep names dynamically -->
          <?php
            $query = "SELECT * FROM `jeepney-info`";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)){
              echo "<option value='{$row['jeepney_name']}'>{$row['jeepney_name']}</option>";
            }
          ?>
        </select>
          <!-- Buttons for saving changes and deleting -->
          <div class="button-container">
            <button type="button" class="edit-jeep" onclick="saveChanges()">Save Changes</button>
            <button type="button" class="delete-jeep" onclick="deleteJeep()">Delete</button>
          </div>
        </form>
      </div>
    </div>



</body>
</html>