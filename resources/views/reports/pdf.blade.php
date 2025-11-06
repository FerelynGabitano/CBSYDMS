<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{ $activity->title }} - Report</title>
  <style>
    body { font-family: sans-serif; color: #333; }
    h1 { text-align: center; color: #1E3A8A; }
    p { line-height: 1.6; }
    .info { margin-bottom: 20px; }
  </style>
</head>
<body>
  <h1>{{ $activity->title }}</h1>
  <p><strong>Description:</strong> {{ $activity->description }}</p>
  <p><strong>Location:</strong> {{ $activity->location }}</p>
  <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }}</p>
  <p><strong>End:</strong> {{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}</p>
  <p><strong>Max Participants:</strong> {{ $activity->max_participants ?? 'N/A' }}</p>
  <p><strong>Lead Facilitator:</strong>
    {{ $activity->leadFacilitator?->first_name }} {{ $activity->leadFacilitator?->last_name }}
  </p>
</body>
</html>
