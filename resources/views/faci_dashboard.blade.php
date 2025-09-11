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

    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 70px);
    }

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

    .main-content {
      flex: 1;
      padding: 2rem;
    }

    .form-section,
    .list-section {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    h3 {
      margin-bottom: 1rem;
      color: #1C0BA3;
    }

    input,
    textarea,
    select {
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

    th,
    td {
      padding: 0.8rem;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f0f2ff;
    }

    .activity-post {
      background: white;
      border-radius: 10px;
      margin-bottom: 1.5rem;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    .activity-post img {
      width: 100%;
      max-height: 250px;
      object-fit: cover;
    }

    .post-content {
      padding: 1rem;
    }

    .status {
      display: inline-block;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .status.not-started {
      background: #ffeeba;
      color: #856404;
    }

    .status.ongoing {
      background: #d4edda;
      color: #155724;
    }

    .status.complete {
      background: #cce5ff;
      color: #004085;
    }

    /* tabs */
    .tab-section {
      display: none;
    }

    .tab-section.active {
      display: block;
    }
  </style>
</head>

<body>
  <header class="dashboard-header">
    <div class="logo">
      <img src="{{ asset('images/bsylogo.png') }}" alt="BSY Logo">
      <h2>BSY Facilitator</h2>
    </div>
    <div class="user-actions" style="display:flex;align-items:center;gap:10px;">
      <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
      <img src="{{ asset('images/user-avatar.jpg') }}" alt="Facilitator Avatar"
        style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </div>
  </header>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="menu-item active" data-target="upload"><i class="fas fa-plus"></i> <span>Upload Activity</span></div>
      <div class="menu-item" data-target="members"><i class="fas fa-users"></i> <span>Members & Attendance</span></div>
      <div class="menu-item" data-target="sponsors"><i class="fas fa-hand-holding-usd"></i> <span>Sponsors</span></div>
    </aside>

    <main class="main-content">
      @if(session('success'))
        <div style="background-color:#d4edda;color:#155724;padding:12px;border-radius:6px;margin-bottom:20px;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Upload Activity Section -->
      <section id="upload" class="tab-section active">
        <div class="form-section">
          <h3>Upload New Activity</h3>
          <form action="{{ route('faci.activity.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Activity Title</label>
            <input type="text" name="title" required>
            <label>Description</label>
            <textarea name="description" required></textarea>
            <label>Activity Cover Photo</label>
            <input type="file" name="cover_photo" accept="image/*">
            <label>Location</label>
            <input type="text" name="location" required>
            <label>Max Participants</label>
            <input type="number" name="max_participants" min="1">
            <div style="display:flex;gap:20px;">
              <div style="flex:1">
                <label>Start Date</label>
                <input type="date" name="start_date" required>
              </div>
              <div style="flex:1">
                <label>Start Time</label>
                <input type="time" name="start_time" required>
              </div>
            </div>
            <div style="display:flex;gap:20px;">
              <div style="flex:1">
                <label>End Date</label>
                <input type="date" name="end_date" required>
              </div>
              <div style="flex:1">
                <label>End Time</label>
                <input type="time" name="end_time" required>
              </div>
            </div>
            <h4>Facilitators</h4>
            <div id="facilitators">
              <div class="facilitator-row" style="display:flex;gap:10px;margin-bottom:10px;">
                <input type="text" name="facilitators[0][surname]" placeholder="Surname" required>
                <input type="text" name="facilitators[0][first_name]" placeholder="First Name" required>
                <input type="text" name="facilitators[0][designation]" placeholder="Designation" required>
              </div>
            </div>
            <button type="button" onclick="addFacilitator()">+ Add Facilitator</button><br><br>
            <button type="submit">Post Activity</button>
          </form>
        </div>


        <!-- Activity Feed -->
        <div class="list-section">
          <h3>Activity Feed</h3>
          @foreach($activities as $activity)
            @php
              $now = \Carbon\Carbon::now();
              $start = \Carbon\Carbon::parse($activity->start_date . ' ' . $activity->start_time);
              $end = \Carbon\Carbon::parse($activity->end_date . ' ' . $activity->end_time);
              if ($now->lt($start)) {
                $status = 'Not Started';
                $statusClass = 'not-started';
              } elseif ($now->between($start, $end)) {
                $status = 'Ongoing';
                $statusClass = 'ongoing';
              } else {
                $status = 'Complete';
                $statusClass = 'complete';
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
                  {{ \Carbon\Carbon::parse($activity->start_date)->format('M d, Y') }}
                  {{ $activity->start_time }}
                  –
                  {{ \Carbon\Carbon::parse($activity->end_date)->format('M d, Y') }}
                  {{ $activity->end_time }}
                </p>
                <p><strong>👥 Max Participants:</strong> {{ $activity->max_participants }}</p>
                <p><strong>⭐ Lead Facilitator:</strong>
                  @if($activity->facilitators->count() > 0)
                    {{ $activity->facilitators->first()->first_name }} {{ $activity->facilitators->first()->surname }}
                    ({{ $activity->facilitators->first()->designation }})
                  @else
                    Not Assigned
                  @endif
                </p>
              </div>
            </div>
          @endforeach
        </div>


      </section>

      <!-- Members & Attendance Section -->
      <section id="members" class="tab-section">
        <div class="list-section">
          <h3>Members & Attendance</h3>
          <form action="{{ route('faci.attendance.update') }}" method="POST">
            @csrf
            <table>
              <thead>
                <tr>
                  <th>Member Name</th>
                  <th>Status</th>
                  <th>Attendance</th>
                </tr>
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
                @if($sponsor->logo_path)
                  <br><img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="Logo" width="80">
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </section>
    </main>
  </div>

  <script>
    // Sidebar tab switching
    document.querySelectorAll('.menu-item').forEach(item => {
      item.addEventListener('click', function () {
        document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.tab-section').forEach(sec => sec.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(this.dataset.target).classList.add('active');
      });
    });

    // Add facilitator input fields
    let faciIndex = 1;
    function addFacilitator() {
      const container = document.getElementById('facilitators');
      const row = document.createElement('div');
      row.classList.add('facilitator-row');
      row.style.display = "flex";
      row.style.gap = "10px";
      row.style.marginBottom = "10px";
      row.innerHTML = `
      <input type="text" name="facilitators[${faciIndex}][surname]" placeholder="Surname" required>
      <input type="text" name="facilitators[${faciIndex}][first_name]" placeholder="First Name" required>
      <input type="text" name="facilitators[${faciIndex}][designation]" placeholder="Designation" required>
    `;
      container.appendChild(row);
      faciIndex++;
    }
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>