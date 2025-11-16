<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";

// Database connection
$conn = mysqli_connect("127.0.0.1:3307", "root", "", "authentication");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user if it doesn't exist
    $check = $conn->prepare("SELECT * FROM login WHERE user=?");
    $check->bind_param("s", $username);
    $check->execute();
    $res = $check->get_result();

    if($res->num_rows == 0){
        $insert = $conn->prepare("INSERT INTO login (user, password) VALUES (?, ?)");
        $insert->bind_param("ss", $username, $password);
        if(!$insert->execute()){
            echo "Insert failed: ".$insert->error;
        } else {
            echo "User inserted successfully.<br>";
        }
        $insert->close();
    }

    $check->close();

    // Validate login
    $stmt = $conn->prepare("SELECT * FROM login WHERE user=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['user'] = $username;
        echo "Login successful. Redirecting...";
        header("Refresh: 2; URL=view.php"); // temporary redirect
        exit();
    } else {
        $error = "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Management Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="page-wrapper">
        <!-- Header -->
        <header class="header">
          <nav class="nav">
            <div class="nav-container">
              <div class="nav-brand">
                <span class="nav-logo">🅿️</span>
                <span class="nav-title">SpotOn</span>
              </div>
              <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="#features" class="nav-link">Features</a></li>
                <li><a href="#pricing" class="nav-link">Pricing</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="login.php" class="nav-link">Login</a></li>
                <li><a href="register.php" class="nav-link">Register</a></li>
              </ul>
              <button class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
              </button>
            </div>
          </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="login-container">
                <div class="login-card">
                    <h2>SpotOn Parking</h2>
                    <p>Secure Login to Manage Parking Slots</p>
                        <form action="" method="post" id="loginForm">
                            <div class="input-group">
                                <input type="text" id="username" name="username" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="input-group">
                                <input type="password" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                            <button type="submit">Login</button>
                            <?php if($error != "") { echo "<p class='error-msg'>$error</p>"; } ?>
                        </form>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
          <div class="container">
            <div class="footer-content">
              <div class="footer-brand">
                <span class="footer-logo">🅿️</span>
                <span class="footer-title">SpotOn</span>
              </div>
              <p class="footer-text">Making parking simple, secure, and convenient for everyone.</p>
            </div>
            <div class="footer-bottom">
              <p>&copy; 2025 SpotOn. All rights reserved.</p>
            </div>
          </div>
        </footer>
    </div>

    <script src="script.js"></script>
</body>
</html>
