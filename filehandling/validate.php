<!DOCTYPE html>
<html>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    if (!filter_var($age, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 120]])) {
        $errors[] = "Invalid age.";
    }

    if (empty($errors)) {
        echo "✅ Form submitted successfully!";
        echo "<br>Name: $name<br>Email: $email<br>Age: $age";
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
  Age: <input type="text" name="age"><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>