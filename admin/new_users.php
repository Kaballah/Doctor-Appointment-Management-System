<?php 
    $currentPage = 'new_users';
    require "../partials/sidenav.php";
    include '../partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>New Users | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/appointment.css">
    </head>

    <body>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                                <li class="breadcrumb-item active">New Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <div id="skeletonLoader" class="skeleton-loader">
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text"></div>
            </div>

            <section class="content">
                <div class="card d-none" id="card">
                    <div class="card-header">
                        <h3 class="card-title">New Users</h3>

                        <div class="card-tools">
                            <a href="#" class="float-left">
                                <button type="button" class="btn-sm btn-outline-primary">Add New User</button>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="jsGrid1" data-toggle="modal" data-target="#modal-lg"></div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Summary</h4>
                        
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
                                            <a class="nav-link active" id="personal-information-tab" data-toggle="pill" href="#personal-information" role="tab" aria-controls="personal-information" aria-selected="true">Personal Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-information-tab" data-toggle="pill" href="#contact-information" role="tab" aria-controls="contact-information" aria-selected="false">Contact Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="emergency-contact-tab" data-toggle="pill" href="#emergency-contact" role="tab" aria-controls="emergency-contact" aria-selected="false">Emergency Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="work-information-tab" data-toggle="pill" href="#work-information" role="tab" aria-controls="work-information" aria-selected="false">Work Info</a>
                                        </li>
                                    </ul>
                                </div>
              
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="personal-information" role="tabpanel" aria-labelledby="personal-information-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="sal">Salutation: </label>
                                                                <input type="text" name="sal" id="sal" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="firstName">First Name: </label>
                                                                <input type="text" name="firstName" id="firstNameModal" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename">Middle Name: </label>
                                                                <input type="text" name="middlename" id="middlename" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname" disabled>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>

                                                <hr>

                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="dob">Date of Birth: </label>
                                                                <input type="date" name="dob" id="dobModal" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="age">Age: </label>
                                                                <input type="number" name="age" id="age" disabled>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </div>

                                        <div class="tab-pane fade" id="contact-information" role="tabpanel" aria-labelledby="contact-information-tab">
                                            <tbody>
                                                <tr>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="primaryNumber">Primary Phone Number: </label>
                                                                <input type="tel" name="primaryNumber" id="primaryNumber" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="secondaryNumber">Secondary Phone Number: </label>
                                                                <input type="tel" name="secondaryNumber" id="secondaryNumber" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="primaryEmail">Primary Email: </label>
                                                                <input type="email" name="primaryEmailModal" id="primaryEmail" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="secondaryEmail">Secondary Email: </label>
                                                                <input type="email" name="secondaryEmail" id="secondaryEmail" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <hr>

                                                    <div class="info2">
                                                        <div>
                                                            <td>
                                                                <label for="address">Physical Address: </label>
                                                                <input type="text" name="address" id="addressModal" disabled>
                                                            
                                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3988.434092707864!2d36.9491909!3d-1.5093063!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182fa1d8115929e1%3A0xcbf2a35c7c4f3c4e!2sHalisi%20Family%20Hospital!5e0!3m2!1sen!2ske!4v1731922679979!5m2!1sen!2ske" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </div>

                                        <div class="tab-pane fade" id="emergency-contact" role="tabpanel" aria-labelledby="emergency-contact-tab">
                                            <tbody>
                                                <tr>
                                                    <h4>Contact 1</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="sal">Salutation: </label>
                                                                <input type="text" name="sal" id="sal1" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname">Surname: </label>
                                                                <input type="text" name="surname" id="surname1" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename">Middle Name: </label>
                                                                <input type="text" name="middlename" id="middlename1" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname1" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number">Tel Number: </label>
                                                                <input type="tel" name="number" id="number1" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Email: </label>
                                                                <input type="email" name="email" id="email1" placeholder="ronnie@gmail.com" disabled>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>

                                                <hr>

                                                <tr>
                                                    <h4>Contact 2</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="sal">Salutation: </label>
                                                                <input type="text" name="sal" id="sal2" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname">Surname:</label>
                                                                <input type="text" name="surname" id="surname2" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename">Middle Name: </label>
                                                                <input type="text" name="middlename" id="middlename2" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname2" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number">Tel Number: </label>
                                                                <input type="tel" name="number" id="number2" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Email: </label>
                                                                <input type="email" name="email" id="email2" placeholder="ronnie@gmail.com" disabled>
                                                            </td>
                                                        </div>
                                                    </div>
                                                </tr>

                                                <hr>
                                            </tbody>
                                        </div>

                                        <div class="tab-pane fade" id="work-information" role="tabpanel" aria-labelledby="work-information-tab">
                                            <tbody>
                                                <tr>
                                                    <h4>Role</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="user-type">User Type: </label>
                                                                <input type="text" name="user-type" id="user-type" placeholder="Doctor" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="specialization">Specialization: </label>
                                                                <input type="text" name="specialization" id="specializationModal" placeholder="..." disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <hr>

                                                    <h4>Weekdays</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="weekdayStart">Start: </label>
                                                                <input type="time" name="weekdayStart" id="weekdayStart" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="weekdayEnd">End: </label>
                                                                <input type="time" name="weekdayEnd" id="weekdayEnd" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <h4>Weekends</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="weekendStart">Start: </label>
                                                                <input type="time" name="weekendStart" id="weekendStart" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="weekendEnd">End: </label>
                                                                <input type="time" name="weekendEnd" id="weekendEnd" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <hr>

                                                    <h4>Other Information</h4>
                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="accountStatus">Account Status: </label>
                                                                <input type="text" name="accountStatus" id="accountStatusModal" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="salary">Salary: </label>
                                                                <input type="text" name="salary" id="salaryModal" placeholder="Ksh. 200,000" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <!-- <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="room-number">Room Number: </label>
                                                                <input type="text" name="room-number" id="room-number" placeholder="B12" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="salary">Salary: </label>
                                                                <input type="text" name="salary" id="salary" placeholder="Ksh. 200,000" disabled>
                                                            </td>
                                                        </div>
                                                    </div> -->
                                                </tr>
                                            </tbody>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Edit Information</button>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>

        <?php 
            include '../partials/connect.php';

            $sql = "SELECT doctorId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS Name, position AS Position, address AS Address, primaryEmail AS Email, primaryNumber AS Number, salutation, dob, secondaryNumber, secondaryEmail, specialization, workingHoursWeekdays, workingHoursWeekends, accountStatus, salary, firstKinId, secondKinId FROM users WHERE accountStatus LIKE 'New'";
            $result = $conn->query($sql);

            $proceduresSql = "SELECT id, procedureName FROM procedures";
            $proceduresResult = $conn->query($proceduresSql);
            $procedures = [];
            if ($proceduresResult->num_rows > 0) {
                while ($row = $proceduresResult->fetch_assoc()) {
                    $procedures[$row['id']] = $row['procedureName'];
                }
            }

            echo '<script>';
            echo 'var db = { clients: [';

                if ($result->num_rows > 0) {
                    $clients = [];
                    while ($row = $result->fetch_assoc()) {
                        $clients[] = json_encode($row);
                    }
                    echo implode(',', $clients);
                }
            echo '], procedures: ' . json_encode($procedures) . ' };';
            echo '</script>';

            $conn->close();
        ?>

        <script>
            $(function () {
                const originalData = db.clients;

                $("#jsGrid1").jsGrid({
                    // height: "100%",
                    width: "100%",

                    sorting: true,
                    paging: true,
                    pageSize: 10,
                    pageButtonCount: 5,

                    data: originalData,

                    fields: [
                        { name: "ID", type: "text", width: 50 },
                        { name: "Name", type: "text", width: 100 },
                        { name: "Position", type: "text", width: 50 },
                        { name: "Address", type: "text", width: 100 },
                        { name: "Email", type: "email", title: "Contact Info" },
                        {
                            name: "Specialization",
                            title: "Specialization",
                            itemTemplate: function(value, item) {
                                return db.procedures[item.specialization] || "N/A";
                            }
                        }

                    ],

                    rowClick: function (args) {
                        const clientData = args.item;

                        displayClientDetails(clientData);
                    }
                });

                $(".jsgrid-header-cell").on("click", function (e) {
                    e.stopPropagation();
                });
                $(".jsgrid-pager").on("click", function (e) {
                    e.stopPropagation();
                });

                $("#tableSearch").on("keyup", function () {
                    const filter = this.value.toLowerCase();

                    const filteredData = originalData.filter(item => {
                        return (
                            item.ID.toString().toLowerCase().includes(filter) ||
                            item.Name.toLowerCase().includes(filter) ||
                            item.Position.toLowerCase().includes(filter) ||
                            item.Address.toLowerCase().includes(filter) ||
                            item.Email.toLowerCase().includes(filter)
                        );
                    });
                    
                    $("#jsGrid1").jsGrid("option", "data", filteredData);
                    $("#jsGrid1").jsGrid("option", "pageIndex", 1);
                });

                function displayClientDetails(clientData) {
                    const weekdayTimes = clientData.workingHoursWeekdays?.split(' - ');
                    const weekendTimes = clientData.workingHoursWeekends?.split(' - ');

                    const weekdayStart = weekdayTimes ? convertTo24HourFormat(weekdayTimes[0]) : '';
                    const weekdayEnd = weekdayTimes ? convertTo24HourFormat(weekdayTimes[1]) : '';
                    const weekendStart = weekendTimes ? convertTo24HourFormat(weekendTimes[0]) : '';
                    const weekendEnd = weekendTimes ? convertTo24HourFormat(weekendTimes[1]) : '';

                    $('#sal').val(clientData.salutation);
                    $('#firstNameModal').val(clientData.Name.split(' ')[0]);
                    $('#middlename').val(clientData.Name.split(' ')[1] || ''); // Handle potentially missing middle name
                    $('#lastname').val(clientData.Name.split(' ')[2]);

                    $('#dobModal').val(clientData.dob);
                    $('#age').val(calculateAge(clientData.dob));

                    $('#primaryNumber').val(clientData.Number);
                    $('#secondaryNumber').val(clientData.secondaryNumber || ''); // Handle potentially missing secondary number
                    $('#primaryEmailModal').val(clientData.Email);
                    $('#secondaryEmail').val(clientData.secondaryEmail || ''); // Handle potentially missing secondary email
                    $('#addressModal').val(clientData.Address);

                    $('#weekdayStart').val(weekdayStart);
                    $('#weekdayEnd').val(weekdayEnd);
                    $('#weekendStart').val(weekendStart);
                    $('#weekendEnd').val(weekendEnd);
                    $('#accountStatusModal').val(clientData.accountStatus);
                    $('#salaryModal').val('Ksh. ' + clientData.salary);

                    $('#user-type').val(clientData.Position);
                    $('#specializationModal').val(db.procedures[clientData.specialization] || "N/A");
                    console.log("Specialization ID:", clientData.specialization);
                    console.log("Procedure Name:", db.procedures[clientData.specialization] || "N/A");

                    // Clear previous emergency contact information
                    $('#sal1').val('');
                    $('#surname1').val('');
                    $('#middlename1').val('');
                    $('#lastname1').val('');
                    $('#number1').val('');
                    $('#email1').val('');
                    $('#sal2').val('');
                    $('#surname2').val('');
                    $('#middlename2').val('');
                    $('#lastname2').val('');
                    $('#number2').val('');
                    $('#email2').val('');


                    // Fetch and display emergency contact information using firstKinId and secondKinId
                    $.ajax({
                        url: '../partials/get_emergency_contacts.php',
                        type: 'GET',
                        data: {
                            firstKinId: clientData.firstKinId,
                            secondKinId: clientData.secondKinId
                        },
                        dataType: 'json',
                        success: function(contacts) {
                            if (contacts.contact1) {
                            $('#sal1').val(contacts.contact1.salutation);
                            $('#surname1').val(contacts.contact1.surname);
                            $('#middlename1').val(contacts.contact1.middle_name);
                            $('#lastname1').val(contacts.contact1.last_name);
                            $('#number1').val(contacts.contact1.phone_number);
                            $('#email1').val(contacts.contact1.email);
                            }
                            if (contacts.contact2) {
                            $('#sal2').val(contacts.contact2.salutation);
                            $('#surname2').val(contacts.contact2.surname);
                            $('#middlename2').val(contacts.contact2.middle_name);
                            $('#lastname2').val(contacts.contact2.last_name);
                            $('#number2').val(contacts.contact2.phone_number);
                            $('#email2').val(contacts.contact2.email);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching emergency contacts:", error);
                        }
                    });
                }

                function calculateAge(dob) {
                    var birthDate = new Date(dob);
                    var age = new Date().getFullYear() - birthDate.getFullYear();
                    var m = new Date().getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && new Date().getDate() < birthDate.getDate())) {
                        age--;
                    }
                    return age;
                }

                function convertTo24HourFormat(time) {
                    var timeParts = time.match(/(\d{1,2})\s*(am|pm)/i);
                    if (!timeParts) return time;

                    var hours = parseInt(timeParts[1]);
                    var period = timeParts[2].toLowerCase();
                    
                    if (period === 'am' && hours === 12) {
                        hours = 0;
                    } else if (period === 'pm' && hours !== 12) {
                        hours += 12;
                    }

                    return (hours < 10 ? '0' : '') + hours + ":00";
                }
            });
        </script>
    </body>
</html>