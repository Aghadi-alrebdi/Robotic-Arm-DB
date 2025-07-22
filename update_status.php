<?php
include 'db.php';

$sql = "UPDATE Run SET status = 0";

if ($conn->query($sql) === TRUE) {
    echo "Status updated successfully.";
} else {
    echo "Error updating status.";
}

$conn->close();
?>


