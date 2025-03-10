<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>
<link rel="stylesheet" href="../styles/appointment.css">

<nav class="main-header navbar navbar-expand">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- <div class="navbar-center">
        <form class="form-inline">
            <div class="input-group input-group-sm" style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div> -->

    <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="list-style: none; margin: auto; margin-right: 1rem;">
            <button id="settings-btn" class="btn btn-outline-secondary" style="border-radius: 20px;">
                <i class="fas fa-cog"></i>
            </button>
        </li>
        <li class="nav-item">
            <button id="date-btn" class="btn btn-outline-primary" style="font-weight: bold; border-radius: 20px;">
                <span id="current-date"></span>
                <i class="fas fa-calendar-alt ml-2"></i>
            </button>
        </li>
    </ul>
    </ul>
</nav>

<!-- Settings Modal -->


<div class="modal fade" id="settings-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Settings</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body">
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="personal-tab" data-toggle="pill" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="work-tab" data-toggle="pill" href="#work" role="tab" aria-controls="work" aria-selected="false">Work Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="false">Account Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="emergency-tab" data-toggle="pill" href="#emergency" role="tab" aria-controls="emergency" aria-selected="false">Emergency Contact</a>
                                </li>
                            </ul>
                        </div>
        
                        <div class="card-body">
                            <div class="tab-content" id="settingsTabContent">
                                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                    <tbody>
                                        <tr>
                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="salutation">Salutation: </label>
                                                        <input type="text" name="salutation" id="salutation">
                                                    </td>
                                                </div>

                                                <div class="td">
                                                    <td>
                                                        <label for="firstName">First Name: </label>
                                                        <input type="text" name="firstName" id="firstName">
                                                    </td>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="lastName">Last Name: </label>
                                                        <input type="text" name="lastName" id="lastName">
                                                    </td>
                                                </div>
                                                <div class="td">
                                                    <td>
                                                        <label for="phoneNumber">Phone Number: </label>
                                                        <input type="text" name="phoneNumber" id="phoneNumber">
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
                                                        <label for="address">Address: </label>
                                                        <input type="text" name="address" id="address">
                                                    </td>
                                                </div>
                                            </div>
                                        </tr>
                                    </tbody>
                                </div>

                                <div class="tab-pane fade" id="work" role="tabpanel" aria-labelledby="work-tab">
                                    <tbody>
                                        <tr>
                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="position">Position: </label>
                                                        </br>
                                                        <select name="position" id="position" value="Doctor" disabled style="width: 100%">
                                                            <option value="doctor" selected>Doctor</option>
                                                            <option value="receptionist">Receptionist</option>
                                                            <option value="admin">Admin</option>
                                                        </select>
                                                    </td>
                                                </div>
                                                <div class="td">
                                                    <td>
                                                        <label for="specialization">Specialization: </label>
                                                        <!-- <input type="test" name="specialization" id="specialization"> -->
                                                        <br>
                                                        <select name="specialization" id="specialization" style="width: 100%;" disabled>
                                                            <?php
                                                                $procedures = $conn->query("SELECT id, procedureName FROM procedures WHERE status='available'");
                                                                while($procedure = $procedures->fetch_assoc()) {
                                                                    $selected = ''; // Initialize $selected
                                                                    // Add selected attribute if procedure name matches user's specialization
                                                                    if (isset($userData) && $procedure['procedureName'] == $userData['specialization']) {
                                                                        $selected = 'selected';
                                                                    }
                                                                    echo "<option value='".htmlspecialchars($procedure['id'], ENT_QUOTES)."' $selected>".htmlspecialchars($procedure['procedureName'])."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </div>
                                                <!-- <div class="td">
                                                    <td>
                                                        <label for="docAssigned">Doctor Assigned: </label>
                                                        <br>
                                                        <select name="docAssigned" id="docAssigned" style="width: 100%;" disabled>
                                                            <option value="<?php echo (int)$_SESSION['user_id']; ?>" selected><?php echo htmlspecialchars($doctorFullName); ?></option>
                                                        </select>
                                                    </td>
                                                </div> -->
                                            </div>

                                            <br>

                                            <div class="info">
                                                <div class="td">
                                                    <label for="weekdayHours">Working Hours (Weekdays) </label>

                                                    </br>
                                                    
                                                    <td>
                                                        <label for="weekdayStartHours" style="width: 49%">From: </label>
                                                        <label for="weekdayEndHours" style="width: 49%">To: </label>
                                                    </td>

                                                    </br>

                                                    <td>
                                                        <input type="time" name="weekdayStartHours" id="weekdayStartHours" style="width: 49%">
                                                        <input type="time" name="weekdayEndHours" id="weekdayEndHours" style="width: 49%">
                                                    </td>
                                                </div>
                                                <div class="td">
                                                    <label for="weekendHours">Working Hours (Weekends) </label>

                                                    <td>
                                                        <label for="weekendStartHours" style="width: 49%">From: </label>
                                                        <label for="weekendEndHours" style="width: 49%">To: </label>
                                                    </td>

                                                    </br>

                                                    <td>
                                                        <input type="time" name="weekendStartHours" id="weekendStartHours" style="width: 49%">
                                                        <input type="time" name="weekendEndHours" id="weekendEndHours" style="width: 49%">
                                                    </td>
                                                </div>
                                            </div>

                                            <br>

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
                                                        <input type="text" name="salary" id="salary" disabled>
                                                    </td>
                                                </div>
                                            </div>
                                        </tr>
                                    </tbody>
                                </div>

                                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                                    <tbody>
                                        <tr>
                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="username">Username: </label>
                                                        <input type="text" name="username" id="username" placeholder="Enter a Username">
                                                    </td>
                                                </div>

                                                <div class="td">
                                                    <td>
                                                        <label for="primaryEmail">Email: </label>
                                                        <input type="text" name="primaryEmail" id="primaryEmail">
                                                    </td>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="password">New Password: </label>
                                                        <input type="password" name="password" id="password" placeholder="Enter a New Password">
                                                    </td>
                                                </div>
                                                <div class="td">
                                                    <td>
                                                        <label for="confirmPassword">Confirm Password: </label>
                                                        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your Password">
                                                    </td>
                                                </div>
                                            </div>
                                        </tr>
                                    </tbody>
                                </div>

                                <div class="tab-pane fade" id="emergency" role="tabpanel" aria-labelledby="emergency-tab">
                                    <tbody>
                                        <tr>
                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="emergencyContactFirstName">First Name: </label>
                                                        <input type="text" name="emergencyContactFirstName" id="emergencyContactFirstName">
                                                    </td>
                                                </div>

                                                <div class="td">
                                                    <td>
                                                        <label for="emergencyContactLastName">Last Name: </label>
                                                        <input type="text" name="emergencyContactLastName" id="emergencyContactLastName">
                                                    </td>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="info">
                                                <div class="td">
                                                    <td>
                                                        <label for="emergencyContactNumber">Phone Number: </label>
                                                        <input type="text" name="emergencyContactNumber" id="emergencyContactNumber">
                                                    </td>
                                                </div>
                                                <div class="td">
                                                    <td>
                                                        <label for="emergencyContactAddress">Email Address: </label>
                                                        <input type="text" name="emergencyContactAddress" id="emergencyContactAddress">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="save_settings" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateBtn = document.getElementById('date-btn');
        const currentDateSpan = document.getElementById('current-date');
        const calendarContainer = document.getElementById('calendar-container');
        const calendar = document.getElementById('calendar');

        let currentDate = new Date();

        function formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        currentDateSpan.textContent = formatDate(currentDate);

        const settingsBtn = document.getElementById('settings-btn');
        const settingsModal = document.getElementById('settings-modal');

        settingsBtn.addEventListener('click', function () {
            $(settingsModal).modal('show');
        });

        function to24Hour(time12h) {
            const [time, modifier] = time12h.split(' ');
            let [hours, minutes] = time.split(':');

            if (hours === '12') {
                hours = '00';
            }

            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }

            return `${hours}:${minutes}`;
        }

        function to12Hour(time24h) {
            let [hours, minutes] = time24h.split(':');
            let modifier = 'AM';

            if (hours >= 12) {
                modifier = 'PM';
                if (hours > 12) {
                    hours -= 12;
                }
            }
            
            if (hours === '00'){
                hours = 12;
            }

            hours = String(hours).padStart(2, '0'); // Ensure two digits

            return `${hours}:${minutes} ${modifier}`;
        }

        // Fetch user information and populate the modal
        function populateUserSettings() {
            $.ajax({
                url: '../partials/get_user_info.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                    } else {
                        const userData = response.user;
                        const emergencyContact = response.emergencyContact;

                        // Populate Personal Information tab
                        $('#salutation').val(userData.salutation);
                        $('#firstName').val(userData.firstName);
                        $('#lastName').val(userData.lastName);
                        $('#address').val(userData.address);
                        $('#dob').val(userData.dob);
                        $('#phoneNumber').val(userData.primaryNumber);
                        $('#primaryEmail').val(userData.primaryEmail);

                        // Populate Work Information tab
                        // Capitalize the first letter of the position
                        var position = userData.position;
                        $('#position').val(userData.position);
                        
                        // Set Specialization
                        $('#specialization').val(userData.specialization);
                        $('#secondaryNumber').val(userData.secondaryNumber);
                        $('#secondaryEmail').val(userData.secondaryEmail);
                        $('#weekdayStartHours').val(userData.workingHoursWeekdays);
                        $('#weekdayEndHours').val(userData.workingHoursEndWeekdays);
                        $('#weekendStartHours').val(userData.workingHoursWeekends);
                        $('#weekendEndHours').val(userData.workingHoursEndWeekends);
                        $('#accountStatus').val(userData.accountStatus.charAt(0).toUpperCase() + userData.accountStatus.slice(1));
                        $('#salary').val(userData.salary);
                        
                        // Populate Account Information tab
                        $('#username').val(userData.username);
                        $('#accountEmail').val(userData.primaryEmail);
                      

                        // Populate Emergency Contact tab
                        if (emergencyContact) {
                            $('#emergencyContactFirstName').val(emergencyContact.surname);
                            $('#emergencyContactLastName').val(emergencyContact.last_name);
                            $('#emergencyContactNumber').val(emergencyContact.phone_number);
                            $('#emergencyContactAddress').val(emergencyContact.email);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching user data:", error);
                }
            });
        }
        settingsBtn.addEventListener('click', function () {
            $(settingsModal).modal('show');
            populateUserSettings();
        });

        $('#save_settings').click(function() {
            // Convert times to 24-hour format before sending
            const weekdayStartHours24 = to24Hour($('#weekdayStartHours').val());
            const weekdayEndHours24 = to24Hour($('#weekdayEndHours').val());
            const weekendStartHours24 = to24Hour($('#weekendStartHours').val());
            const weekendEndHours24 = to24Hour($('#weekendEndHours').val());

            const userData = {
                salutation: $('#salutation').val(),
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                address: $('#address').val(),
                dob: $('#dob').val(),
                primaryNumber: $('#phoneNumber').val(),
                primaryEmail: $('#primaryEmail').val(),
                position: $('#position').val(),
                specialization: $('#specialization').val(),
                secondaryNumber: $('#secondaryNumber').val(),
                secondaryEmail: $('#secondaryEmail').val(),
                weekdayStartHours: weekdayStartHours24, // Use converted values
                weekdayEndHours: weekdayEndHours24,     // Use converted values
                weekendStartHours: weekendStartHours24, // Use converted values
                weekendEndHours: weekendEndHours24,     // Use converted values
                accountStatus: $('#accountStatus').val(),
                salary: $('#salary').val(),
                username: $('#username').val(),
                password: $('#password').val(), // Consider hashing the password on the server-side
                emergencyContactFirstName: $('#emergencyContactFirstName').val(),
                emergencyContactLastName: $('#emergencyContactLastName').val(),
                emergencyContactNumber: $('#emergencyContactNumber').val(),
                emergencyContactAddress: $('#emergencyContactAddress').val()
            };

            $.ajax({
                url: '../partials/update_user_info.php',
                type: 'POST',
                data: userData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Settings saved successfully!');
                        $(settingsModal).modal('hide');
                    } else {
                        alert('Error saving settings: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error saving user data:", error);
                    alert('Error saving settings. See console for details.');
                }
            });
    });
    console.log(<?php echo json_encode($_SESSION); ?>)
});
</script>
