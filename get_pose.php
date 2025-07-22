<?php
include 'db.php';

$sql = "SELECT * FROM Pose ORDER BY id ASC";
$result = $conn->query($sql);

$poses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $poses[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($poses);

$conn->close();
?>
