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
                                                                <input type="text" name="firstName" id="firstName" disabled>
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
                                                                <input type="date" name="dob" id="dob" disabled>
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
                                                                <input type="email" name="primaryEmail" id="primaryEmail" disabled>
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
                                                                <input type="text" name="address" id="address" disabled>
                                                            
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
                                                                <input type="text" name="sal" id="sal" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname">Surname: </label>
                                                                <input type="text" name="surname" id="surname" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename">Middle Name: </label>
                                                                <input type="text" name="middlename" id="middlename" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number">Tel Number: </label>
                                                                <input type="tel" name="number" id="number" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Email: </label>
                                                                <input type="email" name="email" id="email" placeholder="ronnie@gmail.com" disabled>
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
                                                                <input type="text" name="sal" id="sal" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname">Surname:</label>
                                                                <input type="text" name="surname" id="surname" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename">Middle Name: </label>
                                                                <input type="text" name="middlename" id="middlename" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname">Last Name: </label>
                                                                <input type="text" name="lastname" id="lastname" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number">Tel Number: </label>
                                                                <input type="tel" name="number" id="number" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email">Email: </label>
                                                                <input type="email" name="email" id="email" placeholder="ronnie@gmail.com" disabled>
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
                                                                <input type="text" name="specialization" id="specialization" placeholder="..." disabled>
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
                                                                <input type="text" name="accountStatus" id="accountStatus" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="salary">Salary: </label>
                                                                <input type="text" name="salary" id="salary" placeholder="Ksh. 200,000" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
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

            $sql = "SELECT doctorId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS Name, position AS Position, address AS Address, primaryEmail AS Email, primaryNumber AS Number, salutation, dob, secondaryNumber, secondaryEmail, specialization, workingHoursWeekdays, workingHoursWeekends, accountStatus, salary FROM users WHERE accountStatus LIKE 'New'";
            $result = $conn->query($sql);

            echo '<script>';
            echo 'var db = { clients: [';

                if ($result->num_rows > 0) {
                    $clients = [];
                    while ($row = $result->fetch_assoc()) {
                        $clients[] = json_encode($row);
                    }
                    echo implode(',', $clients);
                }

            echo '] };';
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
                        { name: "Email", type: "email", title: "Contact Info" }
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

                // $("#tableSearch").on("keyup", function () {
                //     const filter = this.value.toLowerCase();

                //     const filteredData = originalData.filter(item => {
                //         return (
                //             item.ID.toString().toLowerCase().includes(filter) ||
                //             item.Name.toLowerCase().includes(filter) ||
                //             item.Position.toLowerCase().includes(filter) ||
                //             item.Address.toLowerCase().includes(filter) ||
                //             item.Email.toLowerCase().includes(filter)
                //         );
                //     });

                //     // if (filteredData.length === 0) {
                //     //     $(`#${noMatchMessageId}`).remove();

                //     //     const noMatchMessage = $(`<div id="${noMatchMessageId}" style="text-align: center; color: red; margin: 20px;">No match recorded</div>`);
                //     //     $("#jsGrid1").after(noMatchMessage);
                //     // } else {
                //     //     $(`#${noMatchMessageId}`).remove();
                //     // }
                    
                //     $("#jsGrid1").jsGrid("option", "data", filteredData);
                //     $("#jsGrid1").jsGrid("option", "pageIndex", 1);
                // });

                function displayClientDetails(clientData) {
                    const weekdayTimes = clientData.workingHoursWeekdays.split(' - ');
                    const weekendTimes = clientData.workingHoursWeekends.split(' - ');

                    const weekdayStart = convertTo24HourFormat(weekdayTimes[0]);
                    const weekdayEnd = convertTo24HourFormat(weekdayTimes[1]);
                    const weekendStart = convertTo24HourFormat(weekendTimes[0]);
                    const weekendEnd = convertTo24HourFormat(weekendTimes[1]);

                    $('#sal').val(clientData.salutation);
                    $('#firstName').val(clientData.Name.split(' ')[0]);
                    $('#middlename').val(clientData.Name.split(' ')[1]);
                    $('#lastname').val(clientData.Name.split(' ')[2]);

                    $('#dob').val(clientData.dob);
                    $('#age').val(calculateAge(clientData.dob));

                    $('#primaryNumber').val(clientData.Number);
                    $('#secondaryNumber').val(clientData.secondaryNumber);
                    $('#primaryEmail').val(clientData.Email);
                    $('#secondaryEmail').val(clientData.secondaryEmail);
                    $('#address').val(clientData.Address);

                    $('#weekdayStart').val(weekdayStart);
                    $('#weekdayEnd').val(weekdayEnd);
                    $('#weekendStart').val(weekendStart);
                    $('#weekendEnd').val(weekendEnd);
                    $('#accountStatus').val(clientData.accountStatus);
                    $('#salary').val(clientData.salary);

                    $('#user-type').val(clientData.Position);
                    $('#specialization').val(clientData.specialization);
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