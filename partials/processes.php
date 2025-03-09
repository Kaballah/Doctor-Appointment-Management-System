<?php
// include 'connect.php';
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    header("Access-Control-Allow-Origin: *");

    session_start();
    require 'connect.php';
    date_default_timezone_set("Africa/Nairobi");

    if (isset($_POST['signup'])) {
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $primaryEmail = $_POST['email'];
        $primaryNumber = $_POST['phone'];
        $position = $_POST['user_type'];
        // echo "<script>console.log('Value of specialization from POST:', '" . $_POST['specialization'] . "');</script>";  // Commented out for production
        $specialization = isset($_POST['specialization']) ? $_POST['specialization'] : null; // Handle cases where specialization is not applicable
        $password = md5($_POST['password']);

        // echo "<script>console.log('Value of doctorId from POST:', '" . $_POST['doctorId'] . "');</script>";  // Commented out for production
        $doctorId = $_POST['doctorId'];
        // echo "<script>console.log('Value of salutation from POST:', '" . $_POST['salutationCreate a '] . "');</script>"; // Commented out for production
        $salutation = $_POST['salutation'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];
        $secondaryEmail = $_POST['altEmail'];
        $secondaryNumber = $_POST['altPhone'];
        $workingHoursWeekdays = $_POST['startTimeOnWeekdays'] . '-' . $_POST['endTimeOnWeekdays'];
        $workingHoursWeekends = $_POST['startTimeOnWeekends'] . '-' . $_POST['endTimeOnWeekends'];
        // $accountStatus = $_POST['accountStatus'];
        // $salary = $_POST['salary'];
        
        // Emergency Contact
        $salutationEmergencyContact = $_POST['salutationEmergencyContact'];
        $surnameEmergencyContact = $_POST['surnameEmergencyContact'];
        $middleNameEmergencyContact = $_POST['middleNameEmergencyContact'];
        $lastNameEmergencyContact = $_POST['lastNameEmergencyContact'];
        $phoneNumberEmergencyContact = $_POST['phoneNumberEmergencyContact'];
        $emailEmergencyContact = $_POST['emailEmergencyContact'];

        $ret = "SELECT primaryEmail FROM users WHERE primaryEmail=?";
        $stmt = $conn->prepare($ret);
        $stmt->bind_param("s", $primaryEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Check if emergency_contact table and columns exist with correct data types
            $check_table_query = "SHOW TABLES LIKE 'emergency_contact'";
            $check_table_result = $conn->query($check_table_query);

            if ($check_table_result->num_rows == 0) {
                echo "Error: The 'emergency_contact' table does not exist. Please execute the provided SQL to create the table.";
            } else {
                // Check emergency_contact_id column
                $check_column_query = "SHOW COLUMNS FROM emergency_contact LIKE 'emergency_contact_id'";
                $check_column_result = $conn->query($check_column_query);
                if ($check_column_result->num_rows == 0) {
                    echo "Error: The 'emergency_contact_id' column does not exist in the 'emergency_contact' table. Please execute the provided SQL.";
                } else {
                    $column_data = $check_column_result->fetch_assoc();
                    if (strpos($column_data['Type'], 'bigint') === false) {
                        echo "Error: The 'emergency_contact_id' column in the 'emergency_contact' table has the wrong data type. It should be BIGINT. Please execute the provided SQL.";
                    } else {
                        // Check users table columns
                        $required_columns = ['firstKinId', 'secondKinId', 'specialization', 'workingHoursWeekdays', 'workingHoursWeekends'];
                        $missing_columns = [];
                        foreach ($required_columns as $column) {
                            $check_user_column_query = "SHOW COLUMNS FROM users LIKE '$column'";
                            $check_user_column_result = $conn->query($check_user_column_query);
                            if ($check_user_column_result->num_rows == 0) {
                                $missing_columns[] = $column;
                            }
                        }

                        if (!empty($missing_columns)) {
                            echo "Error: The following columns are missing from the 'users' table: " . implode(', ', $missing_columns) . ". Please execute the provided SQL.";
                        } else {
                            // Generate emergency_contact_id (15 digits)
                            $emergency_contact_id = strval(mt_rand(100000000000000, 999999999999999));

                            // Insert into emergency_contact table
                            $sql_emergency = "INSERT INTO emergency_contact (emergency_contact_id, salutation, surname, middle_name, last_name, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt_emergency = $conn->prepare($sql_emergency);
                            $stmt_emergency->bind_param("sssssss",$emergency_contact_id, $salutationEmergencyContact, $surnameEmergencyContact, $middleNameEmergencyContact, $lastNameEmergencyContact, $phoneNumberEmergencyContact, $emailEmergencyContact);

                            if ($stmt_emergency->execute()) {
                                //$emergency_contact_id = $stmt_emergency->insert_id; // Get the auto-generated ID, no longer needed.

                                // Insert into users table
                                $sql_user = "INSERT INTO users (firstname, lastname, primaryEmail, primaryNumber, position, specialization, password, salutation, doctorId, address, dob, secondaryEmail, secondaryNumber, workingHoursWeekdays, workingHoursEndWeekdays, workingHoursWeekends, workingHoursEndWeekends, accountStatus, salary, firstKinId, secondKinId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt_user = $conn->prepare($sql_user);
                                $accountStatus = 'New';
                                $salary = '0';
                                $secondKinId = NULL; // Set secondKinId to NULL
            
                                $stmt_user->bind_param("sssssssissssssssssiis",
                                    $firstname,
                                    $lastname,
                                    $primaryEmail,
                                    $primaryNumber,
                                    $position,
                                    $specialization,
                                    $password,
                                    $salutation,
                                    $doctorId,
                                    $address,
                                    $dob,
                                    $secondaryEmail,
                                    $secondaryNumber,
                                    $startTimeOnWeekdays,
                                    $endTimeOnWeekdays,
                                    $startTimeOnWeekends,
                                    $endTimeOnWeekends,
                                    $accountStatus,
                                    $salary,
                                    $emergency_contact_id,
                                    $secondKinId
                                );
            
                                if ($stmt_user->execute()) {
                                    echo "<script>console.log('Data being saved to the database:', " . json_encode([
                                        'firstname' => $firstname,
                                        'lastname' => $lastname,
                                        'primaryEmail' => $primaryEmail,
                                        'primaryNumber' => $primaryNumber,
                                        'position' => $position,
                                        'specialization' => $specialization,
                                        'password' => '********', // Don't log the actual password
                                        'salutation' => $salutation,
                                        'doctorId' => $doctorId,
                                        'address' => $address,
                                        'dob' => $dob,
                                        'secondaryEmail' => $secondaryEmail,
                                        'secondaryNumber' => $secondaryNumber,
                                        'workingHoursWeekdays' => $startTimeOnWeekdays,
                                        'workingHoursEndWeekdays' => $endTimeOnWeekdays,
                                        'workingHoursWeekends' => $startTimeOnWeekends,
                                        'workingHoursEndWeekends' => $endTimeOnWeekends,
                                        'accountStatus' => $accountStatus,
                                        'salary' => $salary,
                                        'firstKinId' => $emergency_contact_id,
                                        'secondKinId' => $secondKinId
                                    ]) . ");</script>";
                                    $_SESSION["success"] = "User Added Successfully.";
                                    header("Location: ../auth/login.php");
                                } else { // Closing brace for if ($stmt_emergency->execute())
                                    echo "<script>alert('Something went wrong with user insertion. Please try again');</script>";
                                }
                            } else { // Closing brace for if ($stmt_emergency->execute())
                                echo "<script>alert('Something went wrong with emergency contact insertion. Please try again');</script>";
                            }
                        } // Closing brace for if (!empty($missing_columns))
                    } // Closing brace for if (strpos($column_data['Type'], 'bigint') === false)
                }
            }
        }
    } //Closing brace for if (isset($_POST['signup']))
    // Handle login
    elseif (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));
        
        // Check if user exists with email/username
        $sql = "SELECT doctorId, primaryEmail, position, password, firstname, lastname FROM users WHERE primaryEmail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();


                // Verify password
                if ($user['password'] === $password) {

                    // Check account status
                    if ($user['accountStatus'] === 'New') {
                        $_SESSION['error'] = "Your account is pending approval.";
                        header("Location: ../auth/login.php");
                        exit();
                    } elseif ($user['accountStatus'] === 'Inactive') {
                        $_SESSION['error'] = "Your account is inactive.";
                        header("Location: ../auth/login.php");
                        exit();
                    }
                    
                    $_SESSION['password'] = $user['password']; // Store the hashed password
                    $_SESSION['user_id'] = $user['doctorId'];
                    $_SESSION['email'] = $user['primaryEmail'];
                    $_SESSION['position'] = $user['position'];
                    $_SESSION['firstname'] = $user['firstname'];
                    $_SESSION['lastname'] = $user['lastname'];
                    $_SESSION['authenticated'] = true;

                    // Redirect based on user position
                    switch($_SESSION['position']) {
                        case 'admin':
                            header("Location: ../admin/dashboard.php");
                            break;
                        case 'doctor':
                            header("Location: ../doctor/dashboard.php");
                            break;
                        case 'receptionist':
                            header("Location: ../receptionist/dashboard.php");
                            break;
                        default:
                            header("Location: ../views/dashboard.php");
                    }
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid credentials";
                    header("Location: ../auth/login.php");
                    exit();
                }
        } else {
            $_SESSION['error'] = "User not found";
            header("Location: ../auth/login.php");
            exit();
        }
        $stmt->close();
    }
    elseif (isset($_POST['action']) && $_POST['action'] === 'unlock') {
        $password = md5(trim($_POST['password']));
        $userId = $_SESSION['user_id'];
        $userPosition = $_SESSION['position'];
        $storedPassword = $_SESSION['password']; // Retrieve stored password

        if ($password === $storedPassword) {
            // Redirect based on user position
            switch($userPosition) {
                case 'admin':
                    header("Location: ../admin/dashboard.php");
                    break;
                case 'doctor':
                    header("Location: ../doctor/dashboard.php");
                    break;
                case 'receptionist':
                    header("Location: ../receptionist/dashboard.php");
                    break;
                default:
                    header("Location: ../views/dashboard.php"); // Or some default page
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: ../auth/lockscreen.php");
            exit();
        }
    }
    elseif (isset($_POST['update_appointment'])) {
        $appointmentId = $_POST['appointmentId'];
        $firstNameEdit = $_POST['firstNameEdit'];
        $lastnameEdit = $_POST['lastnameEdit'];
        $emailEdit = $_POST['emailEdit'];
        $phoneNumberEdit = $_POST['phoneNumberEdit'];
        $dobEdit = $_POST['dobEdit'];
        $yobEdit = $_POST['yobEdit'];
        $visitForEdit = $_POST['visitForEdit'];
        $docAssignedEdit = $_POST['docAssignedEdit'];
        $dateOfAppointmentEdit = $_POST['dateOfAppointmentEdit'];
        $timeOfAppointmentEdit = $_POST['timeOfAppointmentEdit'];
        $statusEdit = $_POST['statusEdit'];
    
        $sql = "UPDATE appointments SET patientFirstName=?, patientLastName=?, patientEmail=?, phoneNumber=?, dob=?, yob=?, visitFor=?, doctorId=?, dateOfAppointment=?, timeOfAppointment=?, status=? WHERE appointmentId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisissss", $firstNameEdit, $lastnameEdit, $emailEdit, $phoneNumberEdit, $dobEdit, $yobEdit, $visitForEdit, $docAssignedEdit, $dateOfAppointmentEdit, $timeOfAppointmentEdit, $statusEdit, $appointmentId);
        header('Content-Type: application/json');
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
            // echo "<script>console.error('SQL Error: " . addslashes($stmt->error) . "');</script>"; //Commented out to ensure valid JSON response
        }
        $stmt->close();
    } elseif (isset($_POST['update_cancelled_appointment'])) {
        $appointmentId = $_POST['appointmentId'];
        $firstNameEdit = $_POST['firstName'];
        $lastnameEdit = $_POST['lastname'];
        $emailEdit = $_POST['email'];
        $phoneNumberEdit = $_POST['phoneNumber'];
        $dobEdit = $_POST['dob'];
        $yobEdit = $_POST['yob'];
        $visitForEdit = $_POST['visitFor'];
        $docAssignedEdit = $_POST['docAssigned'];
        $dateOfAppointmentEdit = $_POST['dateOfAppointment'];
        $timeOfAppointmentEdit = $_POST['timeOfAppointment'];
        $statusEdit = $_POST['status'];
    
        $sqlQuery = "UPDATE appointments SET patientFirstName=?, patientLastName=?, patientEmail=?, phoneNumber=?, dob=?, yob=?, visitFor=?, doctorId=?, dateOfAppointment=?, timeOfAppointment=?, status=? WHERE appointmentId=?";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bind_param("sssssisissss", $firstNameEdit, $lastnameEdit, $emailEdit, $phoneNumberEdit, $dobEdit, $yobEdit, $visitForEdit, $docAssignedEdit, $dateOfAppointmentEdit, $timeOfAppointmentEdit, $statusEdit, $appointmentId);
        header('Content-Type: application/json');
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'query' => $sqlQuery]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error, 'query' => $sqlQuery]);
        }
        $stmt->close();
    }

    elseif (isset($_POST['save_appointment'])) {
        $patientID = $_POST['patientID'];
        $firstName = $_POST['firstName'];
        $lastname = $_POST['lastname'];
        $email = $_POST['patientEmail'];
        $phoneNumber = $_POST['phoneNumber'];
        $dob = $_POST['dob'];
        $yob = $_POST[new Date(document.getElementById('dob').value).getFullYear()];
        $visitFor = $_POST['visitFor'];
        $docAssigned = $_POST['docAssigned'];
        $dateOfAppointment = $_POST['dateOfAppointment'];
        $timeOfAppointment = $_POST['timeOfAppointment'];
        $status = $_POST['status'];
        $dateCreated = $_POST['dateCreated'];
    
        $sql = "INSERT INTO appointments (appointmentId, patientFirstName, patientLastName, patientEmail, phoneNumber, dob, yob, visitFor, doctorId, dateOfAppointment, timeOfAppointment, status, dateCreated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $patientID, $firstName, $lastname, $email, $phoneNumber, $dob, $yob, $visitFor, $docAssigned, $dateOfAppointment, $timeOfAppointment, $status, $dateCreated);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    }
?>