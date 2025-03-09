<?php 
    $currentPage = 'cancelled_appointments';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName FROM appointments LEFT JOIN users ON appointments.doctorId = users.doctorId WHERE status='cancelled' AND appointments.doctorId = " . (int)$_SESSION['user_id'];

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cancelled Appointments | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/appointment.css">
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
                                <li class="breadcrumb-item"><a href="appointments.php">Appointments</a></li>
                                <li class="breadcrumb-item active">Cancelled Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <!-- <h3 class="card-title">Cancelled Appointments</h3> -->

                            <!-- <div class="card-tools">
                                <a href="#" class="float-left">
                                    <button type="button" class="btn-sm btn-outline-primary">Add Appointment</button>
                                </a>
                            </div> -->
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                        <?php
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    // Get procedure name
                                                    $procedureSql = "SELECT procedureName FROM procedures WHERE id = ?";
                                                    $procedureStmt = $conn->prepare($procedureSql);
                                                    $procedureStmt->bind_param("s", $row['visitFor']);
                                                    $procedureStmt->execute();
                                                    $procedureResult = $procedureStmt->get_result();
                                                    if ($procedureResult->num_rows === 1) {
                                                        $procedureRow = $procedureResult->fetch_assoc();
                                                        $procedureName = $procedureRow['procedureName'];
                                                    } else {
                                                        $procedureName = 'Unknown';
                                                    }
                                                    $procedureStmt->close();

                                                    echo "<tr>";
                                                    echo "<td>" . $row["appointmentId"] . "</td>";
                                                    echo "<td>" . $row["patientFirstName"] . " " . $row["patientLastName"] . "</td>";
                                                    echo "<td>" . $row["patientEmail"] . "</td>";
                                                    echo "<td>" . $procedureName . "</td>";
                                                    echo "<td>" . $row["doctorName"] . "</td>";
                                                    echo "<td>" . $row["dateCreated"] . "</td>";
                                                    
                                                    // $status = $row["status"];
                                                    // if ($status == "New") {
                                                    //     echo "<td><button class='badge badge-warning' style='border: none; padding: 8px'>New</button></td>";
                                                    // } elseif ($status == "Approved") {
                                                    //     echo "<td><button class='badge badge-success' style='border: none; padding: 8px'>Approved</button></td>";
                                                    // } elseif ($status == "Cancelled") {
                                                    //     echo "<td><button class='badge badge-danger' style='border: none; padding: 8px'>Cancelled</button></td>";
                                                    // }

                                                    echo "<td><button type='button' class='btn-sm btn-block bg-gradient-primary edit-appointment' style='border: 0;' data-toggle='modal' data-target='#modal-lg-edit' data-appointment-id='" . $row["appointmentId"] . "'>Edit</button></td>";
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
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal fade" id="modal-lg-edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Appointment</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span >&times;</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                        <div class="col-12 col-sm-6">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-ywo-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="patient-personal-information-tab" data-toggle="pill" href="#patient-personal-information" role="tab" aria-controls="patient-personal-information" aria-selected="true">Patient's Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="patient-visit-reason-tab" data-toggle="pill" href="#patient-visit-reason" role="tab" aria-controls="patient-visit-reason" aria-selected="false">Reason for Visit</a>
                                        </li>
                                    </ul>
                                </div>
            
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="patient-personal-information" role="tabpanel" aria-labelledby="patient-personal-information-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="firstName">First Name: </label>
                                                                <input type="text" name="firstName" id="firstname">
                                                            </td>
                                                        </div>

                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Patient's Email: </label>
                                                                <input type="mail" name="email" id="patientEmail">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="phoneNumber">Phone Number: </label>
                                                                <input type="tel" name="phoneNumber" id="phonenumber">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dob">Date of Birth: </label>
                                                                <input type="date" name="dob" id="dofb">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="age">Age: </label>
                                                                <input type="number" name="age" id="age" disabled placeholder="18">
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </div>

                                        <div class="tab-pane fade" id="patient-visit-reason" role="tabpanel" aria-labelledby="patient-visit-reason-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="visitFor">Checkup Type: </label>
                                                                <select name="visitFor" id="visitFor" style="width: 100%;">
                                                                </select>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="docAssigned">Doctor Assigned: </label>
                                                                <select name="docAssigned" id="docAssigned" style="width: 100%;">
                                                                </select>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dateOfAppointment">Appointment Date: </label>
                                                                <input type="date" name="dateOfAppointment" id="dateOfAppointment">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="timeOfAppointment">Appointment Time: </label>
                                                                <input type="time" name="timeOfAppointment" id="timeOfAppointment">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dateCreated">Date Created: </label>
                                                                <input type="date" name="dateCreated" id="dateCreated" disabled>
                                                            </td>
                                                        </div>

                                                        <div class="td">
                                                            <td>
                                                                <label for="status">Appointment Status: </label><br>
                                                                <select name="status" id="status" style="width: 100%;">
                                                                    <option value="New">New</option>
                                                                    <option value="Approved">Approved</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                </select>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" style='padding: .5rem;' onclick="updateCancelledAppointment()">Save Changes</button>
                    </div>
                </div>
            </div>
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

        // Edit appointment button click handler
        $('.edit-appointment').on('click', function() {
            var appointmentId = $(this).data('appointment-id');
            editAppointment(appointmentId);
        });
        

        function editAppointment(appointmentId) {
            fetch(`../partials/get_appointment_details.php?appointmentId=${appointmentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error fetching appointment details:', data.error);
                    alert('Error: ' + data.error);
                } else {
                    // Populate form fields and log data
                    console.log(data);
                    document.getElementById('firstname').value = data.patientFirstName;
                    document.getElementById('lastname').value = data.patientLastName;
                    document.getElementById('patientEmail').value = data.patientEmail;
                    document.getElementById('phonenumber').value = data.phoneNumber;
                    document.getElementById('dofb').value = data.dob;
                    
                    // Calculate and set age
                    const dob = new Date(data.dob);
                    if (!isNaN(dob.getTime())) {
                        const today = new Date();
                        let age = today.getFullYear() - dob.getFullYear();
                        const m = today.getMonth() - dob.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                            age--;
                        }
                        document.getElementById('age').value = age;
                    } else {
                        document.getElementById('age').value = '';
                    }

                    document.getElementById('dateOfAppointment').value = data.dateOfAppointment;
                    document.getElementById('timeOfAppointment').value = data.timeOfAppointment;
                    document.getElementById('dateCreated').value = data.dateCreated;

                    // Populate status dropdown
                    const statusSelect = document.getElementById('status');
                    for (let i = 0; i < statusSelect.options.length; i++) {
                        if (statusSelect.options[i].value === data.status) {
                            statusSelect.selectedIndex = i;
                            break;
                        }
                    }

                    // Populate visitFor dropdown
                    const visitForSelect = document.getElementById('visitFor');
                    // Fetch procedures (assuming you have a way to get procedure IDs and names)
                    // For example, you might have a separate PHP script or use existing data
                    // Here, I'll simulate fetching procedures
                    visitForSelect.innerHTML = '';
                    const option = document.createElement('option');
                    option.value = data.visitFor;
                    option.textContent = data.visitForText;
                    option.selected = true;
                    visitForSelect.appendChild(option);


                    // Populate docAssigned dropdown based on selected procedure
                    populateDoctorDropdown(data.visitFor, data.doctorId);
                }
            });
        }

        function populateDoctorDropdown(specializationId, selectedDoctorId) {
            const doctorSelect = document.getElementById('docAssigned');
            if (specializationId) {
            fetch(`../partials/get_doctors.php?specialization=${encodeURIComponent(specializationId)}`)
            .then(response => response.json())
            .then(doctors => {
            doctorSelect.innerHTML = '';
            doctors.forEach(doctor => {
                const option = document.createElement('option');
                option.value = doctor.doctorId;
                option.textContent = doctor.doctorName;
                if (doctor.doctorId === selectedDoctorId) {
                    option.selected = true;
                }
                doctorSelect.appendChild(option);
            });
            });
            } else {
            doctorSelect.innerHTML = '<option value="" disabled selected>Select a Checkup first</option>';
            }
        }




        function updateCancelledAppointment() {
            const appointmentId = document.querySelector('.edit-appointment').dataset.appointmentId;
            const formData = {
                appointmentId: appointmentId,
                firstName: document.getElementById('firstname').value,
                lastname: document.getElementById('lastname').value,
                email: document.getElementById('patientEmail').value,
                phoneNumber: document.getElementById('phonenumber').value,
                dob: document.getElementById('dofb').value,
                yob: new Date(document.getElementById('dofb').value).getFullYear(),
                visitFor: document.getElementById('visitFor').value,
                docAssigned: document.getElementById('docAssigned').value,
                dateOfAppointment: document.getElementById('dateOfAppointment').value,
                timeOfAppointment: document.getElementById('timeOfAppointment').value,
                status: document.getElementById('status').value
            };
            console.log('Updating with data:', formData);


            fetch('../partials/processes.php', {
                method: 'POST',
                body: new URLSearchParams({ ...formData, update_cancelled_appointment: 'true' })
            })
           .then(response => {
               console.log('Raw server response:', response); // Log raw response
               return response.json();
            })
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    // Update the table row in place
                    const row = $(`#tableResponsive tbody tr[data-appointment-id="${appointmentId}"]`);
                    row.find('td:nth-child(2)').text(formData.firstName + ' ' + formData.lastname);
                    row.find('td:nth-child(3)').text(formData.email);
                    row.find('td:nth-child(4)').text($('#visitFor option:selected').text());
                    row.find('td:nth-child(5)').text($('#docAssigned option:selected').text());

                    $('#modal-lg-edit').modal('hide');
                    alert('Appointment updated successfully!');
                } else {
                    alert('Error updating appointment: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
                console.error('Error updating appointment:', error);
            });
        }
    </script>
    </body>
</html>