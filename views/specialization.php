<?php 
    $currentPage = 'specialization';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $sql = "SELECT p.id, p.procedureName, p.dateCreated, p.status, p.description, GROUP_CONCAT(CONCAT(u.salutation, ' ', u.firstName, ' ', u.lastName) SEPARATOR ', ') AS doctorName FROM procedures p LEFT JOIN procedure_doctor pd ON p.id = pd.procedure_Id LEFT JOIN users u ON pd.doctor_Id = u.doctorId GROUP BY p.id";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Specialization | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/specialization.css">
    </head>

    <body>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Specialization</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Specialization</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div id="skeletonLoader" class="skeleton-loader">
                        <div class="skeleton skeleton-text"></div>
                        <div class="skeleton skeleton-text"></div>
                        <div class="skeleton skeleton-text"></div>
                        <div class="skeleton skeleton-text"></div>
                        <div class="skeleton skeleton-text"></div>
                    </div>

                    <div class="card d-none" id="card">
                        <div class="card-header">
                            <!-- <h2 class="card-title" style="font-size: 1.5em">Procedures</h2> -->

                            <div class="card-tools mb-3">
                                <a href="#" class="float-left">
                                    <button type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0; padding: .5rem;">Add Procedure</button>
                                </a>
                            </div>

                            <div class="table-controls mb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="length-change">
                                        <label for="lengthChange" class="mr-2" style="width: auto; display: none;">Show:</label>
                                        <select id="lengthChange" class="form-control form-control-sm" style="width: auto; display: none;">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20" selected>20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    
                                    <div class="search-box">
                                        <input type="text" id="tableSearch" class="form-control form-control-sm" style="width: auto; display: inline-block;" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="customTable" border="1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Procedure</th>
                                        <th>Date Created</th>
                                        <th>Doctors Assigned</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        if ($result->num_rows > 0) {
                                            // Output data for each row
                                            while($row = $result->fetch_assoc()) {
                                                $statusClass = "";

                                                switch($row["status"]) {
                                                    case 'Available':
                                                        $statusClass = "badge-success";
                                                        break;
                                                    case 'Discontinued':
                                                        $statusClass = "badge-danger";
                                                        break;
                                                    case 'Paused':
                                                        $statusClass = "badge-warning";
                                                        break;
                                                }

                                                echo '<tr data-widget="expandable-table" aria-expanded="false">
                                                        <td>' . $row["id"] . '</td>
                                                        <td>' . $row["procedureName"] . '</td>
                                                        <td>' . $row["dateCreated"] . '</td>
                                                        <td>' . $row["doctorName"] . '</td>
                                                        <td><span class="badge ' . $statusClass . '">' . $row["status"] . '</span></td>
                                                        <td><button type="button" class="btn-sm btn-block bg-gradient-primary" style="border: 0;">Edit</button></td>
                                                      </tr>';
                                        
                                                echo '<tr class="expandable-body">
                                                        <td colspan="6">
                                                            <p>' . $row["description"] . '</p>
                                                        </td>
                                                      </tr>';
                                            }
                                        } else {
                                            echo "N0 matching results";
                                        }
                                        
                                        $conn->close();                                        
                                    ?>
                                </tbody>
                            </table>

                            <div id="pagination" class="d-flex justify-content-center mt-3"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const table = document.getElementById("customTable");
                const tbody = table.querySelector("tbody");
                const rows = Array.from(tbody.querySelectorAll("tr"));
                const tableSearch = document.getElementById("tableSearch");
                const pagination = document.getElementById("pagination");

                let currentPage = 1;
                let rowsPerPage = 20;

                function renderTable() {
                    tbody.innerHTML = "";
                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;

                    const filteredRows = rows.filter((row) => {
                        const text = row.textContent.toLowerCase();
                        const searchValue = tableSearch.value.toLowerCase();
                        return text.includes(searchValue);
                    });

                    tbody.innerHTML = "";

                    if (filteredRows.length === 0) {
                        // If no matches found, display a "No matches found" message
                        const noMatchRow = document.createElement("tr");
                        const noMatchCell = document.createElement("td");

                        noMatchCell.setAttribute("colspan", "6"); // Adjust the colspan to match your table columns
                        noMatchCell.textContent = "No matches found";
                        noMatchCell.style.textAlign = "center"; // Optional: center-align the message

                        noMatchRow.appendChild(noMatchCell);
                        tbody.appendChild(noMatchRow);
                    } else {
                        // Append the filtered rows to the table
                        filteredRows.forEach((row) => {
                            tbody.appendChild(row);
                        });
                    }

                    const paginatedRows = filteredRows.slice(start, end);

                    paginatedRows.forEach((row) => {
                        tbody.appendChild(row);
                    });

                    renderPagination(filteredRows.length);
                }

                // function renderPagination(totalRows) {
                //     pagination.innerHTML = "";
                //     const totalPages = Math.ceil(totalRows / rowsPerPage);

                //     for (let i = 1; i <= totalPages; i++) {
                //         const pageLink = document.createElement("button");
                //         pageLink.textContent = i;
                //         pageLink.className = i === currentPage ? "active" : "";
                //         pageLink.addEventListener("click", () => {
                //             currentPage = i;
                //             renderTable();
                //         });
                //         pagination.appendChild(pageLink);
                //     }
                // }
                
                tableSearch.addEventListener("input", function () {
                    currentPage = 1;
                    renderTable();
                });

                renderTable();
            });
        </script>
    </body>
</html>