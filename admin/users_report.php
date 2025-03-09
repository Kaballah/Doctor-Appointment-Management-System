<?php 
    $currentPage = 'reports';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $sql = "SELECT doctorId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS DoctorName, position AS Position, address AS Address, primaryEmail AS DoctorEmail, primaryNumber AS DoctorPhoneNumber, accountStatus AS Status, salutation AS Salutation, dob AS DateOfBirth, secondaryNumber AS SecondaryPhoneNumber, secondaryEmail AS SecondaryEmail, specialization AS Specialization, workingHoursWeekdays AS WeekdayHours, workingHoursWeekends AS WeekendHours, salary AS Salary FROM users";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Reports | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>

        <link rel="stylesheet" href="../styles/reports.css">
    </head>

    <body>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6" style="display: flex;">
                            <h1>Generate Reports</h1>

                            <a href="reports.php">
                                <button id="switchButton" type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0; padding: .5rem; width: auto; height: max-content; margin-left: 1rem;">
                                    Switch to Appointments
                                </button>
                            </a>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Reports</li>
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

            <div class="card d-none" id="card">
                <div class="card-body">

                    <div class="row justify-content-center mb-3">
                        <input type="text" id="tableSearch" class="form-control" placeholder="Search Table..." />
                    </div>

                    <div class="row mb-3" style="display: flex; justify-content: space-between;">
                        <div class="col-md-3">
                            <div class="custom-multiselect-display">
                                <label for="dropdownButton">Columns to Display:</label>
                                <button id="dropdownButton" class="dropdown-button">
                                    Select Columns
                                    <span id="selectedCount">(All Selected)</span>
                                </button>

                                <div id="dropdownOptions" class="dropdown-options">
                                    <label>
                                        <input type="checkbox" value="doctorId" checked> Doctor ID
                                    </label>
                                    <label>
                                        <input type="checkbox" value="doctorName" checked> Doctor Name
                                    </label>
                                    <label>
                                        <input type="checkbox" value="position" checked> Position
                                    </label>
                                    <label>
                                        <input type="checkbox" value="address" checked> Address
                                    </label>
                                    <label>
                                        <input type="checkbox" value="email" checked> Email
                                    </label>
                                    <label>
                                        <input type="checkbox" value="phoneNumber" checked> Phone Number
                                    </label>
                                    <label>
                                        <input type="checkbox" value="status" checked> Status
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="custom-multiselect-print">
                                <label for="dropdownButtonPrint">Columns to Print:</label>
                                <button id="dropdownButtonPrint" class="dropdown-button">
                                    Select Columns
                                    <span id="selectedCount">(All Selected)</span>
                                </button>

                                <div id="dropdownPrintOptions" class="dropdown-options">
                                    <label><input type="checkbox" value="doctorId" data-index="0" checked> Doctor ID</label>
                                    <label><input type="checkbox" value="doctorName" data-index="1" checked> Doctor Name</label>
                                    <label><input type="checkbox" value="position" data-index="2" checked> Position</label>
                                    <label><input type="checkbox" value="address" data-index="3" checked> Address</label>
                                    <label><input type="checkbox" value="email" data-index="4" checked> Email</label>
                                    <label><input type="checkbox" value="phoneNumber" data-index="5" checked> Phone Number</label>
                                    <label><input type="checkbox" value="dob" data-index="7" checked> Date of Birth</label>
                                    <label><input type="checkbox" value="salutation" data-index="8" checked> Salutation</label>
                                    <label><input type="checkbox" value="specialization" data-index="9" checked> Specialization</label>
                                    <label><input type="checkbox" value="secondaryEmail" data-index="10" checked> Secondary Email</label>
                                    <label><input type="checkbox" value="secondaryPhone" data-index="11" checked> Secondary Phone Number</label>
                                    <label><input type="checkbox" value="workingHoursWeekdays" data-index="12" checked> Working Hours (Weekdays)</label>
                                    <label><input type="checkbox" value="workingHoursWeekend" data-index="13" checked> Working Hours (Weekend)</label>
                                    <label><input type="checkbox" value="status" data-index="6" checked> Account Status</label>
                                    <label><input type="checkbox" value="salary" data-index="14" checked> Salary</label>
                                    <label><input type="checkbox" value="nextOfKin1" data-index="15" disabled> Next of Kin 1</label>
                                    <label><input type="checkbox" value="nextOfKin2" data-index="16" disabled> Next of Kin 2</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button id="printOptions" type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0; padding: .5rem; width: auto; height: max-content; margin-top: 35px;">
                                Print
                            </button>
                        </div>
                    </div>
                    
                    <table id="customTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Doctor ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr style='cursor: pointer;'>";
                                        echo "<td><input type='checkbox' class='select-user' data-id='{$row["ID"]}' data-name='{$row["DoctorName"]}' data-position='{$row["Position"]}' data-address='{$row["Address"]}' data-email='{$row["DoctorEmail"]}' data-phone='{$row["DoctorPhoneNumber"]}' data-status='{$row["Status"]}' data-salutation='{$row["Salutation"]}' data-specialization='{$row["Specialization"]}' data-weekday-hours='{$row["WeekdayHours"]}' data-weekend-hours='{$row["WeekendHours"]}' data-dob='{$row["DateOfBirth"]}' data-secondary-phone='{$row["SecondaryPhoneNumber"]}' data-secondary-email='{$row["SecondaryEmail"]}' data-salary='{$row["Salary"]}'></td>";
                                        echo "<td>" . $row["ID"] . "</td>";
                                        echo "<td>" . $row["DoctorName"] . "</td>";
                                        echo "<td>" . $row["Position"] . "</td>";
                                        echo "<td>" . $row["Address"] . "</td>";
                                        echo "<td>" . $row["DoctorEmail"] . "</td>";
                                        echo "<td>" . $row["DoctorPhoneNumber"] . "</td>";
                                        echo "<td>" . $row["Status"] . "</td>";

                                        echo "<td style='display: none;'>" . $row["Salutation"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["Specialization"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["WeekdayHours"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["WeekendHours"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["DateOfBirth"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["SecondaryPhoneNumber"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["SecondaryEmail"] . "</td>";
                                        echo "<td style='display: none;'>" . $row["Salary"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No records found</td></tr>";
                                }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>


                    <div id="pagination" class="d-flex mt-3"></div>
                </div>
            </div>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>

        <script>
            $(document).ready(function () {
                const table = document.getElementById("customTable");
                const tbody = table.querySelector("tbody");
                const rows = Array.from(tbody.querySelectorAll("tr"));
                const tableSearch = document.getElementById("tableSearch");
                const pagination = document.getElementById("pagination");

                const dropdownButton = document.getElementById("dropdownButton");
                const dropdownButtonPrint = document.getElementById("dropdownButtonPrint");
                const dropdownOptions = document.getElementById("dropdownOptions");
                const dropdownPrintOptions = document.getElementById("dropdownPrintOptions");
                const selectedCount = document.getElementById("selectedCount");

                const columnNames = ["doctorId", "doctorName", "position", "address", "email", "phoneNumber",  "status"];

                function updateTableColumns() {
                    const selectedColumns = Array.from(dropdownOptions.querySelectorAll("input:checked")).map(option => option.value);

                    columnNames.forEach((colName, index) => {
                        const show = selectedColumns.includes(colName);
                        
                        table.querySelectorAll(`th:nth-child(${index + 1})`).forEach(cell => {
                            cell.style.display = show ? "" : "none";
                        });
                        
                        table.querySelectorAll(`td:nth-child(${index + 1})`).forEach(cell => {
                            cell.style.display = show ? "" : "none";
                        });
                    });

                    selectedCount.textContent = selectedColumns.length === columnNames.length ? "(All Selected)" : `(${selectedColumns.length} Selected)`;
                }

                dropdownOptions.addEventListener("change", () => {
                    updateTableColumns();
                });

                dropdownButton.addEventListener("click", () => {
                    dropdownOptions.classList.toggle("show");
                });

                dropdownButtonPrint.addEventListener("click", () => {
                    dropdownPrintOptions.classList.toggle("show");
                });

                document.addEventListener("click", (e) => {
                    if (!e.target.closest(".custom-multiselect-display")) {
                        dropdownOptions.classList.remove("show");
                    }
                });

                document.addEventListener("click", (e) => {
                    if(!e.target.closest(".custom-multiselect-print")) {
                        dropdownPrintOptions.classList.remove("show");
                    }
                })

                // Synchronize Print Dropdown with Display Dropdown
                // document.querySelectorAll("#dropdownOptions input").forEach(displayInput => {
                //     displayInput.addEventListener("change", () => {
                //         const value = displayInput.value;
                //         const printInput = document.querySelector(`#printOptions input[value='${value}']`);
                //         if (printInput) {
                //             printInput.checked = displayInput.checked;
                //         }

                //         console.log("Display Changed:", displayInput.value, displayInput.checked);
                //         console.log("Syncing with Print:", value, printInput ? printInput.checked : "Not Found");
                //     });
                // });

                document.querySelectorAll("#dropdownOptions input").forEach(displayInput => {
                    displayInput.addEventListener("change", () => {
                        const value = displayInput.value;
                        const printInput = document.querySelector(`#dropdownPrintOptions input[value="${value}"]`);
                        console.log("Value:", value); // Log the value from the display dropdown
                        console.log("Print Input:", printInput); // Check if the corresponding input is found
                        if (printInput) {
                            printInput.checked = displayInput.checked; // Sync the state
                            console.log("Synced:", printInput.checked);
                        } else {
                            console.error("No matching print input found for value:", value);
                        }
                    });
                });


                // Handle Row Selection
                document.querySelectorAll("#customTable tbody tr").forEach(row => {
                    row.addEventListener("click", () => {
                        // Mark the row as selected
                        document.querySelectorAll("#customTable tbody tr").forEach(r => r.classList.remove("selected"));
                        row.classList.add("selected");

                        // Fetch firstKinId and secondKinId for the selected record
                        const firstKinId = row.getAttribute("data-firstKinId");
                        const secondKinId = row.getAttribute("data-secondKinId");

                        // Enable or disable Next of Kin options in the print dropdown
                        const nextOfKin1Checkbox = document.querySelector("#printOptions input[value='nextOfKin1']");
                        const nextOfKin2Checkbox = document.querySelector("#printOptions input[value='nextOfKin2']");

                        if (firstKinId) {
                            nextOfKin1Checkbox.disabled = false;
                        } else {
                            nextOfKin1Checkbox.disabled = true;
                            nextOfKin1Checkbox.checked = false;
                        }

                        if (secondKinId) {
                            nextOfKin2Checkbox.disabled = false;
                        } else {
                            nextOfKin2Checkbox.disabled = true;
                            nextOfKin2Checkbox.checked = false;
                        }

                        // Enable the Print Columns dropdown
                        document.getElementById("printOptions").removeAttribute("disabled");
                    });
                });

                let currentPage = 1;
                let rowsPerPage = 10;

                function renderTable() {
                    tbody.innerHTML = "";

                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    const searchValue = tableSearch.value.toLowerCase();
                    const filteredRows = rows.filter((row) => row.textContent.toLowerCase().includes(searchValue));

                    if (filteredRows.length === 0) {
                        const noMatchRow = document.createElement("tr");
                        const noMatchCell = document.createElement("td");

                        noMatchCell.setAttribute("colspan", "7");
                        noMatchCell.textContent = "No matches found";
                        noMatchCell.style.textAlign = "center";

                        noMatchRow.appendChild(noMatchCell);
                        tbody.appendChild(noMatchRow);
                    } else {
                        const paginatedRows = filteredRows.slice(start, end);

                        paginatedRows.forEach((row) => {
                            tbody.appendChild(row);
                        });
                    }

                    updateTableColumns();
                    renderPagination(filteredRows.length);
                }

                function getColumnValue(row, columnName) {
                    const columnIndex = {
                        appointmentId: 0,
                        doctorName: 1,
                        position: 2,
                        address: 3,
                        email: 4,
                        number: 5,
                        status: 6
                    };
                    return row.children[columnIndex[columnName]].textContent.trim();
                }

                function renderPagination(totalRows) {
                    pagination.innerHTML = "";

                    const totalPages = Math.ceil(totalRows / rowsPerPage);

                    for (let i = 1; i <= totalPages; i++) {
                        const pageLink = document.createElement("button");
                        pageLink.textContent = i;
                        pageLink.className = i === currentPage ? "active" : "";
                        pageLink.addEventListener("click", () => {
                            currentPage = i;
                            renderTable();
                        });
                        pagination.appendChild(pageLink);
                    }
                }

                tableSearch.addEventListener("input", function () {
                    currentPage = 1;
                    renderTable();
                });

                dropdownOptions.addEventListener("change", updateTableColumns);

                document.getElementById("printOptions").addEventListener("click", function () {
                    const selectedOption = this.value;
                    const table = document.getElementById("customTable");

                    printForm();

                    this.value = "select";
                });

                function getCurrentDateTime() {
                    const now = new Date();
                    const dd = String(now.getDate()).padStart(2, "0");
                    const mm = String(now.getMonth() + 1).padStart(2, "0");
                    const yyyy = now.getFullYear();
                    const hh = String(now.getHours()).padStart(2, "0");
                    const min = String(now.getMinutes()).padStart(2, "0");
                    const ss = String(now.getSeconds()).padStart(2, "0");

                    return `${dd}_${mm}_${yyyy}_${hh}_${min}_${ss}`;
                }

                function printCurrentDateTime() {
                    const now = new Date();
                    const dd = String(now.getDate()).padStart(2, "0");
                    const mm = String(now.getMonth() + 1).padStart(2, "0");
                    const yyyy = now.getFullYear();
                    const hh = String(now.getHours()).padStart(2, "0");
                    const min = String(now.getMinutes()).padStart(2, "0");
                    const ss = String(now.getSeconds()).padStart(2, "0");

                    return `${dd}/${mm}/${yyyy} ${hh}:${min}:${ss}`;
                }

                function printForm() {
                    const table = document.getElementById("customTable");
                    const selectedRow = table.querySelector("tbody tr.selected");

                    if (!selectedRow) {
                        toastr.error('Please Select a User Before Proceeding.')

                        return;
                    }

                    const selectedColumns = Array.from(document.querySelectorAll("#dropdownPrintOptions input:checked")).map(option => parseInt(option.getAttribute("data-index")));

                    // Map all doctor data from the selected row
                    const doctorData = Array.from(selectedRow.children).map((cell, index) => {
                        return selectedColumns.includes(index) ? cell.textContent : '***';
                    });

                    const formHTML = `
                        <html>
                            <head>
                                <title>Doctor Information</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        margin: 20px;
                                    }
                                    .container {
                                        max-width: 800px;
                                        margin: 0 auto;
                                    }
                                    h1, h2 {
                                        text-align: center;
                                        color: #004581;
                                    }
                                    .form-section {
                                        border: 1px solid #ccc;
                                        padding: 20px;
                                        margin-bottom: 20px;
                                        border-radius: 8px;
                                        background: #f9f9f9;
                                    }
                                    .form-section label {
                                        font-weight: bold;
                                    }
                                    .form-section div {
                                        margin-bottom: 10px;
                                    }
                                    .table-container {
                                        margin-top: 20px;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                    }
                                    table th, table td {
                                        border: 1px solid #ccc;
                                        padding: 8px;
                                        text-align: left;
                                    }
                                    table th {
                                        background-color: #004581;
                                        color: white;
                                    }
                                    .footer {
                                        text-align: center;
                                        margin-top: 30px;
                                        font-size: 14px;
                                        color: #666;
                                    }
                                </style>
                            </head>

                            <body>
                                <div class="container">
                                    <h1>Halisi Family Hospital</h1>
                                    <h2>Staff Information</h2>

                                    <div class="form-section">
                                        <h3>Personal Details for User ${doctorData[0]}</h3>

                                        <hr>
                                        <br>

                                        <table style="border-style: dotted;">
                                            <tr>
                                                <td>
                                                    <label for="salutation">Salutation:</label>
                                                    <span id="salutation">${doctorData[7]}</span>
                                                </td>
                                                <td>
                                                    <label for="name">Name:</label>
                                                    <span id="name">${doctorData[1]}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="position">Position:</label>
                                                    <span id="position">${doctorData[2]}</span>
                                                </td>
                                                <td>
                                                    <label for="specialization">Specialization:</label>
                                                    <span id="specialization">${doctorData[8]}</span>
                                                </td>
                                            </tr>
                
                                            <tr>
                                                <td>
                                                    <label for="dob">Date of Birth:</label>
                                                    <span id="dob">${doctorData[11]}</span>
                                                </td>
                                                <td>
                                                    <label for="address">Address:</label>
                                                    <span id="address">${doctorData[3]}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="email">Primary Email:</label>
                                                    <span id="email">${doctorData[4]}</span>
                                                </td>
                                                <td>
                                                    <label for="number">Primary Number:</label>
                                                    <span id="number">${doctorData[5]}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="secondaryNumber">Secondary Number:</label>
                                                    <span id="secondaryNumber">${doctorData[12]}</span>
                                                </td>
                                                <td>
                                                    <label for="secondaryEmail">Secondary Email:</label>
                                                    <span id="secondaryEmail">${doctorData[13]}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="workingHoursWeekdays">Working Hours (Weekdays):</label>
                                                    <span id="workingHoursWeekdays">${doctorData[9]}</span>
                                                </td>
                                                <td>
                                                    <label for="workingHoursWeekends">Working Hours (Weekends):</label>
                                                <span id="workingHoursWeekends">${doctorData[10]}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="status">Account Status:</label>
                                                    <span id="status">${doctorData[6]}</span>
                                                </td>
                                                <td>
                                                    <label for="salary">Salary:</label>
                                                    <span id="salary">${doctorData[14]}</span>
                                                </td>
                                            </tr>
                                        </table>

                                        <br>
                                        <hr>
                                        
                                        <div class="footer">
                                            <p>Generated on ${printCurrentDateTime()}</p>
                                        </div>
                                    </div>
                                </div>
                            </body>
                        </html>
                    `;

                    const newWindow = window.open("", "", "width=800, height=600");
                    newWindow.document.write(formHTML);
                    newWindow.document.close();
                    newWindow.print();
                    newWindow.close();
                }

                document.getElementById("customTable").addEventListener("click", function (e) {
                    const rows = this.querySelectorAll("tbody tr");
                    const clickedRow = e.target.closest("tr");

                    rows.forEach(row => {
                        row.classList.remove("selected");
                        row.style.backgroundColor = "";
                    });

                    if (clickedRow) {
                        clickedRow.classList.add("selected");
                        clickedRow.style.backgroundColor = "#D3D3D3";
                    }
                });

                updateTableColumns();
                renderTable();
            });
        </script>
    </body>
</html>