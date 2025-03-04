<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$userType = $_SESSION['position'];

$sql = "SELECT * FROM users WHERE doctorId = ? AND position = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
    exit;
}
$stmt->bind_param("is", $userId, $userType);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Fetch emergency contact information if available
    $emergencyContact = null;
    // Corrected SQL query to join based on firstKinId and emergency_contact_id
    $emergencySql = "SELECT * FROM emergency_contact WHERE emergency_contact_id = (SELECT firstKinId FROM users WHERE doctorId = ?)";
    $emergencyStmt = $conn->prepare($emergencySql);
    if (!$emergencyStmt) {
        echo json_encode(['error' => 'Prepare failed for emergency contact query: (' . $conn->errno . ') ' . $conn->error]);
        exit;
    }
    $emergencyStmt->bind_param("i", $userId);
    if (!$emergencyStmt->execute()) {
        echo json_encode(['error' => 'Execute failed for emergency contact query: (' . $emergencyStmt->errno . ') ' . $emergencyStmt->error]);
        exit;
    }
    $emergencyResult = $emergencyStmt->get_result();
    if ($emergencyResult->num_rows > 0) {
        $emergencyContact = $emergencyResult->fetch_assoc();
    }

    // Get specialization ID
    $specializationId = null;
    if ($userData['specialization']) {
      $specSql = "SELECT id FROM procedures WHERE procedureName = ?";
      $specStmt = $conn->prepare($specSql);
      
      if ($specStmt) {
        $specStmt->bind_param("s", $userData['specialization']);
        $specStmt->execute();
        $specResult = $specStmt->get_result();
        if ($specResult->num_rows > 0) {
            $specData = $specResult->fetch_assoc();
            $specializationId = $specData['id'];
        }
        $specStmt->close();
      } else {
        echo json_encode(['error' => 'Prepare failed for specialization query: (' . $conn->errno . ') ' . $conn->error]);
        exit;
      }
    }


    // Convert 'position' to lowercase to match the enum values in the database
    $userData['position'] = strtolower($userData['position']);
    $userData['specializationId'] = $specializationId;

    // Combine user and emergency contact data
    $response = [
        'user' => $userData,
        'emergencyContact' => $emergencyContact
    ];
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'User not found']);
}

$stmt->close();
$emergencyStmt->close(); // Close the emergency statement
$conn->close();

?>
