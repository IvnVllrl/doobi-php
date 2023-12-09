<?php
require_once("jeep_connection.php");

// Check if the required POST values are set
if (isset($_POST['jeepId'], $_POST['editJeepName'], $_POST['editJeepColor'], $_POST['editMaxSeats'], $_POST['originalFilePath'])) {
    $jeepId = $_POST['jeepId'];
    $jeepName = $_POST['editJeepName'];
    $jeepColor = $_POST['editJeepColor'];
    $maxSeats = $_POST['editMaxSeats'];
    $originalFilePath = $_POST['originalFilePath'];

    // Initialize the file path variable
    $newFilePath = $originalFilePath;

    // Check if a new file is uploaded
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../map/';
        $newFilePath = $uploadDir . basename($_FILES["fileUpload"]["name"]);

        // Move the uploaded file to the new location
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $newFilePath)) {
            // File uploaded successfully
        } else {
            // Handle the file move error
            $response = [
                'status' => 'error',
                'message' => 'Error moving uploaded file'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        // No file uploaded, keep the existing file path
        $newFilePath = $originalFilePath;
    }

    // Update information in the database
    $sql = "UPDATE `jeepney-info` SET
            `jeepney_name` = '$jeepName',
            `jeepney_color` = '$jeepColor',
            `jeepney_seats` = $maxSeats,
            `file_route` = '$newFilePath'
            WHERE `id` = $jeepId";

    if (mysqli_query($con, $sql)) {
        $response = [
            'status' => 'success',
            'message' => 'Jeep information updated successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error updating Jeep information: ' . mysqli_error($con)
        ];
    }

    mysqli_close($con);
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle the case where required POST values are not set
    $response = [
        'status' => 'error',
        'message' => 'Missing required POST values'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
