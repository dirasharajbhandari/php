<!DOCTYPE html>
<html>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $errors = [];

    // Name Validation: letters and spaces only
    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $errors[] = "Name should contain only letters and spaces.";
    }

    // Email Validation
    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,}$/", $email)) {
        $errors[] = "Invalid email format.";
    }

    // Phone Validation: 10 digits only
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Phone number must be 10 digits.";
    }

    if (empty($errors)) {
        echo "<h3>✅ Form submitted successfully!</h3>";
        echo "Name: $name<br>Email: $email<br>Phone: $phone";
    } else {
        foreach ($errors as $error) {
            echo "❌ $error <br>";
        }
    }
}
?>
<form method="post" action="">
  Name: <input type="text" name="name"><br><br>
  Email: <input type="text" name="email"><br><br>
  Phone: <input type="text" name="phone"><br><br>
  <input type="submit" value="Submit">
</form>
</body>
</html>