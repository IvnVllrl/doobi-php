<?php

include 'jeep_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['terminal'])) {
    $terminal = $_GET['terminal'];

    // Fetch data from the database based on the selected terminal
    $query = "SELECT jc.*, ji.* FROM `jeepney-counter` jc
    JOIN `jeepney-info` ji ON jc.jeepney_name = ji.jeepney_name
    WHERE jc.terminal = '$terminal'";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='jeep-item' data-jeep-id='{$row['jeepney_id']}'>";
            echo "<div class='jeep-content'>";
            echo "<button class='counter-button decrement-button'>-</button>";
            echo "<p class='jeep-counter'>{$row['jeepney_counter']} / {$row['jeepney_seats']}</p>";
            echo "<button class='counter-button increment-button'>+</button>";
            echo "<p class='jeep-name'>{$row['jeepney_name']}</p>";
            echo "</div>";
            echo "<button class='edit-button' onclick=\"openEditModal('{$row['jeepney_id']}', '{$row['jeepney_name']}')\">EDIT</button>";
            echo "</div>";
        }
    } else {
        echo "Error fetching data: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method or missing terminal parameter";
}
?>