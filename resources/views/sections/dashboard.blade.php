@extends('admin_dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="welcome-section">
    <h1>Welcome back, Admin!</h1>
    <p>Here's what's happening with BSY today.</p>
</div>

<div class="stats-cards">
    <div class="stat-card"><h3>Total Members</h3><p>{{ $totalMembers }}</p></div>
    <div class="stat-card"><h3>Upcoming Events</h3><p>{{ $upcomingEvents }}</p></div>
    <div class="stat-card"><h3>New Members (This Month)</h3><p>{{ $newMembersThisMonth }}</p></div>
    <div class="stat-card"><h3>Active Projects</h3><p>{{ $activeProjects }}</p></div>
</div>
@endsection