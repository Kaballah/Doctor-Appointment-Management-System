<?php 
    $currentPage = 'user_types';
    require "../partials/sidenav.php";
    include '../partials/header.php';
    include '../partials/connect.php';
?>

<?php
    $recordsPerPage = 5;

    // Get the current page from the URL, default is 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    // Calculate the offset for the query
    $offset = ($page - 1) * $recordsPerPage;
    
    // Fetch the total number of records
    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM usertypes";
    $totalResult = $conn->query($totalRecordsQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalRecords = $totalRow['total'];
    
    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $sql = "SELECT userTypeId, userTypeName AS task, description, CONCAT(ROUND((total / (SELECT SUM(total) FROM usertypes)) * 100, 2), '%') AS progress, total FROM usertypes LIMIT $recordsPerPage OFFSET $offset";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>User Types | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
        <link rel="stylesheet" href="../styles/user_type.css">
    </head>

    <body>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>User Types</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">All User Types</li>
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

                    <div class="">
                        <div class="">
                            <div class="card-body">
                                <table id="userTypesTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Types</th>
                                            <th>Description</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Determine the progress bar and badge classes dynamically
                                                    $progressClass = "progress-bar ";
                                                    $badgeClass = "badge bg-";

                                                    $progressValue = (float) str_replace('%', '', $row['progress']);
                                                    if ($progressValue < 50) {
                                                        $progressClass .= "progress-bar-danger";
                                                        // $badgeClass .= "danger";
                                                    } elseif ($progressValue < 75) {
                                                        $progressClass .= "bg-warning";
                                                        // $badgeClass .= "warning";
                                                    } elseif ($progressValue < 90) {
                                                        $progressClass .= "bg-primary";
                                                        // $badgeClass .= "primary";
                                                    } else {
                                                        $progressClass .= "bg-success";
                                                        // $badgeClass .= "success";
                                                    }

                                                    echo '<tr>
                                                            <td>' . $row["userTypeId"] . '.</td>
                                                            <td>' . $row["task"] . '</td>
                                                            <td>' . $row["description"] . '</td>
                                                            <td>' . $row["total"] . ' (' . $row["progress"] . ')' . '</td>
                                                        </tr>';
                                                }
                                            } else {
                                                echo '<tr>
                                                        <td colspan="4">No records found.</td>
                                                    </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>

                                <hr>

                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <?php
                                            // Previous button
                                            if ($page > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';
                                            } else {
                                                echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                                            }

                                            // Page number links
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                if ($i == $page) {
                                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                                } else {
                                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                                }
                                            }

                                            // Next button
                                            if ($page < $totalPages) {
                                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
                                            } else {
                                                echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>
    </body>
</html>