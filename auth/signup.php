<?php 
    include '../partials/connect.php';
?>

<?php 
    $specializations = [];
    $query = "SELECT id, procedureName FROM procedures";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $specializations[] = $row; // Store both id and name
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up | Halisi Family Hospital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <?php include '../styles/styles.php'?>

    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <div class="signup-container">
        <h2>Halisi Doctor <br> Appointment System</h2>

        <div class="separator">
            <hr>
        </div>

        <form action="../partials/processes.php" method="POST" id="signupForm">
            <!-- Account Information -->
            <div class="step" id="step-1">
                <center>
                    <h5>Account Information</h5>
                </center>

                <div class="separator">
                    <hr>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="first_name" class="form-label">* First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="col">
                        <label for="last_name" class="form-label">* Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="email" class="form-label">* Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="col">
                        <label for="phone" class="form-label">* Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="user_type" class="form-label">* User Type</label>
                        <select class="form-select" id="user_type" name="user_type" onchange="toggleSpecialization()">
                            <option value="" disabled selected>Select User Type</option>
                            <option value="admin">Admin</option>
                            <option value="doctor">Doctor</option>
                            <option value="receptionist">Receptionist</option>
                        </select>
                    </div>
                    <div class="col" id="specialization_field" style="display:none;">
                        <label for="specialization" class="form-label">* Specialization</label>
                        <select class="form-select" id="specialization" name="specialization">
                            <option value="" disabled selected>Select Specialization</option>

                            <?php foreach ($specializations as $specialization): ?>
                                <option value="<?= htmlspecialchars($specialization['id']) ?>"><?= htmlspecialchars($specialization['procedureName']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <div class="col">
                        <label for="password" class="form-label">* Password</label>
                        <div class="input" style="display: flex; position: relative; width: 100%;">
                            <input type="password" class="form-control" id="password" name="password" style="border-radius: .25rem 0 0 .25rem; width: 100%; padding: 1vw;">
                            <div style="background-color: #fff; border: 1px solid #97CBDC; border-left: none; border-radius: 0 .25rem .25rem 0; display: flex; position: relative; left: -.2vw; align-items: center; justify-content: center; width: 20%;">
                                <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="retype_password" class="form-label">* Retype Password</label>
                        <div class="input" style="display: flex; position: relative;">
                            <input type="password" class="form-control" id="retype_password" name="retype_password" style="border-radius: .25rem 0 0 .25rem; width: 100%; padding: 1vw;">
                                <div style="background-color: #fff; border: 1px solid #97CBDC; border-left: none; border-radius: 0 .25rem .25rem 0; display: flex; position: relative; left: -.2vw; align-items: center; justify-content: center; width: 20%;">
                                    <i class="bi bi-eye-slash" id="toggleRetypedPassword" style="cursor: pointer;"></i>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="footer" style="display: flex;">
                    <a href="login.php" class="back-to-login" style="width: 45%;">Back to Login</a>
                    <button type="button" class="btn btn-primary" id="nextFirstStep" style="width: 45%;" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="step" id="step-2" style="display:none;">
                <center>
                    <h5>Personal Information</h5>
                </center>

                <div class="separator">
                    <hr>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="salutation" class="form-label">Salutation</label>
                        <select class="form-select" id="salutation" name="salutation">
                            <option value="" disabled selected>Select Salutation</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss">Miss</option>
                            <option value="Dr.">Dr.</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="doctorId" class="form-label">* Doctor ID</label>
                        <input type="text" class="form-control" id="doctorId" name="doctorId" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="address" class="form-label">* Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="col">
                        <label for="dob" class="form-label">* Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="altEmail" class="form-label">Alternative Email</label>
                        <input type="email" class="form-control" id="altEmail" name="altEmail">
                    </div>
                    <div class="col">
                        <label for="altPhone" class="form-label">Alternative Number</label>
                        <input type="tel" class="form-control" id="altPhone" name="altPhone">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="timeRangeWeekdays" class="form-label">Weekdays Working Hours</label>
                        <div class="time-range-container" id="timeRangeWeekdays" class="timeRangeWeekdays" style="display: flex; align-items: center; gap: 10px;">
                            <span class="time-label" id="startTimeOnWeekdays" name="timeStartWeekdays" style="font-weight: bold;">08:00 AM</span>
                            <div id="timeSliderWeekdays" style="width: 300px;"></div>
                            <span class="time-label" id="endTimeOnWeekdays" name="timeStopWeekdays" style="font-weight: bold;">06:00 PM</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="startTimeOnWeekdays" name="startTimeOnWeekdays">
                <input type="hidden" id="endTimeOnWeekdays" name="endTimeOnWeekdays">
                <div class="mb-3 row">
                    <div class="col">
                        <label for="timeRangeWeekends" class="form-label">Weekends Working Hours</label>
                        <div class="time-range-container" id="timeRangeWeekends" class="timeRangeWeekends" style="display: flex; align-items: center; gap: 10px;">
                            <span class="time-label" id="startTimeOnWeekends" style="font-weight: bold;">08:00 AM</span>
                            <div id="timeSliderWeekends" style="width: 300px;"></div>
                            <span class="time-label" id="endTimeOnWeekends" style="font-weight: bold;">06:00 PM</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="startTimeOnWeekends" name="startTimeOnWeekends">
                <input type="hidden" id="endTimeOnWeekends" name="endTimeOnWeekends">
                <div class="footer" style="display: flex; justify-content: space-evenly;">
                    <button type="button" class="btn btn-secondary" id="previousSecondStep" style="width: 40%;" onclick="previousStep()">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextSecondStep" style="width: 40%;" onclick="nextStep()">Next</button>
                </div>
            </div>
            
            <!-- Emergency Contact -->
            <div class="step" id="step-3" style="display:none;">
                <center>
                    <h5>Emergency Contact</h5>
                </center>

                <div class="separator">
                    <hr>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="salutationEmergencyContact" class="form-label">Salutation</label>
                        <select class="form-select" id="salutationEmergencyContact" name="salutationEmergencyContact">
                            <option value="" disabled selected>Select Salutation</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss.">Miss.</option>
                            <option value="Dr.">Dr.</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="surnameEmergencyContact" class="form-label">* Surname</label>
                        <input type="text" class="form-control" id="surnameEmergencyContact" name="surnameEmergencyContact">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="middleNameEmergencyContact" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleNameEmergencyContact" name="middleNameEmergencyContact">
                    </div>
                    
                    <div class="col">
                        <label for="lastNameEmergencyContact" class="form-label">* Last Name</label>
                        <input type="text" class="form-control" id="lastNameEmergencyContact" name="lastNameEmergencyContact">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <div class="col">
                        <label for="phoneNumberEmergencyContact" class="form-label">* Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumberEmergencyContact" name="phoneNumberEmergencyContact">
                    </div>
                    
                    <div class="col">
                        <label for="emailEmergencyContact" class="form-label">* Email</label>
                        <input type="email" class="form-control" id="emailEmergencyContact" name="emailEmergencyContact">
                    </div>
                </div>

                <div class="footer" style="display: flex; justify-content: space-evenly;">
                    <button type="button" class="btn btn-secondary" style="width: 40%;" onclick="previousStep()">Previous</button>
                    <button type="submit" class="btn btn-success" style="width: 40%;" name="signup">Sign Up</button>
                </div>
            </div>
        </form>
    </div>

    <?php include '../js/scripts.php' ?>

    <script>
        // Generate Doctor ID
        function generateDoctorId() {
            let id;
            do {
                id = Math.floor(Math.random() * 9000000000) + 1000000000; // 10-digit number
            } while (checkDoctorIdExists(id)); // Basic client-side check (not foolproof)
            return id.toString();
        }

       // Function to check Doctor ID existence (AJAX)
        function checkDoctorIdExists(doctorId) {
            let isDuplicate = false;
            
            // Using synchronous XMLHttpRequest for simplicity (not recommended for production)
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../partials/check_doctorid.php?doctorId=' + doctorId, false); // Synchronous request
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    isDuplicate = xhr.responseText === 'true';
                }
            };
            xhr.send();
            return isDuplicate;
        }


        // Set Doctor ID on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('doctorId').value = generateDoctorId();
        });


        // Multi Step Sign up Form
        // let currentStep = 1;

        // function nextStep() {
        //     document.getElementById(`step-${currentStep}`).style.display = 'none';
        //     currentStep++;
        //     document.getElementById(`step-${currentStep}`).style.display = 'block';
        // }

        // function previousStep() {
        //     document.getElementById(`step-${currentStep}`).style.display = 'none';
        //     currentStep--;
        //     document.getElementById(`step-${currentStep}`).style.display = 'block';
        // }

        // Time Range Picker for Weekday Working Hours
        $(function () {
            function formatTime(minutes) {
                const hours = Math.floor(minutes / 60);
                const mins = minutes % 60;
                const period = hours >= 12 ? "PM" : "AM";
                const formattedHours = hours % 12 || 12;
                const formattedMinutes = mins < 10 ? "0" + mins : mins;

                return `${formattedHours}:${formattedMinutes} ${period}`;
            }

            $("#timeSliderWeekdays").slider({
                range: true,
                min: 0,
                max: 1440,
                step: 15,
                values: [480, 1080],
                slide: function (event, ui) {
                    $("#startTimeOnWeekdays").val(formatTime(ui.values[0]));
                    $("#endTimeOnWeekdays").val(formatTime(ui.values[1]));
                }
            });

            const values = $("#timeSliderWeekdays").slider("values");

            $("#startTimeOnWeekdays").val(formatTime(values[0]));
            $("#endTimeOnWeekdays").val(formatTime(values[1]));
        });

        // // Time Range Picker for Weekday Working Hours
        $(function () {
            function formatTime(minutes) {
                const hours = Math.floor(minutes / 60);
                const mins = minutes % 60;
                const period = hours >= 12 ? "PM" : "AM";
                const formattedHours = hours % 12 || 12;
                const formattedMinutes = mins < 10 ? "0" + mins : mins;

                return `${formattedHours}:${formattedMinutes} ${period}`;
            }

            $("#timeSliderWeekends").slider({
                range: true,
                min: 0,
                max: 1440,
                step: 15,
                values: [480, 1080],
                slide: function (event, ui) {
                    $("#startTimeOnWeekends").text(formatTime(ui.values[0]));
                    $("#endTimeOnWeekends").text(formatTime(ui.values[1]));
                }
            });

            const values = $("#timeSliderWeekends").slider("values");

            $("#startTimeOnWeekends").text(formatTime(values[0]));
            $("#endTimeOnWeekends").text(formatTime(values[1]));
        });

    </script>

    <script>
        // Password Ids
        const passwordId = document.getElementById('password')
        const retypePasswordId = document.getElementById('retype_password');

        // Next Button of Step One
        document.getElementById('nextFirstStep').addEventListener('click', function (e) {
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const userType = document.getElementById('user_type').value;
            const specializationField = document.getElementById('specialization_field');
            const specialization = document.getElementById('specialization').value.trim();
            const password = document.getElementById('password').value;
            const retypePassword = document.getElementById('retype_password').value;

            // Check if the Following Fields have been Filled
            if (!firstName || !lastName || !email || !phone || !userType || !password) {
                e.preventDefault();
                toastr.warning('Please Fill All Required Fields.')
            } else if (userType === 'doctor' && !specialization) {
                e.preventDefault();
                toastr.warning('Specialization is Required for Doctors.');
            } else if (password !== retypePassword) {
                e.preventDefault();
                toastr.error('Passwords do not Match.');
            } else {
                let currentStep = 1;

                document.getElementById(`step-${currentStep}`).style.display = 'none';
                currentStep++;
                document.getElementById(`step-${currentStep}`).style.display = 'block';
            }
        })

        // Next Button of Step Two
        document.getElementById('nextSecondStep').addEventListener('click', function (e) {
            const doctorId = document.getElementById('doctorId').value.trim();
            const address = document.getElementById('address').value.trim();
            const dob = document.getElementById('dob').value.trim();
            const altEmail = document.getElementById('altEmail').value.trim();
            const altPhone = document.getElementById('altPhone').value.trim();

            // Not Included
            // const timeSliderWeekdays = document.getElementById('timeSliderWeekdays').value.trim();
            // const timeSliderWeekends = document.getElementById('timeSliderWeekends').value.trim();

            console.log("I have been Pressed!")

            // Check if the Following Fields have been Filled
            if (!doctorId || !address || !dob) {
                e.preventDefault();
                toastr.warning('Please Fill All Required Fields.')

                console.log("Please Fill in all details!");
            } else {
                let currentStep = 2;

                document.getElementById(`step-${currentStep}`).style.display = 'none';
                currentStep++;
                document.getElementById(`step-${currentStep}`).style.display = 'block';
            }
        })

        // Previous Button for Step Two
        document.getElementById('previousSecondStep').addEventListener('click', function(e) {
            let currentStep = 2;

            document.getElementById(`step-${currentStep}`).style.display = 'none';
            currentStep--;
            document.getElementById(`step-${currentStep}`).style.display = 'block';
        })

        document.getElementById('signupForm').addEventListener('submit', function (e) {
            // Account Information
            // const firstName = document.getElementById('first_name').value.trim();
            // const lastName = document.getElementById('last_name').value.trim();
            // const email = document.getElementById('email').value.trim();
            // const phone = document.getElementById('phone').value.trim();
            // const userType = document.getElementById('user_type').value;
            // const specializationField = document.getElementById('specialization_field');
            // const specialization = document.getElementById('specialization').value.trim();
            // const password = document.getElementById('password').value;
            // const retypePassword = document.getElementById('retype_password').value;

            // Personal Information
            // const id = document.getElementById('id').value.trim();
            // const address = document.getElementById('address').value.trim();
            // const dob = document.getElementById('dob').value.trim();
            // const altEmail = document.getElementById('altEmail').value.trim();
            // const altPhone = document.getElementById('altPhone').value.trim();
            // const timeSliderWeekdays = document.getElementById('timeSliderWeekdays').value.trim();
            // const timeSliderWeekends = document.getElementById('timeSliderWeekends').value.trim();

            // Emergency Contact
            const salutationEmergencyContact = document.getElementById('salutationEmergencyContact').value.trim();
            const surnameEmergencyContact = document.getElementById('surnameEmergencyContact').value.trim();
            const middleNameEmergencyContact = document.getElementById('middleNameEmergencyContact').value.trim();
            const lastNameEmergencyContact = document.getElementById('lastNameEmergencyContact').value.trim();
            const phoneNumberEmergencyContact = document.getElementById('phoneNumberEmergencyContact').value.trim();
            const emailEmergencyContact = document.getElementById('emailEmergencyContact').value.trim();

            // Check if the Field's are filled
            // if (!firstName || !lastName || !email || !phone || !userType || !password || !address || !dob || !altEmail || !altPhone || !surnameEmergencyContact || !lastNameEmergencyContact || !phoneNumberEmergencyContact || !emailEmergencyContact) {
            //     e.preventDefault();
            //     toastr.warning('Please Fill All Required Fields.')
            // }

            // // Check if the Specialization has been Selected
            // if (userType === 'doctor' && !specialization) {
            //     e.preventDefault();
            //     toastr.warning('Specialization is Required for Doctors.');
            // }
            
            // // Check if the Passwords Match
            // if (password !== retypePassword) {
            //     e.preventDefault();
            //     toastr.error('Passwords do not Match.');
            // }
        });

        // Toggle specialization Field based on User Type
        function toggleSpecialization() {
            const userType = document.getElementById('user_type').value;
            const specializationField = document.getElementById('specialization_field');

            if (userType === 'doctor') {
                specializationField.style.display = 'block';
            } else {
                specializationField.style.display = 'none';
            }
        }

        // Check if Caps Lock is Turned On or Off
        let capsLockOn = false;

        passwordId.addEventListener("keyup", function(event) {
            const isCapsLockActive = event.getModifierState("CapsLock");

            if (isCapsLockActive && !capsLockOn) {
                toastr.info('Caps Lock has been turned on.');
            } else if (!isCapsLockActive && capsLockOn) {
                toastr.info('Caps Lock has been turned off.');
            }

            capsLockOn = isCapsLockActive;
        });

        retypePasswordId.addEventListener("keyup", function(event) {
            const isCapsLockActive = event.getModifierState("CapsLock");

            if (isCapsLockActive && !capsLockOn) {
                toastr.info('Caps Lock has been turned on.');
            } else if (!isCapsLockActive && capsLockOn) {
                toastr.info('Caps Lock has been turned off.');
            }

            capsLockOn = isCapsLockActive;
        });

        // Toggle Show Password
        const togglePassword = document.querySelector("#togglePassword");
        const toggleRetypedPassword = document.querySelector("#toggleRetypedPassword");

        togglePassword.addEventListener("click", function () {
            const type = passwordId.getAttribute("type") === "password" ? "text" : "password";
            passwordId.setAttribute("type", type);
            
            this.classList.toggle("bi-eye");
        });

        toggleRetypedPassword.addEventListener("click", function () {
            const type = retypePasswordId.getAttribute("type") === "password" ? "text" : "password";
            retypePasswordId.setAttribute("type", type);

            console.log(type);
            
            this.classList.toggle("bi-eye");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
