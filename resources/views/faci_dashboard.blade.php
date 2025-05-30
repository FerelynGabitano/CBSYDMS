<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batang Surigaonon Youth - Dashboard</title>
<style>
  /* Styles stay mostly the same; updated section titles & minor adjustments */
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

  .dashboard-container {
    display: flex;
    min-height: calc(100vh - 70px);
  }

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

  .main-content {
    flex: 1;
    padding: 2rem;
  }

  .section-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    color: #1C0BA3;
  }

  .form-section, .list-section {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  }

  .form-section h3, .list-section h3 {
    margin-bottom: 1rem;
  }

  input[type="text"], input[type="date"], textarea {
    width: 100%;
    margin-bottom: 1rem;
    padding: 0.7rem;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    background-color: #1C0BA3;
    color: white;
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #6f30d3;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }

  table, th, td {
    border: 1px solid #ddd;
  }

  th, td {
    padding: 0.8rem;
    text-align: left;
  }

  th {
    background-color: #f0f2ff;
  }

  @media (max-width: 768px) {
    .dashboard-container {
      flex-direction: column;
    }
    .sidebar {
      width: 100%;
    }
  }
</style>
</head>
<body>
<header class="dashboard-header">
  <div class="logo">
    <img src="{{ asset('images/bsy-logo.png') }}" alt="BSY Logo">
    <h2>BSY Facilitator</h2>
  </div>
  <div class="user-menu">
    <span>Facilitator Name</span>
    <img src="{{ asset('images/user-avatar.jpg') }}" alt="Facilitator Avatar">
  </div>
</header>

<div class="dashboard-container">
  <aside class="sidebar">
    <div class="menu-item active"><i class="fas fa-plus"></i> <span>Upload Activity</span></div>
    <div class="menu-item"><i class="fas fa-users"></i> <span>Members & Attendance</span></div>
    <div class="menu-item"><i class="fas fa-hand-holding-usd"></i> <span>Sponsors</span></div>
    <div class="menu-item"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></div>
  </aside>

  <main class="main-content">
    <!-- Upload Activity Section -->
    <section class="form-section">
      <h3>Upload New Activity</h3>
      <form>
        <input type="text" placeholder="Activity Title" required>
        <textarea rows="4" placeholder="Activity Description" required></textarea>
        <input type="date" required>
        <button type="submit">Upload Activity</button>
      </form>
    </section>

    <!-- Members & Attendance Section -->
    <section class="list-section">
      <h3>Members & Attendance</h3>
      <table>
        <thead>
          <tr>
            <th>Member Name</th>
            <th>Activity</th>
            <th>Status</th>
            <th>Attendance</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Juan Dela Cruz</td>
            <td>Community Cleanup</td>
            <td>Joined</td>
            <td><input type="checkbox" checked></td>
          </tr>
          <tr>
            <td>Maria Santos</td>
            <td>Art Workshop</td>
            <td>Joined</td>
            <td><input type="checkbox"></td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Sponsors Section -->
    <section class="form-section">
      <h3>Log Sponsor</h3>
      <form>
        <input type="text" placeholder="Sponsor Name" required>
        <textarea rows="3" placeholder="Sponsorship Details" required></textarea>
        <button type="submit">Add Sponsor</button>
      </form>

      <div class="list-section">
        <h3>Current Sponsors</h3>
        <ul>
          <li>Surigao Coop Bank - ₱10,000</li>
          <li>Barangay Council - ₱5,000</li>
        </ul>
      </div>
    </section>
  </main>
</div>

<!-- JavaScript to simulate functionality -->
<script>
  document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
      document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Basic form submissions simulation
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Form submitted!');
      form.reset();
    });
  });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>
