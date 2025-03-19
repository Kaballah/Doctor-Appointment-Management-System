<?php
session_start();
include "connect.php";
include "../styles/styles.php";
?>

<link rel="stylesheet" href="../styles/sidenav.css">

<body class="hold-transition sidebar-mini layout-fixed">
    <link rel="stylesheet" href="../styles/styles.php">

    <aside class="main-sidebar sidebar-light-primary elevation-4">

        <!-- <div id="sidenavLoader" class="sidenav-loader sidebar">
            <div class="loader-user-panel user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="loader-avatar img-circle elevation-2"></div>
                <div class="loader-line loader-user-name info"></div>
            </div>

            <div class="loader-menu">
                <div class="loader-line loader-menu-item"></div>
                <div class="loader-line loader-menu-item"></div>
                <div class="loader-line loader-menu-item"></div>
                <div class="loader-line loader-menu-item"></div>
                <div class="loader-line loader-menu-item"></div>
                <div class="loader-line loader-menu-item"></div>
            </div>

            <div class="separator">
                <hr>
            </div>

            <div class="loader-line loader-menu-item"></div>
        </div> -->

        <div class="sidebar" id="sidenavContent">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../dist/img/avatar.png" class="img-circle elevation-2 avatar-image" alt="User Image">
                </div>

                <div class="info">
                    <?php
                    // Get logged in user's name from database
                    $userId = $_SESSION['user_id'];
                    $stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE doctorId = ?");
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    $fullName = htmlspecialchars($user['firstName'] . ' ' . $user['lastName']);
                    ?>
                    <a href="#" class="d-block username-text"><?php echo $fullName; ?></a>
                    <p class="usertype-text"><?php echo ucfirst($_SESSION['position']); ?></p>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <?php
                    $position = $_SESSION['position'];
                    $basePath = '../views/';
                    switch($position) {
                        case 'admin': $basePath = '../admin/'; break;
                        case 'doctor': $basePath = '../doctor/'; break;
                        case 'receptionist': $basePath = '../receptionist/'; break;
                    }
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo $basePath; ?>dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item <?php echo ($currentPage == 'new_appointments' || $currentPage == 'approved_appointments' || $currentPage == 'cancelled_appointments' || $currentPage == 'appointments' ) ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?php echo ($currentPage == 'new_appointments' || $currentPage == 'approved_appointments' || $currentPage == 'cancelled_appointments' || $currentPage == 'appointments' ) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Appointments
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>new_appointments.php" class="nav-link <?php echo ($currentPage == 'new_appointments') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-warning nav-icon"></i>
                                    <p>New</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>approved_appointments.php" class="nav-link <?php echo ($currentPage == 'approved_appointments') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-info nav-icon"></i>
                                    <p>Approved</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>cancelled_appointments.php" class="nav-link <?php echo ($currentPage == 'cancelled_appointments') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-danger nav-icon"></i>
                                    <p>Cancelled</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>appointments.php" class="nav-link <?php echo ($currentPage == 'appointments') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Appointments</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php if ($_SESSION['position'] === 'admin') : ?>
                    <li class="nav-item <?php echo ($currentPage == 'new_users' || $currentPage == 'active_users' || $currentPage == 'inactive_users' || $currentPage == 'users') ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?php echo ($currentPage == 'new_users' || $currentPage == 'active_users' || $currentPage == 'inactive_users') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>new_users.php" class="nav-link <?php echo ($currentPage == 'new_users') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-warning nav-icon"></i>
                                    <p>New</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>active_users.php" class="nav-link  <?php echo ($currentPage == 'active_users') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-info nav-icon"></i>
                                    <p>Active</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>inactive_users.php" class="nav-link <?php echo ($currentPage == 'inactive_users') ? 'active' : ''; ?>">
                                    <i class="far fa-circle text-danger nav-icon"></i>
                                    <p>Inactive</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo $basePath; ?>users.php" class="nav-link <?php echo ($currentPage == 'users') ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['position'] === 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?php echo $basePath; ?>specialization.php" class="nav-link <?php echo ($currentPage == 'specialization') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-plus-square"></i>
                            <p>Specialization</p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['position'] === 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?php echo $basePath; ?>user_types.php" class="nav-link <?php echo ($currentPage == 'user_types') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>User Types</p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a href="<?php echo $basePath; ?>reports.php" class="nav-link <?php echo ($currentPage == 'reports') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Reports</p>
                        </a>
                    </li>

                    <div class="separator">
                        <hr>
                    </div>

                    <li class="nav-item logout-container">
                        <a href="#" class="nav-link logout-btn" data-toggle="modal" data-target="#logoutModal">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Are you sure you want to log out?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Simulate loading process
        //     setTimeout(() => {
        //         const loader = document.getElementById("sidenavLoader");
        //         const content = document.getElementById("sidenavContent");

        //         // Hide loader and show sidebar content
        //         loader.classList.add("d-none");
        //         content.classList.remove("d-none");
        //     }, 2000); // Adjust loading duration
        // });

        // window.onload = function () {
        //     const loader = document.getElementById("sidenavLoader");
        //     const card = document.getElementById("sidenavContent");

        //     loader.classList.add("d-none");
        //     card.classList.remove("d-none");
        // };
    </script>

</body>