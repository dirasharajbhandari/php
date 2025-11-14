<?php
require('dbms.php');

$status = "";

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $first    = $_POST['first'];
    $middle   = $_POST['middle'];
    $last     = $_POST['last'];
    $email    = $_POST['email'];
    $contact  = $_POST['contact'];
    $address  = $_POST['address'];
    $password = $_POST['password'];
    $option   = $_POST['option'];
    $stream   = $_POST['stream'];

    // Prepare statement using procedural style
    $stmt = mysqli_prepare($connection, "INSERT INTO register 
        (first, middle, last, email, contact, address, password, vehicle, time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($connection));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssss", $first, $middle, $last, $email, $contact, $address, $password, $option, $stream);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        $status = "New Record Inserted Successfully.<br><br>";
    } else {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="head">
        <h1>SpotOn</h1>
        <div class="anchor">
            
             <div class="home">
                <a href="log.html">Home</a>
             </div>
             
             <div class="routine">
                <a href="routine.html">Routine</a>
             </div>
    
             <div class="formatting">
                <a href="formatting.html">Formatting</a>
             </div>
    
             <div class="form">
              <li>
                  Form
                  <ul class="dropdown">
                    <a href="login.html"><li> Login</li></a>
                      <a href="register.html"><li>Register</li></a>
                  </ul>
              </li>
          </ul>
             </div>
                    
                    
        </div>
    </div>


     <div class="main border">
    <h2>Book a Spot</h2>
    <form action="insert.php" method="post">
  <input type="hidden" name="new" value="1" />

  <div class="input-row">
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="first" placeholder="First Name" required>
    </div>
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="middle" placeholder="Middle Name">
    </div>
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="last" placeholder="Last Name" required>
    </div>
  </div>

  <div class="input-group">
    <i class="fa-solid fa-envelope"></i>
    <input type="email" name="email" placeholder="Email" required>
  </div>

  <div class="input-group">
    <i class="fa-solid fa-phone-volume"></i>
    <input type="text" name="contact" placeholder="Contact" required>
  </div>

  <div class="input-group">
    <i class="fa-solid fa-location-dot"></i>
    <input type="text" name="address" placeholder="Address" required>
  </div>

  <div class="input-group">
    <i class="fa-solid fa-lock"></i>
    <input type="password" name="password" placeholder="Password" required>
  </div>

  <h4 style="color: white;">Select Vehicle</h4>
  <div class="gender">
    <input type="radio" name="option" value="2" id="bike" required>
    <label for="bike" style="color: aliceblue;">2-wheeler</label>

    <input type="radio" name="option" value="4" id="car">
    <label for="car" style="color: aliceblue;">4-wheeler</label>
  </div>

  <div class="faculty">
    <select name="stream" id="time" required>
      <option value="">Select time</option>
      <option value="1 hr">1 hr</option>
      <option value="2 hr">2 hr</option>
      <option value="5 hr">5 hr</option>
      <option value="9 hr">9 hr</option>
      <option value="12 hr">12 hr</option>
      <option value="15 hr">15 hr</option>
    </select>
  </div>

  <div class="check_box">
    <input type="checkbox" id="terms" required>
    <label for="terms">I accept the terms and conditions.</label>
  </div>

  <div class="submit">
    <button type="submit">Book</button>
  </div>
</form>

    
  
       <footer class="main-footer">
        <div class="foot">
            <img src="./logo.png">
            <div class="contact">
                <h2>Contact Us</h2>
                <p>For any query or additional information that you may require from us.</p><br>
                <input type="text" placeholder="Full Name"><br><br>
                <input type="text" placeholder="Email"><br><br>
                <input type="number" placeholder="Phone number">

            </div>
        </div>
        <button>Send</button>

    </footer>

</body>
</html>
