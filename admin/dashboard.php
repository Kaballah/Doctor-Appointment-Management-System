<?php 
    $currentPage = 'dashboard';
    
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    // Fetch user counts
    $newUsersQuery = "SELECT COUNT(*) AS newUsersCount FROM users WHERE accountStatus = 'new'";
    $newUsersResult = $conn->query($newUsersQuery);
    $newUsersCount = ($newUsersResult) ? $newUsersResult->fetch_assoc()['newUsersCount'] : 0;

    $activeUsersQuery = "SELECT COUNT(*) AS activeUsersCount FROM users WHERE accountStatus = 'active'";
    $activeUsersResult = $conn->query($activeUsersQuery);
    $activeUsersCount = ($activeUsersResult) ? $activeUsersResult->fetch_assoc()['activeUsersCount'] : 0;

    $inactiveUsersQuery = "SELECT COUNT(*) AS inactiveUsersCount FROM users WHERE accountStatus = 'inactive'";
    $inactiveUsersResult = $conn->query($inactiveUsersQuery);
    $inactiveUsersCount = ($inactiveUsersResult) ? $inactiveUsersResult->fetch_assoc()['inactiveUsersCount'] : 0;

    $allUsersQuery = "SELECT COUNT(*) AS allUsersCount FROM users";
    $allUsersResult = $conn->query($allUsersQuery);
    $allUsersCount = ($allUsersResult) ? $allUsersResult->fetch_assoc()['allUsersCount'] : 0;
?>

<?php
    $newQuery = 'SELECT COUNT(*) AS NewCount FROM appointments WHERE status="new" ';

    $newResults = $conn->query($newQuery);
    $newCount = 0;
    
    if ($newResults) {
        $row = $newResults->fetch_assoc();
        $newCount = $row['NewCount'];
    }
?>

<?php
    $approvedQuery = 'SELECT COUNT(*) AS ApprovedCount FROM appointments WHERE status="approved" ';

    $approvedResults = $conn->query($approvedQuery);
    $approvedCount = 0;
    
    if ($approvedResults) {
        $row = $approvedResults->fetch_assoc();
        $approvedCount = $row['ApprovedCount'];
    }
?>

<?php
    $cancelledQuery = 'SELECT COUNT(*) AS CancelledCount FROM appointments WHERE status="cancelled" ';

    $cancelledResults = $conn->query($cancelledQuery);
    $cancelledCount = 0;
    
    if ($cancelledResults) {
        $row = $cancelledResults->fetch_assoc();
        $cancelledCount = $row['CancelledCount'];
    }
?>

<?php
    $allQuery = 'SELECT COUNT(*) AS AllCount FROM appointments ';

    $allResults = $conn->query($allQuery);
    $allCount = 0;
    
    if ($allResults) {
        $row = $allResults->fetch_assoc();
        $allCount = $row['AllCount'];
    }
?>

