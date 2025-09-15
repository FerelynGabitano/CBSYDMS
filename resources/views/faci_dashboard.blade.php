<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batang Surigaonon Youth - Dashboard</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body { background-color: #f5f7fa; color: #333; }

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
      <div class="menu-item active" data-target="activities"><i class="fas fa-plus"></i> <span>Activity Feed</span></div>
      <div class="menu-item" data-target="members"><i class="fas fa-users"></i> <span>Members & Attendance</span></div>
      <div class="menu-item" data-target="sponsors"><i class="fas fa-hand-holding-usd"></i> <span>Sponsors</span></div>
    </aside>

    <main class="main-content">
      @if(session('success'))
        <div style="background-color:#d4edda;color:#155724;padding:12px;border-radius:6px;margin-bottom:20px;">
          {{ session('success') }}
        </div>
      @endif

        <!-- Activity Feed -->
        <div class="list-section">
          <h3>Activity Feed</h3>
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
            @endforeach
          </div>
          <!-- Activities Section -->
        <section id="activities" class="tab-section active">
          <button class="btn btn-primary" onclick="openModal('addActivityModal')">+ Add Activity</button>
        </div>
              

            <!-- Edit Modal -->
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
    </main>
  </div>

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
        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Add</button>
      </form>
    </div>
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
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>
