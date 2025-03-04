<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Status</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="new-user" class="hidden">
            <h1>Account Pending</h1>
            <p>Your account is currently pending approval. Please wait for an administrator to activate your account.</p>
        </div>

        <div id="inactive-user" class="hidden">
            <h1>Account Inactive</h1>
            <p>Your account is currently inactive. Please contact an administrator to reactivate your account.</p>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'new') {
            document.getElementById('new-user').classList.remove('hidden');
        } else if (status === 'inactive') {
            document.getElementById('inactive-user').classList.remove('hidden');
        } else {
          // Optional:  Redirect or show a default message if no status or an invalid status is provided.
          window.location.href = "../auth/login.php"; // Redirect to the login page.
        }
    </script>
</body>
</html>