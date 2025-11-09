@extends('mem_dashboard')

@section('title', 'My Profile')

@section('content')
 <!-- Profile Section -->
      <div id="profile-section" class="content-section">
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-avatar">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                @else
                    {{ strtoupper(substr(Auth::user()->first_name,0,1) . substr(Auth::user()->last_name,0,1)) }}
                @endif
            </div>

            <div class="profile-info">
              <h2>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</h2>
              <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
              <p><i class="fas fa-phone"></i> {{ Auth::user()->contact_number }}</p>
              <p><i class="fas fa-calendar"></i> Member since {{ Auth::user()->created_at->format('F Y') }}</p>
            </div>

            <!-- 3-dot dropdown -->
            <div class="dropdown">
              <i class="fas fa-ellipsis-v dropdown-toggle"></i>
              <div class="dropdown-menu">
                <label for="profilePicUpload">Change Profile Picture</label>
                <a href="#" id="changePasswordBtn">Change Password</a>
                <a href="#" id="editProfileBtn">Edit Information</a>
              </div>
            </div>
          </div>

          <!-- hidden form for profile picture -->
          <form id="profilePicForm" action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
            @csrf
            <input type="file" id="profilePicUpload" name="profile_picture" accept="image/*" onchange="document.getElementById('profilePicForm').submit();">
          </form>

          <div class="profile-details">
            <div class="detail-group">
              <label>Address:</label>
              <span>{{ Auth::user()->street_address . ', ' . Auth::user()->barangay . ', ' . Auth::user()->city_municipality . ', ' . Auth::user()->province . ' ' . Auth::user()->zip_code }}</span>
            </div>
            <div class="detail-group">
              <label>School:</label>
              <span>{{ Auth::user()->school }}</span>
            </div>
            <div class="detail-group">
              <label>Course:</label>
              <span>{{ Auth::user()->course }}</span>
            </div>
            <div class="detail-group">
              <label>Yeal Level:</label>
              <span>{{ Auth::user()->gradeLevel}}</span>
            </div>
            <div class="detail-group">
              <label>Skills/Interests:</label>
              <span>{{ Auth::user()->skills }}</span>
            </div>
            <div class="detail-group">
              <label>Emergency Contact:</label>
              <span>{{ Auth::user()->emergency_contact_no }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= MODAL ================= -->
<div id="changePasswordModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Change Password</h2>
    <form id="changePasswordForm" action="{{ route('member.profile.password.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="detail-group">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>
      </div>
      <div class="detail-group">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
      </div>
      <div class="detail-group">
        <label for="new_password_confirmation">Confirm New Password:</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
      </div>

      <button type="submit" class="btn-join">Update Password</button>
    </form>
  </div>
</div>


      <!-- ================= MODAL ================= -->
<div id="editProfileModal" class="modal-profile">
  <div class="modal-profile-content">
    <span class="close">&times;</span>
    <h2>Edit Profile Information</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

      <div class="form-grid">
        <div class="detail-group">
          <label for="first_name">First Name:</label>
          <input type="text" name="first_name" value="{{ Auth::user()->first_name }}">
        </div>
        <div class="detail-group">
          <label for="middle_name">Middle Name:</label>
          <input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}">
        </div>
        <div class="detail-group">
          <label for="last_name">Last Name:</label>
          <input type="text" name="last_name" value="{{ Auth::user()->last_name }}">
        </div>
        <div class="detail-group">
          <label for="contact_number">Contact Number:</label>
          <input type="text" name="contact_number" value="{{ Auth::user()->contact_number }}">
        </div>
        <div class="detail-group">
          <label for="street_address">Street Address:</label>
          <input type="text" name="street_address" value="{{ Auth::user()->street_address }}">
        </div>
        <div class="detail-group">
          <label for="barangay">Barangay:</label>
          <input type="text" name="barangay" value="{{ Auth::user()->barangay }}">
        </div>
        <div class="detail-group">
          <label for="city_municipality">City / Municipality:</label>
          <input type="text" name="city_municipality" value="{{ Auth::user()->city_municipality }}">
        </div>
        <div class="detail-group">
          <label for="province">Province:</label>
          <input type="text" name="province" value="{{ Auth::user()->province }}">
        </div>
        <div class="detail-group">
          <label for="zip_code">Zip Code:</label>
          <input type="text" name="zip_code" value="{{ Auth::user()->zip_code }}">
        </div>
        <div class="detail-group">
          <label for="school">School:</label>
          <input type="text" name="school" value="{{ Auth::user()->school }}">
        </div>
        <div class="detail-group">
          <label for="course">Course:</label>
          <input type="text" name="course" value="{{ Auth::user()->course }}">
        </div>
        <div class="detail-group">
          <label for="gradeLevel">Year Level:</label>
          <input type="text" name="gradeLevel" value="{{ Auth::user()->gradeLevel }}">
        </div>
        <div class="detail-group">
          <label for="skills">Skills/Interests:</label>
          <input type="text" name="skills" value="{{ Auth::user()->skills }}">
        </div>
        <div class="detail-group">
          <label for="emergency_contact_no">Emergency Contact:</label>
          <input type="text" name="emergency_contact_no" value="{{ Auth::user()->emergency_contact_no }}">
        </div>
      </div>

      <button type="submit" class="btn-join">Save Changes</button>
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Dropdown toggle
  document.querySelectorAll('.dropdown').forEach(drop => {
    const toggle = drop.querySelector('.dropdown-toggle');
    const menu = drop.querySelector('.dropdown-menu');

    toggle.addEventListener('click', e => {
      e.stopPropagation();
      menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    });

    document.addEventListener('click', () => menu.style.display = 'none');
  });

  // Reusable popup
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

  // ================= Edit Profile Modal =================
  const editProfileModal = document.getElementById('editProfileModal');
  const editProfileBtn = document.getElementById('editProfileBtn');
  const editClose = editProfileModal ? editProfileModal.querySelector('.close') : null;

  if (editProfileModal && editProfileBtn && editClose) {
    editProfileBtn.addEventListener('click', e => {
      e.preventDefault();
      editProfileModal.style.display = 'block';
    });
    editClose.addEventListener('click', () => editProfileModal.style.display = 'none');
    window.addEventListener('click', e => { if (e.target === editProfileModal) editProfileModal.style.display = 'none'; });
  }

  // ================= Change Password Modal =================
  const passwordModal = document.getElementById('changePasswordModal');
  const passwordBtn = document.getElementById('changePasswordBtn');
  const passwordClose = passwordModal ? passwordModal.querySelector('.close') : null;
  const passwordForm = document.getElementById('changePasswordForm');

  if (passwordModal && passwordBtn && passwordClose && passwordForm) {
    passwordBtn.addEventListener('click', e => {
      e.preventDefault();
      passwordModal.style.display = 'block';
    });
    passwordClose.addEventListener('click', () => passwordModal.style.display = 'none');
    window.addEventListener('click', e => { if (e.target === passwordModal) passwordModal.style.display = 'none'; });

    passwordForm.addEventListener('submit', async e => {
      e.preventDefault();
      const current = passwordForm.current_password.value.trim();
      const newPassword = passwordForm.new_password.value.trim();
      const confirmPassword = passwordForm.new_password_confirmation.value.trim();

      // Client-side validation
      if (newPassword.length < 6) { showPopup(errorPopup, 'New password must be at least 6 characters long.'); return; }
      if (newPassword !== confirmPassword) { showPopup(errorPopup, 'New passwords do not match.'); return; }

      const formData = new FormData(passwordForm);

      try {
        const response = await fetch(passwordForm.action, {
          method: 'POST',
          headers: {
            'X-HTTP-Method-Override': 'PUT',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });

        const data = await response.json();

        if (response.ok && data.success) {
          showPopup(successPopup, 'Password updated successfully!');
          passwordModal.style.display = 'none';
          setTimeout(() => location.reload(), 2000);
        } else {
          // Show server-side error (wrong current password)
          showPopup(errorPopup, data.message || 'Failed to update password.');
        }
      } catch (err) {
        showPopup(errorPopup, 'Error: ' + err.message);
      }
    });
  }
});
</script>

@endsection
