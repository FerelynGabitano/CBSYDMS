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
    }
  </style>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <header class="dashboard-header">
    <div class="logo">
      <img src="{{ asset('images/BSYLogo.png') }}" alt="BSY Logo">
      <h2>Batang Surigaonon</h2>
    </div>
    <div class="user-menu">
      <span>Member Name</span>
      <img src="{{ asset('images/user-avatar.jpg') }}" alt="User Avatar">
    </div>
  </header>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active">
        <i class="fas fa-calendar-alt"></i>
        <span>Activities</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-user"></i>
        <span>My Profile</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-check-circle"></i>
        <span>My Participation</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-images"></i>
        <span>Gallery</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </div>
    </aside>

    <main class="main-content">
      <section class="welcome-section">
        <h1>Welcome back, [Member Name]!</h1>
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
              <img src="{{ asset('images/event1.jpg') }}" alt="Community Cleanup">
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
              <img src="{{ asset('images/event2.jpg') }}" alt="Art Workshop">
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
              <img src="{{ asset('images/event3.jpg') }}" alt="Youth Summit">
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
              <img src="{{ asset('images/event4.jpg') }}" alt="Sports Fest">
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
              <img src="{{ asset('images/event5.jpg') }}" alt="Christmas Party">
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
    </main>
  </div>

  <script>
    // Example JavaScript for join buttons
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
  </script>
</body>

</html>