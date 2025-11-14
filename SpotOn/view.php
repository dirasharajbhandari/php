<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Parking Management Dashboard</title>
  <link rel="stylesheet" href="view.css" />

  <!-- Leaflet CSS & JS -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Leaflet Control Geocoder CSS & JS -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css"
  />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo-section">
          <div class="logo">🚗</div>
          <div class="title-section">
            <h1>ParkSmart Dashboard</h1>
            <p class="location">📍 Downtown Parking Complex</p>
          </div>
        </div>
        <nav class="nav-menu">
          <ul>
            <li><a href="home.php" class="nav-link">Home</a></li>
            <li><a href="view.html" class="nav-link">View</a></li>
            <li><a href="reserve.php" class="nav-link">Reserve</a></li>
            <li><a href="#" class="nav-link">Login</a></li>
            <li><a href="#" class="nav-link">Register</a></li>
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

  <!-- Main Content -->
  <main class="main">
    <div class="container">
      <!-- Overall Statistics -->
      <section class="stats-section">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Total Spots</h3>
                <div class="stat-value">360</div>
                <div class="stat-subtitle">Across all levels</div>
              </div>
              <div class="stat-icon blue">🚗</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Available</h3>
                <div class="stat-value">142</div>
                <div class="stat-subtitle">39.4% free</div>
              </div>
              <div class="stat-icon green">✅</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Occupied</h3>
                <div class="stat-value">186</div>
                <div class="stat-subtitle">Currently in use</div>
              </div>
              <div class="stat-icon red">🚫</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Occupancy Rate</h3>
                <div class="stat-value">60.6%</div>
                <div class="stat-subtitle">Overall utilization</div>
              </div>
              <div class="stat-icon purple">📊</div>
            </div>
          </div>
        </div>
      </section>

      <!-- PHP: Display Parking Records from Database -->
      <?php
      // Database credentials
      $servername = "127.0.0.1:3307";
      $username = "root";
      $password = "";
      $dbname = "parking";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
      }

      // Query parking spots table (update table and column names accordingly)
     $sql = "SELECT booking_id, location, booking_date, start_time, end_time, spot_id, vehicle_type, license_plate FROM bookings ORDER BY booking_date DESC, start_time DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<section class="db-records-section">';
    echo '<h2>Parking Bookings</h2>';
    echo '<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: left;">';
    echo '<thead><tr><th>Booking ID</th><th>Location</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Spot ID</th><th>Vehicle Type</th><th>License Plate</th></tr></thead><tbody>';

    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['booking_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['location']) . '</td>';
        echo '<td>' . htmlspecialchars($row['booking_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['start_time']) . '</td>';
        echo '<td>' . htmlspecialchars($row['end_time']) . '</td>';
        echo '<td>' . htmlspecialchars($row['spot_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['vehicle_type']) . '</td>';
        echo '<td>' . htmlspecialchars($row['license_plate']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</section>';
} else {
    echo '<p>No booking records found.</p>';
}


      $conn->close();
      ?>

      <!-- Parking Levels -->
      <section class="levels-section">
        <div class="section-header">
          <h2>Parking Levels</h2>
          <div class="live-status">
            <div class="pulse-dot"></div>
            <span>Real-time updates</span>
          </div>
        </div>

        <div class="levels-grid">
          <!-- Ground Level -->
          <div class="level-card">
            <div class="level-header">
              <div class="level-title">
                <div class="level-icon">🏢</div>
                <h3>Ground Level</h3>
              </div>
              <button class="view-details-btn">View Details</button>
            </div>

            <div class="occupancy-info">
              <div class="occupancy-label">
                <span>Occupancy Rate</span>
                <span class="rate">65.0%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 65%;"></div>
              </div>
            </div>

            <div class="level-stats">
              <div class="level-stat">
                <div class="stat-number green">28</div>
                <div class="stat-label">Available</div>
              </div>
              <div class="level-stat">
                <div class="stat-number red">45</div>
                <div class="stat-label">Occupied</div>
              </div>
              <div class="level-stat">
                <div class="stat-number yellow">7</div>
                <div class="stat-label">Reserved</div>
              </div>
            </div>
          </div>

          <!-- Level 1 -->
          <div class="level-card">
            <div class="level-header">
              <div class="level-title">
                <div class="level-icon">🏢</div>
                <h3>Level 1</h3>
              </div>
              <button class="view-details-btn">View Details</button>
            </div>

            <div class="occupancy-info">
              <div class="occupancy-label">
                <span>Occupancy Rate</span>
                <span class="rate">58.0%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill green" style="width: 58%;"></div>
              </div>
            </div>

            <div class="level-stats">
              <div class="level-stat">
                <div class="stat-number green">42</div>
                <div class="stat-label">Available</div>
              </div>
              <div class="level-stat">
                <div class="stat-number red">50</div>
                <div class="stat-label">Occupied</div>
              </div>
              <div class="level-stat">
                <div class="stat-number yellow">8</div>
                <div class="stat-label">Reserved</div>
              </div>
            </div>
          </div>

          <!-- Level 2 -->
          <div class="level-card">
            <div class="level-header">
              <div class="level-title">
                <div class="level-icon">🏢</div>
                <h3>Level 2</h3>
              </div>
              <button class="view-details-btn">View Details</button>
            </div>

            <div class="occupancy-info">
              <div class="occupancy-label">
                <span>Occupancy Rate</span>
                <span class="rate">72.0%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill yellow" style="width: 72%;"></div>
              </div>
            </div>

            <div class="level-stats">
              <div class="level-stat">
                <div class="stat-number green">28</div>
                <div class="stat-label">Available</div>
              </div>
              <div class="level-stat">
                <div class="stat-number red">62</div>
                <div class="stat-label">Occupied</div>
              </div>
              <div class="level-stat">
                <div class="stat-number yellow">10</div>
                <div class="stat-label">Reserved</div>
              </div>
            </div>
          </div>

          <!-- Level 3 -->
          <div class="level-card">
            <div class="level-header">
              <div class="level-title">
                <div class="level-icon">🏢</div>
                <h3>Level 3</h3>
              </div>
              <button class="view-details-btn">View Details</button>
            </div>

            <div class="occupancy-info">
              <div class="occupancy-label">
                <span>Occupancy Rate</span>
                <span class="rate">45.0%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill green" style="width: 45%;"></div>
              </div>
            </div>

            <div class="level-stats">
              <div class="level-stat">
                <div class="stat-number green">44</div>
                <div class="stat-label">Available</div>
              </div>
              <div class="level-stat">
                <div class="stat-number red">29</div>
                <div class="stat-label">Occupied</div>
              </div>
              <div class="level-stat">
                <div class="stat-number yellow">7</div>
                <div class="stat-label">Reserved</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Map Section -->
      <section class="map-section">
        <h2>Parking Locations in Kathmandu</h2>
        <div
          id="map"
          style="height: 400px; border-radius: 8px; margin-bottom: 2rem"
        ></div>

        <script>
          // Parking spots with lat, lng, availability, and available slots
          const parkingSpots = [
            {
              name: "Downtown Parking Complex",
              lat: 27.7172,
              lng: 85.324,
              available: true,
              availableSlots: 25,
            },
            {
              name: "City Mall Parking",
              lat: 27.7185,
              lng: 85.32,
              available: false,
              availableSlots: 0,
            },
            {
              name: "Riverside Parking",
              lat: 27.715,
              lng: 85.31,
              available: true,
              availableSlots: 15,
            },
            {
              name: "Central Plaza",
              lat: 27.716,
              lng: 85.325,
              available: true,
              availableSlots: 10,
            },
          ];

          // Initialize map centered on Kathmandu
          var map = L.map("map").setView([27.7172, 85.324], 13);

          // Add OpenStreetMap tile layer
          L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
          }).addTo(map);

          // Group for markers
          var markersGroup = L.layerGroup().addTo(map);

          // Custom green dot icon
          var greenDot = L.divIcon({
            html:
              '<div style="width:16px; height:16px; background:green; border-radius:50%; border: 2px solid white;"></div>',
            className: "",
            iconSize: [16, 16],
            iconAnchor: [8, 8],
          });

          // Add geocoder control
          var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
          }).addTo(map);

          // On search result
          geocoder.on("markgeocode", function (e) {
            var center = e.geocode.center;
            map.setView(center, 15);

            markersGroup.clearLayers();

            parkingSpots.forEach((spot) => {
              var spotLatLng = L.latLng(spot.lat, spot.lng);
              var distance = center.distanceTo(spotLatLng);

              if (spot.available && distance < 2000) {
                L.marker(spotLatLng, { icon: greenDot })
                  .addTo(markersGroup)
                  .bindPopup(
                    `<b>${spot.name}</b><br>Parking Available<br>Slots Available: ${spot.availableSlots}`
                  );
              }
            });
          });
        </script>
      </section>

      <!-- Parking Grid Visualization -->
      <section class="parking-grid-section">
        <div class="section-header">
          <h2>Ground Level - Detailed View</h2>
          <button class="close-btn">✕ Close</button>
        </div>

        <div class="parking-grid-container">
          <div class="parking-grid">
            <!-- Row 1 -->
            <div
              class="parking-spot available"
              title="Spot G001 - Available"
            >
              G01
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G002 - Occupied"
            >
              G02
            </div>
            <div
              class="parking-spot available"
              title="Spot G003 - Available"
            >
              G03
            </div>
            <div
              class="parking-spot reserved"
              title="Spot G004 - Reserved"
            >
              G04
            </div>
            <div
              class="parking-spot available"
              title="Spot G005 - Available"
            >
              G05
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G006 - Occupied"
            >
              G06
            </div>
            <div
              class="parking-spot available"
              title="Spot G007 - Available"
            >
              G07
            </div>
            <div
              class="parking-spot available"
              title="Spot G008 - Available"
            >
              G08
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G009 - Occupied"
            >
              G09
            </div>
            <div
              class="parking-spot available"
              title="Spot G010 - Available"
            >
              G10
            </div>

            <!-- Row 2 -->
            <div
              class="parking-spot occupied"
              title="Spot G011 - Occupied"
            >
              G11
            </div>
            <div
              class="parking-spot available"
              title="Spot G012 - Available"
            >
              G12
            </div>
            <div
              class="parking-spot available"
              title="Spot G013 - Available"
            >
              G13
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G014 - Occupied"
            >
              G14
            </div>
            <div
              class="parking-spot reserved"
              title="Spot G015 - Reserved"
            >
              G15
            </div>
            <div
              class="parking-spot available"
              title="Spot G016 - Available"
            >
              G16
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G017 - Occupied"
            >
              G17
            </div>
            <div
              class="parking-spot available"
              title="Spot G018 - Available"
            >
              G18
            </div>
            <div
              class="parking-spot available"
              title="Spot G019 - Available"
            >
              G19
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G020 - Occupied"
            >
              G20
            </div>

            <!-- Row 3 -->
            <div
              class="parking-spot available"
              title="Spot G021 - Available"
            >
              G21
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G022 - Occupied"
            >
              G22
            </div>
            <div
              class="parking-spot available"
              title="Spot G023 - Available"
            >
              G23
            </div>
            <div
              class="parking-spot available"
              title="Spot G024 - Available"
            >
              G24
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G025 - Occupied"
            >
              G25
            </div>
            <div
              class="parking-spot reserved"
              title="Spot G026 - Reserved"
            >
              G26
            </div>
            <div
              class="parking-spot available"
              title="Spot G027 - Available"
            >
              G27
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G028 - Occupied"
            >
              G28
            </div>
            <div
              class="parking-spot available"
              title="Spot G029 - Available"
            >
              G29
            </div>
            <div
              class="parking-spot available"
              title="Spot G030 - Available"
            >
              G30
            </div>

            <!-- Row 4 -->
            <div
              class="parking-spot occupied"
              title="Spot G031 - Occupied"
            >
              G31
            </div>
            <div
              class="parking-spot available"
              title="Spot G032 - Available"
            >
              G32
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G033 - Occupied"
            >
              G33
            </div>
            <div
              class="parking-spot available"
              title="Spot G034 - Available"
            >
              G34
            </div>
            <div
              class="parking-spot available"
              title="Spot G035 - Available"
            >
              G35
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G036 - Occupied"
            >
              G36
            </div>
            <div
              class="parking-spot reserved"
              title="Spot G037 - Reserved"
            >
              G37
            </div>
            <div
              class="parking-spot available"
              title="Spot G038 - Available"
            >
              G38
            </div>
            <div
              class="parking-spot occupied"
              title="Spot G039 - Occupied"
            >
              G39
            </div>
            <div
              class="parking-spot available"
              title="Spot G040 - Available"
            >
              G40
            </div>
          </div>

          <div class="legend">
            <div class="legend-item">
              <div class="legend-color available"></div>
              <span>Available</span>
            </div>
            <div class="legend-item">
              <div class="legend-color occupied"></div>
              <span>Occupied</span>
            </div>
            <div class="legend-item">
              <div class="legend-color reserved"></div>
              <span>Reserved</span>
            </div>
            <div class="legend-item">
              <div class="legend-icon">⚡</div>
              <span>Electric</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Quick Actions -->
      <section class="actions-section">
        <h3>Quick Actions</h3>
        <div class="actions-grid">
          <button class="action-btn blue">
            <span class="action-icon">🎯</span>
            <span>Find Nearest Spot</span>
          </button>
          <button class="action-btn green">
            <span class="action-icon">⏰</span>
            <span>Reserve Spot</span>
          </button>
          <button class="action-btn purple">
            <span class="action-icon">📈</span>
            <span>View Analytics</span>
          </button>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
        <p>Parking data updates every 3 seconds • Last sync: January 15, 2025 at 2:45:32 PM</p>
      </footer>
    </div>
  </main>
</body>
</html>
