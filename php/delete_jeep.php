<?php
include 'jeep_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jeepId'])) {
    $jeepId = $_POST['jeepId'];

    // Validation (perform any necessary validation)

    // Delete the record from the database
    $query = "DELETE FROM `jeepney-counter` WHERE jeepney_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $jeepId);

    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful
        echo "Jeep deleted successfully";
    } else {
        // Error deleting record
        echo "Error deleting jeep: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request method or missing parameters
    echo "Invalid request method or missing parameters";
}

mysqli_close($con);
?>
