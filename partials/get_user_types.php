<?php
include 'connect.php';

$sql = "SELECT DISTINCT position FROM users"; // Assuming 'position' holds the user type
$result = $conn->query($sql);

$userTypes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Convert to sentence case if it's 'DOCTOR'
        $userType = ($row['position'] == 'Doctor') ? 'doctor' : $row['position'];
        $userTypes[] = $userType;
    }
}

echo json_encode($userTypes);

$conn->close();
?>