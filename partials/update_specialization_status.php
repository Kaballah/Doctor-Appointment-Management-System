<?php
include 'connect.php';

// Function to determine the status based on doctor counts
function determineStatus($activeCount, $inactiveCount, $newCount) {
    if ($activeCount > 0) {
        return 'available';
    } elseif ($inactiveCount > 0 && $activeCount == 0) {
        return 'paused';
    } else {
        return 'unavailable';
    }
}

$conn->begin_transaction();

try {
    // Get all distinct specializations from the procedures table
    $specializationsSql = "SELECT DISTINCT id, procedureName FROM procedures";
    $specializationsStmt = $conn->prepare($specializationsSql);
    if (!$specializationsStmt) {
        throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $specializationsStmt->execute();
    $specializationsResult = $specializationsStmt->get_result();

    while ($specialization = $specializationsResult->fetch_assoc()) {
        $specializationId = $specialization['id'];

        // Count doctors with the given specialization and different account statuses
        $doctorsSql = "SELECT
                            SUM(CASE WHEN accountStatus = 'active' THEN 1 ELSE 0 END) as activeCount,
                            SUM(CASE WHEN accountStatus = 'inactive' THEN 1 ELSE 0 END) as inactiveCount,
                            SUM(CASE WHEN accountStatus = 'new' THEN 1 ELSE 0 END) as newCount
                        FROM users
                        WHERE specialization = ?";
        $doctorsStmt = $conn->prepare($doctorsSql);
        if (!$doctorsStmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        
        $doctorsStmt->bind_param("s", $specializationId);
        $doctorsStmt->execute();
        $doctorsResult = $doctorsStmt->get_result();
        $doctorCounts = $doctorsResult->fetch_assoc();
        $doctorsStmt->close();

        $activeCount = (int)$doctorCounts['activeCount'];
        $inactiveCount = (int)$doctorCounts['inactiveCount'];
        $newCount = (int)$doctorCounts['newCount'];

        // Determine the new status
        $newStatus = determineStatus($activeCount, $inactiveCount, $newCount);

        // Update the procedures table
        $updateSql = "UPDATE procedures SET status = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if (!$updateStmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $updateStmt->bind_param("si", $newStatus, $specializationId);
        if (!$updateStmt->execute()) {
            throw new Exception("Update failed: (" . $conn->errno . ") " . $conn->error);
        }
        $updateStmt->close();
    }

    $conn->commit();
    echo "Specialization statuses updated successfully.\n";

} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage() . "\n";
}

$specializationsStmt->close();
$conn->close();

?>
