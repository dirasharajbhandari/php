<?php
require('dbms.php'); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ParkEasy - Premium Parking Solutions</title>
    <link rel="stylesheet" href="home.css">
  </head>
  <body>
   
    <header class="header">
      <nav class="nav">
        <div class="nav-container">
          <div class="nav-brand">
            <span class="nav-logo">🅿️</span>
            <span class="nav-title">SpotOn</span>
          </div>
          <ul class="nav-menu">
            <li><a href="home.html" class="nav-link">Home</a></li>
            <li><a href="#features" class="nav-link">Features</a></li>
            <li><a href="#pricing" class="nav-link">Pricing</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
            <li><a href="login.html" class="nav-link">Login</a></li>
        <li><a href="register.html" class="nav-link">Register</a></li>
          </ul>
          <button class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </nav>
    </header>

   
    <section id="home" class="hero">
      <div class="hero-container">
        <div class="hero-content">
          <h1 class="hero-title">Find Your Perfect Parking Spot</h1>
          <p class="hero-subtitle">Secure, convenient, and affordable parking solutions in prime locations. Reserve your spot in seconds and park with confidence.</p>
          <div class="hero-buttons">
            <button class="btn btn-primary"><a href="reserve.php">Reserve Now</a></button>
            <button class="btn btn-secondary">Learn More</button>
          </div>
        </div>
        <div class="hero-image">
          <div class="parking-visual">
            <div class="parking-grid">
              <div class="parking-spot available">🚗</div>
              <div class="parking-spot occupied">🚙</div>
              <div class="parking-spot available">🚗</div>
              <div class="parking-spot occupied">🚐</div>
              <div class="parking-spot available"></div>
              <div class="parking-spot occupied">🚗</div>
            </div>
          </div>
        </div>
      </div>
    </section>

  
    <section id="features" class="features">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Why Choose ParkEasy?</h2>
          <p class="section-subtitle">Experience the future of parking with our innovative solutions</p>
        </div>
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon">📍</div>
            <h3 class="feature-title">Prime Locations</h3>
            <p class="feature-description">Strategic parking spots in downtown, shopping centers, and business districts.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3 class="feature-title">Secure Parking</h3>
            <p class="feature-description">24/7 security monitoring and covered parking options for your vehicle's safety.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3 class="feature-title">Instant Booking</h3>
            <p class="feature-description">Reserve your parking spot in under 30 seconds with real-time availability.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">💰</div>
            <h3 class="feature-title">Best Prices</h3>
            <p class="feature-description">Competitive rates with flexible hourly, daily, and monthly parking options.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">📱</div>
            <h3 class="feature-title">Easy Access</h3>
            <p class="feature-description">QR code entry and mobile app control for seamless parking experience.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🔄</div>
            <h3 class="feature-title">Flexible Terms</h3>
            <p class="feature-description">No long-term commitments. Cancel or modify your reservation anytime.</p>
          </div>
        </div>
      </div>
    </section>

   
    <section id="pricing" class="pricing">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Simple, Transparent Pricing</h2>
          <p class="section-subtitle">Choose the plan that works best for your parking needs</p>
        </div>
        <div class="pricing-grid">
          <div class="pricing-card">
            <div class="pricing-header">
              <h3 class="pricing-title">Hourly</h3>
              <div class="pricing-price">
                <span class="price-amount">30</span>
                <span class="price-period">/hour</span>
              </div>
            </div>
            <ul class="pricing-features">
              <li>✅ Pay as you go</li>
              <li>✅ Perfect for short visits</li>
              <li>✅ No minimum commitment</li>
              <li>✅ Mobile app access</li>
            </ul>
            <button class="btn btn-outline">Get Started</button>
          </div>
          <div class="pricing-card featured">
            <div class="pricing-badge">Most Popular</div>
            <div class="pricing-header">
              <h3 class="pricing-title">Daily</h3>
              <div class="pricing-price">
                <span class="price-amount">300</span>
                <span class="price-period">/day</span>
              </div>
            </div>
            <ul class="pricing-features">
              <li>✅ Up to 12 hours parking</li>
              <li>✅ Great for work commutes</li>
              <li>✅ Priority spot selection</li>
              <li>✅ 24/7 customer support</li>
            </ul>
            <button class="btn btn-primary">Choose Daily</button>
          </div>
          <div class="pricing-card">
            <div class="pricing-header">
              <h3 class="pricing-title">Monthly</h3>
              <div class="pricing-price">
                <span class="price-amount">10,000</span>
                <span class="price-period">/month</span>
              </div>
            </div>
            <ul class="pricing-features">
              <li>✅ Unlimited parking</li>
              <li>✅ Reserved dedicated spot</li>
              <li>✅ Best value option</li>
              <li>✅ Premium locations</li>
            </ul>
            <button class="btn btn-outline">Go Monthly</button>
          </div>
        </div>
      </div>
    </section>

    <section id="contact" class="contact">
      <div class="container">
        <div class="contact-content">
          <div class="contact-info">
            <h2 class="contact-title">Ready to Park Smart?</h2>
            <p class="contact-description">Join thousands of satisfied customers who've made parking hassle-free with ParkEasy.</p>
            <div class="contact-details">
              <div class="contact-item">
                <span class="contact-icon">📞</span>
                <span>9851336288</span>
              </div>
              <div class="contact-item">
                <span class="contact-icon">✉️</span>
                <span>spoton@gmail.com</span>
              </div>
              <div class="contact-item">
                <span class="contact-icon">📍</span>
                <span>Nepal's Parking Solutions</span>
              </div>
            </div>
          </div>
          <div class="contact-form">
            <form class="form">
              <div class="form-group">
                <input type="text" class="form-input" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-input" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <textarea class="form-input" placeholder="How can we help you?" rows="4" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary full-width">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>

   
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-brand">
            <span class="footer-logo">🅿️</span>
            <span class="footer-title">SpotOn</span>
          </div>
          <p class="footer-text">Making parking simple, secure, and convenient for everyone.</p>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2025 SpotOn. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
