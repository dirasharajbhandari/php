<?php

$host = "127.0.0.1:3307";
$user = "root";
$password = "";
$dbname = "parking";


$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $location = $_POST['location'] ?? '';
    $date = $_POST['date'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $spot_id = $_POST['spot_id'] ?? '';

    $vehicle_type = $_POST['vehicle_type'] ?? '';
    $license_plate = strtoupper(trim($_POST['license_plate'] ?? ''));
    $vehicle_make = $_POST['vehicle_make'] ?? '';
    $vehicle_model = $_POST['vehicle_model'] ?? '';
    $vehicle_color = $_POST['vehicle_color'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';

    $electric_charging = isset($_POST['electric_charging']) ? 1 : 0;
    $covered_parking = isset($_POST['covered_parking']) ? 1 : 0;
    $disability_access = isset($_POST['disability_access']) ? 1 : 0;

 
    if (empty($location) || empty($date) || empty($start_time) || empty($end_time) || empty($spot_id) || empty($vehicle_type) || empty($license_plate)) {
        die("Please fill in all required fields.");
    }

  
    $stmt = $conn->prepare("INSERT INTO bookings 
        (location, booking_date, start_time, end_time, duration, spot_id, vehicle_type, license_plate, vehicle_make, vehicle_model, vehicle_color, contact_number, electric_charging, covered_parking, disability_access) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssssssiii",
        $location, $date, $start_time, $end_time, $duration, $spot_id, $vehicle_type, $license_plate, $vehicle_make, $vehicle_model, $vehicle_color, $contact_number, $electric_charging, $covered_parking, $disability_access
    );

    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
        echo "<p style='color:green; font-weight:bold;'>Booking successful! Your booking ID is: $booking_id</p>";
        // Optionally redirect or reset form here
    } else {
        echo "<p style='color:red;'>Error: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book Your Spot - ParkEasy</title>
  <link rel="stylesheet" href="reserve.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <header>
    <div class="container header-container">
      <div class="logo">
        <h1><i class="fas fa-parking"></i> ParkEasy</h1>
      </div>
      <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="view.php">View</a></li>
          <li><a href="reserve.php" class="active">Reserve</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="signup.php">Sign Up</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <form action="" method="POST" id="booking-form">

    <div class="booking-step active" id="step-1">
      <h2>1. Choose Location & Time</h2>
      <label for="location">Parking Location:</label>
      <select id="location" name="location" required>
        <option value="">Select a location</option>
        <option value="downtown">Downtown Business District</option>
        <option value="mall">Shopping Mall Complex</option>
        <option value="airport">Airport Terminal</option>
        <option value="stadium">Sports Stadium</option>
        <option value="hospital">Medical Center</option>
      </select><br/>

      <label for="date">Date:</label>
      <input type="date" id="date" name="date" min="" required /><br/>

      <label for="start-time">Start Time:</label>
      <input type="time" id="start-time" name="start_time" required /><br/>

      <label for="end-time">End Time:</label>
      <input type="time" id="end-time" name="end_time" required /><br/>

      <label for="duration">Expected Duration:</label>
      <select id="duration" name="duration" required>
        <option value="">Select duration</option>
        <option value="1-2">1-2 hours</option>
        <option value="3-4">3-4 hours</option>
        <option value="5-8">5-8 hours</option>
        <option value="full-day">Full day</option>
        <option value="overnight">Overnight</option>
      </select><br/>

      <button type="button" class="btn btn-primary" onclick="nextStep(2)">Search Available Spots</button>
    </div>

  
    <div class="booking-step" id="step-2">
      <h2>2. Select Your Parking Spot</h2>
      <p>Choose from available spots:</p>

      <div>
        <div class="parking-spot available" data-spot="A1" data-type="regular">A1</div>
        <div class="parking-spot occupied" data-spot="A2">A2</div>
        <div class="parking-spot available" data-spot="A3" data-type="regular">A3</div>
        <div class="parking-spot available" data-spot="A4" data-type="regular">A4</div>
        <div class="parking-spot available" data-spot="A5" data-type="regular">A5</div>
      </div>
      <br/>

      <input type="hidden" id="spot-id" name="spot_id" required />

      <div id="spot-info" style="display:none; margin-top:10px;">
        <strong>Selected Spot:</strong> <span id="selected-spot-id"></span><br/>
        <strong>Type:</strong> <span id="selected-spot-type"></span><br/>
        <strong>Features:</strong> <span id="selected-spot-features"></span>
      </div>

      <br/>
      <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Back</button>
      <button type="button" class="btn btn-primary" onclick="nextStep(3)" id="continue-spot" disabled>Continue with Selected Spot</button>
    </div>

    
    <div class="booking-step" id="step-3">
      <h2>3. Vehicle Information</h2>
      <label for="vehicle-type">Vehicle Type:</label>
      <select id="vehicle-type" name="vehicle_type" required>
        <option value="">Select vehicle type</option>
        <option value="sedan">Sedan</option>
        <option value="suv">SUV</option>
        <option value="hatchback">Hatchback</option>
        <option value="truck">Truck</option>
        <option value="motorcycle">Motorcycle</option>
        <option value="van">Van</option>
      </select><br/>

      <label for="license-plate">License Plate:</label>
      <input type="text" id="license-plate" name="license_plate" placeholder="ABC-1234" style="text-transform:uppercase;" required /><br/>

      <label for="vehicle-make">Vehicle Make:</label>
      <input type="text" id="vehicle-make" name="vehicle_make" placeholder="Toyota, Honda..." /><br/>

      <label for="vehicle-model">Vehicle Model:</label>
      <input type="text" id="vehicle-model" name="vehicle_model" placeholder="Camry, Civic..." /><br/>

      <label for="vehicle-color">Vehicle Color:</label>
      <select id="vehicle-color" name="vehicle_color">
        <option value="">Select color</option>
        <option value="white">White</option>
        <option value="black">Black</option>
        <option value="silver">Silver</option>
        <option value="gray">Gray</option>
        <option value="red">Red</option>
        <option value="blue">Blue</option>
        <option value="green">Green</option>
        <option value="other">Other</option>
      </select><br/>

      <label for="contact-number">Contact Number:</label>
      <input type="tel" id="contact-number" name="contact_number" placeholder="+1 (555) 123-4567" /><br/>

      <h3>Special Requirements</h3>
      <label><input type="checkbox" id="electric-charging" name="electric_charging" value="1" /> Electric vehicle charging needed</label><br/>
      <label><input type="checkbox" id="covered-parking" name="covered_parking" value="1" /> Covered parking preferred</label><br/>
      <label><input type="checkbox" id="disability-access" name="disability_access" value="1" /> Disability accessible spot required</label><br/>

      <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Back</button>
      <button type="submit" class="btn btn-primary">Complete Booking</button>
    </div>
  </form>


  <footer id="contact">
    <div class="container">
      <div class="footer-columns">
        <div class="footer-column">
          <h3><i class="fas fa-parking"></i> ParkEasy</h3>
          <p>Smart parking solutions for modern drivers. Save time, reduce stress, and park with confidence.</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="view.php">View</a></li>
            <li><a href="reserve.php">Reserve</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Locations</h3>
          <ul>
            <li><a href="reserve.php?location=downtown">Downtown</a></li>
            <li><a href="reserve.php?location=mall">Shopping Mall</a></li>
            <li><a href="reserve.php?location=airport">Airport</a></li>
            <li><a href="reserve.php?location=stadium">Sports Stadium</a></li>
            <li><a href="reserve.php?location=hospital">Medical Center</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Contact Us</h3>
          <address>
            <p><i class="fas fa-map-marker-alt"></i> 123 Parking Avenue, City</p>
            <p><i class="fas fa-phone"></i> (555) 123-4567</p>
            <p><i class="fas fa-envelope"></i> info@parkeasy.com</p>
          </address>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> ParkEasy. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
  
    document.getElementById('date').min = new Date().toISOString().split('T')[0];

    function nextStep(step) {
      document.querySelector('.booking-step.active').classList.remove('active');
      document.getElementById(`step-${step}`).classList.add('active');
    }

    function prevStep(step) {
      document.querySelector('.booking-step.active').classList.remove('active');
      document.getElementById(`step-${step}`).classList.add('active');
    }

  
    document.querySelectorAll('.parking-spot.available').forEach(spot => {
      spot.addEventListener('click', function () {
        document.querySelectorAll('.parking-spot.selected').forEach(s => s.classList.remove('selected'));
        this.classList.add('selected');

      
        document.getElementById('spot-id').value = this.dataset.spot;

       
        document.getElementById('selected-spot-id').textContent = this.dataset.spot;
        document.getElementById('selected-spot-type').textContent = this.dataset.type || 'Standard';
        document.getElementById('selected-spot-features').textContent = 'Security Camera, Well-lit Area';

        document.getElementById('spot-info').style.display = 'block';
        document.getElementById('continue-spot').disabled = false;
      });
    });

   
    document.getElementById('license-plate').addEventListener('input', function (e) {
      e.target.value = e.target.value.toUpperCase();
    });
  </script>
</body>
</html>