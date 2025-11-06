@extends('faci_dashboard')

@section('title', 'Reports')

@section('content')
<div class="list-section">
    <h3>Generate Report</h3>

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

                    <div class="buttons">
                      <a href="{{ route('facilitator.reports.preview', $activity->activity_id) }}" target="_blank" class="btn">Preview PDF</a>
                      <a href="{{ route('facilitator.reports.download', $activity->activity_id) }}" class="btn">Download PDF</a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
