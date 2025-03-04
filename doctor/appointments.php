<?php 
    $currentPage = 'appointments';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName FROM appointments LEFT JOIN users ON appointments.doctorId = users.doctorId WHERE appointments.doctorId = " . (int)$_SESSION['user_id'];

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Appointments | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
    </head>

    <body>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Appointments</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header border-transparent" style="display: flex;">
                            <!-- <h3 class="card-title">All Appointments</h3> -->
                        </div>

                        <div id="skeletonLoader" class="skeleton-loader">
                            <div class="skeleton skeleton-text"></div>
                            <div class="skeleton skeleton-text"></div>
                            <div class="skeleton skeleton-text"></div>
                            <div class="skeleton skeleton-text"></div>
                            <div class="skeleton skeleton-text"></div>
                        </div>

                        <div class="card-body d-none" id="card" style="padding-top: 0;">
                            <div class="table-responsive">
                                <table class="table m-0 table-hover" id="tableResponsive">
                                    <thead>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Patient's Name</th>
                                            <th>Patient's Email</th>
                                            <th>Procedure</th>
                                            <th>Doctor Assigned</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                        <?php
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td><a href='#'>" . $row["appointmentId"] . "</a></td>";
                                                    echo "<td>" . $row["patientFirstName"] . " " . $row["patientLastName"] . "</td>";
                                                    echo "<td>" . $row["patientEmail"] . "</td>";
                                                    echo "<td>" . $row["visitFor"] . "</td>";
                                                    echo "<td>" . $row["doctorName"] . "</td>";
                                                    echo "<td>" . $row["dateCreated"] . "</td>";
                                                    
                                                    $status = $row["status"];
                                                    if ($status == "New") {
                                                        echo "<td><button class='badge badge-warning' style='border: none; padding: 8px'>New</button></td>";
                                                    } elseif ($status == "Approved") {
                                                        echo "<td><button class='badge badge-success' style='border: none; padding: 8px'>Approved</button></td>";
                                                    } elseif ($status == "Cancelled") {
                                                        echo "<td><button class='badge badge-danger' style='border: none; padding: 8px'>Cancelled</button></td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No appointments found</td></tr>";
                                            }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Patient's Name</th>
                                            <th>Patient's Email</th>
                                            <th>Procedure</th>
                                            <th>Doctor Assigned</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
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

        <script>
            $(function () {
                $('#tableResponsive').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>
</html>