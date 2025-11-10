@extends('faci_dashboard')

@section('title', 'Sponsors')

@section('content')
<div class="sponsor-section">
  <div class="sponsor-header">
    <h3>Partners</h3>
    <button id="openAddModal">+ Add Partner</button>
  </div>

  <form method="GET" action="{{ route('faci.sponsor.index') }}" style="display:inline-block; margin-right:15px;">
        <input type="text" name="search" placeholder="Search partners..." value="{{ request('search') }}" style="padding:5px; width: 200px;">
        <button type="submit" class="btn btn-secondary">Search</button>
        @if(request('search'))
            <a href="{{ route('faci.sponsor.index') }}" class="clear-btn">✕</a>
        @endif
    </form>

  {{-- Sponsor Grid --}}
  @if($sponsors->count() > 0)
  <div class="sponsor-grid">
    @foreach($sponsors as $sponsor)
      <div class="sponsor-card">
        <strong>{{ $sponsor->name }}</strong>
        <div class="sponsor-info">
          @if($sponsor->contact_person) 👤 {{ $sponsor->contact_person }} <br>@endif
          @if($sponsor->email) 📧 {{ $sponsor->email }} <br>@endif
          @if($sponsor->phone) ☎️ {{ $sponsor->phone }} <br>@endif
          @if($sponsor->address) 📍 {{ $sponsor->address }} @endif
        </div>
        <div class="sponsor-actions">
          {{-- Edit Button --}}
          <button class="edit-btn" 
            data-id="{{ $sponsor->sponsor_id }}" 
            data-name="{{ $sponsor->name }}" 
            data-contact="{{ $sponsor->contact_person }}" 
            data-email="{{ $sponsor->email }}" 
            data-phone="{{ $sponsor->phone }}" 
            data-address="{{ $sponsor->address }}">
            Edit
          </button>

          {{-- Delete Form --}}
          <form action="{{ route('faci.sponsor.destroy', ['id' => $sponsor->sponsor_id]) }}" 
                method="POST" 
                onsubmit="return confirm('Are you sure you want to delete this sponsor?');" 
                style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Delete</button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
  @else
    <p style="text-align:center; color:#666;">No sponsors yet. Click “Add Sponsor” to start.</p>
  @endif
</div>

{{-- Add Sponsor Modal --}}
<div class="modal" id="addModal">
  <div class="modal-content">
    <span class="close-btn" id="closeAdd">&times;</span>
    <h4>Add Sponsor</h4>
    <form action="{{ route('faci.sponsor.store') }}" method="POST">
      @csrf
      <input type="text" name="name" placeholder="Sponsor Name" required>
      <input type="text" name="contact_person" placeholder="Contact Person">
      <input type="email" name="email" placeholder="Email">
      <input type="text" name="phone" placeholder="Phone">
      <textarea name="address" rows="3" placeholder="Address"></textarea>
      <button type="submit">Add Sponsor</button>
    </form>
  </div>
</div>

{{-- Edit Sponsor Modal --}}
<div class="modal" id="editModal">
  <div class="modal-content">
    <span class="close-btn" id="closeEdit">&times;</span>
    <h4>Edit Sponsor</h4>
    <form id="editForm" method="POST">
      @csrf
      @method('PUT')
      <input type="text" name="name" id="editName" required>
      <input type="text" name="contact_person" id="editContact">
      <input type="email" name="email" id="editEmail">
      <input type="text" name="phone" id="editPhone">
      <textarea name="address" id="editAddress" rows="3"></textarea>
      <button type="submit">Update Sponsor</button>
    </form>
  </div>
</div>

<div class="w-full text-center py-4">
      <div class="inline-block">
        {{ $sponsors->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
      </div>
    </div>

<script>
  // Add Sponsor Modal
  const addModal = document.getElementById('addModal');
  document.getElementById('openAddModal').onclick = () => addModal.style.display = 'flex';
  document.getElementById('closeAdd').onclick = () => addModal.style.display = 'none';
  addModal.onclick = e => { if (e.target === addModal) addModal.style.display = 'none'; };

  // Edit Sponsor Modal
  const editModal = document.getElementById('editModal');
  const closeEdit = document.getElementById('closeEdit');
  const editForm = document.getElementById('editForm');

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      document.getElementById('editName').value = btn.dataset.name;
      document.getElementById('editContact').value = btn.dataset.contact;
      document.getElementById('editEmail').value = btn.dataset.email;
      document.getElementById('editPhone').value = btn.dataset.phone;
      document.getElementById('editAddress').value = btn.dataset.address;

      // ✅ use correct route URL
      editForm.action = `/facilitator/sponsor/${id}`;
      editModal.style.display = 'flex';
    });
  });

  closeEdit.onclick = () => editModal.style.display = 'none';
  editModal.onclick = e => { if (e.target === editModal) editModal.style.display = 'none'; };
</script>
@endsection
