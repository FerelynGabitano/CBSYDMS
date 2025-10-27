@extends('mem_dashboard')

@section('title', 'My Participation')

@section('content')
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
@endsection
