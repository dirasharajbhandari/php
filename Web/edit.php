<?php
require('dbms.php');

if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

if (isset($_POST['new']) && $_POST['new'] == 1) {
    if (!isset($_POST['terms'])) {
        die("You must accept the terms and conditions.");
    }

    // Clean inputs
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $vehicle = $_POST['option'];
    $time = $_POST['stream'];

    $password = $_POST['password'];

    // If password entered, hash it, else ignore password update
    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $password_sql = "password = ?,";
    } else {
        $password_hashed = null;
        $password_sql = "";
    }

    // Build SQL dynamically depending on password
    $sql = "UPDATE register SET 
                first = ?, 
                middle = ?, 
                last = ?, 
                email = ?, 
                contact = ?, 
                address = ?, ";

    if (!empty($password)) {
        $sql .= "password = ?, ";
    }

    $sql .= "vehicle = ?, 
             time = ? 
             WHERE first = ?";

    // Prepare statement
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($connection));
    }

    // Bind params depending on password presence
    if (!empty($password)) {
        mysqli_stmt_bind_param($stmt, "sssssssssi", 
            $first, $middle, $last, $email, $contact, $address, $password_hashed, $vehicle, $time, $id);
    } else {
        mysqli_stmt_bind_param($stmt, "sssssssii", 
            $first, $middle, $last, $email, $contact, $address, $vehicle, $time, $id);
    }

    $exec = mysqli_stmt_execute($stmt);

    if ($exec) {
        echo '<p style="color:green;">Record Updated Successfully.<br><br><a href="view.php">View Updated Record</a></p>';
    } else {
        echo '<p style="color:red;">Update failed: ' . mysqli_stmt_error($stmt) . '</p>';
    }

    mysqli_stmt_close($stmt);

} else {
    // Fetch existing record for prefill
    $query = "SELECT * FROM register WHERE first = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update SpotOn Booking</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="register.css" />
</head>
<body>

  <div class="head">
    <h1>SpotOn</h1>
    <div class="anchor">
      <div class="home"><a href="log.html">Home</a></div>
      <div class="routine"><a href="routine.html">Routine</a></div>
      <div class="formatting"><a href="formatting.html">Formatting</a></div>
      <div class="form">
        <li>
          Form
          <ul class="dropdown">
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
          </ul>
        </li>
      </div>
    </div>
  </div>

  <div class="main border">
    <h2>Update Booking</h2>
    <form action="" method="post">
      <input type="hidden" name="new" value="1" />

      <div class="input-row">
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="first" placeholder="First Name" required
                 value="<?php echo htmlspecialchars($row['First']); ?>" />
        </div>
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="middle" placeholder="Middle Name"
                 value="<?php echo htmlspecialchars($row['Middle']); ?>" />
        </div>
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="last" placeholder="Last Name" required
                 value="<?php echo htmlspecialchars($row['Last']); ?>" />
        </div>
      </div>

      <div class="input-group">
        <i class="fa-solid fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required
               value="<?php echo htmlspecialchars($row['Email']); ?>" />
      </div>

      <div class="input-group">
        <i class="fa-solid fa-phone-volume"></i>
        <input type="text" name="contact" placeholder="Contact" required
               value="<?php echo htmlspecialchars($row['Contact']); ?>" />
      </div>

      <div class="input-group">
        <i class="fa-solid fa-location-dot"></i>
        <input type="text" name="address" placeholder="Address" required
               value="<?php echo htmlspecialchars($row['Address']); ?>" />
      </div>

      <div class="input-group">
        <i class="fa-solid fa-lock"></i>
        <input type="password" name="password" placeholder="New Password (leave blank to keep current)" />
      </div>

      <h4 class="select">Select Vehicle</h4>
      <div class="gender">
        <input type="radio" name="option" value="2" id="bike" required
          <?php if ($row['Vehicle'] == 2) echo 'checked'; ?> />
        <label for="bike" style="color: aliceblue;">2-wheeler</label>

        <input type="radio" name="option" value="4" id="car"
          <?php if ($row['Vehicle'] == 4) echo 'checked'; ?> />
        <label for="car" style="color: aliceblue;">4-wheeler</label>
      </div>

      <div class="faculty">
        <select name="stream" id="time" required>
          <option value="">Select time</option>
          <option value="1 hr" <?php if ($row['Time'] == '1 hr') echo 'selected'; ?>>1 hr</option>
          <option value="2 hr" <?php if ($row['Time'] == '2 hr') echo 'selected'; ?>>2 hr</option>
          <option value="5 hr" <?php if ($row['Time'] == '5 hr') echo 'selected'; ?>>5 hr</option>
          <option value="9 hr" <?php if ($row['Time'] == '9 hr') echo 'selected'; ?>>9 hr</option>
          <option value="12 hr" <?php if ($row['Time'] == '12 hr') echo 'selected'; ?>>12 hr</option>
          <option value="15 hr" <?php if ($row['Time'] == '15 hr') echo 'selected'; ?>>15 hr</option>
        </select>
      </div>

      <div class="check_box">
        <input type="checkbox" name="terms" id="terms" required checked />
        <label for="terms">I accept the terms and conditions.</label>
      </div>

      <div class="submit">
        <button type="submit">Update</button>
      </div>
    </form>
  </div>

  <footer class="main-footer">
    <div class="foot">
      <img src="./logo.png" alt="Logo" />
      <div class="contact">
        <h2>Contact Us</h2>
        <p>For any query or additional information that you may require from us.</p><br />
        <input type="text" placeholder="Full Name" /><br /><br />
        <input type="text" placeholder="Email" /><br /><br />
        <input type="number" placeholder="Phone number" />
      </div>
    </div>
    <button>Send</button>
  </footer>

</body>
</html>

<?php
}  // end else (form display)
?>
