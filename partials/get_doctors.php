<?php
    include 'connect.php';

    if(isset($_GET['specialization'])){
        $specialization = $conn->real_escape_string($_GET['specialization']);

        $sql = "SELECT doctorId, CONCAT(salutation, ' ', firstName, ' ', lastName) AS doctorName FROM users WHERE specialization = ? AND position = 'doctor' AND accountStatus = 'active'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $specialization);
        $stmt->execute();
        $result = $stmt->get_result();

        $doctors = [];

        while($row = $result->fetch_assoc()){
            $doctors[] = $row;
        }

        echo json_encode($doctors);
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode([]);
    }
?>