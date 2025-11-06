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

<div class="w-full text-center py-4">
  <div class="inline-block">
    {{ $noCredentialUsers->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
  </div>
</div>
