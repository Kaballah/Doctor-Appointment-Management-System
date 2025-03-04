<?php 
    $currentPage = 'reports';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $sql = "SELECT appointments.*, CONCAT(users.salutation, ' ', users.firstName, ' ', users.lastName) as doctorName FROM appointments LEFT JOIN users ON appointments.doctorId = users.doctorId WHERE appointments.doctorId = " . (int)$_SESSION['user_id'];

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

                            <!-- <a href="users_report.php">
                                <button id="switchButton" type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0; padding: .5rem; width: auto; height: max-content; margin-left: 1rem;">
                                    Switch to Staff
                                </button>
                            </a> -->
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
                        <div class="col-md-2">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" class="form-control" />
                        </div>

                        <div class="col-md-2">
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate" class="form-control" />
                        </div>

                        <div class="col-md-3">
                            <label for="columnsToSearch">Columns to Search:</label>
                            <select id="columnsToSearch" class="form-control">
                                <option value="all" selected>All Columns</option>
                                <option value="appointmentId">Appointment ID</option>
                                <option value="patientName">Patient's Name</option>
                                <option value="patientEmail">Patient's Email</option>
                                <option value="procedure">Procedure</option>
                                <option value="doctorName">Doctor Assigned</option>
                                <option value="dateCreated">Date Created</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="sortColumn">Sort Column:</label>
                            <select id="sortColumn" class="form-control">
                                <option value="appointmentId">Appointment ID</option>
                                <option value="patientName">Patient's Name</option>
                                <option value="patientEmail">Patient's Email</option>
                                <option value="procedure">Procedure</option>
                                <option value="doctorName">Doctor Assigned</option>
                                <option value="dateCreated">Date Created</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="sortOrder">Sort Order:</label>
                            <select id="sortOrder" class="form-control">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>

                        <button id="clearButton" type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0; padding: .5rem; width: auto; height: max-content; margin-top: 35px;">
                            Clear Filters
                        </button>
                    </div>

                    <div class="row mb-3" style="display: flex; justify-content: space-between;">
                        <div class="col-md-3">
                            <div class="custom-multiselect">
                                <label for="dropdownButton">Columns to Print:</label>
                                <button id="dropdownButton" class="dropdown-button">
                                    Select Columns
                                    <span id="selectedCount">(All Selected)</span>
                                </button>

                                <div id="dropdownOptions" class="dropdown-options">
                                    <label>
                                        <input type="checkbox" value="appointmentId" checked> Appointment ID
                                    </label>
                                    <label>
                                        <input type="checkbox" value="patientName" checked> Patient Name
                                    </label>
                                    <label>
                                        <input type="checkbox" value="patientEmail" checked> Patient Email
                                    </label>
                                    <label>
                                        <input type="checkbox" value="procedure" checked> Procedure
                                    </label>
                                    <label>
                                        <input type="checkbox" value="doctorName" checked> Doctor Name
                                    </label>
                                    <label>
                                        <input type="checkbox" value="dateCreated" checked> Date Created
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="printOptions">Print Options:</label>
                            <select id="printOptions" class="form-control">
                                <option value="select" disabled selected>Select Option</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                                <option value="print">Print</option>
                            </select>
                        </div>
                    </div>
                    
                    <table id="customTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Patient's Name</th>
                                <th>Patient's Email</th>
                                <th>Procedure</th>
                                <th>Doctor Assigned</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                  
                        <tbody class="">
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
                const startDateInput = document.getElementById("startDate");
                const endDateInput = document.getElementById("endDate");
                const sortColumn = document.getElementById("sortColumn");
                const sortOrder = document.getElementById("sortOrder");
                const columnsToSearch = document.getElementById("columnsToSearch");
                const clearButton = document.getElementById("clearButton");
                const pagination = document.getElementById("pagination");

                const dropdownButton = document.getElementById("dropdownButton");
                const dropdownOptions = document.getElementById("dropdownOptions");
                const selectedCount = document.getElementById("selectedCount");

                const columnNames = ["appointmentId", "patientName", "patientEmail", "procedure", "doctorName", "dateCreated"];
                // let selectedColumns = [];

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
                    // Update the selected columns based on checked checkboxes
                    // selectedColumns = Array.from(dropdownOptions.querySelectorAll("input:checked")).map(option => option.value);
                    updateTableColumns();
                });

                dropdownButton.addEventListener("click", () => {
                    dropdownOptions.classList.toggle("show");
                });

                document.addEventListener("click", (e) => {
                    if (!e.target.closest(".custom-multiselect")) {
                        dropdownOptions.classList.remove("show");
                    }
                });

                let currentPage = 1;
                let rowsPerPage = 10;

                function renderTable() {
                    tbody.innerHTML = "";

                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;

                    const filteredRows = rows.filter((row) => {
                        const selectedColumn = columnsToSearch.value;
                        const searchValue = tableSearch.value.toLowerCase();
                        const columnValue = selectedColumn === "all" ? row.textContent.toLowerCase() : getColumnValue(row, selectedColumn).toLowerCase();
                        const dateCell = row.cells[5]?.textContent.trim();
                        const rowDate = dateCell ? new Date(dateCell) : null;

                        const startDate = startDateInput.value ? new Date(startDateInput.value) : null;
                        const endDate = endDateInput.value ? new Date(endDateInput.value) : null;

                        const isWithinDateRange = (!startDate || rowDate >= startDate) && (!endDate || rowDate <= endDate);
                        const matchesSearch = columnValue.includes(searchValue);

                        return matchesSearch && isWithinDateRange;
                    });

                    const sortedRows = filteredRows.sort((a, b) => {
                        const col = sortColumn.value;
                        const order = sortOrder.value === "asc" ? 1 : -1;

                        const valA = getColumnValue(a, col).toLowerCase();
                        const valB = getColumnValue(b, col).toLowerCase();

                        if (col === "dateCreated") {
                            return order * (new Date(valA) - new Date(valB));
                        }

                        return order * valA.localeCompare(valB);
                    });

                    if (sortedRows.length === 0) {
                        const noMatchRow = document.createElement("tr");
                        const noMatchCell = document.createElement("td");

                        noMatchCell.setAttribute("colspan", "6");
                        noMatchCell.textContent = "No matches found";
                        noMatchCell.style.textAlign = "center";

                        noMatchRow.appendChild(noMatchCell);
                        tbody.appendChild(noMatchRow);
                    } else {
                        const paginatedRows = sortedRows.slice(start, end);

                        paginatedRows.forEach((row) => {
                            tbody.appendChild(row);
                        });
                    }

                    updateTableColumns();
                    renderPagination(sortedRows.length);
                }

                function getColumnValue(row, columnName) {
                    const columnIndex = {
                        appointmentId: 0,
                        patientName: 1,
                        patientEmail: 2,
                        procedure: 3,
                        doctorName: 4,
                        dateCreated: 5
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

                columnsToSearch.addEventListener("change", function () {
                    currentPage = 1;
                    renderTable();
                });

                startDateInput.addEventListener("change", function () {
                    const startDate = new Date(startDateInput.value);

                    if (startDateInput.value) {
                        endDateInput.min = startDateInput.value;
                    } else {
                        endDateInput.removeAttribute("min");
                    }

                    currentPage = 1;
                    renderTable();
                });

                endDateInput.addEventListener("change", function () {
                    const endDate = new Date(endDateInput.value);

                    if (endDateInput.value) {
                        startDateInput.max = endDateInput.value;
                    } else {
                        startDateInput.removeAttribute("max");
                    }

                    currentPage = 1;
                    renderTable();
                });

                sortColumn.addEventListener("change", function () {
                    currentPage = 1;
                    renderTable();
                });

                sortOrder.addEventListener("change", function () {
                    currentPage = 1;
                    renderTable();
                });

                dropdownOptions.addEventListener("change", updateTableColumns);

                clearButton.addEventListener("click", function () {
                    tableSearch.value = "";
                    startDateInput.value = "";
                    endDateInput.value = "";
                    columnsToSearch.value = "all";
                    sortColumn.value = "appointmentId";
                    sortOrder.value = "asc";
                    
                    const checkboxes = dropdownOptions.querySelectorAll("input[type='checkbox']");

                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = true;
                    });

                    selectedCount.textContent = "(All Selected)";

                    columnNames.forEach((_, index) => {
                        table.querySelectorAll(`th:nth-child(${index + 1})`).forEach(cell => {
                            cell.style.display = "";
                        });
                        table.querySelectorAll(`td:nth-child(${index + 1})`).forEach(cell => {
                            cell.style.display = "";
                        });
                    });

                    dropdownOptions.classList.remove("show");

                    currentPage = 1;
                    renderTable();
                });

                document.getElementById("printOptions").addEventListener("change", function () {
                    const selectedOption = this.value;
                    const table = document.getElementById("customTable");

                    if (selectedOption === "excel") {
                        exportToExcel(table);
                    } else if (selectedOption === "csv") {
                        exportToCSV(table);
                    } else if (selectedOption === "print") {
                        printTable(table);
                    }

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

                function exportToExcel(table) {
                    const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
                    XLSX.writeFile(wb, `appointment_data-${getCurrentDateTime()}.xlsx`);
                }

                function exportToCSV(table) {
                    let csv = [];
                    const rows = table.querySelectorAll("tr");

                    const watermark = `"","Halisi Family Hospital","","","",""`;
                    csv.unshift(watermark);

                    rows.forEach(row => {
                        const cols = row.querySelectorAll("td, th");
                        const rowData = Array.from(cols).map(col => col.textContent.trim());
                        csv.push(rowData.join(","));
                    });

                    const csvBlob = new Blob([csv.join("\n")], { type: "text/csv" });
                    const link = document.createElement("a");

                    link.href = URL.createObjectURL(csvBlob);
                    link.download = `appointment_data-${getCurrentDateTime()}.csv`;
                    link.click();
                }

                function printTable(table) {
                    const newWindow = window.open("", "", "width=800, height=600");

                    const copyrightHTML = `
                        <div style="position: absolute; bottom: 10px; left: 10px; font-size: 12px; font-style: italic;">
                            © ${new Date().getFullYear()} Halisi Family Hospital
                        </div>
                    `;
                    
                    newWindow.document.write(`
                        <html>
                            <head>
                                <title>Halisi Family Hospital Appointments</title>
                                <style>
                                    table { width: 100%; border-collapse: collapse; }
                                    table, th, td { border: 1px solid black; }
                                    th, td { padding: 8px; text-align: left; }
                                </style>
                            </head>
                            <body>
                                ${table.outerHTML}
                                ${copyrightHTML}
                            </body>
                        </html>
                    `);
                    newWindow.document.close();
                    newWindow.print();
                    newWindow.close();
                }

                updateTableColumns();
                renderTable();
            });
        </script>

        <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    </body>
</html>