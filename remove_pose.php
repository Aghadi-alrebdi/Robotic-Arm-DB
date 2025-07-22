<?php
include 'db.php';

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM Pose WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Pose removed successfully.";
} else {
    echo "Error removing pose.";
}

$stmt->close();
$conn->close();
?>
