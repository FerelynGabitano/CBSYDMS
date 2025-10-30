@extends('faci_dashboard')

@section('title', 'Activity Feed')

@section('content')
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
          <button class="btn btn-info" onclick="openModal('viewActivityModal{{ $activity->activity_id }}')">View</button>
        </div>
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

      <!-- View Modal -->
      <div id="viewActivityModal{{ $activity->activity_id }}" class="modal">
        <div class="modal-content" style="max-width:600px;">
          <span class="close" onclick="closeModal('viewActivityModal{{ $activity->activity_id }}')">&times;</span>
          <h3>Participants for: {{ $activity->title }}</h3>

          @if($activity->participants && $activity->participants->count() > 0)
            <form action="{{ route('faci.attendance.update', $activity->activity_id) }}" method="POST">
              @csrf
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
                        <td>
                          <input type="checkbox"
                                class="attendance-checkbox"
                                data-user-id="{{ $participant->user_id }}"
                                data-activity-id="{{ $activity->activity_id }}"
                                @if(optional($participant->pivot)->attendance_status === 'attended') checked @endif>
                        </td>


                    </tr>
                    @endforeach
                </tbody>
              </table>
              <button type="submit" class="btn btn-success" style="margin-top:15px;">Save Attendance</button>
            </form>
          @else
            <p>No participants joined yet.</p>
          @endif
        </div>
      </div>
    @endforeach
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
</script>
@endsection
