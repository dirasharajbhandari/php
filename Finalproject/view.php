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


  <main class="main">
    <div class="container">
    
      <section class="stats-section">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Total Spots</h3>
                <div class="stat-value">360</div>
                <div class="stat-subtitle">Across all levels</div>
              </div>
              <div class="stat-icon blue">&#x1F697;</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Available</h3>
                <div class="stat-value">142</div>
                <div class="stat-subtitle">39.4% free</div>
              </div>
              <div class="stat-icon green">&#9989;</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Occupied</h3>
                <div class="stat-value">186</div>
                <div class="stat-subtitle">Currently in use</div>
              </div>
              <div class="stat-icon red">&#x1F6AB;</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-content">
              <div class="stat-info">
                <h3>Occupancy Rate</h3>
                <div class="stat-value">60.6%</div>
                <div class="stat-subtitle">Overall utilization</div>
              </div>
              <div class="stat-icon purple">&#x1F4CA;</div>
            </div>
          </div>
        </div>
      </section>

      

  

      <section class="map-section">
        <h2>Parking Locations in Kathmandu</h2>
        <div
          id="map"
          style="height: 400px; border-radius: 8px; margin-bottom: 2rem"
        ></div>

        <script>
        
          const parkingSpots = [
            {
              name: "New road,Kathmandu",
              lat: 27.7172,
              lng: 85.324,
              available: true,
              availableSlots: 25,
            },
            {
              name: "Kathmandu Mall",
              lat: 27.7185,
              lng: 85.32,
              available: false,
              availableSlots: 0,
            },
            {
              name: "Ranjana Complex",
              lat: 27.715,
              lng: 85.31,
              available: true,
              availableSlots: 15,
            },
            {
              name: "Rising Mall",
              lat: 27.715,
              lng: 85.31,
              available: true,
              availableSlots: 20,
            },
            {
              name: "Labim Mall",
              lat: 27.716,
              lng: 85.325,
              available: true,
              availableSlots: 10,
            },
          ];

          var map = L.map("map").setView([27.7172, 85.324], 13);


          L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
          }).addTo(map);

        
          var markersGroup = L.layerGroup().addTo(map);

         
          var greenDot = L.divIcon({
            html:
              '<div style="width:16px; height:16px; background:green; border-radius:50%; border: 2px solid white;"></div>',
            className: "",
            iconSize: [16, 16],
            iconAnchor: [8, 8],
          });

          var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
          }).addTo(map);

       
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

      <section class="parking-grid-section">
        <div class="section-header">
          <h2>Ground Level - Detailed View</h2>
          <button class="close-btn">✕ Close</button>
        </div>

        <div class="parking-grid-container">
          <div class="parking-grid">
         
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

            </div>
          </div>
        </div>
      </section>

    
      <section class="actions-section">
        <h3>Quick Actions</h3>
        <div class="actions-grid">
          <button class="action-btn blue">
            <span class="action-icon">&#x1F3AF;</span>
            <span>Find Nearest Spot</span>
          </button>
          <button class="action-btn green">
            <span class="action-icon">&#x23F0;</span>
            <span>Reserve Spot</span>
          </button>
          <button class="action-btn purple">
            <span class="action-icon">&#x1F4C8; </span>
            <span>View Analytics</span>
          </button>
        </div>
      </section>

   
      <footer class="footer">
        <p>Parking data updates every 3 seconds • Last sync: January 15, 2025 at 2:45:32 PM</p>
      </footer>
    </div>
  </main>
</body>
</html>