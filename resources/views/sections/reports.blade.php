@extends('faci_dashboard')

@section('title', 'Reports')

@section('content')
<div class="list-section">
    <h3>Generate Report</h3>

    {{-- 🔍 Search Bar --}}
    <form method="GET" action="{{ route('sections.reports') }}" class="search-bar">
        <input 
            type="text" 
            name="search" 
            placeholder="Search activity title, description, location..." 
            value="{{ request('search') }}"
        >
        <button type="submit">Search</button>
        @if(request('search'))
            <a href="{{ route('sections.reports') }}" class="clear-btn">✕</a>
        @endif
        <a href="{{ route('facilitator.reports.download') }}?search={{ urlencode($search) }}" class="download-btn">
            Download PDF
        </a>
    </form>

    {{-- 🧩 Activity Grid --}}
    <div class="activity-grid">
        @forelse($activities as $activity)
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
                        <a href="{{ route('facilitator.reports.download.single', $activity->activity_id) }}" class="btn">Download PDF</a>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center; margin-top:20px;">No activities found{{ request('search') ? ' for your search.' : '.' }}</p>
        @endforelse
    </div>
</div>

{{-- 💅 Inline Styles (optional, tweak freely) --}}
<style>
.search-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
}
.search-bar input {
    flex: 1;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.search-bar button {
    padding: 8px 14px;
    border: none;
    background-color: #1C0BA3;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}
.search-bar button:hover {
    background-color: #1C0BA3;
}
.search-bar .clear-btn {
    text-decoration: none;
    color: #888;
    font-size: 18px;
    line-height: 1;
}
</style>
@endsection
