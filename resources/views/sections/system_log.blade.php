@extends('admin_dashboard')

@section('title', 'System Logs')

@section('content')
<div id="system-log-section">
  <h1>System Logs</h1>

  <!-- Search and Filter -->
  <div style="margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
    <input type="text" id="searchLog" placeholder="Search logs..."
           class="border rounded px-3 py-1 w-72 focus:outline-none focus:ring focus:ring-indigo-300">

    <select id="filterType" class="border rounded px-3 py-1 focus:outline-none focus:ring focus:ring-indigo-300">
      <option value="">All Actions</option>
      <option value="create">Create</option>
      <option value="update">Update</option>
      <option value="delete">Delete</option>
      <option value="login">Login</option>
    </select>
  </div>

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
    <tbody id="logTable">
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
      <tr><td colspan="6" style="text-align:center; color:gray; font-style:italic;">No logs available.</td></tr>
      @endforelse
    </tbody>
  </table>

  <!-- Pagination -->
  <div class="w-full text-center py-4">
    <div class="inline-block">
      {{ $logs->links('pagination::simple-tailwind') }}
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchLog');
  const filterSelect = document.getElementById('filterType');
  const rows = document.querySelectorAll('#logTable tr');

  function filterLogs() {
    const query = searchInput.value.toLowerCase();
    const filter = filterSelect.value.toLowerCase();

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const matchesSearch = text.includes(query);
      const matchesFilter = filter === '' || text.includes(filter);
      row.style.display = matchesSearch && matchesFilter ? '' : 'none';
    });
  }

  searchInput.addEventListener('input', filterLogs);
  filterSelect.addEventListener('change', filterLogs);
});
</script>
@endsection
