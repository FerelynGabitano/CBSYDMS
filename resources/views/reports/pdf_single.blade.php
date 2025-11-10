<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{ $activity->title }} - Activity Report</title>
  <style>
    body { font-family: Arial, sans-serif; color: #333; margin: 20px; font-size: 14px; }
    h1 { text-align: center; color: #1E3A8A; margin-bottom: 5px; }
    .info { margin-bottom: 15px; }
    .label { font-weight: bold; color: #1E3A8A; }
    .section { margin-top: 25px; }
    hr { border: none; border-top: 1px solid #ccc; margin: 20px 0; }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      font-size: 13px;
    }

    th {
      background-color: #1E3A8A;
      color: #fff;
      text-transform: uppercase;
      font-size: 12px;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .no-participants {
      text-align: center;
      color: #777;
      font-style: italic;
    }
  </style>
</head>
<body>
  <h1>Batang Surigaonon Youth</h1>
  <h1>{{ $activity->title }}</h1>
  <p><strong>Description:</strong> {{ $activity->description }}</p>

  <div class="info">
    <p><span class="label">Location:</span> {{ $activity->location }}</p>
    <p><span class="label">Schedule:</span>
      {{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }} – 
      {{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}
    </p>
    <p><span class="label">Max Participants:</span> {{ $activity->max_participants ?? 'N/A' }}</p>
    <p><span class="label">Lead Facilitator:</span>
      {{ $activity->leadFacilitator?->first_name }} {{ $activity->leadFacilitator?->last_name }}
      <span class="label">Sponsor:</span> {{ $activity->sponsor?->name ?? 'N/A' }}
    </p>
  </div>

  <hr>

  <div class="section">
    <h2 style="color:#1E3A8A;">Participants & Attendance</h2>

    @if($activity->participants && $activity->participants->count() > 0)
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Attendance</th>
          </tr>
        </thead>
        <tbody>
          @foreach($activity->participants as $index => $participant)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $participant->first_name }} {{ $participant->last_name }}</td>
              <td>{{ $participant->contact_number ?? 'N/A' }}</td>
              <td>{{ $participant->email ?? 'N/A' }}</td>
              <td>
                {{ ucfirst($participant->pivot->attendance_status ?? 'Not Recorded') }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="no-participants">No participants found for this activity.</p>
    @endif
  </div>

  <hr>

  <p><small>Generated on {{ now()->format('F d, Y h:i A') }}</small></p>
</body>
</html>
