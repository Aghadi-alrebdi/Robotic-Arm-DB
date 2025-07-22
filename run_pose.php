<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo "Invalid data.";
    exit;
}

$servo1 = $data['servo1'];
$servo2 = $data['servo2'];
$servo3 = $data['servo3'];
$servo4 = $data['servo4'];
$servo5 = $data['servo5'];
$servo6 = $data['servo6'];

$check = $conn->query("SELECT COUNT(*) as count FROM Run");
$count = $check->fetch_assoc()['count'];

if ($count > 0) {
 
    $stmt = $conn->prepare("
        UPDATE Run SET 
            servo1 = ?, servo2 = ?, servo3 = ?, 
            servo4 = ?, servo5 = ?, servo6 = ?, 
            status = 1
        LIMIT 1
    ");
    $stmt->bind_param("dddddd", $servo1, $servo2, $servo3, $servo4, $servo5, $servo6);
    $stmt->execute();
    echo "Run pose updated.";
} else {
    $stmt = $conn->prepare("
        INSERT INTO Run (servo1, servo2, servo3, servo4, servo5, servo6, status) 
        VALUES (?, ?, ?, ?, ?, ?, 1)
    ");
    $stmt->bind_param("dddddd", $servo1, $servo2, $servo3, $servo4, $servo5, $servo6);
    $stmt->execute();
    echo "Run pose saved.";
}

$conn->close();
?>

