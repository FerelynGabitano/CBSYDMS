@extends('admin_dashboard')

@section('title', 'User Management')

@section('content')
<div id="users-section">
  <h1>Users</h1>

  {{-- 🔍 Search form --}}
  <form method="GET" action="{{ route('sections.user_manage') }}" style="text-align: right; margin-bottom: 1rem;">
    <input type="hidden" name="tab" value="{{ $activeTab }}">
    <input type="text" name="search" placeholder="Search users..."
           value="{{ request('search') }}"
           class="border rounded px-3 py-1 w-64 focus:outline-none focus:ring focus:ring-indigo-300">
    <button type="submit" class="btn">Search</button>
  </form>

  {{-- 🟩 Subtab Navigation as Links --}}
  <div style="margin-bottom: 1rem;">
    <a href="{{ route('sections.user_manage', ['tab' => 'no-credentials']) }}"
       class="subtab-btn {{ $activeTab === 'no-credentials' ? 'active' : '' }}">
       No Credentials
    </a>

    <a href="{{ route('sections.user_manage', ['tab' => 'with-credentials']) }}"
       class="subtab-btn {{ $activeTab === 'with-credentials' ? 'active' : '' }}">
       With Credentials
    </a>
  </div>

  {{-- 🧩 Load Partial --}}
  <div id="tab-content">
    @if ($activeTab === 'no-credentials')
        @include('sections.users_no_credentials')
    @elseif ($activeTab === 'with-credentials')
        @include('sections.users_with_credentials')
    @endif@extends('admin_dashboard')

@section('title', 'User Management')

@section('content')
<div id="users-section">
  <h1>Users</h1>

  {{-- 🔍 Search --}}
  <form method="GET" action="{{ route('sections.user_manage') }}" style="text-align: right; margin-bottom: 1rem;">
    <input type="hidden" name="tab" value="{{ $activeTab }}">
    <input type="text" name="search" placeholder="Search users..."
           value="{{ request('search') }}"
           class="border rounded px-3 py-1 w-64 focus:outline-none focus:ring focus:ring-indigo-300">
    <button type="submit" class="btn">Search</button>
  </form>

  {{-- 🟩 Tabs as Links --}}
  <div style="margin-bottom: 1rem;">
    <a href="{{ route('sections.user_manage', ['tab' => 'no-credentials', 'search' => $search]) }}"
       class="subtab-btn {{ $activeTab === 'no-credentials' ? 'active' : '' }}">
       No Credentials
    </a>

    <a href="{{ route('sections.user_manage', ['tab' => 'with-credentials', 'search' => $search]) }}"
       class="subtab-btn {{ $activeTab === 'with-credentials' ? 'active' : '' }}">
       With Credentials
    </a>
  </div>

  {{-- 🧩 Display Corresponding Table --}}
  <div id="tab-content">
    @if ($activeTab === 'no-credentials')
        @include('sections.users_no_credentials')
    @elseif ($activeTab === 'with-credentials')
        @include('sections.users_with_credentials')
    @endif
  </div>
</div>
@endsection

  </div>
</div>
@endsection
