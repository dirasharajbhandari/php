<?php
// db link
require('dbms.php');

// Insert code
$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {  // Check if the form is submitted
    $Username = $_POST['Username'];   // Get the form data
    $Password = $_POST['Password'];

    // Query to insert into the login table without the ID
    $insert_query = "INSERT INTO login (Username, Password) VALUES ('$Username', '$Password')";

    // Execute the query and check for errors
    if (mysqli_query($connection, $insert_query)) {
    $status = "New Record Inserted Successfully.";
} else {
    die("Insert failed: " . mysqli_error($connection));
}

    // Set status message
    $status = "New Record Inserted Successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<nav>
            <a href="index.php">Home</a> |
            <a href="insert.php">Insert new record</a> |
            <a href="view.php">View</a>
            <a href="login.php">Login</a>
        </nav>

    <h1>Login Data</h1>

    <!-- Form to submit the login details -->
    <form name="form" action="" method="post">
        <input type="text" name="Username" placeholder="Enter the username" required><br><br>
        <input type="password" name="Password" placeholder="Enter the password" required><br><br>
        
        <!-- Hidden field to mark the form as a new record insertion -->
        <input type="hidden" name="new" value="1">

        <button type="submit">Login</button>
    </form>

    <!-- Status message -->
    <p><?php echo $status; ?></p>
</body>
</html>
