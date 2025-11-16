@extends('faci_dashboard')

@section('title', 'Manage Scholarships Status')

@section('content')
<div class="content-section">
    <h2>User Scholarship Status</h2>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or status" class="border px-2 py-1 rounded" style="padding:5px; width: 250px;">
        <button type="submit" class="btn">Search</button>
            @if(request('search'))
            <a href="{{ route('sections.user_scholar_stat') }}" class="clear-btn">✕</a>
        @endif
    </form>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Scholarship Status</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
          @foreach($users as $index => $user)
        <tr>
            <td>{{ $users->firstItem() + $index }}</td>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->scholarship_status ?? 'N/A' }}</td>
            <td>
                <form action="{{ route('sections.update_scholar_status', $user->user_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="scholarship_status">
                        @foreach(['Not Started','Ongoing','Accepted','Rejected','Revoked'] as $status)
                            <option value="{{ $status }}" {{ ($user->scholarship_status ?? '') === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-scholar">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>    
    <div class="mt-4">
    {{ $users->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
</div>
@endsection