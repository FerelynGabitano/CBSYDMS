@extends('faci_dashboard')

@section('title', 'Reports')

@section('content')
<div class="list-section">
    <h3>Generate Report</h3>

    {{-- 🔍 Search + Year Filter --}}
    <form method="GET" action="{{ route('sections.reports') }}" class="search-bar">
        <input 
            type="text" 
            name="search" 
            placeholder="Search activity title, description, location, partners..." 
            value="{{ request('search') }}"
        >

        {{-- 📅 Year Filter --}}
        <select name="year" class="year-filter">
            <option value="">All Years</option>
            @php
                $currentYear = now()->year;
                $startYear = $activities->min(fn($a) => \Carbon\Carbon::parse($a->start_datetime)->year) ?? ($currentYear - 5);
            @endphp
            @for ($y = $currentYear; $y >= $startYear; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>

        <button type="submit">Search</button>

        @if(request('search') || request('year'))
            <a href="{{ route('sections.reports') }}" class="clear-btn">✕</a>
        @endif

        <a href="{{ route('facilitator.reports.download') }}?search={{ urlencode(request('search')) }}&year={{ request('year') }}" class="download-btn">
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
                        {{ $start->format('M d, Y h:i A') }} – {{ $end->format('M d, Y h:i A') }}
                    </p>
                    <p><strong>👥 Max Participants:</strong> {{ $activity->max_participants ?? 'N/A' }}</p>
                    <p><strong>⭐ Lead Facilitator:</strong>
                        @if($activity->leadFacilitator)
                            {{ $activity->leadFacilitator->first_name }} {{ $activity->leadFacilitator->last_name }}
                        @else
                            Not Assigned
                        @endif
                    </p>
                    <p><strong>🏢 Sponsor:</strong>
                        {{ $activity->sponsor->name ?? 'None' }}
                    </p>

                    <div class="buttons">
                        <a href="{{ route('facilitator.reports.preview', $activity->activity_id) }}" target="_blank" class="btn">Preview PDF</a>
                        <a href="{{ route('facilitator.reports.download.single', $activity->activity_id) }}" class="btn">Download PDF</a>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center; margin-top:20px;">No activities found{{ request('search') || request('year') ? ' for your filters.' : '.' }}</p>
        @endforelse
    </div>
</div>

@if($activities->hasPages())
<div class="w-full text-center py-4">
    <div class="inline-block">
        {{ $activities->appends(['search' => request('search'), 'year' => request('year')])->links('pagination::simple-tailwind') }}
    </div>
</div>
@endif

{{-- 💅 Inline Styles --}}
<style>
.search-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.search-bar input {
    flex: 1;
    min-width: 350px; /* ✅ Wider search bar */
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.year-filter {
    width: 120px;
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
    background-color: #16088a;
}
.search-bar .clear-btn {
    text-decoration: none;
    color: #888;
    font-size: 18px;
}
.download-btn {
    background: #1C0BA3;
    color: #fff;
    padding: 8px 14px;
    text-decoration: none;
    border-radius: 6px;
}
.download-btn:hover {
    background: #16088a;
}
</style>
@endsection
