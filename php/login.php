<?php

session_start();

$_SESSION["id"] = "logg";

if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Securely get database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ims";
    $portname = "3306";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname, $portname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize entered data
    $userName = htmlspecialchars(trim($_POST['username']));
    $userPassword = htmlspecialchars(trim($_POST['password']));

    // Server-side validation
    if (empty($userName) || empty($userPassword)) {
        $error = "Username and password are required.";
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT userID, password FROM user WHERE userName = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with the entered username exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($userPassword, $hashed_password)) {
                // Password is correct, start a session and regenerate session ID
                $_SESSION['user_id'] = $id;
                        // Redirect to Dashboard
                header("Location: dd.php");
                exit(); // Make sure to exit after redirecting
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/login.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loginForm').addEventListener('submit', function (event) {
                var username = document.getElementById('username').value.trim();
                var password = document.getElementById('password').value.trim();
                var errorMessages = [];

                // Client-side validation
                if (username === "") {
                    errorMessages.push("Username is required.");
                }

                if (password === "") {
                    errorMessages.push("Password is required.");
                }

                // Display errors if there are any
                if (errorMessages.length > 0) {
                    alert(errorMessages.join("\n"));
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</head>

<body>
    <!-- Login Form -->
    <div class="login-container">
        <h2 style="color: black">Login</h2>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form id="loginForm" action="login.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="input-group">
                <input type="text" id="username" placeholder="Username" name="username" required>
            </div>

            <div class="input-group">
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="signupButton-container">
            <h4>Don't have an account?</h4>
            <a href="../php/signup.php">
                <button type="button" id="signupButton">Sign up</button>
            </a>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
