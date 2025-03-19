<?php
include 'connect.php';

$sql = "SELECT id, procedureName FROM procedures";
$result = $conn->query($sql);

$specializations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $specializations[] = $row; // Keep both id and name
    }
}

echo json_encode($specializations);

$conn->close();
?>