<?php
include 'connect.php';

$sql = "SELECT DISTINCT accountStatus FROM users";
$result = $conn->query($sql);

$statuses = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $statuses[] = $row['accountStatus'];
    }
}

echo json_encode($statuses);

$conn->close();

?>