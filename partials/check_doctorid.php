<?php
require 'connect.php';

$doctorId = $_GET['doctorId'];

$sql = "SELECT doctorId FROM users WHERE doctorId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "true"; // Duplicate
} else {
    echo "false"; // Not a duplicate
}

$stmt->close();
?>