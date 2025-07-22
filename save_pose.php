<?php
include 'db.php';

$servo1 = $_POST['servo1'];
$servo2 = $_POST['servo2'];
$servo3 = $_POST['servo3'];
$servo4 = $_POST['servo4'];
$servo5 = $_POST['servo5'];
$servo6 = $_POST['servo6'];

$stmt = $conn->prepare("INSERT INTO Pose (servo1, servo2, servo3, servo4, servo5, servo6) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("dddddd", $servo1, $servo2, $servo3, $servo4, $servo5, $servo6);

if ($stmt->execute()) {
    echo "Pose saved successfully.";
} else {
    echo "Error saving pose.";
}

$stmt->close();
$conn->close();
?>
