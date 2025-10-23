<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batang Surigaonon Youth - Dashboard</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body { 
      background-color: #f5f7fa; color: #333; 
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
    .dashboard-header {
      background-color: #1C0BA3; color: white; padding: 1rem 2rem;
      display: flex; justify-content: space-between; align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .logo { display: flex; align-items: center; gap: 10px; }
    .logo img { width: 40px; height: 40px; border-radius: 50%; }
    .btn-logout {
      background-color: #1C0BA3; color: white; border: none; padding: 0.3rem 0.7rem;
      border-radius: 5px; cursor: pointer; margin-left: 10px; font-size: 0.9rem;
    }
    .btn-logout:hover { background-color: #150882; }

    .dashboard-container { display: flex; min-height: calc(100vh - 70px); }
    .sidebar { width: 250px; background: white; padding: 1.5rem 0; box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
    .menu-item {
      padding: 0.8rem 2rem; display: flex; align-items: center; gap: 10px; cursor: pointer;
      transition: all 0.3s;
    }
    .menu-item:hover, .menu-item.active {
      background-color: #f0f2ff; color: #1C0BA3; border-left: 4px solid #1C0BA3;
    }

    .main-content { flex: 1; padding: 2rem; }
    h3 { margin-bottom: 1rem; color: #1C0BA3; }

    .btn { padding: 8px 14px; margin: 5px; border: none; border-radius: 6px; cursor: pointer; }
    .btn-primary { background: #1C0BA3; color: #fff; }
    .btn-warning { background: #1C0BA3; color: #fff; }
    .btn-danger { background: #1C0BA3; color: #fff; }
    .btn:hover { opacity: 0.9; }

    /* Sections */
    .tab-section { display: none; }
    .tab-section.active { display: block; }

    /* Activity Feed */
    .list-section {
      background: white; border-radius: 10px; padding: 1.5rem;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    .activity-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* responsive 2-3 cols */
      gap: 20px;
    }

    .activity-post {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;      
      background: white; border-radius: 10px; margin-bottom: 1.5rem;
      overflow: hidden; box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    .activity-post img { width: 100%; max-height: 250px; object-fit: cover; }
    .post-content { padding: 1rem; }
    .status { display: inline-block; padding: 0.3rem 0.8rem; border-radius: 20px;
      font-size: 0.8rem; font-weight: bold; margin-bottom: 10px; }
    .status.not-started { background: #ffeeba; color: #856404; }
    .status.ongoing { background: #d4edda; color: #155724; }
    .status.complete { background: #cce5ff; color: #004085; }

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

    /* Modal */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0;
      width: 100%; height: 100%; background: rgba(0,0,0,0.6); }
    .modal-content {
      background: #fff; margin: 6% auto; padding: 20px; width: 450px;
      border-radius: 12px; position: relative;
    }
    .modal-header { font-size: 18px; margin-bottom: 10px; }
    .close { position: absolute; right: 15px; top: 10px; font-size: 20px; cursor: pointer; }
    .modal form label { display: block; margin-top: 10px; font-weight: bold; }
    .modal form input, .modal form textarea, .modal form select {
      width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 6px;
    }
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
  </style>
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
      <h2>BSY Facilitator</h2>
    </div>
    <div class="user-actions" style="display:flex;align-items:center;gap:10px;">
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
    <aside class="sidebar">
      <div class="menu-item active" data-target="activities"><i class="fas fa-plus"></i> <span>Activity Feed</span></div>
      <div class="menu-item" data-target="members"><i class="fas fa-users"></i> <span>Members & Attendance</span></div>
      <div class="menu-item" data-target="sponsors"><i class="fas fa-hand-holding-usd"></i> <span>Sponsors</span></div>
      <div class="menu-item" data-target="profile"><i class="fas fa-user"></i> <span>My Profile</span></div>
      <div class="menu-item" data-target="reports"><i class="fa fa-book"></i> <span>Report</span></div>
    </aside>

    <main class="main-content">
        <!-- Activity Feed -->
        <section id="activities" class="tab-section active">
        <div class="list-section">
          <h3>Activity Feed</h3>
          <button class="btn btn-primary" onclick="openModal('addActivityModal')">+ Add Activity</button>
        <div class="activity-grid">
          @foreach($activities as $activity)
            @php
              $now = \Carbon\Carbon::now();
              $start = \Carbon\Carbon::parse($activity->start_datetime);
              $end = \Carbon\Carbon::parse($activity->end_datetime);
              if ($now->lt($start)) {
                $status = 'Not Started'; $statusClass = 'not-started';
              } elseif ($now->between($start, $end)) {
                $status = 'Ongoing'; $statusClass = 'ongoing';
              } else {
                $status = 'Complete'; $statusClass = 'complete';
              }
            @endphp

            <div class="activity-post">
              @if($activity->cover_photo)
                <img src="{{ asset('storage/' . $activity->cover_photo) }}" alt="Activity Cover">
              @endif
              <div class="post-content">
                <span class="status {{ $statusClass }}">{{ $status }}</span>
                <h4>{{ $activity->title }}</h4>
                <p>{{ $activity->description }}</p>
                <p><strong>📍 Location:</strong> {{ $activity->location }}</p>
                <p><strong>📅 When:</strong>
                  {{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }} –
                  {{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}
                </p>
                <p><strong>👥 Max Participants:</strong> {{ $activity->max_participants ?? 'N/A' }}</p>
                <p><strong>⭐ Lead Facilitator:</strong>
                  @if($activity->leadFacilitator)
                    {{ $activity->leadFacilitator->first_name }} {{ $activity->leadFacilitator->last_name }}
                  @else
                    Not Assigned
                  @endif
                </p>

                <!-- Action Buttons -->
                <button class="btn btn-warning" onclick="openModal('editActivityModal{{ $activity->activity_id }}')">Edit</button>
                <form action="{{ route('faci.activity.destroy', $activity->activity_id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this activity?')">Delete</button>
                </form>
              </div>
            </div>

            <!-- Edit Modal for this activity -->
            <div id="editActivityModal{{ $activity->activity_id }}" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeModal('editActivityModal{{ $activity->activity_id }}')">&times;</span>
                <div class="modal-header">Edit Activity</div>
                <form action="{{ route('faci.activity.update', $activity->activity_id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <label>Title</label>
                  <input type="text" name="title" value="{{ $activity->title }}" required>
                  <label>Description</label>
                  <textarea name="description" required>{{ $activity->description }}</textarea>
                  <label>Start Date & Time</label>
                  <input type="datetime-local" name="start_datetime" value="{{ date('Y-m-d\TH:i', strtotime($activity->start_datetime)) }}" required>
                  <label>End Date & Time</label>
                  <input type="datetime-local" name="end_datetime" value="{{ date('Y-m-d\TH:i', strtotime($activity->end_datetime)) }}" required>
                  <label>Location</label>
                  <input type="text" name="location" value="{{ $activity->location }}" required>
                  <label>Max Participants</label>
                  <input type="number" name="max_participants" value="{{ $activity->max_participants }}" min="1">
                  <label>Lead Facilitator</label>
                  <select name="lead_facilitator_id">
                    <option value="">-- Select Facilitator --</option>
                    @foreach($regularFacilitators as $faci)
                      <option value="{{ $faci->user_id }}" {{ $activity->lead_facilitator_id == $faci->user_id ? 'selected' : '' }}>
                        {{ $faci->first_name }} {{ $faci->last_name }}
                      </option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-primary" style="margin-top:15px;">Update</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </section>

            <!-- Profile Section -->
      <section id="profile" class="tab-section">
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
                    <h2>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
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
                    <label>Full Name:</label>
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                  </div>
                  <div class="detail-group">
                    <label>Age:</label>
                    <span>{{ \Carbon\Carbon::parse(Auth::user()->birthdate)->age }} years old</span>
                  </div>
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
                    <span>{{ Auth::user()->gradeLevel }}</span>
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
          <form action="{{ route('faci.profile.update') }}" method="POST">
              @csrf
              @method('PUT')
            
            <div class="detail-group">
              <label for="first_name">First Name:</label>
              <input type="text" name="first_name" value="{{ Auth::user()->first_name }}">
            </div>
            <div class="detail-group">
              <label for="last_name">Last Name:</label>
              <input type="text" name="last_name" value="{{ Auth::user()->last_name }}">
            </div>
            <div class="detail-group">
              <label for="contact_number">Phone:</label>
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
              <label for="yr_lvl">Year Level:</label>
              <input type="text" name="gradeLevel" value="{{ Auth::user()->gradeLevel }}">
            </div>
            <div class="detail-group">
              <label for="skills">Skills/Interests:</label>
              <input type="text" name="skills" value="{{ Auth::user()->skills }}">
            </div>
            <div class="detail-group">
              <label for="emergency_contact">Emergency Contact:</label>
              <input type="text" name="emergency_contact_no" value="{{ Auth::user()->emergency_contact_no }}">
            </div>

            <button type="submit" class="btn-join">Save Changes</button>
          </form>
        </div>
      </div>
      </section>

      <!-- Members Section -->
      <section id="members" class="tab-section">
        <div class="list-section">
          <h3>Members & Attendance</h3>
          <form action="{{ route('faci.attendance.update') }}" method="POST">
            @csrf
            <table>
              <thead>
                <tr><th>Member Name</th><th>Status</th><th>Attendance</th></tr>
              </thead>
              <tbody>
                @foreach($members as $member)
                  <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->status }}</td>
                    <td>
                      <input type="checkbox" name="attendance[{{ $member->id }}]" value="1" {{ $member->attendance ? 'checked' : '' }}>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit">Save Attendance</button>
          </form>
        </div>
      </section>

      <!-- Sponsors Section -->
      <section id="sponsors" class="tab-section">
        <div class="list-section">
          <h3>Sponsors</h3>
          <form action="{{ route('faci.sponsor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Sponsor Name" required>
            <input type="text" name="contact_person" placeholder="Contact Person">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
            <textarea name="address" rows="3" placeholder="Address"></textarea>
            <input type="file" name="logo_path" accept="image/*">
            <button type="submit">Add Sponsor</button>
          </form>
          <ul>
            @foreach($sponsors as $sponsor)
              <li>
                <strong>{{ $sponsor->name }}</strong>
                @if($sponsor->contact_person) - Contact: {{ $sponsor->contact_person }} @endif
                @if($sponsor->email) - Email: {{ $sponsor->email }} @endif
                @if($sponsor->phone) - Phone: {{ $sponsor->phone }} @endif
                @if($sponsor->address) - Address: {{ $sponsor->address }} @endif
                @if($sponsor->logo_path)<br><img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="Logo" width="80">@endif
              </li>
            @endforeach
          </ul>
        </div>
      </section>

  <!-- Add Activity Modal -->
  <div id="addActivityModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('addActivityModal')">&times;</span>
      <div class="modal-header">Add New Activity</div>
      <form action="{{ route('faci.activity.store') }}" method="POST">
        @csrf
        <label>Title</label>
        <input type="text" name="title" required>
        <label>Description</label>
        <textarea name="description" required></textarea>
        <label>Start Date & Time</label>
        <input type="datetime-local" name="start_datetime" required>
        <label>End Date & Time</label>
        <input type="datetime-local" name="end_datetime" required>
        <label>Location</label>
        <input type="text" name="location" required>
        <label>Max Participants</label>
        <input type="number" name="max_participants" min="1">
        <label>Lead Facilitator</label>
            <select name="lead_facilitator_id">
              <option value="">-- Select Facilitator --</option>
                @foreach($regularFacilitators as $faci) 
                <option value="{{ $faci->user_id }}">{{ $faci->first_name }} {{ $faci->last_name }}</option> 
                @endforeach
            </select>
        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Add</button>
      </form>
    </div>
  </div>
  
  <!-- 🧾 Reports Tab -->
    <section id="reports" class="tab-section">
      <div class="list-section">
        <h3>Generate Report</h3>

        <form method="GET" action="{{ route('facilitator.reports.filter') }}">
          <label>Choose Type:</label>
          <select name="type" required>
            <option value="">Select Type</option>
            <option value="daily" {{ request('type')=='daily'?'selected':'' }}>Daily</option>
            <option value="monthly" {{ request('type')=='monthly'?'selected':'' }}>Monthly</option>
            <option value="annual" {{ request('type')=='annual'?'selected':'' }}>Annual</option>
          </select>
          <input type="date" name="date" value="{{ request('date') }}">
          <button type="submit" class="btn btn-primary">Filter</button>
          @if(isset($filtered))
          <a href="{{ route('facilitator.reports.pdf', ['type'=>request('type'),'date'=>request('date')]) }}" class="btn btn-primary">Download PDF</a>
          @endif
        </form>

        @if(isset($filtered))
        <h4 style="margin-top:1rem;">Report Results</h4>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Start</th>
              <th>End</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            @forelse($filtered as $a)
              <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->description }}</td>
                <td>{{ \Carbon\Carbon::parse($a->start_datetime)->format('M d, Y h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($a->end_datetime)->format('M d, Y h:i A') }}</td>
                <td>{{ $a->location }}</td>
              </tr>
            @empty
              <tr><td colspan="5">No activities found for this period.</td></tr>
            @endforelse
          </tbody>
        </table>
        @endif
      </div>
    </section>
    </main>
  </div>

  <script>
    // Sidebar nav switching
    document.querySelectorAll('.menu-item').forEach(item => {
      item.addEventListener('click', function () {
        document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.tab-section').forEach(sec => sec.classList.remove('active'));
        this.classList.add('active');
        const target = this.dataset.target;
        document.getElementById(target).classList.add('active');
      });
    });

    // Modals
    function openModal(id) { document.getElementById(id).style.display = 'block'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    window.onclick = function(event) {
      document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) modal.style.display = 'none';
      });
    }
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
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>
