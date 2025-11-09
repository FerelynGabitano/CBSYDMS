@extends('admin_dashboard')

@section('title', 'User Management')

@section('content')
<div id="users-section">
  <h1>Users</h1>

  {{-- Search --}}
  <form method="GET" action="{{ route('sections.user_manage') }}" style="text-align: right; margin-bottom: 1rem;">
    <input type="hidden" name="tab" value="{{ $activeTab }}">
    <input type="text" name="search" placeholder="Search name or email"
           value="{{ request('search') }}"
           class="border rounded px-3 py-1 w-64 focus:outline-none focus:ring focus:ring-indigo-300">
    <button type="submit" class="btn">Search</button>
        @if(request('search'))
            <a href="{{ route('sections.user_manage', ['tab' => $activeTab]) }}" class="clear-btn">✕</a>
        @endif
  </form>

  {{-- Tabs as Links --}}
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

  {{-- Display Table --}}
  <div id="tab-content">
    @if ($activeTab === 'no-credentials')
        @include('sections.users_no_credentials')
    @elseif ($activeTab === 'with-credentials')
        @include('sections.users_with_credentials')
    @endif
  </div>
</div>
@endsection

<!-- Edit Modal -->
<div id="editUserModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Manage User</h2>
    <form id="editUserForm" method="POST">
      @csrf @method('PUT')
      <label>Credential Email:</label>
      <input type="email" name="credential_email" id="credential_email" required>

      <label>Role:</label>
      <select name="role_id" id="role" required>
        @foreach($roles as $role)
        <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
        @endforeach
      </select>

      <label>New Password (optional):</label>
      <input type="password" name="password" placeholder="Enter new password">

      <label>Confirm Password:</label>
      <input type="password" name="password_confirmation" placeholder="Confirm new password">

      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</div>

<script>
document.addEventListener('click', function(e) {
  const modal = document.getElementById('editUserModal');
  const form = document.getElementById('editUserForm');
  const emailInput = document.getElementById('credential_email');
  const roleSelect = document.getElementById('role');

  // Open modal
  if (e.target.classList.contains('btn-edit')) {
    e.preventDefault();
    const btn = e.target;
    form.action = `/users/${btn.dataset.userId}`;
    emailInput.value = btn.dataset.credentialEmail || '';
    roleSelect.value = btn.dataset.roleId || '';
    modal.style.display = 'block';
  }

  // Close modal
  if (e.target.classList.contains('close') || e.target === modal) {
    modal.style.display = 'none';
  }
});

// Create reusable popup
function createPopup(color) {
  const popup = document.createElement('div');
  Object.assign(popup.style, {
    position: 'fixed',
    top: '20px',
    left: '50%',
    transform: 'translateX(-50%)',
    backgroundColor: color,
    color: 'white',
    padding: '10px 20px',
    borderRadius: '6px',
    boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
    fontWeight: '600',
    opacity: '0',
    transition: 'opacity 0.3s ease',
    zIndex: '2000'
  });
  document.body.appendChild(popup);
  return popup;
}

const errorPopup = createPopup('#ff4d4d');
const successPopup = createPopup('#4CAF50');

function showPopup(popup, message) {
  popup.textContent = message;
  popup.style.opacity = '1';
  setTimeout(() => popup.style.opacity = '0', 2000);
}

// Handle form submit
const form = document.getElementById('editUserForm');
const passwordInput = form.querySelector('input[name="password"]');
const confirmInput = form.querySelector('input[name="password_confirmation"]');
const modal = document.getElementById('editUserModal');

form.addEventListener('submit', async function(e) {
  e.preventDefault();

  const password = passwordInput.value.trim();
  const confirm = confirmInput.value.trim();

  // ✅ Validate password before sending
  if (password !== '' || confirm !== '') {
    if (password.length < 6) {
      showPopup(errorPopup, 'Password must be at least 6 characters long.');
      return;
    }
    if (password !== confirm) {
      showPopup(errorPopup, 'Passwords do not match.');
      return;
    }
  }

  const formData = new FormData(form);

  try {
    const response = await fetch(form.action, {
      method: 'POST',
      headers: { 
        'X-HTTP-Method-Override': 'PUT', 
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    });

    if (response.ok) {
      showPopup(successPopup, 'User updated successfully! Email sent.');
      modal.style.display = 'none';
      setTimeout(() => location.reload(), 2000);
    } else {
      showPopup(errorPopup, 'Failed to update user.');
    }
  } catch (error) {
    showPopup(errorPopup, 'Error: ' + error.message);
  }
});
</script>

