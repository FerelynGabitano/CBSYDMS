<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{ $title ?? 'Activities Report' }}</title>
  <style>
    body { font-family: sans-serif; color: #333; font-size:12px; }
    h1 { text-align: center; color: #1E3A8A; margin-bottom: 8px; }
    .meta { text-align: center; margin-bottom: 18px; color:#666; }
    .activity { border-bottom: 1px solid #ddd; padding: 10px 0; page-break-inside: avoid; }
    .label { font-weight: bold; color:#1E3A8A; }
    .participants { margin-top:8px; font-size:11px; }
    table { width:100%; border-collapse: collapse; margin-top:8px; }
    th, td { padding:6px; border:1px solid #e8e8e8; text-align:left; font-size:11px; }
    .center { text-align:center; }
    .small { font-size:11px; color:#555; }
  </style>
</head>
<body>
  <h1>Batang Surigaonon Youth</h1>
  <h1>{{ $title ?? 'Activities Report' }}</h1>
  <p class="meta small">Generated on {{ \Carbon\Carbon::now()->format('F d, Y h:i A') }}
    @if(!empty($type)) — {{ $type }} @endif
  </p>

  {{-- CASE A: single activity passed as $activity --}}
  @if(isset($activity))
    <div class="activity">
      <p class="label">Title:</p>
      <p>{{ $activity->title }}</p>

      <p class="label">Description:</p>
      <p>{{ $activity->description }}</p>

      <p>
        <span class="label">Location:</span> {{ $activity->location }}<br>
        <span class="label">Schedule:</span>
        {{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }} — 
        {{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}<br>
        <span class="label">Lead Facilitator:</span>
        {{ $activity->leadFacilitator?->first_name ?? 'N/A' }} {{ $activity->leadFacilitator?->last_name ?? '' }}
        <span class="label">Sponsor:</span> {{ $activity->sponsor?->name ?? 'N/A' }}
      </p>

      {{-- Participants table if available --}}
      @if($activity->relationLoaded('participants') || $activity->participants()->exists())
        @php $participants = $activity->participants()->get(); @endphp
        <div class="participants">
          <p class="label">Participants ({{ $participants->count() }}):</p>
          <table>
            <thead>
              <tr>
                <th class="center">#</th>
                <th>Name</th>
                <th>Participant ID</th>
                <th class="center">Attendance</th>
              </tr>
            </thead>
            <tbody>
              @foreach($participants as $i => $p)
                <tr>
                  <td class="center">{{ $i+1 }}</td>
                  <td>{{ $p->first_name }} {{ $p->last_name }}</td>
                  <td class="small">{{ $p->participant_id ?? $p->user_id ?? '—' }}</td>
                  <td class="center">{{ $p->pivot->attendance_status ?? 'N/A' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="small">No participants data available.</p>
      @endif
    </div>

  {{-- CASE B: collection passed as $activities --}}
@elseif(isset($activities) && $activities->count() > 0)
    @foreach($activities as $idx => $a)
        <div class="activity">
            <p class="label">#{{ $idx + 1 }} — {{ $a->title }}</p>
            <p>{{ \Illuminate\Support\Str::limit($a->description, 400) }}</p>
            <p class="small">
                <strong>Location:</strong> {{ $a->location ?? 'N/A' }} |
                <strong>Schedule:</strong>
                {{ \Carbon\Carbon::parse($a->start_datetime)->format('M d, Y h:i A') }} — 
                {{ \Carbon\Carbon::parse($a->end_datetime)->format('M d, Y h:i A') }}
            </p>
            @if(method_exists($a, 'participants') && $a->participants()->exists())
                @php $count = $a->participants()->count(); @endphp
                <p class="small"><strong>Participants:</strong> {{ $count }}</p>
            @endif
        </div>
    @endforeach
@else
    <p>No activities found for the selected criteria.</p>
@endif

</body>
</html>
