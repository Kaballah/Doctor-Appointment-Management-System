<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <?php
        if(isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Halisi Family Hospital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <?php include '../styles/styles.php'?>

    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="login-container">
        <i class="far fa-hospital logo"></i>
        <h2>Halisi Doctor Appointment System</h2>

        <div class="separator">
            <hr>
        </div>

        <form action="../partials/processes.php" method="POST" id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username or Email</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <input type="hidden" name="action" value="login">
                <a href="signup.php" class="btn btn-secondary">Sign up</a>
            </div>
            <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
        </form>
    </div>

    <?php include '../js/scripts.php' ?>

    <script>
        // Show error notification after page loads
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(isset($error)): ?>
                var errorMessage = '<?php echo htmlspecialchars($error, ENT_QUOTES); ?>';
                if (errorMessage.includes("pending approval")) {
                    toastr.warning(errorMessage);
                } else {
                    toastr.error(errorMessage);
                }
            <?php endif; ?>
        });

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!username || !password) {
                e.preventDefault();
                toastr.warning('Please Fill both Fields.');
            }
        });
    </script>
</body>
</html>
