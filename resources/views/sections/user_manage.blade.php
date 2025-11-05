@extends('admin_dashboard')

@section('title', 'User Management')

@section('content')

<div id="users-section">
  <h1>Users</h1>
<form method="GET" action="{{ route('sections.user_manage') }}" style="text-align: right; margin-bottom: 1rem;">
    <input type="hidden" name="tab" value="{{ $activeTab }}">
    <input type="text" name="search" placeholder="Search users..."
           value="{{ request('search') }}"
           class="border rounded px-3 py-1 w-64 focus:outline-none focus:ring focus:ring-indigo-300">
    <button type="submit" class="btn">Search</button>
</form>
  <div style="margin-bottom: 1rem;">
    <button class="subtab-btn active" data-tab="no-credentials">No Credentials</button>
    <button class="subtab-btn" data-tab="with-credentials">With Credentials</button>
  </div>

  <!-- No Credentials Tab -->
  <div id="no-credentials" class="user-tab active">
    <table>
      <thead>
        <tr>
          <th>Name</th><th>Gender</th><th>Contact No.</th><th>Email</th>
          <th>Address</th><th>Credential Email</th><th>Role</th>
          <th>Joined Since</th><th>Actions</th>
        </tr>
      </thead>
      <tbody id="noCredTable">
        @forelse($noCredentialUsers as $user)
        <tr>
          <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
          <td>{{ $user->gender }}</td>
          <td>{{ $user->contact_number }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->street_address }} {{ $user->barangay }} {{ $user->city_municipality }} {{ $user->province }} {{ $user->zip_code }}</td>
          <td>—</td>
          <td>{{ $user->role ? $user->role->role_name : 'No role' }}</td>
          <td>{{ $user->created_at->format('M d, Y') }}</td>
          <td>
            <a href="#" class="btn btn-edit" data-user-id="{{ $user->user_id }}" data-credential-email="" data-role-id="{{ $user->role_id ?? '' }}">Edit</a>
            <form action="{{ route('users.destroy', ['user_id' => $user->user_id]) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" style="text-align:center; font-style:italic; color:gray;">No new users.</td></tr>
        @endforelse
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="w-full text-center py-4">
      <div class="inline-block">
        {{ $noCredentialUsers->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
      </div>
    </div>
  </div>

  <!-- With Credentials Tab -->
  <div id="with-credentials" class="user-tab" style="display:none;">
    <table>
      <thead>
        <tr>
          <th>Name</th><th>Gender</th><th>Contact No.</th><th>Email</th>
          <th>Address</th><th>Credential Email</th><th>Role</th>
          <th>Joined Since</th><th>Actions</th>
        </tr>
      </thead>
      <tbody id="withCredTable">
        @forelse($withCredentialUsers as $user)
        <tr>
          <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
          <td>{{ $user->gender }}</td>
          <td>{{ $user->contact_number }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->street_address }} {{ $user->barangay }} {{ $user->city_municipality }} {{ $user->province }} {{ $user->zip_code }}</td>
          <td>{{ $user->credential_email }}</td>
          <td>{{ $user->role ? $user->role->role_name : 'No role' }}</td>
          <td>{{ $user->created_at->format('M d, Y') }}</td>
          <td>
            <a href="#" class="btn btn-edit" data-user-id="{{ $user->user_id }}" data-credential-email="{{ $user->credential_email }}" data-role-id="{{ $user->role_id ?? '' }}">Edit</a>
            <form action="{{ route('users.destroy', ['user_id' => $user->user_id]) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" style="text-align:center; font-style:italic; color:gray;">No users with credentials.</td></tr>
        @endforelse
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="w-full text-center py-4">
      <div class="inline-block">
        {{ $withCredentialUsers->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div id="editUserModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Manage User</h2>
    <div id="modalSuccess" class="alert-success" style="display:none;">User updated successfully!</div>
    <div id="modalError" class="alert-error" style="display:none;">Something went wrong.</div>
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
      <label>New Password (leave blank to keep current):</label>
      <input type="password" name="password" placeholder="Enter new password">
      <label>Confirm Password:</label>
      <input type="password" name="password_confirmation" placeholder="Confirm new password">
      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
  // --- Live search for No Credentials ---
  const searchNoCred = document.getElementById('searchNoCred');
  const noCredTable = document.getElementById('noCredTable');

  searchNoCred.addEventListener('keyup', function() {
    const query = this.value.toLowerCase();
    const rows = noCredTable.querySelectorAll('tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });

  // --- Live search for With Credentials ---
  const searchWithCred = document.getElementById('searchWithCred');
  const withCredTable = document.getElementById('withCredTable');

  searchWithCred.addEventListener('keyup', function() {
    const query = this.value.toLowerCase();
    const rows = withCredTable.querySelectorAll('tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
});
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('editUserModal');
  const closeBtn = modal.querySelector('.close');
  const editButtons = document.querySelectorAll('.btn-edit');
  const form = document.getElementById('editUserForm');
  const credentialInput = document.getElementById('credential_email');
  const roleSelect = document.getElementById('role');

  // 🔹 Create red popup for errors
  const popup = document.createElement('div');
  popup.id = 'errorPopup';
  Object.assign(popup.style, {
    position: 'absolute',
    top: '15px',
    left: '50%',
    transform: 'translateX(-50%)',
    backgroundColor: '#ff4d4d',
    color: 'white',
    padding: '10px 20px',
    borderRadius: '6px',
    boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
    fontWeight: '600',
    display: 'none',
    opacity: '0',
    transition: 'opacity 0.3s ease',
    zIndex: '1500'
  });
  modal.querySelector('.modal-content').appendChild(popup);

  function showErrorPopup(message) {
    popup.textContent = message;
    popup.style.display = 'block';
    popup.style.opacity = '1';
    setTimeout(() => {
      popup.style.opacity = '0';
      setTimeout(() => popup.style.display = 'none', 300);
    }, 2000);
  }

  // Modal open
  editButtons.forEach(button => {
    button.addEventListener('click', e => {
      e.preventDefault();
      const userId = button.dataset.userId;
      const credentialEmail = button.dataset.credentialEmail;
      const roleId = button.dataset.roleId;
      form.action = `/users/${userId}`;
      credentialInput.value = credentialEmail || '';
      roleSelect.value = roleId || '';
      modal.style.display = 'block';
    });
  });

  // Modal close
  closeBtn.onclick = () => modal.style.display = 'none';
  window.onclick = e => { if (e.target === modal) modal.style.display = 'none'; };

  // Subtabs + persistent active state
  const subtabButtons = document.querySelectorAll('.subtab-btn');
  const userTabs = document.querySelectorAll('.user-tab');

  // --- Detect active tab from PHP or URL/localStorage ---
  const phpActiveTab = "{{ $activeTab ?? 'no-credentials' }}";
  const urlParams = new URLSearchParams(window.location.search);
  const urlTab = urlParams.get('tab');
  const savedTab = localStorage.getItem('activeUserTab');
  const activeTab = urlTab || savedTab || phpActiveTab || 'no-credentials';

  // --- Apply active tab ---
  subtabButtons.forEach(b => b.classList.remove('active'));
  userTabs.forEach(t => t.style.display = 'none');
  document.querySelector(`.subtab-btn[data-tab="${activeTab}"]`)?.classList.add('active');
  document.getElementById(activeTab).style.display = 'block';

  // --- Save clicked tab and modify pagination links ---
  subtabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      subtabButtons.forEach(b => b.classList.remove('active'));
      userTabs.forEach(t => t.style.display = 'none');
      btn.classList.add('active');
      document.getElementById(btn.dataset.tab).style.display = 'block';
      localStorage.setItem('activeUserTab', btn.dataset.tab);

      // Update pagination links with correct ?tab=...
      document.querySelectorAll('.pagination a').forEach(link => {
        const url = new URL(link.href);
        url.searchParams.set('tab', btn.dataset.tab);
        link.href = url.toString();
      });
    });
  });

  // --- Fix pagination links on page load too ---
  document.querySelectorAll('.pagination a').forEach(link => {
    const url = new URL(link.href);
    url.searchParams.set('tab', activeTab);
    link.href = url.toString();
  });

  // 🔸 Password validation + AJAX submit
const passwordInput = form.querySelector('input[name="password"]');
const confirmInput = form.querySelector('input[name="password_confirmation"]');

form.addEventListener('submit', async function(e) {
  e.preventDefault();

  const password = passwordInput.value.trim();
  const confirm = confirmInput.value.trim();
  if (password !== '' || confirm !== '') {
    if (password !== confirm) {
      showErrorPopup('Passwords do not match.');
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
      showSuccessPopup(" User updated successfully! Email sent.");
      modal.style.display = 'none';
      setTimeout(() => location.reload(), 2000);
    } else {
      showErrorPopup("Failed to update user.");
    }
  } catch (error) {
    showErrorPopup("Error: " + error.message);
  }
});

// 🔹 Success popup (fixed)
function showSuccessPopup(message) {
  const popup = document.createElement('div');
  popup.textContent = message;
  Object.assign(popup.style, {
    position: 'fixed',
    top: '20px',
    left: '50%',
    transform: 'translateX(-50%)',
    backgroundColor: '#d7f8d8',
    color: '#1c7e20',
    border: '1px solid #b2e6b3',
    padding: '15px 25px',
    borderRadius: '8px',
    boxShadow: '0 4px 8px rgba(0,0,0,0.1)',
    zIndex: '9999',
    fontFamily: 'Segoe UI, sans-serif',
    minWidth: '300px',
    textAlign: 'center',
    animation: 'fadeInDown 0.5s ease',
  });
  document.body.appendChild(popup);
  setTimeout(() => popup.remove(), 3000);
}
});
</script>

@endsection
