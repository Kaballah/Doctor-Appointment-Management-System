<?php
include 'connect.php';
header('Content-Type: application/json');
ini_set('display_errors', 0);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $appointmentId = $conn->real_escape_string($_POST['patientID']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phoneNumber']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $procedure = $conn->real_escape_string($_POST['visitFor']);
    // Get doctor ID from selected doctor name
    $doctorName = $conn->real_escape_string($_POST['docAssigned']);
    $doctorQuery = $conn->query("SELECT doctorId FROM users WHERE CONCAT(salutation, ' ', firstName, ' ', lastName) = '$doctorName'");
    
    if($doctorQuery && $doctorQuery->num_rows > 0) {
        $doctorId = $doctorQuery->fetch_assoc()['doctorId'];
    } else {
        echo json_encode(['success' => false, 'error' => 'Doctor not found']);
        exit;
    }
    $date = $conn->real_escape_string($_POST['dateOfAppointment']);
    $time = $conn->real_escape_string($_POST['timeOfAppointment']);
    
    // Calculate year of birth from DOB
    $yob = date('Y', strtotime($dob));

    // Insert into database
    $sql = "INSERT INTO appointments (
        appointmentId, 
        patientFirstName, 
        patientLastName, 
        patientEmail, 
        phoneNumber, 
        yob, 
        visitFor, 
        doctorId, 
        dateOfAppointment, 
        timeOfAppointment,
        status
    ) VALUES (
        '$appointmentId',
        '$firstName',
        '$lastName',
        '$email',
        '$phone',
        '$yob',
        '$procedure',
        '$doctorId',
        '$date',
        '$time',
        'New'
    )";

    if($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}