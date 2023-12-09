<?php
session_start();

include 'jeep_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($enteredPassword, $row["password"])) {
            $_SESSION['username'] = $enteredUsername;
            header("Location: admin.php");
            exit();
        } else {
            // Invalid username or password
            echo "Invalid username or password!";
        }
    } else {
        // Invalid username or password
        echo "Invalid username or password!";
    }
}

$conn->close();
?>
