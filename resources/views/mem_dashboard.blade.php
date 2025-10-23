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
    .success-popup {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #d7f8d8;
      color: #1c7e20;
      border: 1px solid #d7f8d8;
      padding: 15px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      z-index: 9999;
      font-family: 'Segoe UI', sans-serif;
      min-width: 300px;
      text-align: left;
      animation: fadeInDown 0.5s ease;
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

    /* dropdown menu styles */
.dropdown {
  position: relative;
  margin-left: auto;
  cursor: pointer;
}
.dropdown-toggle {
  font-size: 1.2rem;
  color: #666;
}
.dropdown-menu {
  position: absolute;
  top: 25px;
  right: 0;
  background: white;
  border-radius: 5px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  display: none;
  flex-direction: column;
  min-width: 180px;
  z-index: 10;
}
.dropdown-menu a,
.dropdown-menu label {
  padding: 10px;
  color: #333;
  text-decoration: none;
  cursor: pointer;
  display: block;
}
.dropdown-menu a:hover,
.dropdown-menu label:hover {
  background-color: #f0f2ff;
  color: #1C0BA3;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 100;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}
.modal-content {
  background: white;
  margin: 10% auto;
  padding: 2rem;
  border-radius: 10px;
  width: 90%;
  max-width: 600px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.modal-content h2 {
  color: #1C0BA3;
  margin-bottom: 1rem;
}
.modal-content .detail-group {
  margin-bottom: 1rem;
}
.modal-content input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}
.close:hover {
  color: black;
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
  @if (session('success'))
    <div id="success-popup" class="success-popup">
      <strong>{{ session('success') }}</strong>
    </div>
      <script>
        setTimeout(() => {
          const popup = document.getElementById('success-popup');
            if (popup) popup.style.display = 'none';
          }, 6000);
      </script>
      <style>
      @keyframes fadeInDown {
        from { opacity: 0; transform: translate(-50%, -30px); }
        to { opacity: 1; transform: translate(-50%, 0); }
      }
      </style>
  @endif
  <header class="dashboard-header">
    <div class="logo">
      <img src="{{ asset('images/bsylogo.png') }}" alt="BSY Logo">
      <h2>Batang Surigaonon Youth</h2>
    </div>
    <div class="user-menu">
      <span id="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
      <div style="width: 36px; height: 36px; background: #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
      </div>
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </div>
  </header>

  <div class="dashboard-container">
    <!-- Sidebar -->
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
      <div class="menu-item" data-section="scholarships">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Scholarship</span>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Activities Section -->
      <div id="activities-section" class="content-section active">
        <!-- Active Activities -->
        <section class="activity-section">
          <div class="section-title">
            <h2><i class="fas fa-fire"></i> Active Activities</h2>
          </div>
          <div class="activity-cards">
            @forelse($activeActivities as $activity)
              <div class="activity-card">
                <div class="activity-image">
                  @if($activity->icon)
                    <i class="fas {{ $activity->icon }}" style="font-size: 3rem; color: #28a745;"></i>
                  @else
                    <i class="fas fa-calendar" style="font-size: 3rem; color: #28a745;"></i>
                  @endif
                </div>
                <div class="activity-details">
                  <span class="activity-status status-active">Ongoing</span>
                  <h3>{{ $activity->title }}</h3>
                  <div class="activity-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $activity->location }}</span>
                    <span><i class="fas fa-calendar-day"></i> {{ $activity->start_date->format('M d, Y') }}
                      @if($activity->end_date) - {{ $activity->end_date->format('M d, Y') }} @endif
                    </span>
                  </div>
                  <p>{{ $activity->description }}</p>
                      @php
                          $alreadyJoined = DB::table('activity_participants')
                              ->where('user_id', Auth::id())
                              ->where('activity_id', $activity->activity_id)
                              ->exists();
                        @endphp

                        @if ($alreadyJoined)
                          <button class="btn-join btn-disabled" disabled>Joined</button>
                        @else
                          <form action="{{ route('activities.join', $activity->activity_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-join"
                              onclick="return confirm('Are you sure you want to join this activity?');">
                              Join
                            </button>
                          </form>
                        @endif

                </div>
              </div>
            @empty
              <p>No active activities available.</p>
            @endforelse
          </div>
        </section>

        <!-- Upcoming Activities -->
        <section class="activity-section">
          <div class="section-title">
            <h2><i class="fas fa-clock"></i> Upcoming Activities</h2>
          </div>
          <div class="activity-cards">
            @forelse($upcomingActivities as $activity)
              <div class="activity-card">
                <div class="activity-image">
                  @if($activity->icon)
                    <i class="fas {{ $activity->icon }}" style="font-size: 3rem; color: #fd7e14;"></i>
                  @else
                    <i class="fas fa-calendar" style="font-size: 3rem; color: #fd7e14;"></i>
                  @endif
                </div>
                <div class="activity-details">
                  <span class="activity-status status-upcoming">Starts {{ $activity->start_date->format('M d, Y') }}</span>
                  <h3>{{ $activity->title }}</h3>
                  <div class="activity-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $activity->location }}</span>
                    <span><i class="fas fa-calendar-day"></i> {{ $activity->start_date->format('M d, Y') }}
                      @if($activity->end_date) - {{ $activity->end_date->format('M d, Y') }} @endif
                    </span>
                  </div>
                  <p>{{ $activity->description }}</p>
                      @php
                          $alreadyJoined = DB::table('activity_participants')
                              ->where('user_id', Auth::id())
                              ->where('activity_id', $activity->activity_id)
                              ->exists();
                        @endphp

                        @if ($alreadyJoined)
                          <button class="btn-join btn-disabled" disabled>Joined</button>
                        @else
                          <form action="{{ route('activities.join', $activity->activity_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-join"
                              onclick="return confirm('Are you sure you want to join this activity?');">
                              Join
                            </button>
                          </form>
                        @endif
                </div>
              </div>
            @empty
              <p>No upcoming activities available.</p>
            @endforelse
          </div>
        </section>
      </div>

      <!-- Profile Section -->
      <div id="profile-section" class="content-section">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-avatar">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                @else
                    {{ strtoupper(substr(Auth::user()->first_name,0,1) . substr(Auth::user()->last_name,0,1)) }}
                @endif
            </div>

            <div class="profile-info">
              <h2>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</h2>
              <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
              <p><i class="fas fa-phone"></i> {{ Auth::user()->contact_number }}</p>
              <p><i class="fas fa-calendar"></i> Member since {{ Auth::user()->created_at->format('F Y') }}</p>
            </div>

            <!-- 3-dot dropdown -->
            <div class="dropdown">
              <i class="fas fa-ellipsis-v dropdown-toggle"></i>
              <div class="dropdown-menu">
                <label for="profilePicUpload">Change Profile Picture</label>
                <a href="#" id="editProfileBtn">Edit Information</a>
              </div>
            </div>
          </div>

          <!-- hidden form for profile picture -->
          <form id="profilePicForm" action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
            @csrf
            <input type="file" id="profilePicUpload" name="profile_picture" accept="image/*" onchange="document.getElementById('profilePicForm').submit();">
          </form>

          <div class="profile-details">
            <div class="detail-group">
              <label>Address:</label>
              <span>{{ Auth::user()->street_address . ', ' . Auth::user()->barangay . ', ' . Auth::user()->city_municipality . ', ' . Auth::user()->province . ' ' . Auth::user()->zip_code }}</span>
            </div>
            <div class="detail-group">
              <label>School:</label>
              <span>{{ Auth::user()->school }}</span>
            </div>
            <div class="detail-group">
              <label>Course:</label>
              <span>{{ Auth::user()->course }}</span>
            </div>
            <div class="detail-group">
              <label>Yeal Level:</label>
              <span>{{ Auth::user()->gradeLevel}}</span>
            </div>
            <div class="detail-group">
              <label>Skills/Interests:</label>
              <span>{{ Auth::user()->skills }}</span>
            </div>
            <div class="detail-group">
              <label>Emergency Contact:</label>
              <span>{{ Auth::user()->emergency_contact_no }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= MODAL ================= -->
<div id="editProfileModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Profile Information</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
      
      <div class="detail-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}">
      </div>
      <div class="detail-group">
        <label for="middle_name">Middle Name:</label>
        <input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}">
      </div>
      <div class="detail-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}">
      </div>
      <div class="detail-group">
        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="{{ Auth::user()->contact_number }}">
      </div>
      <div class="detail-group">
        <label for="street_address">Street Address:</label>
        <input type="text" name="street_address" value="{{ Auth::user()->street_address }}">
      </div>
      <div class="detail-group">
        <label for="barangay">Barangay:</label>
        <input type="text" name="barangay" value="{{ Auth::user()->barangay }}">
      </div>
      <div class="detail-group">
        <label for="city_municipality">City / Municipality:</label>
        <input type="text" name="city_municipality" value="{{ Auth::user()->city_municipality }}">
      </div>
      <div class="detail-group">
        <label for="province">Province:</label>
        <input type="text" name="province" value="{{ Auth::user()->province }}">
      </div>
      <div class="detail-group">
        <label for="zip_code">Zip Code:</label>
        <input type="text" name="zip_code" value="{{ Auth::user()->zip_code }}">
      </div>
      <div class="detail-group">
        <label for="school">School:</label>
        <input type="text" name="school" value="{{ Auth::user()->school }}">
      </div>
      <div class="detail-group">
        <label for="course">Course:</label>
        <input type="text" name="course" value="{{ Auth::user()->course }}">
      </div>
      <div class="detail-group">
        <label for="gradeLevel">Year Level:</label>
        <input type="text" name="gradeLevel" value="{{ Auth::user()->gradeLevel }}">
      </div>
      <div class="detail-group">
        <label for="skills">Skills/Interests:</label>
        <input type="text" name="skills" value="{{ Auth::user()->skills }}">
      </div>
      <div class="detail-group">
        <label for="emergency_contact_no">Emergency Contact:</label>
        <input type="text" name="emergency_contact_no" value="{{ Auth::user()->emergency_contact_no }}">
      </div>

      <button type="submit" class="btn-join">Save Changes</button>
    </form>
  </div>
</div>


      <!-- Participation Section -->
       <div id="participation-section" class="content-section">
          <div class="stat-card">
            <div class="stat-number">{{ $joinedCount }}</div>
            <div class="stat-label">Activities Joined</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">{{ $completedCount }}</div>
            <div class="stat-label">Completed</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">{{ $ongoingCount }}</div>
            <div class="stat-label">Ongoing</div>
          </div>
          <div class="stat-card">
            <div class="stat-number">{{ $upcomingCount }}</div>
            <div class="stat-label">Upcoming</div>
          </div>

        <div class="participation-list">
            <h3 style="color: #1C0BA3; margin-bottom: 1rem;">My Activity History</h3>

            @forelse($history as $activity)
              <div class="participation-item">
                <div class="participation-info">
                  <h4>{{ $activity->title }}</h4>
                  <p><i class="fas fa-calendar"></i> Joined: {{ \Carbon\Carbon::parse($activity->joined_at)->format('F d, Y') }}</p>
                </div>
                <span class="participation-badge status-active">{{ $activity->attendance_status }}</span>
              </div>
            @empty
              <p>No activities joined yet.</p>
            @endforelse
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

      <!-- Scholarships Section -->
      <div id="scholarships-section" class="content-section">
        <div class="section-title">
          <h2><i class="fa-solid fa-graduation-cap"></i> Scholarships</h2>
        </div>
        <form action="{{ route('upload.scholarship') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="detail-group">
            <label>Barangay Certificate:</label>
            <input type="file" name="brgyCert">
            @if(Auth::user()->brgyCert)
              <a href="{{ asset('storage/' . Auth::user()->brgyCert) }}" target="_blank">View File</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Birth Certificate:</label>
            <input type="file" name="birthCert">
            @if(Auth::user()->birthCert)
              <a href="{{ asset('storage/' . Auth::user()->birthCert) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Grade Report:</label>
            <input type="file" name="gradeReport">
            @if(Auth::user()->gradeReport)
              <a href="{{ asset('storage/' . Auth::user()->gradeReport) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>ID Picture:</label>
            <input type="file" name="idPicture">
            @if(Auth::user()->idPicture)
              <a href="{{ asset('storage/' . Auth::user()->idPicture) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Certificate of Registration (COR):</label>
            <input type="file" name="cor">
            @if(Auth::user()->cor)
              <a href="{{ asset('storage/' . Auth::user()->cor) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Voter's Certificate:</label>
            <input type="file" name="votersCert">
            @if(Auth::user()->votersCert)
              <a href="{{ asset('storage/' . Auth::user()->votersCert) }}" target="_blank">View</a>
            @endif
          </div>
          <button type="submit" class="btn-submit">Submit Requirements</button>
        </form>
      </div>
    </main>
  </div>

  <script>
    // Sidebar navigation
    function initializeSidebar() {
      const menuItems = document.querySelectorAll('.menu-item');
      const contentSections = document.querySelectorAll('.content-section');

      menuItems.forEach(item => {
        item.addEventListener('click', function () {
          const sectionName = this.getAttribute('data-section');

          menuItems.forEach(menuItem => menuItem.classList.remove('active'));
          this.classList.add('active');

          contentSections.forEach(section => section.classList.remove('active'));
          const targetSection = document.getElementById(sectionName + '-section');
          if (targetSection) targetSection.classList.add('active');
        });
      });
    }

function initializeJoinButtons() {
  document.querySelectorAll('.activity-card .btn-join').forEach(button => {
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

    // Gallery
    function initializeGallery() {
      document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', function () {
          const title = this.querySelector('h4').textContent;
          const date = this.querySelector('p').textContent;
          alert(`Viewing: ${title} - ${date}`);
        });
      });
    }

    document.addEventListener('DOMContentLoaded', function () {
  // Sidebar / join / gallery (already there)
  initializeSidebar();
  initializeJoinButtons();
  initializeGallery();

  // Dropdown toggle
  document.querySelectorAll('.dropdown').forEach(drop => {
    const toggle = drop.querySelector('.dropdown-toggle');
    const menu = drop.querySelector('.dropdown-menu');

    toggle.addEventListener('click', (e) => {
      e.stopPropagation();
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    });

    document.addEventListener('click', () => {
      menu.style.display = 'none';
    });
  });

  // ================= Modal handling =================
  const modal = document.getElementById("editProfileModal");
  const btn = document.getElementById("editProfileBtn");
  const span = modal ? modal.querySelector(".close") : null;

  if (btn && modal && span) {
    btn.addEventListener("click", function(e) {
      e.preventDefault();
      modal.style.display = "block";
    });

    span.addEventListener("click", function() {
      modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  }
});


  </script>
</body>
</html>