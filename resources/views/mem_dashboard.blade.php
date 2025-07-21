<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batang Surigaonon Youth - Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5f7fa;
      color: #333;
    }

    /* Header/Navbar */
    .dashboard-header {
      background-color: #1C0BA3;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: white;
      padding: 5px;
    }

    .logo h2 {
      font-size: 1.3rem;
    }

    .user-menu {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .user-menu img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      background-color: #ccc;
    }

    /* Main Layout */
    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 70px);
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: white;
      padding: 1.5rem 0;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
    }

    .menu-item {
      padding: 0.8rem 2rem;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .menu-item:hover,
    .menu-item.active {
      background-color: #f0f2ff;
      color: #1C0BA3;
      border-left: 4px solid #1C0BA3;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 2rem;
    }

    .content-section {
      display: none;
    }

    .content-section.active {
      display: block;
    }

    .welcome-section {
      background: linear-gradient(135deg, #1C0BA3, rgb(126, 151, 241));
      color: white;
      padding: 2rem;
      border-radius: 10px;
      margin-bottom: 2rem;
    }

    .welcome-section h1 {
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }

    /* Activity Cards */
    .activity-section {
      margin-bottom: 2rem;
    }

    .section-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .section-title h2 {
      color: #1C0BA3;
    }

    .activity-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    .activity-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
    }

    .activity-card:hover {
      transform: translateY(-5px);
    }

    .activity-image {
      height: 150px;
      overflow: hidden;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .activity-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .activity-details {
      padding: 1.5rem;
    }

    .activity-details h3 {
      margin-bottom: 0.5rem;
      color: #1C0BA3;
    }

    .activity-meta {
      display: flex;
      gap: 15px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      color: #666;
    }

    .activity-meta i {
      margin-right: 5px;
      color: #6f30d3;
    }

    .activity-status {
      display: inline-block;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .status-active {
      background-color: #e3f7e8;
      color: #28a745;
    }

    .status-upcoming {
      background-color: #fff4e5;
      color: #fd7e14;
    }

    .status-completed {
      background-color: #e3f2fd;
      color: #2196f3;
    }

    .btn-join {
      display: inline-block;
      padding: 0.6rem 1.5rem;
      background-color: #1C0BA3;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }

    .btn-join:hover {
      background-color: #6f30d3;
    }

    .btn-disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    /* Profile Section */
    .profile-card {
      background: white;
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }

    .profile-header {
      display: flex;
      align-items: center;
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      color: #6c757d;
    }

    .profile-info h2 {
      color: #1C0BA3;
      margin-bottom: 0.5rem;
    }

    .profile-info p {
      color: #666;
      margin-bottom: 0.3rem;
    }

    .profile-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
    }

    .detail-group {
      margin-bottom: 1rem;
    }

    .detail-group label {
      font-weight: bold;
      color: #1C0BA3;
      display: block;
      margin-bottom: 0.3rem;
    }

    .detail-group span {
      color: #666;
    }

    /* Gallery Section */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1rem;
    }

    .gallery-item {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
    }

    .gallery-item:hover {
      transform: scale(1.05);
    }

    .gallery-image {
      height: 150px;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6c757d;
    }

    .gallery-caption {
      padding: 1rem;
      text-align: center;
    }

    .gallery-caption h4 {
      color: #1C0BA3;
      margin-bottom: 0.5rem;
    }

    .gallery-caption p {
      font-size: 0.9rem;
      color: #666;
    }

    /* Participation Section */
    .participation-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-number {
      font-size: 2rem;
      font-weight: bold;
      color: #1C0BA3;
      margin-bottom: 0.5rem;
    }

    .stat-label {
      color: #666;
      font-size: 0.9rem;
    }

    .participation-list {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .participation-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      border-bottom: 1px solid #eee;
    }

    .participation-item:last-child {
      border-bottom: none;
    }

    .participation-info h4 {
      color: #1C0BA3;
      margin-bottom: 0.3rem;
    }

    .participation-info p {
      color: #666;
      font-size: 0.9rem;
    }

    .participation-badge {
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .dashboard-container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .activity-cards {
        grid-template-columns: 1fr;
      }

      .profile-header {
        flex-direction: column;
        text-align: center;
      }

      .profile-details {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header class="dashboard-header">
    <div class="logo">
      <div
        style="width: 40px; height: 40px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1C0BA3; font-weight: bold;">
        BSY</div>
      <h2>Batang Surigaonon</h2>
    </div>
    <div class="user-menu">
      <span id="user-name">Juan Dela Cruz</span>
      <div
        style="width: 36px; height: 36px; background: #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
        JD</div>
    </div>
  </header>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active" data-section="activities">
        <i class="fas fa-calendar-alt"></i>
        <span>Activities</span>
      </div>
      <div class="menu-item" data-section="profile">
        <i class="fas fa-user"></i>
        <span>My Profile</span>
      </div>
      <div class="menu-item" data-section="participation">
        <i class="fas fa-check-circle"></i>
        <span>My Participation</span>
      </div>
      <div class="menu-item" data-section="gallery">
        <i class="fas fa-images"></i>
        <span>Gallery</span>
      </div>
      <div class="menu-item" data-section="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </div>
    </aside>

    <main class="main-content">
      <!-- Activities Section -->
      <div id="activities-section" class="content-section active">
        <section class="welcome-section">
          <h1 id="greeting">Welcome!</h1>
          <p>Stay updated with BSY activities and join upcoming events.</p>
        </section>

        <!-- Active Activities Section -->
        <section class="activity-section">
          <div class="section-title">
            <h2><i class="fas fa-fire"></i> Active Activities</h2>
          </div>
          <div class="activity-cards">
            <!-- Activity Card 1 -->
            <div class="activity-card">
              <div class="activity-image">
                <i class="fas fa-broom" style="font-size: 3rem; color: #28a745;"></i>
              </div>
              <div class="activity-details">
                <span class="activity-status status-active">Ongoing</span>
                <h3>Community Cleanup Drive</h3>
                <div class="activity-meta">
                  <span><i class="fas fa-map-marker-alt"></i> Surigao City Plaza</span>
                  <span><i class="fas fa-calendar-day"></i> Until Oct 30</span>
                </div>
                <p>Help clean our community and win prizes for most collected trash!</p>
                <a href="#" class="btn-join">Participate Now</a>
              </div>
            </div>

            <!-- Activity Card 2 -->
            <div class="activity-card">
              <div class="activity-image">
                <i class="fas fa-palette" style="font-size: 3rem; color: #fd7e14;"></i>
              </div>
              <div class="activity-details">
                <span class="activity-status status-active">Ongoing</span>
                <h3>Youth Art Workshop</h3>
                <div class="activity-meta">
                  <span><i class="fas fa-map-marker-alt"></i> BSY Center</span>
                  <span><i class="fas fa-calendar-day"></i> Daily until Nov 15</span>
                </div>
                <p>Free art workshops for young aspiring artists every afternoon.</p>
                <a href="#" class="btn-join">Join Today</a>
              </div>
            </div>
          </div>
        </section>

        <!-- Upcoming Activities Section -->
        <section class="activity-section">
          <div class="section-title">
            <h2><i class="fas fa-clock"></i> Upcoming Activities</h2>
          </div>
          <div class="activity-cards">
            <!-- Activity Card 1 -->
            <div class="activity-card">
              <div class="activity-image">
                <i class="fas fa-users" style="font-size: 3rem; color: #1C0BA3;"></i>
              </div>
              <div class="activity-details">
                <span class="activity-status status-upcoming">Starts Nov 5</span>
                <h3>BSY Youth Summit 2023</h3>
                <div class="activity-meta">
                  <span><i class="fas fa-map-marker-alt"></i> City Convention Center</span>
                  <span><i class="fas fa-calendar-day"></i> Nov 5-7, 2023</span>
                </div>
                <p>Annual gathering of Surigao youth with workshops, talks, and networking.</p>
                <a href="#" class="btn-join">Register Now</a>
              </div>
            </div>

            <!-- Activity Card 2 -->
            <div class="activity-card">
              <div class="activity-image">
                <i class="fas fa-basketball-ball" style="font-size: 3rem; color: #dc3545;"></i>
              </div>
              <div class="activity-details">
                <span class="activity-status status-upcoming">Starts Dec 10</span>
                <h3>Inter-Barangay Sports Fest</h3>
                <div class="activity-meta">
                  <span><i class="fas fa-map-marker-alt"></i> City Sports Complex</span>
                  <span><i class="fas fa-calendar-day"></i> Dec 10-15, 2023</span>
                </div>
                <p>Basketball, volleyball, and badminton tournaments for youth.</p>
                <a href="#" class="btn-join">Join Team</a>
              </div>
            </div>

            <!-- Activity Card 3 -->
            <div class="activity-card">
              <div class="activity-image">
                <i class="fas fa-gift" style="font-size: 3rem; color: #28a745;"></i>
              </div>
              <div class="activity-details">
                <span class="activity-status status-upcoming">Starts Dec 23</span>
                <h3>BSY Christmas Party</h3>
                <div class="activity-meta">
                  <span><i class="fas fa-map-marker-alt"></i> BSY Headquarters</span>
                  <span><i class="fas fa-calendar-day"></i> Dec 23, 2023</span>
                </div>
                <p>Annual Christmas celebration with games, gifts, and performances.</p>
                <a href="#" class="btn-join">Confirm Attendance</a>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Profile Section -->
      <div id="profile-section" class="content-section">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-avatar">
              <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
              <h2>Juan Dela Cruz</h2>
              <p><i class="fas fa-envelope"></i> juan.delacruz@email.com</p>
              <p><i class="fas fa-phone"></i> +63 912 345 6789</p>
              <p><i class="fas fa-calendar"></i> Member since January 2023</p>
            </div>
          </div>

          <div class="profile-details">
            <div class="detail-group">
              <label>Full Name:</label>
              <span>Juan Miguel Dela Cruz</span>
            </div>
            <div class="detail-group">
              <label>Age:</label>
              <span>22 years old</span>
            </div>
            <div class="detail-group">
              <label>Address:</label>
              <span>123 Rizal Street, Surigao City</span>
            </div>
            <div class="detail-group">
              <label>Barangay:</label>
              <span>Barangay Centro</span>
            </div>
            <div class="detail-group">
              <label>Education:</label>
              <span>College Student - Surigao State University</span>
            </div>
            <div class="detail-group">
              <label>Course:</label>
              <span>Bachelor of Science in Information Technology</span>
            </div>
            <div class="detail-group">
              <label>Skills/Interests:</label>
              <span>Programming, Community Service, Sports</span>
            </div>
            <div class="detail-group">
              <label>Emergency Contact:</label>
              <span>Maria Dela Cruz - +63 912 345 6788</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Participation Section -->
      <div id="participation-section" class="content-section">
        <div class="participation-stats">
          <div class="stat-card">
            <div class="stat-number">12</div>
            <div class="stat-label">Activities Joined</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">8</div>
            <div class="stat-label">Completed</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">2</div>
            <div class="stat-label">Ongoing</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">2</div>
            <div class="stat-label">Upcoming</div>
          </div>
        </div>

        <div class="participation-list">
          <h3 style="color: #1C0BA3; margin-bottom: 1rem;">My Activity History</h3>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Community Cleanup Drive</h4>
              <p><i class="fas fa-calendar"></i> Joined: October 15, 2023</p>
            </div>
            <span class="participation-badge status-active">Ongoing</span>
          </div>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Youth Art Workshop</h4>
              <p><i class="fas fa-calendar"></i> Joined: October 10, 2023</p>
            </div>
            <span class="participation-badge status-active">Ongoing</span>
          </div>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Tree Planting Activity</h4>
              <p><i class="fas fa-calendar"></i> Completed: September 20, 2023</p>
            </div>
            <span class="participation-badge status-completed">Completed</span>
          </div>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Blood Donation Drive</h4>
              <p><i class="fas fa-calendar"></i> Completed: September 5, 2023</p>
            </div>
            <span class="participation-badge status-completed">Completed</span>
          </div>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Youth Leadership Seminar</h4>
              <p><i class="fas fa-calendar"></i> Completed: August 15, 2023</p>
            </div>
            <span class="participation-badge status-completed">Completed</span>
          </div>

          <div class="participation-item">
            <div class="participation-info">
              <h4>Beach Cleanup Campaign</h4>
              <p><i class="fas fa-calendar"></i> Completed: July 30, 2023</p>
            </div>
            <span class="participation-badge status-completed">Completed</span>
          </div>
        </div>
      </div>

      <!-- Gallery Section -->
      <div id="gallery-section" class="content-section">
        <div class="section-title">
          <h2><i class="fas fa-images"></i> Photo Gallery</h2>
        </div>

        <div class="gallery-grid">
          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-broom" style="font-size: 2rem; color: #28a745;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Community Cleanup</h4>
              <p>October 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-palette" style="font-size: 2rem; color: #fd7e14;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Art Workshop</h4>
              <p>October 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-tree" style="font-size: 2rem; color: #28a745;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Tree Planting</h4>
              <p>September 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-tint" style="font-size: 2rem; color: #dc3545;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Blood Donation</h4>
              <p>September 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-graduation-cap" style="font-size: 2rem; color: #1C0BA3;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Leadership Seminar</h4>
              <p>August 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-water" style="font-size: 2rem; color: #17a2b8;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Beach Cleanup</h4>
              <p>July 2023</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-users" style="font-size: 2rem; color: #6f42c1;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Youth Summit 2022</h4>
              <p>November 2022</p>
            </div>
          </div>

          <div class="gallery-item">
            <div class="gallery-image">
              <i class="fas fa-gift" style="font-size: 2rem; color: #28a745;"></i>
            </div>
            <div class="gallery-caption">
              <h4>Christmas Party 2022</h4>
              <p>December 2022</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Function to get the member name from the user's account
    function getMemberName() {
      // Replace this with your actual method to get the user's name
      // Example: From a session object, token, or API
      const user = JSON.parse(sessionStorage.getItem('user')) || {}; // Example: Mock session data
      return user.name || 'Juan Dela Cruz'; // Fallback to default name
    }

    // Function to handle the greeting logic
    function setGreeting() {
      const memberName = getMemberName();
      const currentTime = new Date().getTime();
      let visitData = JSON.parse(localStorage.getItem('visitData')) || {
        visitCount: 0,
        lastVisit: null
      };

      // Increment visit count
      visitData.visitCount += 1;

      // Determine greeting
      let greetingText = '';
      if (visitData.visitCount === 1) {
        greetingText = `Welcome, ${memberName}!`;
      } else {
        const lastVisitTime = visitData.lastVisit;
        const timeDiff = lastVisitTime ? (currentTime - lastVisitTime) / (1000 * 60 * 60) : Infinity;

        if (timeDiff <= 1) {
          greetingText = `Welcome back, ${memberName}!`;
        } else {
          visitData.visitCount = 1;
          greetingText = `Welcome, ${memberName}!`;
        }
      }

      // Update the greeting
      document.getElementById('greeting').textContent = greetingText;

      // Update visit data
      visitData.lastVisit = currentTime;
      localStorage.setItem('visitData', JSON.stringify(visitData));
    }

    // Sidebar navigation functionality
    function initializeSidebar() {
      const menuItems = document.querySelectorAll('.menu-item');
      const contentSections = document.querySelectorAll('.content-section');

      menuItems.forEach(item => {
        item.addEventListener('click', function () {
          const sectionName = this.getAttribute('data-section');

          // Handle logout separately
          if (sectionName === 'logout') {
            if (confirm('Are you sure you want to logout?')) {
              alert('Logging out...');
              // Add your logout logic here
              // window.location.href = '/logout';
            }
            return;
          }

          // Remove active class from all menu items
          menuItems.forEach(menuItem => {
            menuItem.classList.remove('active');
          });

          // Add active class to clicked item
          this.classList.add('active');

          // Hide all content sections
          contentSections.forEach(section => {
            section.classList.remove('active');
          });

          // Show selected section
          const targetSection = document.getElementById(sectionName + '-section');
          if (targetSection) {
            targetSection.classList.add('active');
          }
        });
      });
    }

    // Initialize join button functionality
    function initializeJoinButtons() {
      document.querySelectorAll('.btn-join').forEach(button => {
        button.addEventListener('click', function (e) {
          e.preventDefault();
          const activityTitle = this.closest('.activity-card').querySelector('h3').textContent;
          alert(`You've joined "${activityTitle}"! Details will be sent to your email.`);
          this.textContent = "Joined!";
          this.classList.add('btn-disabled');
          this.style.backgroundColor = '#28a745';
        });
      });
    }

    // Initialize gallery item click functionality
    function initializeGallery() {
      document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function () {
          const title = this.querySelector('h4').textContent;
          const date = this.querySelector('p').textContent;
          alert(`Viewing: ${title} - ${date}`);
          // You can implement a modal or lightbox here
        });
      });
    }

    // Initialize all functionality when page loads
    document.addEventListener('DOMContentLoaded', function () {
      setGreeting();
      initializeSidebar();
      initializeJoinButtons();
      initializeGallery();
    });
  </script>
</body>

</html>