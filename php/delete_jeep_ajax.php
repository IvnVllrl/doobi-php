<?php
// Include your database connection file
require_once("jeep_connection.php");

// Retrieve value from POST data
$jeepId = $_POST['jeepId'];

// Assuming you have a table named 'jeepney-info'
$sql = "DELETE FROM `jeepney-info` WHERE `id` = $jeepId";

if (mysqli_query($con, $sql)) {
    $response = [
        'status' => 'success',
        'message' => 'Jeep information deleted successfully.'
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error deleting Jeep information: ' . mysqli_error($con)
    ];
}

// Close the database connection
mysqli_close($con);

// Return a response in JSON format
echo json_encode($response);
?>