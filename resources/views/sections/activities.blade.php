@extends('mem_dashboard')

@section('title', 'Activities')

@section('content')
  <!--Active Activities -->
  <div class="activity-section">
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
  </div>

  <!-- Upcoming Activities -->
  <div class="activity-section">
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
  </div>
@endsection
