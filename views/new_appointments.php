<?php 
    $currentPage = 'new_appointments';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
    
    // Generate random patient ID
    $patientID = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 9);
?>

<?php
    $sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName FROM appointments LEFT JOIN users ON appointments.doctorId = users.doctorId WHERE status='new'";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>New Appointments | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/appointment.css">
    </head>

    <body>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">New Appointments</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="appointments.php">Appointments</a></li>
                                <li class="breadcrumb-item active">New Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header border-transparent" style='padding: .75rem 2rem;'>
                            <!-- <h3 class="card-title">New Appointments</h3> -->

                            <div class="card-tools">
                                <a href="#" class="float-left">
                                    <button type="button" class="btn-sm btn-block bg-gradient-primary" style='border: 0; padding: .5rem;' data-toggle="modal" data-target="#modal-lg">Add Appointment</button>
                                </a>
                            </div>
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
                                                    echo "<tr>";
                                                    echo "<td>" . $row["appointmentId"] . "</td>";
                                                    echo "<td>" . $row["patientFirstName"] . " " . $row["patientLastName"] . "</td>";
                                                    echo "<td>" . $row["patientEmail"] . "</td>";
                                                    echo "<td>" . $row["visitFor"] . "</td>";
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
                                                    echo "<td><button type='button' class='btn-sm btn-block bg-gradient-primary' style='border: 0;'>Edit</button></td>";
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

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Appointment for Patient <?php echo $patientID; ?></h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span >&times;</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                        <div class="col-12 col-sm-6">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
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
                                                                <input type="text" name="firstName" id="firstName">
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
                                                                <input type="" name="patientID" id="patientID" value="<?php echo $patientID; ?>">
                                                                <label for="email">Patient's Email: </label>
                                                                <input type="mail" name="email" id="patientEmail">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="phoneNumber">Phone Number: </label>
                                                                <input type="tel" name="phoneNumber" id="phoneNumber">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dob">Date of Birth: </label>
                                                                <input type="date" name="dob" id="dob">
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
                                                                <!-- <input type="test" name="visitFor" id="visitFor"> -->
                                                                <br>
                                                                <select name="visitFor" id="visitFor" style="width: 100%;">
                                                                    <option value="" disabled selected>Select a Checkup</option>
                                                                    <?php
                                                                        $procedures = $conn->query("SELECT procedureName FROM procedures WHERE status='available'");
                                                                        while($procedure = $procedures->fetch_assoc()) {
                                                                            echo "<option value='".htmlspecialchars($procedure['procedureName'], ENT_QUOTES)."'>".htmlspecialchars($procedure['procedureName'])."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="docAssigned">Doctor Assigned: </label>
                                                                <!-- <input type="text" name="docAssigned" id="docAssigned"> -->
                                                                <br>
                                                                <select name="docAssigned" id="docAssigned" style="width: 100%;">
                                                                    <option value="">Select Doctor</option>
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
                                                                <input type="date" name="dateCreated" id="dateCreated" disabled value="<?php echo date('Y-m-d');?>">
                                                            </td>
                                                        </div>

                                                        <div class="td">
                                                            <td>
                                                                <label for="status">Appointment Status: </label>
                                                                <input type="text" name="status" id="status" value="New" disabled>
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
                        <button type="button" class="btn btn-primary btn-sm" style='padding: .5rem;' disabled onclick="saveAppointment()">Add Appointment</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>

        <script>
            // Calculate age from date of birth
            function calculateAge() {
                const dob = new Date(document.getElementById('dob').value);
                const age = new Date().getFullYear() - dob.getFullYear();
                document.getElementById('age').value = isNaN(age) ? '' : age;
                validateForm();
            }

            async function generatePatientId() {
                let newId = '';
                
                do {
                    newId = 'PID' + Date.now().toString(36) + Math.random().toString(36).substr(2, 4).toUpperCase();
                    var isUnique = await fetch(`../partials/check_patientid.php?patientId=${newId}`)
                        .then(response => response.json())
                        .then(data => data.isUnique)
                        .catch(() => true);
                } while (!isUnique);
                
                // document.getElementById('patientID').value = newId;
                document.querySelector('.modal-title').textContent = `Appointment for Patient ${newId}`;
                validateForm(); // Update button state after ID generation
            }

            function validateForm() {
                const requiredFields = [
                    'firstName', 'lastname', 'patientEmail',
                    'phoneNumber', 'dob', 'visitFor',
                    'docAssigned', 'dateOfAppointment', 'timeOfAppointment'
                ];

                const isValid = requiredFields.every(id => {
                    const el = document.getElementById(id);
                    return el.value.trim() !== '';
                });

                document.querySelector('#modal-lg .btn-primary').disabled = !isValid;
            }

            $(function () {
                // Initialize DataTable
                $('#tableResponsive').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });

                // Generate ID on modal show
                $('#modal-lg').on('show.bs.modal', generatePatientId);

                // Validate form on input
                document.querySelectorAll('#modal-lg input, #modal-lg select').forEach(el => {
                    el.addEventListener('input', validateForm);
                    el.addEventListener('change', validateForm);
                });

                // Initial validation
                validateForm();

                // Add event listener for procedure selection
                document.getElementById('visitFor').addEventListener('change', function() {
                    const procedure = this.value;
                    const doctorSelect = document.getElementById('docAssigned');
                    
                    if(procedure) {
                        fetch(`../partials/get_doctors.php?procedure=${encodeURIComponent(procedure)}`)
                            .then(response => response.json())
                            .then(doctors => {
                                doctorSelect.innerHTML = '<option value="" disabled selected>Select Doctor</option>';
                                doctors.forEach(doctor => {
                                    const option = document.createElement('option');
                                    option.value = doctor.doctorId;
                                    option.textContent = doctor.doctorName;
                                    doctorSelect.appendChild(option);
                                });
                                doctorSelect.disabled = false;
                                validateForm();
                            });
                    } else {
                        doctorSelect.innerHTML = '<option value="" disabled selected>Select a Checkup first</option>';
                        doctorSelect.disabled = true;
                        validateForm();
                    }
                });

                // Add date of birth listener for age calculation
                document.getElementById('dob').addEventListener('change', function() {
                    const dob = new Date(this.value);
                    if (!isNaN(dob)) {
                        const age = new Date().getFullYear() - dob.getFullYear();
                        document.getElementById('age').value = age;
                        validateForm();
                    }
                });
            });
            function saveAppointment() {
                const formData = {
                    patientID: document.getElementById('patientID').value,
                    firstName: document.getElementById('firstName').value,
                    lastname: document.getElementById('lastname').value,
                    email: document.getElementById('patientEmail').value,
                    phoneNumber: document.getElementById('phoneNumber').value,
                    dob: document.getElementById('dob').value,
                    visitFor: document.getElementById('visitFor').value,
                    docAssigned: document.getElementById('docAssigned').value,
                    dateOfAppointment: document.getElementById('dateOfAppointment').value,
                    timeOfAppointment: document.getElementById('timeOfAppointment').value
                };

                console.log(formData);

                fetch('../partials/save_appointment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        $('#modal-lg').modal('hide');
                        location.reload(); // Refresh to show new appointment
                    } else {
                        alert('Error saving appointment: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
            }
        </script>
    </body>
</html>