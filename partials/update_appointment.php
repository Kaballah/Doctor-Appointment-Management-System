<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Log received data
    file_put_contents('update_log.txt', 'Received data: ' . print_r($data, true) . PHP_EOL, FILE_APPEND);

    $appointmentId = $data['appointmentId'];
    $firstName = $data['firstName'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $phoneNumber = $data['phoneNumber'];
    $dob = $data['dob'];
    $yob = $data['yob'];
    $visitFor = $data['visitFor'];
    $docAssigned = $data['docAssigned'];
    $dateOfAppointment = $data['dateOfAppointment'];
    $timeOfAppointment = $data['timeOfAppointment'];
    $status = $data['status'];



    $sql = "UPDATE appointments SET patientFirstName=?, patientLastName=?, patientEmail=?, phoneNumber=?, dob=?, yob=?, visitFor=?, doctorId=?, dateOfAppointment=?, timeOfAppointment=?, status=? WHERE appointmentId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssissss", $firstName, $lastname, $email, $phoneNumber, $dob, $yob, $visitFor, $docAssigned, $dateOfAppointment, $timeOfAppointment, $status, $appointmentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
        echo "<script>console.error('SQL Error: " . addslashes($stmt->error) . "');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
