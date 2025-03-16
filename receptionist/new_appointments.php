<?php
    session_start();
    $currentPage = 'new_appointments';

    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';

    // Generate random patient ID
    $patientID = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 9);

?>

<?php
    // Get logged-in doctor's specialization and name
    if (isset($_SESSION['user_id'])) {
        $doctorQuery = "SELECT users.*, procedures.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName
                        FROM users
                        LEFT JOIN procedures ON users.specialization = procedures.id";
        $doctorResult = $conn->query($doctorQuery);
        $doctorData = $doctorResult->fetch_assoc();
    } else {
        $doctorData = ['id' => null]; // Simulate no specialization
    }
    $doctorFullName = $doctorData['doctorName'] ?? '';

    $sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName FROM appointments LEFT JOIN users ON appointments.doctorId = users.doctorId WHERE status='new' ";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>New Appointments | Halisi Family Home</title>

        <?php include '../styles/styles.php?v=' . time(); ?>
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
                                                                <input type="hidden" name="patientID" id="patientID" value="<?php echo $patientID; ?>">
                                                                <label for="patientEmail">Patient's Email: </label>
                                                                <input type="mail" name="patientEmail" id="patientEmail">
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
                                                                <!-- <input type="test" name="visitFor" id="visitFor"> -->
                                                                <br>
                                                                <select name="visitFor" id="visitFor" style="width: 100%;">
                                                                    <option value="" disabled selected>Select a specialization</option>
                                                                    <?php
                                                                        $procedures = $conn->query("SELECT id, procedureName FROM procedures WHERE status='available'");
                                                                        while($procedure = $procedures->fetch_assoc()) {
                                                                            $selected = ($procedure['id'] == $doctorData['id']) ? 'selected' : '';
                                                                            echo "<option value='".htmlspecialchars($procedure['id'], ENT_QUOTES)."' $selected>".htmlspecialchars($procedure['procedureName'])."</option>";
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
                                                                <select name="docAssigned" id="docAssigned" style="width: 100%;" disabled>
                                                                    <option value="Dr. Ronnie Kaballah" selected><?php echo htmlspecialchars($doctorFullName); ?></option>
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
                        <button type="button" class="btn btn-primary btn-sm" style='padding: .5rem;'  onclick="saveAppointment()">Add Appointment</button>
                    </div>
                </div>
            </div>
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
                                            <a class="nav-link active" id="patient-personal-edit-information-tab" data-toggle="pill" href="#patient-personal-edit-information" role="tab" aria-controls="patient-personal-edit-information" aria-selected="true">Patient's Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="patient-visit-edit-reason-tab" data-toggle="pill" href="#patient-visit-edit-reason" role="tab" aria-controls="patient-visit-edit-reason" aria-selected="false">Reason for Visit</a>
                                        </li>
                                    </ul>
                                </div>
              
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="patient-personal-edit-information" role="tabpanel" aria-labelledby="patient-personal-edit-information-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="firstName">First Name: </label>
                                                                <input type="text" name="firstName" id="firstNameEdit">
                                                            </td>
                                                        </div>

                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastnameEdit">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Patient's Email: </label>
                                                                <input type="mail" name="email" id="patientEmailEdit">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="phoneNumber">Phone Number: </label>
                                                                <input type="tel" name="phoneNumber" id="phoneNumberEdit">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dob">Date of Birth: </label>
                                                                <input type="date" name="dob" id="dobEdit">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="age">Age: </label>
                                                                <input type="number" name="age" id="ageEdit" disabled placeholder="18">
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </div>

                                        <div class="tab-pane fade" id="patient-visit-edit-reason" role="tabpanel" aria-labelledby="patient-visit-edit-reason-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="visitFor">Checkup Type: </label>
                                                                <select name="visitFor" id="visitForEdit" style="width: 100%;">
                                                                </select>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="docAssigned">Doctor Assigned: </label>
                                                                <select name="docAssigned" id="docAssignedEdit" style="width: 100%;">
                                                                </select>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dateOfAppointment">Appointment Date: </label>
                                                                <input type="date" name="dateOfAppointment" id="dateOfAppointmentEdit">
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="timeOfAppointment">Appointment Time: </label>
                                                                <input type="time" name="timeOfAppointment" id="timeOfAppointmentEdit">
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dateCreated">Date Created: </label>
                                                                <input type="date" name="dateCreated" id="dateCreatedEdit" disabled>
                                                            </td>
                                                        </div>

                                                        <div class="td">
                                                            <td>
                                                                <label for="status">Appointment Status: </label><br>
                                                                <select name="status" id="statusEdit" style="width: 100%;">
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
                        <button type="button" class="btn btn-primary btn-sm" style='padding: .5rem;' onclick="updateAppointment()">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

    <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
        <?php include '../partials/footer.php'?>
    </footer>

    <?php include '../js/scripts.php' ?>

    <script>
        console.log('Script loaded'); // Top-level debug

        // For randomly generating the appointment's ID
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
            validateForm();
        }

        // For checking if all the stated fields are filled as required.
        // If not, then the Add button should be disabled and non-functional
        function validateForm() {
            const requiredFields = [
                'firstname', 'lastname', 'patientEmail',
                'phonenumber', 'dofb', 'visitFor',
                'docAssigned', 'dateOfAppointment', 'timeOfAppointment'
            ];

            const isValid = requiredFields.every(id => {
                const el = document.getElementById(id);
                return el.value.trim() !== '';
            });

            // document.querySelector('#modal-lg .btn-primary').disabled = !isValid;
        }

        // For creating the table to display the appointment information
        $(function () {
            // Initialize DataTable
            let table = $('#tableResponsive').DataTable({
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

            

            // Add date of birth listener for age calculation
            // document.getElementById('dob').addEventListener('change', function() {
            //     const dob = new Date(this.value);
            //     console.log('dob:', dob); // Debugging
            //     if (!isNaN(dob.getTime())) { // Use getTime() for more robust date validation
            //         const today = new Date();
            //         let age = today.getFullYear() - dob.getFullYear();
            //         const m = today.getMonth() - dob.getMonth();
            //         if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            //             age--;
            //         }
            //         console.log('age:', age); // Debugging
            //         document.getElementById('age').value = age;
            //         validateForm();
            //     } else {
            //         document.getElementById('age').value = ''; // Clear age if dob is invalid
            //     }
            // });

            // // Calculate age on edit form as well
            // document.getElementById('dobEdit').addEventListener('change', function() {
            //     const dobEdit = new Date(this.value);
            //     console.log('dobEdit:', dobEdit);
            //     if (!isNaN(dobEdit.getTime())) {
            //         const todayEdit = new Date();
            //         let ageEdit = todayEdit.getFullYear() - dobEdit.getFullYear();
            //         const monthEdit = todayEdit.getMonth() - dobEdit.getMonth();

            //         if(monthEdit < 0 || (monthEdit === 0 && todayEdit.getDate() < dobEdit.getDate())) {
            //             ageEdit--;
            //         }

            //         console.log('ageEdit', ageEdit);
            //         document.getElementById('ageEdit').value = ageEdit;
            //     } else {
            //         document.getElementById('ageEdit').value = '';
            //     }
            // });
        });

        // Add event listener for procedure selection
        document.getElementById('visitFor').addEventListener('change', function() {
            const procedure = this.value;
            const doctorSelect = document.getElementById('docAssigned');

            if(procedure) {
                fetch(`../partials/get_doctors.php?specialization=${encodeURIComponent(procedure)}`)
                    .then(response => response.json())
                    .then(doctors => {
                        doctorSelect.innerHTML = '<option value="" disabled selected>Select Doctor</option>';
                        doctors.forEach(doctor => {
                            const option = document.createElement('option');
                            option.value = doctor.doctorId;
                            option.textContent = doctor.doctorName;
                            doctorSelect.appendChild(option);
                        });
                        // doctors.forEach(doctor => {
                        //     const option = document.createElement('option');
                        //     option.value = doctor.doctorId;
                        //     option.textContent = doctor.doctorName;
                        //     doctorSelect.appendChild(option);
                        // });
                        doctorSelect.disabled = false;
                        validateForm();
                    });
            } else {
                doctorSelect.innerHTML = '<option value="" disabled selected>Select a Checkup first</option>';
                doctorSelect.disabled = true;
                validateForm();
            }
        });

        const dobInput = document.getElementById('dofb');
        if (dobInput) {
            // dobInput.addEventListener('change', function() {
                // console.log('Script loaded');
            dobInput.addEventListener('change', function() {
                const dob = new Date(this.value);
                if (!isNaN(dob.getTime())) { // Use getTime() for more robust date validation
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const m = today.getMonth() - dob.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }
                    document.getElementById('age').value = age;
                    validateForm();
                } else {
                    document.getElementById('age').value = ''; // Clear age if dob is invalid
                }
            });
            // });
        } else {
            console.error('Element with ID "dofb" not found.');
        }

        function saveAppointment() {
            const formDataSave = {
                patientID: document.getElementById('patientID').value,
                firstName: document.getElementById('firstname').value,
                lastname: document.getElementById('lastname').value,
                email: document.getElementById('patientEmail').value,
                phoneNumber: document.getElementById('phonenumber').value,
                dob: document.getElementById('dofb').value,
                visitFor: document.getElementById('visitFor').value,
                docAssigned: document.getElementById('docAssigned').value,
                yob: new Date(document.getElementById('dofb').value).getFullYear(),
                status: document.getElementById('status').value,
                dateOfAppointment: document.getElementById('dateOfAppointment').value,
                timeOfAppointment: document.getElementById('timeOfAppointment').value,
                dateCreated: document.getElementById('dateCreated').value
                // save_appointment: 'true'
            };

            console.log(formDataSave);

            fetch('../partials/processes.php', {
                method: 'POST',
                body: new URLSearchParams({ ...formDataSave, save_appointment: 'true' })
            })
            .then(response => {
                console.log('Raw server response:', response); // Log raw response
                return response.json(); // First, get the response as text
            })
            .then(data => {
                console.log('Raw response text:', data);
                if(data.success) {
                    $('#modal-lg').modal('hide');
                    // location.reload(); // Refresh to show new appointment
                } else {
                    alert('Error saving appointment: ' + (data.error || 'Unknown error'));
                    // console.error('Error fetching appointment details:', data.error);
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
                console.error('Error fetching appointment details:', error.message);
            });
        }

        // Edit appointment button click handler
        $('.edit-appointment').on('click', function() {
            var appointmentId = $(this).data('appointment-id');
            editAppointment(appointmentId);
        });
        
        // Edit the information from the appointment
        function editAppointment(appointmentId) {
            fetch(`../partials/get_appointment_details.php?appointmentId=${appointmentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error fetching appointment details:', data.error);
                    alert('Error: ' + data.error);
                } else {
                    // Populate form fields
                    document.getElementById('firstNameEdit').value = data.patientFirstName;
                    document.getElementById('lastnameEdit').value = data.patientLastName;
                    document.getElementById('patientEmailEdit').value = data.patientEmail;
                    document.getElementById('phoneNumberEdit').value = data.phoneNumber;
                    document.getElementById('dobEdit').value = data.dob;

                    // Auto generate the age
                    document.getElementById('dobEdit').addEventListener('change', function() {
                        const dobEdit = new Date(this.value);
                        if (!isNaN(dobEdit)) {
                            const ageEdit = new Date().getFullYear() - dobEdit.getFullYear();
                            document.getElementById('ageEdit').value = ageEdit;
                        }
                    });

                    document.getElementById('dateOfAppointmentEdit').value = data.dateOfAppointment;
                    document.getElementById('timeOfAppointmentEdit').value = data.timeOfAppointment;
                    document.getElementById('dateCreatedEdit').value = data.dateCreated;

                    // Populate status dropdown
                    const statusSelect = document.getElementById('statusEdit');
                    for (let i = 0; i < statusSelect.options.length; i++) {
                        if (statusSelect.options[i].value === data.status) {
                            statusSelect.selectedIndex = i;
                            break;
                        }
                    }

                    // Populate visitFor dropdown
                    const visitForSelect = document.getElementById('visitForEdit');
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

        // Populate the doctor's dropdown options
        function populateDoctorDropdown(specializationId, selectedDoctorId) {
            const doctorSelect = document.getElementById('docAssignedEdit');

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

        // Function to refresh the table data
        function refreshTable() {
            fetch('/partials/fetch-appointments.php') // Replace with your server-side script
                .then(response => response.json())
                .then(data => {
                    // Clear the existing table data
                    table.clear();

                    // Add the new data
                    table.rows.add(data).draw();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Updates the data on the database
        function updateAppointment() {
            const appointmentId = document.querySelector('.edit-appointment').dataset.appointmentId;
            const formData = {
                appointmentId: appointmentId,
                firstNameEdit: document.getElementById('firstNameEdit').value,
                lastnameEdit: document.getElementById('lastnameEdit').value,
                emailEdit: document.getElementById('patientEmailEdit').value,
                phoneNumberEdit: document.getElementById('phoneNumberEdit').value,
                dobEdit: document.getElementById('dobEdit').value,
                yobEdit: new Date(document.getElementById('dobEdit').value).getFullYear(), // Extract year from dob
                visitForEdit: document.getElementById('visitForEdit').value,
                docAssignedEdit: document.getElementById('docAssignedEdit').value,
                dateOfAppointmentEdit: document.getElementById('dateOfAppointmentEdit').value,
                timeOfAppointmentEdit: document.getElementById('timeOfAppointmentEdit').value,
                statusEdit: document.getElementById('statusEdit').value
            };

            // const jsonData = JSON.stringify(formData, null, 2);
            // alert(jsonData);

            console.log('Updating with data:', formData);

            fetch('../partials/processes.php', {
                method: 'POST',
                // headers: {
                //     'Content-Type': 'x-www-form-urlencoded', // Set the correct header
                // },
                body: new URLSearchParams({ ...formData, update_appointment: 'true' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // // Update the table row in place
                    // const row = $(`#tableResponsive tbody tr[data-appointment-id="${appointmentId}"]`);
                    // row.find('td:nth-child(2)').text(formData.firstName + ' ' + formData.lastname);
                    // row.find('td:nth-child(3)').text(formData.email);
                    // row.find('td:nth-child(4)').text($('#visitFor option:selected').text());
                    // row.find('td:nth-child(5)').text($('#docAssigned option:selected').text());

                    toastr.success('Appointment updated successfully!');

                    refreshTable();
                    $('#modal-lg-edit').modal('hide');
                    <?php $_SESSION['update_success'] = 'Appointment Updated Successfully!'; ?>
                    // location.reload();
                } else {
                    <?php $_SESSION['update_error'] = 'Error! Please Try Again Later.'; ?>
                    // location.reload();
                    // setTimeout(function() { window.location.reload(); }, 5000);
                    // toastr.error('Error Updating Appointment 1: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                <?php $_SESSION['update_error'] = 'Error! Please Try Again Later.'; ?>
                location.reload();
            });
        }
    </script>
    <!-- <script>
        // Show success notification after page loads
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(isset($update_success)): ?>
                toastr.success('<?php echo htmlspecialchars($update_success, ENT_QUOTES); ?>');
                unset($update_success);
            <?php endif; ?>

            <?php if(isset($update_error)): ?>
                toastr.error('<?php echo htmlspecialchars($update_error, ENT_QUOTES); ?>');
                unset($update_error);
            <?php endif; ?>
        });
    </script> -->

    <!-- Check for local storage items on page load and clear them after displaying -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('update_success')) {
                toastr.success(decodeURIComponent(urlParams.get('update_success')));
                // Remove the parameter from the URL
                urlParams.delete('update_success');
                window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
            }

            if (urlParams.has('update_error')) {
                toastr.error(decodeURIComponent(urlParams.get('update_error')));
                // Remove the parameter from the URL
                urlParams.delete('update_error');
                window.history.replaceState({}, '', `${window.location.pathname}?${urlParams.toString()}`);
            }
        });
    </script>
</body>
</html>