<?php
    $queryThisWeek = "SELECT DATE(appointments.dateOfAppointment) AS AppointmentDate, COUNT(*) AS PatientCount FROM appointments WHERE appointments.dateOfAppointment >= CURDATE() - INTERVAL 6 DAY GROUP BY DATE(appointments.dateOfAppointment) ORDER BY AppointmentDate DESC";

    $resultThisWeek = $conn->query($queryThisWeek);

    $datesThisWeek = [];
    $patientCountsThisWeek = [];

    if ($resultThisWeek) {
        while ($row = $resultThisWeek->fetch_assoc()) {
            $datesThisWeek[] = $row['AppointmentDate'];
            $patientCountsThisWeek[] = $row['PatientCount'];
        }
    }

    // Fetching last week's data (7 days prior)
    $queryLastWeek = "SELECT DATE(appointments.dateOfAppointment) AS AppointmentDate, COUNT(*) AS PatientCount FROM appointments WHERE appointments.dateOfAppointment BETWEEN CURDATE() - INTERVAL (DAYOFWEEK(CURDATE()) + 6) DAY AND CURDATE() - INTERVAL DAYOFWEEK(CURDATE()) DAY GROUP BY DATE(appointments.dateOfAppointment) ORDER BY AppointmentDate DESC";

    $resultLastWeek = $conn->query($queryLastWeek);

    $datesLastWeek = [];
    $patientCountsLastWeek = [];

    if ($resultLastWeek) {
        while ($row = $resultLastWeek->fetch_assoc()) {
            $datesLastWeek[] = $row['AppointmentDate'];
            $patientCountsLastWeek[] = $row['PatientCount'];
        }
    }

    // Ensure exactly 7 days for both datasets
    $today = new DateTime();
    $graphDataThisWeek = [];
    $graphDataLastWeek = [];

    for ($i = 6; $i >= 0; $i--) {
        $day = clone $today;
        $day->modify("-$i day");
        $formattedDate = $day->format('Y-m-d');

        $graphDataThisWeek[$formattedDate] = 0; // Default count
        if (($key = array_search($formattedDate, $datesThisWeek)) !== false) {
            $graphDataThisWeek[$formattedDate] = $patientCountsThisWeek[$key];
        }

        $dayLastWeek = clone $today;
        $dayLastWeek->modify("-" . ($i - 7) . " day");
        $formattedDateLastWeek = $dayLastWeek->format('Y-m-d');

        $graphDataLastWeek[$formattedDateLastWeek] = 0; // Default count
        if (($key = array_search($formattedDateLastWeek, $datesLastWeek)) !== false) {
            $graphDataLastWeek[$formattedDateLastWeek] = $patientCountsLastWeek[$key];
        }
    }

    // Convert data to JSON for JavaScript
    $graphDates = json_encode(array_keys($graphDataThisWeek));
    $graphCountsThisWeek = json_encode(array_values($graphDataThisWeek));
    $graphCountsLastWeek = json_encode(array_values($graphDataLastWeek));

    $totalThisWeek = array_sum(array_values($graphDataThisWeek));
    $totalLastWeek = array_sum(array_values($graphDataLastWeek));

    $percentageDifference = 0;
    
    if ($totalLastWeek > 0) {
        $percentageDifference = (($totalThisWeek - $totalLastWeek) / $totalLastWeek) * 100;
    }
?>

<?php
    $sql = "SELECT CONCAT(patientfirstName, ' ', patientlastName) as patientName, phoneNumber, visitFor, dateCreated, dateOfAppointment, timeOfAppointment, doctorNote FROM appointments WHERE status = 'New' ";
    $NewModalResult = $conn->query($sql);
    
    $newModalAppointments = [];
    
    if ($NewModalResult->num_rows > 0) {
        while ($row = $NewModalResult->fetch_assoc()) {
            $newModalAppointments[] = $row;
        }
    }
?>

<?php
    $sql = "SELECT CONCAT(patientfirstName, ' ', patientlastName) as patientName, phoneNumber, visitFor, dateCreated, dateOfAppointment, timeOfAppointment, doctorNote FROM appointments WHERE status = 'Approved' ";
    $ApprovedModalResult = $conn->query($sql);
    
    $approvedModalAppointments = [];
    
    if ($ApprovedModalResult->num_rows > 0) {
        while ($row = $ApprovedModalResult->fetch_assoc()) {
            $approvedModalAppointments[] = $row;
        }
    }
?>

