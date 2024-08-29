<?php
// Database configuration
$servername = "inventsys-svr.mysql.database.azure.com";
$username = "qcsvrzgcic";
$password = "r00t@azure";
$dbname = "ims";
$portname = "3306";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname, $portname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors = []; // Array to store validation errors

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    // Collect form data
    $userName = htmlspecialchars(trim($_POST['username']));
    $userEmail = htmlspecialchars(trim($_POST['email']));
    $userTelNo = htmlspecialchars(trim($_POST['telephone']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Input validation
    if (!preg_match('/^[a-zA-Z0-9]+$/', $userName)) {
        $errors[] = "Username should not contain symbols!";
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address!";
    }

    if (!preg_match('/^\d{10}$/', $userTelNo)) {
        $errors[] = "Telephone number should contain exactly 10 digits!";
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $password)) {
        $errors[] = "Password must be at least 8 characters long and include lowercase, uppercase, numbers, and symbols!";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match!";
    }

    if (!$terms) {
        $errors[] = "You must accept the Terms of Use & Privacy Policy.";
    }

    // If there are no errors, proceed with storing the data
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (userName, userEmail, userTelNo, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $userName, $userEmail, $userTelNo, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to the login page after successful signup
            header("Location: ../php/login.php");
            exit(); // Ensure the script stops executing after the redirect
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Inventory Management System</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>

<body>
    <div class="blur-overlay"></div>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Sign Up</h2>
            <?php
            if (!empty($errors)) {
                echo '<div class="error-messages">';
                foreach ($errors as $error) {
                    echo '<p>' . htmlspecialchars($error) . '</p>';
                }
                echo '</div>';
            }
            ?>
            <form action="" method="POST" autocomplete="on">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div class="textbox">
                    <input type="text" id="username" placeholder="Username" name="username" required value="<?php echo isset($userName) ? htmlspecialchars($userName) : ''; ?>">
                </div>
                <div class="textbox">
                    <input type="email" id="email" placeholder="Email" name="email" required value="<?php echo isset($userEmail) ? htmlspecialchars($userEmail) : ''; ?>">
                </div>
                <div class="textbox">
                    <input type="tel" id="telephone" placeholder="Telephone" name="telephone" required value="<?php echo isset($userTelNo) ? htmlspecialchars($userTelNo) : ''; ?>">
                </div>
                <div class="textbox">
                    <input type="password" id="password" placeholder="Password" name="password" required>
                </div>
                <div class="textbox">
                    <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I accept the Terms of Use & Privacy Policy</label>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <div class="login-link">
                    Already have an account? <a href="../php/login.php">Login here</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Add this CSS to style the error messages */
        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error-messages p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</body>

</html>