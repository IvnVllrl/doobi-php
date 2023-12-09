<?php
$con = mysqli_connect('localhost', 'root', '', 'jeepney-counter');

if (mysqli_connect_error()) {
    echo "Cannot Connect";
    exit();
}

// Perform SQL selection
$sql = "SELECT * FROM `jeepney-info`";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($con);
    exit();
}

$data = [];

// Fetch data as associative array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the connection
mysqli_close($con);

// Return data as JSON
echo json_encode($data);
?>