<?php
    $sql = "SELECT CONCAT(patientfirstName, ' ', patientlastName) as patientName, phoneNumber, visitFor, dateCreated, dateOfAppointment, timeOfAppointment, doctorNote FROM appointments WHERE dateOfAppointment < CURDATE() AND doctorNote IS NOT NULL ";
    $CompletedModalResult = $conn->query($sql);
    
    $completedModalAppointments = [];
    
    if ($CompletedModalResult->num_rows > 0) {
        while ($row = $CompletedModalResult->fetch_assoc()) {
            $completedModalAppointments[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Dashboard | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <!-- <link rel="stylesheet" href="../styles/dashboard.css"> -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </head>

    <body>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>
                                        <?php echo htmlspecialchars($newCount); ?>
                                    </h3>

                                    <p>New Appointments</p>
                                </div>
                                
                                <div class="icon">
                                    <i class="ion">
                                        <ion-icon name="person-add"></ion-icon>
                                    </i>
                                </div>
                            
                                <a href="./new_appointments.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>
                                        <?php echo htmlspecialchars($approvedCount); ?>
                                    </h3>

                                    <p>Approved Appointments</p>
                                </div>
                                
                                <div class="icon">
                                    <i class="ion">
                                        <ion-icon name="person"></ion-icon>
                                    </i>
                                </div>
                                
                                <a href="./approved_appointments.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>
                                        <?php echo htmlspecialchars($cancelledCount); ?>
                                    </h3>

                                    <p>Cancelled Appointments</p>
                                </div>

                                <div class="icon">
                                    <i class="ion">
                                        <ion-icon name="person-remove"></ion-icon>
                                    </i>
                                </div>

                                <a href="./cancelled_appointments.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>
                                        <?php echo htmlspecialchars($allCount); ?>
                                    </h3>

                                    <p>All Appointments</p>
                                </div>
              
                                <div class="icon">
                                    <i class="ion">
                                    <ion-icon name="people"></ion-icon>
                                    </i>
                                </div>
              
                                <a href="./appointments.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="new_users.php" style="color: black;">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">New Users</span>
                                        <span class="info-box-number">
                                            <?php echo $newUsersCount; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="active_users.php" style="color: black;">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Active Users</span>
                                        <span class="info-box-number">
                                            <?php echo $activeUsersCount; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="inactive_users.php" style="color: black;">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Inactive Users</span>
                                        <span class="info-box-number">
                                            <?php echo $inactiveUsersCount; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="users.php" style="color: black;">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">All Users</span>
                                        <span class="info-box-number">
                                            <?php echo $allUsersCount; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                $proceduresQuery = "SELECT p.procedureName, COUNT(a.visitFor) AS procedureCount
                                                    FROM procedures p
                                                    LEFT JOIN appointments a ON p.id = a.visitFor
                                                    GROUP BY p.procedureName";
                                $proceduresResult = $conn->query($proceduresQuery);

                                $procedureLabels = [];
                                $procedureCounts = [];
                                $procedureColors = [];

                                // Generate some colors
                                $colors = [
                                    '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de',
                                    '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
                                    '#e377c2', '#7f7f7f', '#bcbd22', '#17becf'
                                ];

                                if ($proceduresResult->num_rows > 0) {
                                    $colorIndex = 0;
                                    while ($row = $proceduresResult->fetch_assoc()) {
                                        $procedureLabels[] = $row['procedureName'];
                                        $procedureCounts[] = $row['procedureCount'];
                                        $procedureColors[] = $colors[$colorIndex % count($colors)]; // Cycle through colors
                                        $colorIndex++;
                                    }
                                }

                                $procedureLabelsJSON = json_encode($procedureLabels);
                                $procedureCountsJSON = json_encode($procedureCounts);
                                $procedureColorsJSON = json_encode($procedureColors);
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Visits per Procedure</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="chart-responsive">
                                                <canvas id="pieChart" height="150"></canvas>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <ul class="chart-legend clearfix" id="chartLegend">
                                                <!-- Legend will be generated here -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer p-0" style="display: none;">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?php
                                $recentUsersQuery = "SELECT CONCAT(salutation, ' ', firstName, ' ', lastName) AS fullName, dateCreated
                                                    FROM users
                                                    WHERE accountStatus = 'active'
                                                    ORDER BY dateCreated DESC
                                                    LIMIT 8";
                                $recentUsersResult = $conn->query($recentUsersQuery);
                                $recentUsers = [];
                                if ($recentUsersResult->num_rows > 0) {
                                    while ($row = $recentUsersResult->fetch_assoc()) {
                                        $recentUsers[] = $row;
                                    }
                                }
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">New Members</h3>

                                    <div class="card-tools">                                        
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        <?php foreach ($recentUsers as $user) : ?>
                                            <li>
                                                <img src="../dist/img/avatar.png" alt="User Image">
                                                <a class="users-list-name" href="#"><?php echo htmlspecialchars($user['fullName']); ?></a>
                                                <span class="users-list-date"><?php echo date('M d, Y', strtotime($user['dateCreated'])); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <div class="card-footer text-center">
                                <a href="users.php">View All Users</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="width: 100%">
                        <section class="col-lg-7 connectedSortable">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Patient Overview</h3>
                                        <a href="reports.php">View Report</a>
                                    </div>
                                </div>
            
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">
                                                <?php echo htmlspecialchars($allCount); ?>
                                            </span>
                                            <span>Patients Over Time</span>
                                        </p>

                                        <p class="ml-auto d-flex flex-column text-right percentage-difference">
                                            <span class="<?php echo $percentageDifference >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                <i class="fas fa-arrow-<?php echo $percentageDifference >= 0 ? 'up' : 'down'; ?>"></i> 
                                                <?php echo round(abs($percentageDifference), 1); ?>%
                                            </span>

                                            <span class="text-muted">Last 7 Days</span>
                                        </p>
                                    </div>

                                    <div class="position-relative mb-4">
                                        <canvas id="visitors-chart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="col-lg-5 connectedSortable">
                            <div class="card bg-gradient-success">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Appointments
                                    </h3>

                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>

                                            <div class="dropdown-menu" role="menu">
                                                <a href="#" class="dropdown-item">Add Appointment</a>
                                                <a href="appointments.php" class="dropdown-item">View Appointments</a>

                                                <div class="dropdown-divider"></div>

                                                <a href="javascript:void(0);" class="dropdown-item">View calendar</a>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div id="calendar" style="width: 100%;"></div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="modal fade" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <p id="selected-date">No date selected.</p>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="content-wrapper kanban" style="margin-left: 0; background-color: #fff; padding-bottom: 0; height: auto; min-height: 0;">
                                    <section class="content pb-3">
                                        <div class="container-fluid h-100">
                                            <div class="card card-row card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">New</h3>

                                                    <div class="card-tools">
                                                        <h6>
                                                            <?php echo count($newModalAppointments); ?>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="card-body" style="height: 50vh;">
                                                    <div class="card card-outline">
                                                        <div id="appointments-list">
                                                            <?php if (empty($newModalAppointments)) : ?>
                                                                <p>No appointments found with status "New".</p>
                                                            <?php else : ?>
                                                                <?php foreach ($newModalAppointments as $appointment) : ?>
                                                                    <div class="card card-primary card-outline inner-card">
                                                                        <div class="card-header" data-id="1">
                                                                            <h5 class="card-title">
                                                                                <?= htmlspecialchars($appointment['patientName']) ?>
                                                                            </h5>
                                                                            <div class="card-tools">
                                                                                <a href="javascript:void(0);" class="btn btn-tool btn-link"></a>
                                                                                <a href="javascript:void(0);" class="btn-tool toggle-card">
                                                                                    <i class="fas fa-pen"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card-body card-two-body" style="display: none;">
                                                                            <label for="">Phone Number: </label>
                                                                            <?= htmlspecialchars($appointment['phoneNumber']) ?>
                                                                            <br>

                                                                            <label for="">Procedure:</label>
                                                                            <?= htmlspecialchars($appointment['visitFor']) ?>
                                                                            <br>

                                                                            <label for="">Date of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['dateOfAppointment']) ?>
                                                                            <br>

                                                                            <label for="">Time of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['timeOfAppointment']) ?>
                                                                            <br>

                                                                            <div class="buttons" style="display: flex; justify-content: space-around; ">
                                                                                <button class="btn-sm bg-gradient-danger btn-block" style='border: 0; padding: .5rem; width: auto;'>Cancel</button>
                                                                                <button class="btn-sm bg-gradient-primary btn-block" style='border: 0; padding: .5rem; margin-top: 0; width: auto;'>Approve</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card card-row card-default">
                                                <div class="card-header bg-info">
                                                    <h3 class="card-title">In Progress</h3>

                                                    <div class="card-tools">
                                                        <h6>
                                                            <?php echo count($approvedModalAppointments); ?>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="card-body" style="height: 50vh;">
                                                    <div class="card card-outline">
                                                        <div id="appointments-list">
                                                            <?php if (empty($approvedModalAppointments)) : ?>
                                                                <p>No appointments found with status "New".</p>
                                                            <?php else : ?>
                                                                <?php foreach ($approvedModalAppointments as $appointment) : ?>
                                                                    <div class="card card-info card-outline inner-card">
                                                                        <div class="card-header" data-id="1">
                                                                            <h5 class="card-title">
                                                                                <?= htmlspecialchars($appointment['patientName']) ?>
                                                                            </h5>
                                                                            <div class="card-tools">
                                                                                <a href="javascript:void(0);" class="btn btn-tool btn-link"></a>
                                                                                <a href="javascript:void(0);" class="btn-tool toggle-card">
                                                                                    <i class="fas fa-pen"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card-body card-two-body" style="display: none;">
                                                                            <label for="">Phone Number: </label>
                                                                            <?= htmlspecialchars($appointment['phoneNumber']) ?>
                                                                            <br>

                                                                            <label for="">Procedure:</label>
                                                                            <?= htmlspecialchars($appointment['visitFor']) ?>
                                                                            <br>

                                                                            <label for="">Date of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['dateOfAppointment']) ?>
                                                                            <br>

                                                                            <label for="">Time of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['timeOfAppointment']) ?>
                                                                            <br>

                                                                            <div class="custom-control custom-switch">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                                                <label class="custom-control-label" for="customSwitch1">Click to Mark as Treated</label>
                                                                            </div>

                                                                            <div>
                                                                                <label for="doctorNote" style="display: block;">Doctor's Note:</label>
                                                                                <textarea name="doctorNote" id="doctorNote" style="resize: both; width: -webkit-fill-available;" placeholder="Type Here..."></textarea>
                                                                            </div>
                                                                            <br>

                                                                            <div class="buttons" style="display: flex; justify-content: space-around; ">
                                                                                <button type="button" class="btn-sm bg-gradient-danger btn-block" id="resetBtn" style='border: 0; padding: .5rem; width: auto;'>Reset</button>
                                                                                <button type="button" class="btn-sm bg-gradient-primary btn-block" id="submitBtn" style='border: 0; padding: .5rem; margin-top: 0; width: auto;'>Done</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="card card-row card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Completed</h3>

                                                    <div class="card-tools">
                                                        <h6>
                                                            <?php echo count($completedModalAppointments); ?>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="card-body" style="height: 50vh;">
                                                    <div class="card card-outline">
                                                        <div id="appointments-list">
                                                            <?php if (empty($completedModalAppointments)) : ?>
                                                                <p>No appointments found with status "New".</p>
                                                            <?php else : ?>
                                                                <?php foreach ($completedModalAppointments as $appointment) : ?>
                                                                    <div class="card card-success card-outline inner-card">
                                                                        <div class="card-header" data-id="1">
                                                                            <h5 class="card-title">
                                                                                <?= htmlspecialchars($appointment['patientName']) ?>
                                                                            </h5>
                                                                            <div class="card-tools">
                                                                                <a href="javascript:void(0);" class="btn btn-tool btn-link"></a>
                                                                                <a href="#" class="btn-tool toggle-card">
                                                                                    <i class="fas fa-pen"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card-body card-two-body" style="display: none;">
                                                                            <label for="">Phone Number: </label>
                                                                            <?= htmlspecialchars($appointment['phoneNumber']) ?>
                                                                            <br>

                                                                            <label for="">Procedure:</label>
                                                                            <?= htmlspecialchars($appointment['visitFor']) ?>
                                                                            <br>

                                                                            <label for="">Date of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['dateOfAppointment']) ?>
                                                                            <br>

                                                                            <label for="">Time of Appointment:</label>
                                                                            <?= htmlspecialchars($appointment['timeOfAppointment']) ?>
                                                                            <br>

                                                                            <label for="">Treated:</label>
                                                                            Yes
                                                                            <br>

                                                                            <label for="">Doctor's Comment:</label>
                                                                            <?= htmlspecialchars($appointment['doctorNote']) ?>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>    
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>
        <script src="../js/inactivity_timer.js"></script>

        <script>
            $(function () {
  	            'use strict'

                var ticksStyle = {
                    fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                // Make the dashboard widgets sortable Using jquery UI
                $('.connectedSortable').sortable({
                    placeholder: 'sort-highlight',
                    connectWith: '.connectedSortable',
                    handle: '.card-header, .nav-tabs',
                    forcePlaceholderSize: true,
                    zIndex: 999999
                })
                $('.connectedSortable .card-header').css('cursor', 'move')

                // jQuery UI sortable for the todo list
                $('.todo-list').sortable({
                    placeholder: 'sort-highlight',
                    handle: '.handle',
                    forcePlaceholderSize: true,
                    zIndex: 999999
                })

	            $('.textarea').summernote()

                $('.daterange').daterangepicker({
                    ranges: {
                        Today: [moment(), moment()],
                        Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                }, function (start, end) {
                    alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                })

                $('.knob').knob()

                // Real-time data from PHP
                const graphDates = <?php echo $graphDates; ?>;
                const graphCountsThisWeek = <?php echo $graphCountsThisWeek; ?>;
                const graphCountsLastWeek = <?php echo $graphCountsLastWeek; ?>;
                const totalThisWeek = <?php echo $totalThisWeek; ?>;
                const totalLastWeek = <?php echo $totalLastWeek; ?>;

                console.log(totalThisWeek);
                console.log(totalLastWeek);

                // Chart.js configuration
                const ctx = document.getElementById('visitors-chart').getContext('2d');
                const visitorsChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: graphDates,
                        datasets: [
                            {
                                label: 'This Week',
                                data: graphCountsThisWeek,
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: true,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(60,141,188,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                fill: false,
                                tension: 0.3,
                            }, {
                                label: 'Last Week',
                                data: graphCountsLastWeek,
                                backgroundColor: 'rgba(108,117,125,0.1)',
                                borderColor: 'rgba(108,117,125,1)',
                                pointRadius: true,
                                pointColor: '#6c757d',
                                pointStrokeColor: 'rgba(108,117,125,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(108,117,125,1)',
                                fill: false,
                                tension: 0.3,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                grid: {
                                    display: true
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });

                let percentageDifference = 0;

                if (totalLastWeek > 0) {
                    percentageDifference = ((totalThisWeek - totalLastWeek) / totalLastWeek) * 100;
                } else {
                    percentageDifference = 100;
                }

                const percentageElement = document.querySelector('.percentage-difference');
                percentageElement.innerHTML = `
                    <span class="${percentageDifference >= 0 ? 'text-success' : 'text-danger'}">
                        <i class="fas fa-arrow-${percentageDifference >= 0 ? 'up' : 'down'}"></i>
                        ${Math.abs(percentageDifference).toFixed(1)}%
                    </span>
                `;

                $('#calendar').datetimepicker({
                    format: 'L',
                    inline: true
                });

                // Prevent date clicks
                // Prevent date clicks with more specific targeting
                $('#calendar').on('click', '.day', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                });

                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                
                // var pieData = {
                //     labels: [
                //         'Chrome',
                //         'IE',
                //         'FireFox',
                //         'Safari',
                //         'Opera',
                //         'Navigator'
                //     ],
                //     datasets: [
                //         {
                //             data: [700, 500, 400, 600, 300, 100],
                //             backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                //         }
                //     ]
                // }

               var pieOptions = {
                    legend: {
                        display: false
                    },
                    maintainAspectRatio : false,
                    responsive : true,
                }

                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo $procedureLabelsJSON; ?>,
                        datasets: [{
                            data: <?php echo $procedureCountsJSON; ?>,
                            backgroundColor: <?php echo $procedureColorsJSON; ?>,
                        }]
                    },
                    options: pieOptions
                });
                
                //-----------------
                //- END PIE CHART -
                //-----------------

                // Generate legend
                var legendHtml = '';
                for (var i = 0; i < pieChart.data.labels.length; i++) {
                    legendHtml += '<li><i class="far fa-circle" style="color:' + pieChart.data.datasets[0].backgroundColor[i] + '"></i> ' + pieChart.data.labels[i] + '</li>';
                }
                $('#chartLegend').html(legendHtml);

                 // Get new and approved appointment counts by date from database
                <?php
                // Query for new appointments count by date
                $newCountsQuery = "SELECT DATE(dateOfAppointment) AS AppointmentDate, COUNT(*) AS count FROM appointments WHERE status='new' GROUP BY DATE(dateOfAppointment)";
                $newCountsResult = $conn->query($newCountsQuery);
                $newCountsByDate = [];
                while ($row = $newCountsResult->fetch_assoc()) {
                    $newCountsByDate[$row['AppointmentDate']] = $row['count'];
                }

                // Query for approved appointments count by date
                $approvedCountsQuery = "SELECT DATE(dateOfAppointment) AS AppointmentDate, COUNT(*) AS count
                                      FROM appointments
                                      WHERE status='approved'
                                      AND doctorId = " . $_SESSION['user_id'] . "
                                      GROUP BY DATE(dateOfAppointment)";
                $approvedCountsResult = $conn->query($approvedCountsQuery);
                $approvedCountsByDate = [];
                while ($row = $approvedCountsResult->fetch_assoc()) {
                    $approvedCountsByDate[$row['AppointmentDate']] = $row['count'];
                }
                ?>

                // Pass PHP data to JavaScript
                const newDateCounts = <?php echo json_encode($newCountsByDate); ?>;
                const approvedDateCounts = <?php echo json_encode($approvedCountsByDate); ?>;

                // Initialize tooltips with combined counts
                $('#calendar').tooltip({
                    selector: '.day',
                    title: function() {
                        const day = $(this).text().trim();
                        const viewDate = $('#calendar').datetimepicker('viewDate');
                        const hoverDate = viewDate.clone().date(day).format('YYYY-MM-DD');
                        const newCount = newDateCounts[hoverDate] || 0;
                        const approvedCount = approvedDateCounts[hoverDate] || 0;
                        return `New: ${newCount}\nApproved: ${approvedCount}`;
                    },
                    placement: 'top',
                    trigger: 'hover',
                    template: '<div class="tooltip appointment-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                });

                // Add click handler for current date
                // $('#calendar').on('click', '.today', function() {
                //     const currentDate = moment().format('YYYY-MM-DD');
                //     $('#selected-date').text(`Appointment Information: ${currentDate}`);
                //     $('#modal-lg').modal('show');
                // });
                                // });

                // Handle clicks on calendar dates including current date
                // $('#calendar').on('click', '.day:not(.disabled)', function() {
                //     const date = $(this).data('action').selectDate;
                //     const currentDate = moment().format('YYYY-MM-DD');
                    
                //     if (date && date.format('YYYY-MM-DD') === currentDate) {
                //         $('#selected-date').text(`Appointment Information: ${currentDate}`);
                //         $('#modal-lg').modal('show');
                //     }
                // });

                $(document).ready(function () {
                    $('.toggle-card').on('click', function () {
                        const cardBody = $(this).closest('.card').find('.card-two-body');

                        if (cardBody.is(':visible')) {
                            cardBody.slideUp();
                        } else {
                            $('.card-two-body').slideUp();

                            cardBody.slideDown();
                        }
                    });
                });
                
                const resetBtn = document.getElementById("resetBtn");
                const switchInput = document.getElementById("customSwitch1");
                const textarea = document.getElementById("doctorNote");
                const submitBtn = document.getElementById("submitBtn");

                resetBtn.addEventListener("click", function() {
                    switchInput.checked = false;
                    textarea.value = '';
                });

                submitBtn.addEventListener("click", function() {
                    if (textarea.value.trim() === '') {
                        toastr.warning('Please Fill in a Comment in the Comment Section!')
                    } else {
                        toastr.success('Patient is Marked as Treated.')
                    }
                })
            })
        </script>
    </body>
</html>


<!-- <section class="content pb-3">
    <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
            <div class="card-header">
                <h3 class="card-title">Backlog</h3>
            </div>

            <div class="card-body">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Labels</h5>
                        
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#3</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                            <label for="customCheckbox1" class="custom-control-label">Bug</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                            <label for="customCheckbox2" class="custom-control-label">Feature</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                            <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                            <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                            <label for="customCheckbox5" class="custom-control-label">Examples</label>
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Issue template</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#4</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                            <label for="customCheckbox1_1" class="custom-control-label">Bug Report</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1_2" disabled>
                            <label for="customCheckbox1_2" class="custom-control-label">Feature Request</label>
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create PR template</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#6</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card card-light card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Actions</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#7</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo ligula eget dolor. Aenean massa.
                        Cum sociis natoque penatibus et magnis dis parturient montes,
                        nascetur ridiculus mus.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-row card-primary">
            <div class="card-header">
                <h3 class="card-title">To Do</h3>
            </div>

            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create first milestone</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#5</a>

                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-row card-default">
            <div class="card-header bg-info">
                <h3 class="card-title">In Progress</h3>
            </div>

            <div class="card-body">
                <div class="card card-light card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Update Readme</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#2</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-row card-success">
            <div class="card-header">
                <h3 class="card-title"> Done </h3>
            </div>

            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create repo</h5>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#1</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
