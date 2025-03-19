<?php 
    $currentPage = 'active_users';
    require "../partials/sidenav.php";
    include '../partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Active Users | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/appointment.css">
        <style>
            /* Style for dropdown hover effect */
            select option:hover {
                background-color: #007bff; /* Replace with actual theme color if different */
                color: white;
            }
        </style>
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
                                <li class="breadcrumb-item active">Active Users</li>
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
                        <h3 class="card-title">Active Users</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="tableSearch" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
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
                                                                <input type="email" name="primaryEmail" id="primaryEmailModal" disabled>
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
                                                                <label for="sal1">Salutation: </label>
                                                                <input type="text" name="sal1" id="sal1" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname1">Surname: </label>
                                                                <input type="text" name="surname1" id="surname1" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename1">Middle Name: </label>
                                                                <input type="text" name="middlename1" id="middlename1" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname1">Last Name: </label>
                                                                <input type="text" name="lastname1" id="lastname1" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number1">Tel Number: </label>
                                                                <input type="tel" name="number1" id="number1" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email1">Email: </label>
                                                                <input type="email" name="email1" id="email1" placeholder="ronnie@gmail.com" disabled>
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
                                                                <label for="sal2">Salutation: </label>
                                                                <input type="text" name="sal2" id="sal2" placeholder="Dr." disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="surname2">Surname:</label>
                                                                <input type="text" name="surname2" id="surname2" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="middlename2">Middle Name: </label>
                                                                <input type="text" name="middlename2" id="middlename2" placeholder="Kaballah" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="lastname2">Last Name: </label>
                                                                <input type="text" name="lastname2" id="lastname2" placeholder="Ronnie" disabled>
                                                            </td>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="info">
                                                        <div class="td">
                                                            <td>
                                                                <label for="number2">Tel Number: </label>
                                                                <input type="tel" name="number2" id="number2" placeholder="0712345678" disabled>
                                                            </td>
                                                        </div>
                                                        <div class="td">
                                                            <td>
                                                                <label for="email2">Email: </label>
                                                                <input type="email" name="email2" id="email2" placeholder="ronnie@gmail.com" disabled>
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
                                                            <select name="user-type" id="user-type" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.25rem;"></select>
                                                        </td>
                                                    </div>
                                                    <div class="td">
                                                        <td>
                                                            <label for="specialization">Specialization: </label>
                                                            <select name="specialization" id="specializationModal" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.25rem;"></select>
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
                                                            <select name="accountStatus" id="accountStatusModal" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.25rem;"></select>
                                                        </td>
                                                    </div>
                                                    <div class="td">
                                                        <td>
                                                            <label for="salary">Salary: </label>
                                                            <input type="text" name="salary" id="salaryModal" placeholder="Ksh. 200,000">
                                                        </td>
                                                    </div>
                                                </div>
                                            </tbody>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn" disabled>Save Changes</button>
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

            $sql = "SELECT doctorId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS Name, position AS Position, address AS Address, primaryEmail AS Email, primaryNumber AS Number, salutation, dob, secondaryNumber, secondaryEmail, specialization, workingHoursWeekdays, workingHoursWeekends, accountStatus, salary, firstKinId, secondKinId FROM users WHERE accountStatus LIKE 'Active'";
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
            const noMatchMessageId = "noMatchMessage";

            $("#jsGrid1").jsGrid({
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
                // Helper function to set input values, handling undefined and null
                function setInputValue(selector, value) {
                    $(selector).val(value || 'N/A');
                }

                // Personal Info
                setInputValue('#sal', clientData.salutation);
                const nameParts = clientData.Name.split(' ');
                setInputValue('#firstNameModal', nameParts[0]);
                setInputValue('#middlename', nameParts.slice(1, -1).join(' ') || 'N/A');
                setInputValue('#lastname', nameParts[nameParts.length - 1]);
                setInputValue('#dobModal', clientData.dob);
                setInputValue('#age', calculateAge(clientData.dob));

                // Contact Info
                setInputValue('#primaryNumber', clientData.Number);
                setInputValue('#secondaryNumber', clientData.secondaryNumber);
                setInputValue('#primaryEmailModal', clientData.Email);
                setInputValue('#secondaryEmail', clientData.secondaryEmail);
                setInputValue('#addressModal', clientData.Address);

                // Work Info
                setInputValue('#weekdayStart', clientData.workingHoursWeekdays);
                setInputValue('#weekdayEnd', clientData.workingHoursEndWeekdays);
                setInputValue('#weekendStart', clientData.workingHoursWeekends);
                setInputValue('#weekendEnd', clientData.workingHoursEndWeekends);
                setInputValue('#accountStatusModal', clientData.Status);
                setInputValue('#salaryModal', 'Ksh. ' + (clientData.salary || 'N/A'));

                // Clear previous emergency contact information
                $('#sal1, #surname1, #middlename1, #lastname1, #number1, #email1, #sal2, #surname2, #middlename2, #lastname2, #number2, #email2').val('');

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
                            setInputValue('#sal1', contacts.contact1.salutation);
                            setInputValue('#surname1', contacts.contact1.surname);
                            setInputValue('#middlename1', contacts.contact1.middle_name);
                            setInputValue('#lastname1', contacts.contact1.last_name);
                            setInputValue('#number1', contacts.contact1.phone_number);
                            setInputValue('#email1', contacts.contact1.email);
                        }
                        if (contacts.contact2) {
                            setInputValue('#sal2', contacts.contact2.salutation);
                            setInputValue('#surname2', contacts.contact2.surname);
                            setInputValue('#middlename2', contacts.contact2.middle_name);
                            setInputValue('#lastname2', contacts.contact2.last_name);
                            setInputValue('#number2', contacts.contact2.phone_number);
                            setInputValue('#email2', contacts.contact2.email);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching emergency contacts:", error);
                    }
                });

                // Populate dropdowns and set initial values
                $.when(
                    $.getJSON('../partials/get_user_types.php'),
                    $.getJSON('../partials/get_specializations.php'),
                    $.getJSON('../partials/get_account_statuses.php')
                ).done(function(userTypesData, specializationsData, accountStatusesData) {
                    // Populate User Type dropdown
                    var userTypes = userTypesData[0];
                    var userTypeSelect = $('#user-type');
                    userTypeSelect.empty();
                    $.each(userTypes, function(index, type) {
                        userTypeSelect.append($('<option>', {
                            value: type,
                            text: type
                        }));
                    });
                    

                    // Populate Specialization dropdown
                    var specializations = specializationsData[0];
                    var specializationSelect = $('#specializationModal');
                    specializationSelect.empty();
                    $.each(specializations, function(index, spec) {
                        specializationSelect.append($('<option>', {
                            value: spec.id,
                            text: spec.procedureName
                        }));
                    });
                    

                    // Populate Account Status dropdown
                    var accountStatuses = accountStatusesData[0];
                    var accountStatusSelect = $('#accountStatusModal');
                    accountStatusSelect.empty();
                    $.each(accountStatuses, function(index, status) {
                        accountStatusSelect.append($('<option>', {
                            value: status,
                            text: status
                        }));
                    });
                    

                    // Set initial values for dropdowns AFTER populating
                    userTypeSelect.val(clientData.Position);
                    specializationSelect.val(clientData.specialization);
                    accountStatusSelect.val(clientData.Status);

                    // Enable/disable specialization based on user type
                    function updateSpecializationDropdown() {
                        if ($('#user-type').val() === 'Doctor') {
                            $('#specializationModal').prop('disabled', false);
                        } else {
                            $('#specializationModal').prop('disabled', true).append($('<option>', { value: 'N/A', text: 'N/A' })).val('N/A');
                        }
                    }

                    // Initial state and event listener
                    updateSpecializationDropdown();
                    $('#user-type').change(updateSpecializationDropdown);

                    // Store initial values and track changes
                    trackChanges();

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching dropdown data:", textStatus, errorThrown);
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

            // Function to track changes and enable/disable the Save Changes button
            function trackChanges() {
                const initialValues = {};
                const inputFields = $('#user-type, #specializationModal, #accountStatusModal, #salaryModal');

                // Store initial values
                inputFields.each(function() {
                    initialValues[this.id] = $(this).val();
                });

                // Listen for changes
                inputFields.on('input change', function() {
                    let hasChanged = false;
                    inputFields.each(function() {
                        if ($(this).val() !== initialValues[this.id]) {
                            hasChanged = true;
                            return false; // Exit loop early if a change is found
                        }
                    });

                    $('#saveChangesBtn').prop('disabled', !hasChanged);
                });
            }
        });
        </script>
    </body>
</html>