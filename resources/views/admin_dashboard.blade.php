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
        /* Base button style */
    .btn {
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      font-size: 0.9rem;
      transition: background-color 0.3s ease;
    }

    /* Hover effect */
    .btn:hover {
      background-color: #150882;
    }

    /* Specific button types (optional) */
    .btn-edit {
      /* Same as base for uniform color */
    }

    .btn-delete {
      background-color: #1C0BA3; /* same blue */
    }

    .btn-delete:hover {
      background-color: #150882; /* same hover as others */
    }

    .download-btn {
      background-color: #1C0BA3; /* same base blue */
    }

    .download-btn:hover {
      background-color: #150882;
    }

    .btn-logout {
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 0.3rem 0.7rem;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
      font-size: 0.9rem;
      transition: background-color 0.3s;
    }

    .btn-logout:hover {
      background-color: #150882;
    }
    /* Modal background */
    .modal {
      display: none; 
      position: fixed; 
      z-index: 1000; 
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto; 
      background-color: rgba(0,0,0,0.5); 
      padding: 2rem;
    }

    /* Modal box styled like edit page */
    .modal-content {
      background-color: white;
      margin: auto;
      padding: 2rem;
      border-radius: 10px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      position: relative;
    }
    .modal-content select {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
    }

    /* Close button */
    .close {
      position: absolute;
      right: 15px;
      top: 10px;
      color: #1C0BA3;
      font-size: 1.5rem;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: #150882;
    }

    .modal-content h2 {
      color: #1C0BA3;
      margin-bottom: 1.5rem;
    }

    .modal-content label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
      color: #1C0BA3;
    }

    .modal-content input {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
    }

    .modal-content .btn {
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .modal-content .btn:hover {
      background-color: #150882;
    }

    /* Alert messages */
    .alert-success {
      background-color: #e6f4ea;
      color: #256029;
      padding: 0.75rem 1rem;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    .alert-error {
      background-color: #fdecea;
      color: #b71c1c;
      padding: 0.75rem 1rem;
      border-radius: 5px;
      margin-bottom: 1rem;
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
      <img src="{{ asset('images/BSYLogo.png') }}" alt="BSY Logo">
      <h2>Batang Surigaonon Youth</h2>
    </div>

    <div class="user-menu">
      <span>{{ auth()->user()->first_name }}</span>
      <img src="{{ asset('images/user-avatar.jpg') }}" alt="User Avatar">

      <!-- Logout Form -->
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
      </form>
    </div>
  </header>


  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active" onclick="navigate('dashboard')">
        <i class="fas fa-home"></i><span>Dashboard</span>
      </div>
      <div class="menu-item" onclick="navigate('users')">
        <i class="fas fa-users"></i><span>Users</span>
      </div>
    </aside>

    <main class="main-content">
      <!-- Dashboard Section -->
      <section id="dashboard-section">
        <div class="welcome-section">
          <h1>Welcome back, Admin!</h1>
          <p>Here's what's happening with BSY today.</p>
        </div>

        <div class="stats-cards">
          <div class="stat-card"><h3>Total Members</h3><p>{{ $users->count() }}</p></div>
          <div class="stat-card"><h3>Upcoming Events</h3><p>5</p></div>
          <div class="stat-card"><h3>New Members (This Month)</h3><p>18</p></div>
          <div class="stat-card"><h3>Active Projects</h3><p>3</p></div>
        </div>
      </section>

      <!-- Users Section -->
      <div id="users-section" style="display:none;">
        <h1>Users</h1>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Gender</th>
              <th>Contact No.</th>
              <th>Email</th>
              <th>Address</th>
              <th>Credential Email</th>
              <th>Role</th>
              <th>Joined Since </th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->street_address }} {{ $user->barangay}} {{ $user->city_municipality}} {{ $user->province}} {{ $user->zip_code}}</td>
                <td>{{ $user->credential_email}}</td>
                <td>{{ $user->role ? $user->role->role_name : 'No role' }}</td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                
                <a href="#" class="btn btn-edit" data-user-id="{{ $user->user_id }}" data-credential-email="{{ $user->credential_email }}">Edit</a>

                <form action="{{ route('users.destroy', ['user_id' => $user->user_id]) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">
                    Delete
                  </button>
                </form>
                <!-- Edit User Modal -->
                <div id="editUserModal" class="modal">
                  <div class="modal-content">
                    <span class="close">&times;</span>

                    <h2>Manage User</h2>

                    <!-- Alert messages (hidden by default, can be toggled via JS) -->
                    <div id="modalSuccess" class="alert-success" style="display:none;">User updated successfully!</div>
                    <div id="modalError" class="alert-error" style="display:none;">Something went wrong.</div>

                    <form id="editUserForm" method="POST">
                      @csrf
                      @method('PUT')

                      <label>Credential Email:</label>
                      <input type="email" name="credential_email" id="credential_email" required>

                      <label>Role:</label> <select name="role_id" id="role" required>
                                              @foreach($roles as $role)
                                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                              @endforeach
                                            </select>


                      <label>New Password (leave blank to keep current):</label>
                      <input type="password" name="password" placeholder="Enter new password">

                      <label>Confirm Password:</label>
                      <input type="password" name="password_confirmation" placeholder="Confirm new password">

                      <button type="submit" class="btn">Update</button>
                    </form>
                  </div>
                </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    const modal = document.getElementById('editUserModal');
    const closeBtn = modal.querySelector('.close');
    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('editUserForm');

    editButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.dataset.userId; // add data-user-id attribute on your edit button
        const credentialEmail = this.dataset.credentialEmail;

        // Fill the form with user's data
        form.action = `/users/${userId}`; 
        form.credential_email.value = credentialEmail;

        modal.style.display = 'block';
      });
    });

    closeBtn.onclick = function() {
      modal.style.display = 'none';
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
    function navigate(section) {
      document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
      event.target.closest('.menu-item').classList.add('active');

      document.getElementById('dashboard-section').style.display = (section === 'dashboard') ? 'block' : 'none';
      document.getElementById('users-section').style.display = (section === 'users') ? 'block' : 'none';
    }
  </script>
</body>
</html>