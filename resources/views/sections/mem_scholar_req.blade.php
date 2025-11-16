@extends('faci_dashboard')

@section('title', 'Member Scholarship Requirements')

@section('content')
<div class="container">
    <h2>Member Scholarship Documents</h2>

    {{-- 🔍 Search form --}}
    <form action="{{ route('sections.mem_scholar_req') }}" method="GET" style="margin-bottom: 20px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search name or status" 
            style="padding:5px; width: 200px;"
        >
        <button type="submit" class="btn">Search</button>
        @if(request('search'))
            <a href="{{ route('sections.mem_scholar_req') }}" class="clear-btn">✕</a>
        @endif
    </form>

    <table class="table" border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th>Name</th>
                <th>Email</th>
                <th>Voter's Certificate</th>
                <th>COR</th>
                <th>ID Picture</th>
                <th>Grade Report</th>
                <th>Birth Certificate</th>
                <th>Barangay Certificate</th>
                <th>Scholarship Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                    <td>{{ $member->email }}</td>

                    {{-- File columns --}}
                    <td>
                        @if($member->votersCert)
                            <a href="{{ asset('storage/'.$member->votersCert) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($member->cor)
                            <a href="{{ asset('storage/'.$member->cor) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($member->idPicture)
                            <a href="{{ asset('storage/'.$member->idPicture) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($member->gradeReport)
                            <a href="{{ asset('storage/'.$member->gradeReport) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($member->birthCert)
                            <a href="{{ asset('storage/'.$member->birthCert) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($member->brgyCert)
                            <a href="{{ asset('storage/'.$member->brgyCert) }}" target="_blank">View</a>
                        @else
                            -
                        @endif
                    </td>

                    {{-- 🟢 Scholarship status --}}
                    <td>{{ $member->scholarship_status ?? 'Not Set' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">No members found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 📄 Pagination --}}
    <div class="w-full text-center py-4">
        <div class="inline-block">
            {{ $members->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
