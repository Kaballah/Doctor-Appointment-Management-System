<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$userType = $_SESSION['user_type'];

$userData = $_POST;

// Basic input validation (you should implement more robust validation)
if (empty($userData['firstName']) || empty($userData['lastName'])) {
    echo json_encode(['success' => false, 'error' => 'First name and last name are required']);
    exit;
}

$conn->begin_transaction();

try {
    // Update user data based on user type
    $sql = "UPDATE users SET salutation=?, firstName=?, lastName=?, username=?, address=?, dob=?, primaryNumber=?, primaryEmail=?, position=?, specialization=?, secondaryNumber=?, secondaryEmail=?, workingHoursWeekdays=?, workingHoursEndWeekdays=?, workingHoursWeekends=?, workingHoursEndWeekends=?, accountStatus=?, salary=? WHERE doctorId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssi", $userData['salutation'], $userData['firstName'], $userData['lastName'], $userData['username'], $userData['address'], $userData['dob'], $userData['primaryNumber'], $userData['primaryEmail'], $userData['position'], $userData['specialization'], $userData['secondaryNumber'], $userData['secondaryEmail'], $userData['weekdayStartHours'], $userData['weekdayEndHours'], $userData['weekendStartHours'], $userData['weekendEndHours'], $userData['accountStatus'], $userData['salary'], $userId);

    if (!$stmt->execute()) {
        throw new Exception("Error updating user information: " . $stmt->error);
    }

    // Update emergency contact information
    // Get the firstKinId from the users table
    $kinIdSql = "SELECT firstKinId FROM users WHERE doctorId=?";
    $kinIdStmt = $conn->prepare($kinIdSql);
    $kinIdStmt->bind_param("s", $userId);
    $kinIdStmt->execute();
    $kinIdResult = $kinIdStmt->get_result();
    if ($kinIdResult->num_rows === 0) {
        throw new Exception("User not found: " . $userId);
    }
    $kinIdRow = $kinIdResult->fetch_assoc();
    $firstKinId = $kinIdRow['firstKinId'];
    $kinIdStmt->close();

    $emergencySql = "UPDATE emergency_contact SET surname=?, last_name=?, phone_number=?, email=? WHERE emergency_contact_id=?";
    $emergencyStmt = $conn->prepare($emergencySql);
    $emergencyStmt->bind_param("sssss", $userData['emergencyContactFirstName'], $userData['emergencyContactLastName'], $userData['emergencyContactNumber'], $userData['emergencyContactAddress'], $firstKinId);

    if (!$emergencyStmt->execute()) {
        throw new Exception("Error updating emergency contact information: " . $emergencyStmt->error);
    }

    $conn->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$stmt->close();
$emergencyStmt->close();
$conn->close();
?>
