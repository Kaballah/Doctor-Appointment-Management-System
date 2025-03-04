<?php session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Fetch user details from the session
$userName = htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']);
$userImage = "../dist/img/user1-128x128.jpg";

// echo "Session Variables: <pre>";
// print_r($_SESSION);
// echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lockscreen | Halisi Family Hospital</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../dist/css/adminlte.min.css"> -->
        <?php include '../styles/styles.php'?>

        <link rel="stylesheet" href="../styles/lockscreen.css">
    </head>

    <body class="hold-transition lockscreen">
        <!--  The skeleton loader is removed for now, as it's not relevant with dynamic content -->

        <div class="lockscreen-container">
            <i class="far fa-hospital logo"></i>
            <h2 href="login.php">Halisi Doctor <br> Appointment System</h2>

            <div class="separator">
                <hr>
            </div>

            <div class="lockscreen-name"><?php echo htmlspecialchars($userName); ?></div>

            <div class="lockscreen-item">
                <div class="lockscreen-image">
                    <img src="<?php echo htmlspecialchars($userImage); ?>" alt="User Image">
                </div>

                <form class="lockscreen-credentials" action="../partials/processes.php" method="POST">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="password" name="password" required>
                        <input type="hidden" name="action" value="unlock">
                        <div class="input-group-append">
                            <button type="submit" class="btn" name="unlock">
                                <i class="fas fa-arrow-right text-muted"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="help-block text-center">
                Enter your password to retrieve your session
            </div>

            <div class="text-center">
                <a href="login.php">Or sign in as a different user</a>
            </div>

            <div class="separator">
                <hr>
            </div>

            <div class="lockscreen-footer text-center">
                Copyright &copy; 2025
                <b>
                    <a href="login.php" class="text-black">Halisi Family Hospital</a>
                </b>
                
                <br>
                All rights reserved
            </div>
        </div>

        <?php include '../js/scripts.php' ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if(isset($error)): ?>
                    toastr.error('<?php echo htmlspecialchars($error, ENT_QUOTES); ?>');
                <?php endif; ?>
            });
        </script>

    </body>
</html>
