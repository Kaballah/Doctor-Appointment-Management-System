<?php
session_start();
require "../../partials/connect.php"; // Adjust path as needed

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); // Return empty array if not logged in
    exit;
}

$doctorId = (int)$_SESSION['user_id'];
$sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName, procedures.procedureName as visitForText
        FROM appointments
        LEFT JOIN users ON appointments.doctorId = users.doctorId
        LEFT JOIN procedures ON appointments.visitFor = procedures.id
        WHERE appointments.status = 'new' AND appointments.doctorId = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctorId);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = [
            $row["appointmentId"],
            $row["patientFirstName"] . " " . $row["patientLastName"],
            $row["patientEmail"],
            $row["visitForText"], // Use the aliased column name
            $row["doctorName"],
            $row["dateCreated"],
            "<button type='button' class='btn-sm btn-block bg-gradient-primary edit-appointment' style='border: 0;' data-toggle='modal' data-target='#modal-lg-edit' data-appointment-id='" . $row["appointmentId"] . "'>Edit</button>"
        ];
    }
}

echo json_encode($data);

$stmt->close();
$conn->close();

?>