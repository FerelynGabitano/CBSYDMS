<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Batang Surigaonon Youth')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
  <!-- Success Popup -->
  @if (session('success'))
    <div id="success-popup" class="success-popup">
      <strong>{{ session('success') }}</strong>
    </div>
      <script>
        setTimeout(() => {
          const popup = document.getElementById('success-popup');
            if (popup) popup.style.display = 'none';
          }, 6000);
      </script>
      <style>
      @keyframes fadeInDown {
        from { opacity: 0; transform: translate(-50%, -30px); }
        to { opacity: 1; transform: translate(-50%, 0); }
      }
      </style>
  @endif
  
  <!-- Header -->
  <header class="dashboard-header">
    <div class="logo">
      <img src="{{ asset('images/bsylogo.png') }}" alt="BSY Logo">
      <h2>Batang Surigaonon Youth</h2>
    </div>
    <div class="user-menu">
      <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
      <div style="width:36px;height:36px;border-radius:50%;overflow:hidden;">
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
      </div>
      <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </form>
    </div>
  </header>

  <!-- Layout Wrapper -->
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <a href="{{ route('sections.activities') }}" class="menu-item {{ request()->routeIs('sections.activities') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt"></i> Activities
      </a>
      <a href="{{ route('sections.profile') }}" class="menu-item {{ request()->routeIs('sections.profile') ? 'active' : '' }}">
          <i class="fas fa-user"></i> My Profile
      </a>

      <a href="{{ route('sections.participation') }}" class="menu-item {{ request()->routeIs('sections.participation') ? 'active' : '' }}">
        <i class="fas fa-check-circle"></i> My Participation
      </a>
      <a href="{{ route('sections.gallery') }}" class="menu-item {{ request()->routeIs('sections.gallery') ? 'active' : '' }}">
        <i class="fas fa-images"></i> Gallery
      </a>
      <a href="{{ route('sections.scholarships') }}" class="menu-item {{ request()->routeIs('sections.scholarships') ? 'active' : '' }}">
        <i class="fa-solid fa-graduation-cap"></i> Scholarship
      </a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      @yield('content')
    </main>
  </div>
</body>
</html>
