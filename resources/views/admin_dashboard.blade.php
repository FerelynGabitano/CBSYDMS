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
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }

    .menu-item {
      padding: 0.8rem 2rem;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .menu-item:hover, .menu-item.active {
      background-color: #f0f2ff;
      color: #1C0BA3;
      border-left: 4px solid #1C0BA3;
    }

    .menu-item i {
      font-size: 1.1rem;
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

    .stats-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .stat-card h3 {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }

    .stat-card p {
      font-size: 1.8rem;
      font-weight: bold;
      color: #1C0BA3;
    }

    .recent-activity {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .recent-activity h2 {
      margin-bottom: 1rem;
      color: #1C0BA3;
    }

    .activity-item {
      display: flex;
      align-items: center;
      padding: 0.8rem 0;
      border-bottom: 1px solid #eee;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-item img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 1rem;
      object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .dashboard-container {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
      }
    }
  </style>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <header class="dashboard-header">
    <div class="logo">
      <img src="{{ asset('images/bsy-logo.png') }}" alt="BSY Logo">
      <h2>Batang Surigaonon Youth</h2>
    </div>
    <div class="user-menu">
      <span>Admin User</span>
      <img src="{{ asset('images/user-avatar.jpg') }}" alt="User Avatar">
    </div>
  </header>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-users"></i>
        <span>Members</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-calendar-alt"></i>
        <span>Events</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-image"></i>
        <span>Gallery</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-file-alt"></i>
        <span>Reports</span>
      </div>
      <div class="menu-item">
        <i class="fas fa-cog"></i>
        <span>Settings</span>
      </div>
    </aside>

    <main class="main-content">
      <section class="welcome-section">
        <h1>Welcome back, Admin!</h1>
        <p>Here's what's happening with BSY today.</p>
      </section>

      <div class="stats-cards">
        <div class="stat-card">
          <h3>Total Members</h3>
          <p>248</p>
        </div>
        <div class="stat-card">
          <h3>Upcoming Events</h3>
          <p>5</p>
        </div>
        <div class="stat-card">
          <h3>New Members (This Month)</h3>
          <p>18</p>
        </div>
        <div class="stat-card">
          <h3>Active Projects</h3>
          <p>3</p>
        </div>
      </div>

      <section class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-item">
          <img src="{{ asset('images/user1.jpg') }}" alt="User">
          <div>
            <p><strong>Juan Dela Cruz</strong> registered as new member</p>
            <small>2 hours ago</small>
          </div>
        </div>
        <div class="activity-item">
          <img src="{{ asset('images/user2.jpg') }}" alt="User">
          <div>
            <p><strong>Maria Santos</strong> attended the community meeting</p>
            <small>5 hours ago</small>
          </div>
        </div>
        <div class="activity-item">
          <img src="{{ asset('images/user3.jpg') }}" alt="User">
          <div>
            <p>New event <strong>Youth Summit 2023</strong> was created</p>
            <small>Yesterday</small>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>