<?php
session_start();
require 'Connection.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Rate per hour
$rate_per_hour = 40;

// Handle cancel booking request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve_id'])) {
    $reserve_id = intval($_POST['reserve_id']);

    // Check if booking exists and belongs to this user
    $check_query = mysqli_query($conn, "SELECT * FROM reserve WHERE reserve_id='$reserve_id' AND user_id='$user_id'");
    if ($check_query && mysqli_num_rows($check_query) > 0) {
        // Delete the booking
        mysqli_query($conn, "DELETE FROM reserve WHERE reserve_id='$reserve_id'");
        $message = "Booking canceled successfully!";
    } else {
        $message = "Booking not found or cannot be canceled!";
    }
}

// Fetch username
$user_result = mysqli_query($conn, "SELECT u_username FROM users WHERE u_id='$user_id'");
$user = mysqli_fetch_assoc($user_result);

// Fetch booking history from reserve table
$history_result = mysqli_query($conn, "
    SELECT reserve_id, location, vehicle_type, vehicle_num, date, start_time, end_time
    FROM reserve
    WHERE user_id='$user_id'
    ORDER BY date DESC, start_time DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>My Parking Booking History</title>
<link rel="stylesheet" href="view.css" />
<style>
body { font-family: Arial; background:#f7f7f7; margin:0; padding:0; }
h2,h3 { text-align:center; margin:20px 0; }
table { width:90%; max-width:900px; margin:20px auto 50px; border-collapse:collapse; background:#fff; }
th,td { padding:12px 15px; border:1px solid #ddd; text-align:center; }
th { background:#4CAF50; color:white; }
tr:nth-child(even){ background:#f2f2f2; }
.cancel-btn { padding:5px 10px; background:#ff5722; color:#fff; border:none; border-radius:5px; cursor:pointer; }
.cancel-btn:hover { background:#ff784e; }
.message { text-align:center; color:green; font-weight:bold; margin-bottom:20px; }
</style>
</head>
<body>

<header class="header">
  <div class="container">
    <div class="header-content">
      <div class="logo-section">
        <div class="logo">&#x1F17F;&#xFE0F;</div>
        <div class="title-section">
          <h1>SpotOn Dashboard</h1>
          <p class="location">&#x1F4CD; Nepal's Parking Complex</p>
        </div>
      </div>
      <nav class="nav-menu">
        <ul>
          <li><a href="view.php" class="nav-link">Dashboard</a></li>
          <li><a href="sample.php" class="nav-link">Reserve</a></li>
          <li><a href="booking_history.php" class="nav-link">My Bookings</a></li>
          <li><a href="home.php" class="nav-link">Logout</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>

<h2>My Parking Booking History</h2>
<h3>Username: <?= htmlspecialchars($user['u_username']) ?></h3>

<?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>

<?php if(mysqli_num_rows($history_result) > 0): ?>
<table>
<tr>
<th>Location</th>
<th>Vehicle Type</th>
<th>Vehicle Number</th>
<th>Date</th>
<th>Start Time</th>
<th>End Time</th>
<th>Payment (Rs.)</th>
<th>Action</th>
</tr>
<?php while($row = mysqli_fetch_assoc($history_result)): ?>
<tr>
<td><?= htmlspecialchars($row['location']) ?></td>
<td><?= htmlspecialchars($row['vehicle_type']) ?></td>
<td><?= htmlspecialchars($row['vehicle_num']) ?></td>
<td><?= htmlspecialchars($row['date']) ?></td>
<td><?= htmlspecialchars($row['start_time']) ?></td>
<td><?= htmlspecialchars($row['end_time']) ?></td>
<td>
<?php
// Calculate payment correctly
if($row['start_time'] && $row['end_time']) {
    $start = new DateTime($row['start_time']);
    $end = new DateTime($row['end_time']);
    $diff_seconds = $end->getTimestamp() - $start->getTimestamp();
    $total_hours = ceil($diff_seconds / 3600); // total hours, rounded up
    $payment = $total_hours * $rate_per_hour;
    echo $payment;
} else {
    echo '-';
}
?>
</td>
<td>
<form method="POST" onsubmit="return confirm('Cancel this booking?');">
<input type="hidden" name="reserve_id" value="<?= $row['reserve_id'] ?>">
<button type="submit" class="cancel-btn">Cancel</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
<p style="text-align:center;">You have no booking history yet.</p>
<?php endif; ?>

</body>
</html>
