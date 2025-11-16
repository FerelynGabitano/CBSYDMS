@extends('admin_dashboard')

@section('title', 'System Logs')

@section('content')
<div id="system-log-section">
  <h1>System Logs</h1>

  <!-- Search -->
  <form method="GET" action="{{ route('system_log') }}" 
        style="margin-bottom: 1rem; display: flex; justify-content: flex-end; align-items: center; gap: 8px;">
    <input type="text" name="search" placeholder="Search name or action"
           value="{{ request('search') }}"
           style="padding:5px; width: 250px;"
           class="border rounded px-3 py-1 focus:outline-none focus:ring focus:ring-indigo-300">
    <button type="submit" class="btn">Search</button>
    @if(request('search'))
            <a href="{{ route('system_log')}}" class="clear-btn">✕</a>
        @endif
  </form>

  <!-- Logs Table -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Action</th>
        <th>Details</th>
        <th>IP Address</th>
        <th>Date & Time</th>
      </tr>
    </thead>
    <tbody>
      @forelse($logs as $log)
      <tr>
        <td>{{ $log->log_id }}</td>
        <td>
          @if($log->user)
            {{ $log->user->first_name . ' ' . $log->user->last_name }}
          @else
            <span style="color: gray; font-style: italic;">System</span>
          @endif
        </td>
        <td>{{ ucfirst($log->action) }}</td>
        <td>{{ $log->details }}</td>
        <td>{{ $log->ip_address }}</td>
        <td>{{ $log->created_at->format('M d, Y h:i A') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="6" style="text-align:center; color:gray; font-style:italic;">No logs available.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="w-full text-center py-4">
    <div class="inline-block">
      {{ $logs->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
    </div>
  </div>
</div>
@endsection
