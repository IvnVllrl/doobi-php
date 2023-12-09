<?php
$con = mysqli_connect('localhost', 'root', '', 'jeepney-counter');

if (mysqli_connect_error()) {
    echo "Cannot Connect";
    exit();
}

$sql = "SELECT file_route FROM `jeepney-info` WHERE file_route IS NOT NULL";
$result = mysqli_query($con, $sql);

$files = [];

while ($row = mysqli_fetch_assoc($result)) {
    $files[] = $row['file_route'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Files</title>
</head>
<body>
    <h2>Uploaded Files</h2>
    <ul>
        <?php foreach ($files as $file): ?>
            <li><a href="<?php echo $file; ?>" target="_blank"><?php echo basename($file); ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
