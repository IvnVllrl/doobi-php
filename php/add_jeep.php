<?php

include 'jeep_connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are set
    if (isset($_POST['jeepName']) && isset($_POST['counter']) && isset($_POST['terminal'])) {
        $jeepName = $_POST['jeepName'];
        $counter = $_POST['counter'];
        $terminal = $_POST['terminal'];

        // Validation: Check for empty values
        $errors = array();

        if (empty($jeepName)) {
            $errors[] = "Jeep Name is required";
        }

        if (!is_numeric($counter) || $counter < 0) {
            $errors[] = "Counter should be a non-negative number";
        }

        // Perform additional validation if needed

        // If there are no validation errors, proceed with the database operation
        if (empty($errors)) {
            // Insert the data into the database
            $query = "INSERT INTO `jeepney-counter` (jeepney_id, jeepney_name, jeepney_counter, terminal) VALUES (NULL, '$jeepName', $counter, '$terminal')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "Jeep added successfully!";
            } else {
                echo "<script>";
                echo "alert('Error adding jeep: " . mysqli_error($con) . "');";
                echo "</script>";
            }
        } else {
            // Display validation errors
            echo implode("<br>", $errors);
        }
    } else {
        echo "Invalid or missing data received";
    }
} else {
    echo "Invalid request method";
}

mysqli_close($con);
?>
