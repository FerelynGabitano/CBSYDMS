<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Activities Report' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
        }
        h2 {
            text-align: center;
            color: #1C0BA3;
            margin-bottom: 0.25rem;
        }
        p.meta {
            text-align: center;
            margin-top: 0;
            margin-bottom: 1rem;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.75rem;
        }
        th, td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f2f2f2;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>
    <h2>Batang Surigaonon Youth - Activity Report</h2>
    <p class="meta">
        Type: <strong>{{ $type ?? 'All' }}</strong> |
        Date: <strong>{{ \Carbon\Carbon::parse($date ?? now())->toFormattedDateString() }}</strong>
    </p>

    @if(isset($filtered) && $filtered->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Location</th>
                    <th>Lead Facilitator</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filtered as $i => $activity)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $activity->title }}</td>
                        <td style="white-space:pre-wrap;">{{ \Illuminate\Support\Str::limit($activity->description, 250) }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}</td>
                        <td>{{ $activity->location }}</td>
                        <td>
                            @if($activity->lead_facilitator_id)
                                {{ \App\Models\User::find($activity->lead_facilitator_id)->first_name ?? 'N/A' }}
                                {{ \App\Models\User::find($activity->lead_facilitator_id)->last_name ?? '' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">No activities found for this period.</div>
    @endif

    <div class="footer">
        Generated: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}
    </div>
</body>
</html>
