<?php
    include 'connect.php';

    if (isset($_GET['appointmentId'])) {
        $appointmentId = $_GET['appointmentId'];

        $sql = "SELECT * FROM appointments WHERE appointmentId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $appointmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Get procedure name
            $procedureSql = "SELECT procedureName FROM procedures WHERE id = ?";
            $procedureStmt = $conn->prepare($procedureSql);
            $procedureStmt->bind_param("s", $row['visitFor']);
            $procedureStmt->execute();
            $procedureResult = $procedureStmt->get_result();
            if ($procedureResult->num_rows === 1) {
                $procedureRow = $procedureResult->fetch_assoc();
                $row['visitForText'] = $procedureRow['procedureName'];
            } else {
                $row['visitForText'] = 'Unknown';
                $row['error'] = 'Procedure not found for appointment ID: ' . $appointmentId . ', visitFor: ' . $row['visitFor'];
            }
            $procedureStmt->close();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Appointment not found']);
        }
    } else {
        echo json_encode(['error' => 'appointmentId not provided']);
    }

    $conn->close();
?>