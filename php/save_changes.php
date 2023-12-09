<?php
include 'jeep_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jeepId']) && isset($_POST['editJeepName'])) {
    $jeepId = $_POST['jeepId'];
    $newJeepName = $_POST['editJeepName'];

    // Validation (perform any necessary validation)

    // Update the name in the database
    $query = "UPDATE `jeepney-counter` SET jeepney_name = ? WHERE jeepney_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "si", $newJeepName, $jeepId);
    
    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo "Changes saved successfully";
    } else {
        // Error updating name
        echo "Error saving changes: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request method or missing parameters
    echo "Invalid request method or missing parameters";
}

mysqli_close($con);
?>
