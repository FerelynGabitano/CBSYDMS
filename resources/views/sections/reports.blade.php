@extends('faci_dashboard')

@section('title', 'Reports')

@section('content')
<div class="list-section">
        <h3>Generate Report</h3>

        <form method="GET" action="{{ route('facilitator.reports.filter') }}">
          <label>Choose Type:</label>
          <select name="type" required>
            <option value="">Select Type</option>
            <option value="daily" {{ request('type')=='daily'?'selected':'' }}>Daily</option>
            <option value="monthly" {{ request('type')=='monthly'?'selected':'' }}>Monthly</option>
            <option value="annual" {{ request('type')=='annual'?'selected':'' }}>Annual</option>
          </select>
          <input type="date" name="date" value="{{ request('date') }}">
          <button type="submit" class="btn btn-primary">Filter</button>
          @if(isset($filtered))
          <a href="{{ route('facilitator.reports.pdf', ['type'=>request('type'),'date'=>request('date')]) }}" class="btn btn-primary">Download PDF</a>
          @endif
        </form>

        @if(isset($filtered))
        <h4 style="margin-top:1rem;">Report Results</h4>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Start</th>
              <th>End</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            @forelse($filtered as $a)
              <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->description }}</td>
                <td>{{ \Carbon\Carbon::parse($a->start_datetime)->format('M d, Y h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($a->end_datetime)->format('M d, Y h:i A') }}</td>
                <td>{{ $a->location }}</td>
              </tr>
            @empty
              <tr><td colspan="5">No activities found for this period.</td></tr>
            @endforelse
          </tbody>
        </table>
        @endif
      </div>
@endsection