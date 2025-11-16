@extends('faci_dashboard')

@section('title', 'Activity Feed')

@section('content')
<div class="list-section">
  <h3>Activity Feed</h3>

  <button class="btn btn-primary" onclick="openModal('addActivityModal')">+ Add Activity</button>

  <form method="GET" action="{{ route('sections.activities_feed') }}" style="margin-bottom:15px;">
    <input type="text" name="search" placeholder="Search activities..." value="{{ request('search') }}"style="padding:5px; width: 200px;">
    <button type="submit" class="btn btn-secondary">Search</button>
    @if(request('search'))
      <a href="{{ route('sections.activities_feed') }}" class="clear-btn">✕</a>
    @endif
  </form>

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
          <p><strong>🏢 Partner:</strong>
            @if($activity->sponsor)
              {{ $activity->sponsor->name }}
            @else
              None
            @endif
          </p>

          <!-- Action Buttons -->
          <button class="btn btn-warning" onclick="openModal('editActivityModal{{ $activity->activity_id }}')">Edit</button>
          <form action="{{ route('faci.activity.destroy', $activity->activity_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this activity?')">Delete</button>
          </form>
          <button class="btn btn-info" onclick="openModal('viewActivityModal{{ $activity->activity_id }}')">View</button>
        </div>
      </div>

      <!-- Edit Activity Modal -->
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
            <label>Partner</label>
            <select name="sponsor_id">
              <option value="">-- None --</option>
              @foreach($sponsors as $sponsor)
                <option value="{{ $sponsor->sponsor_id }}" {{ $activity->sponsor_id == $sponsor->sponsor_id ? 'selected' : '' }}>
                  {{ $sponsor->name }}
                </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary" style="margin-top:15px;">Update</button>
          </form>
        </div>
      </div>

      <!-- View Activity Modal -->
      <div id="viewActivityModal{{ $activity->activity_id }}" class="modal">
        <div class="modal-content" style="max-width:600px;">
          <span class="close" onclick="closeModal('viewActivityModal{{ $activity->activity_id }}')">&times;</span>
          <h3>Participants for: {{ $activity->title }}</h3>

          @if($activity->participants && $activity->participants->count() > 0)
            <table style="width:100%; border-collapse:collapse;">
              <thead>
                <tr>
                  <th style="text-align:left;">Name</th>
                  <th style="text-align:center;">Present</th>
                </tr>
              </thead>
              <tbody>
                @foreach($activity->participants as $participant)
                  <tr>
                    <td>{{ $participant->first_name }} {{ $participant->last_name }}</td>
                    <td class="center">
                      <input type="checkbox"
                        class="attendance-checkbox"
                        data-user-id="{{ $participant->user_id }}"
                        data-activity-id="{{ $activity->activity_id }}"
                        data-url="{{ route('faci.attendance.update', $activity->activity_id) }}"
                        {{ optional($participant->pivot)->attendance_status === 'attended' ? 'checked' : '' }}>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p>No participants joined yet.</p>
          @endif
        </div>
      </div>

    @endforeach <!-- End of activities loop -->
  </div>

  <!-- Pagination -->
  <div class="w-full text-center py-4">
    <div class="inline-block">
      {{ $activities->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
    </div>
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
        <label>Lead Facilitator</label>
        <select name="lead_facilitator_id">
          <option value="">-- Select Facilitator --</option>
          @foreach($regularFacilitators as $faci)
            <option value="{{ $faci->user_id }}">{{ $faci->first_name }} {{ $faci->last_name }}</option>
          @endforeach
        </select>
        <label>Partner</label>
        <select name="sponsor_id">
          <option value="">-- None --</option>
          @foreach($sponsors as $sponsor)
            <option value="{{ $sponsor->sponsor_id }}">{{ $sponsor->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Add</button>
      </form>
    </div>
  </div>
</div>

<script>
function openModal(id) { document.getElementById(id).style.display = 'block'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }
window.onclick = function(event) {
  document.querySelectorAll('.modal').forEach(modal => {
    if (event.target === modal) modal.style.display = 'none';
  });
}

// Attendance AJAX
document.querySelectorAll('.attendance-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const userId = this.dataset.userId;
        const activityId = this.dataset.activityId;
        const url = this.dataset.url;
        const status = this.checked ? 'attended' : 'absent';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ attendance: { [userId]: status } })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                console.log('Attendance updated for user:', userId);
            }
        })
        .catch(err => console.error('Error updating attendance:', err));
    });
});
// Reusable popup creation (same as your style)
function createPopup(color) {
  const popup = document.createElement('div');
  Object.assign(popup.style, {
    position: 'fixed',
    top: '20px',
    left: '50%',
    transform: 'translateX(-50%)',
    backgroundColor: color,
    color: 'white',
    padding: '10px 20px',
    borderRadius: '6px',
    boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
    fontWeight: '600',
    opacity: '0',
    transition: 'opacity 0.3s ease',
    zIndex: '2000'
  });
  document.body.appendChild(popup);
  return popup;
}

const errorPopup = createPopup('#ff4d4d');

function showPopup(popup, message) {
  popup.textContent = message;
  popup.style.opacity = '1';
  setTimeout(() => popup.style.opacity = '0', 3000);
}

// Form validation
document.querySelectorAll('form[action*="activity"]').forEach(form => {
  form.addEventListener('submit', function(e) {
    const startInput = form.querySelector('input[name="start_datetime"]');
    const endInput = form.querySelector('input[name="end_datetime"]');

    if (startInput && endInput) {
      const start = new Date(startInput.value);
      const end = new Date(endInput.value);

      if (end < start) {
        e.preventDefault();
        showPopup(errorPopup, '⚠️ The end date/time cannot be earlier than the start date/time.');
      }
    }
  });
});
</script>
@endsection
