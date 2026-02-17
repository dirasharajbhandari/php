<?php
session_start();
require 'Connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* 1️⃣ Auto-free expired slots */
mysqli_query($conn, "
    UPDATE parking_slots
    SET 
        status = 'free',
        booked_until = NULL
    WHERE 
        status = 'booked'
        AND booked_until < NOW()
");

/* 2️⃣ Fetch all slots */
$result = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY slot_no");
$slots = [];
while ($row = mysqli_fetch_assoc($result)) {
    $slots[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Parking Management Dashboard</title>
  <link rel="stylesheet" href="view.css" />

  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css"
  />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<style>
body { font-family: Arial; background:#f7f7f7; margin:0; padding:0; }
.parking-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:15px; max-width:400px; margin:30px auto; }
.slot-btn { padding:20px; font-size:18px; border:none; border-radius:8px; background:#ccc; cursor:pointer; }
.slot-btn:hover { background:#aaa; }
.slot-btn.selected { background:green; color:white; }
.slot-btn.booked { background:red; color:white; cursor:not-allowed; }
.book-btn { padding:10px 20px; font-size:16px; border:none; border-radius:5px; background:#4CAF50; color:white; cursor:pointer; }
.reset-btn { margin-top:5px; padding:8px 14px; background:#ff5722; color:#fff; font-weight:bold; border:none; border-radius:6px; cursor:pointer; }
.reset-btn:hover { background:#ff784e; }
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
        <div class="status-section">
          <div class="last-updated">
            <div class="label">Last Updated</div>
            <div class="time">2:45:32 PM</div>
          </div>
          <div class="live-indicator"></div>
        </div>
      </div>
    </div>
  </header>
<h2 style="text-align:center;">Parking Slot Booking</h2>

<form id="slotForm">
    <input type="hidden" id="selected_slot" name="slot_no">

    <div class="parking-grid">
        <?php foreach ($slots as $slot): ?>
            <button 
                type="button" 
                class="slot-btn <?= ($slot['status'] === 'booked') ? 'booked' : '' ?>" 
                data-spot="<?= $slot['slot_no'] ?>" 
                <?= ($slot['status'] === 'booked') ? 'disabled' : '' ?>
            >
                <?= $slot['slot_no'] ?> - <?= ($slot['status'] === 'booked') ? 'Booked' : 'Free' ?>
            </button>

            <?php if (isset($_SESSION['role']) && $_SESSION['role']==='admin' && $slot['status']==='booked'): ?>
                <button type="button" class="reset-btn" data-reset="<?= $slot['slot_no'] ?>">Reset</button>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div style="display:flex; justify-content: space-between; max-width:400px; margin:20px auto;">
        <button type="button" onclick="goBack()" 
                style="padding:10px 20px; font-size:16px; border:none; border-radius:5px; background:#2196F3; color:white; cursor:pointer;">
            ← Back
        </button>
        <button type="submit" class="book-btn">Book Slot</button>
    </div>
</form>

<script>
const form = document.getElementById('slotForm');
const hiddenInput = document.getElementById('selected_slot');
const buttons = document.querySelectorAll('.slot-btn');
let selectedButton = null;

// Slot selection
buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('booked')) return;

        buttons.forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        hiddenInput.value = btn.dataset.spot;
        selectedButton = btn;
    });
});

// Booking
form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!hiddenInput.value) { alert("Please select a slot"); return; }

    fetch('book_slot.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'slot_no=' + hiddenInput.value
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        // Immediately update button to red
        selectedButton.classList.remove('selected');
        selectedButton.classList.add('booked');
        selectedButton.innerText = selectedButton.dataset.spot + ' - Booked';
        selectedButton.disabled = true;
        hiddenInput.value = '';
    });
});

// Admin reset
document.querySelectorAll('.reset-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const slot = btn.dataset.reset;
        if(!confirm("Reset this slot?")) return;

        fetch('reset_slot.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'slot_no=' + slot
        })
        .then(res => res.text())
        .then(msg => { alert(msg); location.reload(); });
    });
});

function goBack(){ window.history.back(); }
</script>
</body>
</html>
