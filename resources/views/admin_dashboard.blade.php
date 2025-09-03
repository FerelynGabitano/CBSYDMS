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
      overflow-x: hidden;
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
      transition: transform 0.3s ease, width 0.3s ease;
      position: fixed;
      height: calc(100vh - 70px);
      overflow-y: auto;
    }

    .sidebar.collapsed {
      transform: translateX(-100%);
      width: 0;
    }

    .sidebar-toggle {
      position: absolute;
      top: 1rem;
      right: -40px;
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 0 5px 5px 0;
      display: none;
    }

    .sidebar.collapsed+.main-content .sidebar-toggle {
      display: block;
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

    .menu-item i {
      font-size: 1.1rem;
    }

    /* Event Box */
    .event-box {
      background-color: #f9f9f9;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      margin-top: 2rem;
    }

    .event-box img {
      width: 100%;
      height: auto;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    .event-box h2 {
      color: #1C0BA3;
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
    }

    .event-box p {
      color: #666;
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    .event-box .facilitators {
      font-size: 0.9rem;
      color: #444;
      font-weight: bold;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 2rem;
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed+.main-content {
      margin-left: 0;
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
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
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
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
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

    .download-btn {
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 1rem;
    }

    .download-btn:hover {
      background-color: #150882;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.collapsed {
        transform: translateX(0);
        width: 250px;
      }

      .main-content {
        margin-left: 0;
      }

      .sidebar-toggle {
        display: block;
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
      <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <div class="menu-item active" onclick="navigate('dashboard')">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
      </div>
      <div class="menu-item" onclick="navigate('users')">
        <i class="fas fa-users"></i>
        <span>Users</span>
      </div>
      <div class="menu-item" onclick="navigate('members')">
        <i class="fas fa-users"></i>
        <span>Members</span>
      </div>
      <div class="menu-item" onclick="navigate('facilitator')">
        <i class="fas fa-users"></i>
        <span>Facilitators</span>
      </div>
      <div class="menu-item" onclick="navigate('events')">
        <i class="fas fa-calendar-alt"></i>
        <span>Events</span>
      </div>
      <div class="menu-item" onclick="navigate('gallery')">
        <i class="fas fa-image"></i>
        <span>Gallery</span>
      </div>
      <div class="menu-item" onclick="navigate('reports')">
        <i class="fas fa-file-alt"></i>
        <span>Reports</span>
      </div>
      <div class="menu-item" onclick="navigate('settings')">
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

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('collapsed');
    }

    function navigate(section) {
      // Remove active class from all menu items
      document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
      });
      // Add active class to clicked menu item
      event.target.closest('.menu-item').classList.add('active');

      // Simple navigation logic
      let content = '';
      switch (section) {
        case 'dashboard':
          content = `
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
          `;
          break;
        case 'users':
          content = `
            <h1>Add Users Credentials</h1>
            <p>View and manage users here.</p>
            <button class="edit-btn" onclick="editUsers()">Edit</button>
            <button class="delete-btn" onclick="deleteUsers()">Delete</button>
          `;
          break;
        case 'members':
          content = `
            <h1>Members Section</h1>
            <p>View and manage members here.</p>
            <button class="download-btn" onclick="downloadMembers()">Download All Members</button>
          `;
          break;
        case 'facilitator':
          content = `
            <h1>Facilitators Section</h1>
            <p>View and manage facilitators here.</p>
            <button class="download-btn" onclick="downloadFacilitators()">Download All Facilitators</button>
          `;
          break;
        case 'events':
          content = `
            <h1>Events Section</h1>
            <p>Manage upcoming events here.</p>
            <div class="event-box">
              <img src="{{ asset('images/event-placeholder.jpg') }}" alt="Event Image">
              <h2>Youth Summit 2025</h2>
              <p>A gathering to empower young leaders in Surigao on August 28, 2025.</p>
              <div class="facilitators">Facilitators: John Doe, Jane Smith</div>
            </div>
          `;
          break;
        case 'gallery':
          content = `<h1>Gallery Section</h1><p>Browse the gallery here.</p>`;
          break;
        case 'reports':
          content = `
            <h1>Reports Section</h1>
            <p>Generate reports here.</p>
            <button class="download-btn" onclick="downloadReports()">Download All Reports</button>
          `;
          break;
        case 'settings':
          content = `<h1>Settings Section</h1><p>Configure settings here.</p>`;
          break;
      }
      document.querySelector('.main-content').innerHTML = content;
    }

    function downloadMembers() {
      // Sample member data (replace with your actual data)
      const members = [
        { id: 1, name: "Juan Dela Cruz", batch: "Batch 1", email: "juan@example.com" },
        { id: 2, name: "Maria Santos", batch: "Batch 2", email: "maria@example.com" },
        { id: 3, name: "Pedro Reyes", batch: "Batch 1", email: "pedro@example.com" }
      ];

      // Group by batch and create CSV content
      const batches = {};
      members.forEach(member => {
        if (!batches[member.batch]) batches[member.batch] = [];
        batches[member.batch].push(`${member.id},${member.name},${member.email}`);
      });

      for (const [batch, data] of Object.entries(batches)) {
        const csvContent = `ID,Name,Email\n${data.join('\n')}`;
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', `members_${batch.replace(' ', '_').toLowerCase()}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
      }
    }

    function downloadReports() {
      // Sample report data (replace with your actual report files or data)
      const reports = [
        { id: 1, title: "Monthly Report - August 2025", content: "Report content for August 2025..." },
        { id: 2, title: "Annual Report - 2024", content: "Annual report content for 2024..." }
      ];

      reports.forEach(report => {
        const csvContent = `Title,Content\n${report.title},${report.content}`;
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', `${report.title.replace(/ /g, '_').toLowerCase()}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
      });
    }
  </script>
</body>

</html>