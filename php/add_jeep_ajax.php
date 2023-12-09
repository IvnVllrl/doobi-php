<?php
// Include your database connection file
require_once("jeep_connection.php");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $jeepName = $_POST["jeepName"];
    $jeepColor = $_POST["jeepColor"];
    $maxSeats = $_POST["maxSeats"];

    $uploadDir = '../map/';
    $uploadedFile = $uploadDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFile)) {
        $sql = "INSERT INTO `jeepney-info` (jeepney_name, jeepney_color, jeepney_seats, file_route) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $jeepName, $jeepColor, $maxSeats, $uploadedFile);

        if ($stmt->execute()) {
            $response = ["status" => "success", "message" => "Jeep added successfully!"];
        } else {
            $response = ["status" => "error", "message" => "Error: " . $stmt->error];
        }

        $stmt->close();
    } else {
        $response = ["status" => "error", "message" => "File upload failed"];
    }


    // Close the statement and connection
    $con->close();

    // Return JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // If not a POST request, return an error
    header("HTTP/1.1 405 Method Not Allowed");
    echo "Method Not Allowed";
}
?>
