<?php
    include 'connect.php';

    $sql = "SELECT id, procedureName FROM procedures WHERE status='available'";
    $result = $conn->query($sql);

    $procedures = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $procedures[] = $row;
        }
    }

    echo json_encode($procedures);
    $conn->close();
?>