<?php
    include 'connect.php';

    $firstKinId = $_GET['firstKinId'] ?? null;
    $secondKinId = $_GET['secondKinId'] ?? null;

    $contacts = [];

    if ($firstKinId) {
        $sql1 = "SELECT salutation, surname, middle_name, last_name, phone_number, email FROM emergency_contact WHERE emergency_contact_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $firstKinId);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $contacts['contact1'] = $result1->fetch_assoc();
        }
        $stmt1->close();
    }

    if ($secondKinId) {
        $sql2 = "SELECT salutation, surname, middle_name, last_name, phone_number, email FROM emergency_contact WHERE emergency_contact_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $secondKinId);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            $contacts['contact2'] = $result2->fetch_assoc();
        }
        $stmt2->close();
    }

    header('Content-Type: application/json');
    echo json_encode($contacts);

    $conn->close();
?>