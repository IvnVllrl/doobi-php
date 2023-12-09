<?php

include 'jeep_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jeepId']) && isset($_POST['operation'])) {
    $jeepId = $_POST['jeepId'];
    $operation = $_POST['operation'];

    // Perform any necessary validation

    // Update the counter in the database
    $query = "UPDATE `jeepney-counter` SET jeepney_counter = GREATEST(jeepney_counter + $operation, 0) WHERE jeepney_id = $jeepId";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error updating counter: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method or missing parameters";
}
?>
