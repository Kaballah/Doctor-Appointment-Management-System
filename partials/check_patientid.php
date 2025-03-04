<?php
include 'connect.php';

if(isset($_GET['patientId'])) {
    $patientId = $conn->real_escape_string($_GET['patientId']);
    
    $sql = "SELECT appointmentId FROM appointments WHERE appointmentId = '$patientId'";
    $result = $conn->query($sql);
    
    echo json_encode(['isUnique' => $result->num_rows === 0]);
    exit;
}

echo json_encode(['isUnique' => false]);