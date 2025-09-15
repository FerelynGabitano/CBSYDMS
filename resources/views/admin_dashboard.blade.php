<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batang Surigaonon Youth - Dashboard</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body { background-color: #f5f7fa; color: #333; overflow-x: hidden; }

    /* Header/Navbar */
    .dashboard-header { background-color: #1C0BA3; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .logo { display: flex; align-items: center; gap: 10px; }
    .logo img { width: 40px; height: 40px; border-radius: 50%; }
    .logo h2 { font-size: 1.3rem; }
    .user-menu { display: flex; align-items: center; gap: 20px; }
    .user-menu img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; }

    /* Layout */
    .dashboard-container { display: flex; min-height: calc(100vh - 70px); }
    .sidebar { width: 250px; background-color: white; padding: 1.5rem 0; box-shadow: 2px 0 10px rgba(0,0,0,0.05); position: fixed; height: calc(100vh - 70px); overflow-y: auto; }
    .main-content { flex: 1; padding: 2rem; margin-left: 250px; transition: margin-left 0.3s ease; }
    .menu-item { padding: 0.8rem 2rem; display: flex; align-items: center; gap: 10px; cursor: pointer; transition: all 0.3s; }
    .menu-item:hover, .menu-item.active { background-color: #f0f2ff; color: #1C0BA3; border-left: 4px solid #1C0BA3; }

    /* Cards */
    .welcome-section { background: linear-gradient(135deg, #1C0BA3, rgb(126, 151, 241)); color: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem; }
    .stats-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
    .stat-card h3 { color: #666; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .stat-card p { font-size: 1.8rem; font-weight: bold; color: #1C0BA3; }

    /* Table */
    table { width: 100%; border-collapse: collapse; background: white; margin-top: 1rem; border-radius: 8px; overflow: hidden; }
    th, td { padding: 0.8rem; border-bottom: 1px solid #eee; text-align: left; }
    th { background: #f9f9f9; color: #1C0BA3; font-weight: bold; }

    /* Buttons */
    .btn { background-color: #1C0BA3; color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 0.9rem; transition: background-color 0.3s ease; }
    .btn:hover { background-color: #150882; }
    .btn-delete { background-color: #1C0BA3; }
    .btn-delete:hover { background-color: #150882; }
    .btn-logout { background-color: #1C0BA3; color: white; border: none; padding: 0.3rem 0.7rem; border-radius: 5px; cursor: pointer; margin-left: 10px; font-size: 0.9rem; transition: background-color 0.3s; }
    .btn-logout:hover { background-color: #150882; }

    /* Modal */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); padding: 2rem; }
    .modal-content { background-color: white; margin: auto; padding: 2rem; border-radius: 10px; max-width: 500px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); position: relative; }
    .modal-content select, .modal-content input { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; font-size: 0.95rem; }
    .modal-content h2 { color: #1C0BA3; margin-bottom: 1.5rem; }
    .close { position: absolute; right: 15px; top: 10px; color: #1C0BA3; font-size: 1.5rem; font-weight: bold; cursor: pointer; }
    .close:hover { color: #150882; }

    .alert-success { background-color: #e6f4ea; color: #256029; padding: 0.75rem 1rem; border-radius: 5px; margin-bottom: 1rem; }
    .alert-error { background-color: #fdecea; color: #b71c1c; padding: 0.75rem 1rem; border-radius: 5px; margin-bottom: 1rem; }

    @media (max-width: 768px) { .sidebar { display: none; } .main-content { margin-left: 0; } }
  </style>
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
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
      </form>
    </div>
  </header>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active" onclick="navigate('dashboard')"><i class="fas fa-home"></i><span>Dashboard</span></div>
      <div class="menu-item" onclick="navigate('users')"><i class="fas fa-users"></i><span>Users</span></div>
    </aside>

    <main class="main-content">
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

      <div id="users-section" style="display:none;">
        <h1>Users</h1>
        <table>
          <thead>
            <tr>
              <th>Name</th><th>Gender</th><th>Contact No.</th><th>Email</th><th>Address</th><th>Credential Email</th><th>Role</th><th>Joined Since</th><th>Actions</th>
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
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Single Modal (outside loop) -->
  <div id="editUserModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Manage User</h2>
      <div id="modalSuccess" class="alert-success" style="display:none;">User updated successfully!</div>
      <div id="modalError" class="alert-error" style="display:none;">Something went wrong.</div>
      <form id="editUserForm" method="POST">
        @csrf @method('PUT')
        <label>Credential Email:</label>
        <input type="email" name="credential_email" id="credential_email" required>
        <label>Role:</label>
        <select name="role_id" id="role" required>
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

  <script>
    const modal = document.getElementById('editUserModal');
    const closeBtn = modal.querySelector('.close');
    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('editUserForm');
    const credentialInput = document.getElementById('credential_email');

    editButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.dataset.userId;
        const credentialEmail = this.dataset.credentialEmail;
        form.action = `/users/${userId}`;
        credentialInput.value = credentialEmail;
        modal.style.display = 'block';
      });
    });

    closeBtn.onclick = () => modal.style.display = 'none';
    window.onclick = e => { if (e.target == modal) modal.style.display = 'none'; }

    function navigate(section) {
      document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
      event.target.closest('.menu-item').classList.add('active');
      document.getElementById('dashboard-section').style.display = (section === 'dashboard') ? 'block' : 'none';
      document.getElementById('users-section').style.display = (section === 'users') ? 'block' : 'none';
    }
  </script>
</body>
</html>
