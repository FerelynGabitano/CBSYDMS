@extends('faci_dashboard')

@section('title', 'Member Scholarship Requirements')

@section('content')
<div class="container">
    @if(session('error'))
    <script>
        // Reusable popup creation (same as your style)
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

        function showPopup(popup, message) {
        popup.textContent = message;
        popup.style.opacity = '1';
        setTimeout(() => popup.style.opacity = '0', 3000);
        }

        // Trigger the popup with Laravel session message
        document.addEventListener('DOMContentLoaded', function() {
            showPopup(errorPopup, "{{ session('error') }}");
        });
    </script>
    @endif
    <h2>Member Scholarship Documents</h2>

    {{-- 🔍 Search form --}}
    <form action="{{ route('sections.mem_scholar_req') }}" method="GET" style="margin-bottom: 20px; display:inline-block;">
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

    {{-- 📄 Export button --}}
    <form action="{{ route('sections.export_members_docs') }}" method="GET" style="margin-bottom: 20px; display:inline-block;">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <button type="submit" class="btn btn-success">Export All Documents</button>
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
                @php $docs = $member->documents; @endphp
                <tr>
                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                    <td>{{ $member->email }}</td>

                    {{-- File columns --}}
                    <td>@if($docs && $docs->votersCert)<a href="{{ asset('storage/'.$docs->votersCert) }}" target="_blank">View</a>@else - @endif</td>
                    <td>@if($docs && $docs->cor)<a href="{{ asset('storage/'.$docs->cor) }}" target="_blank">View</a>@else - @endif</td>
                    <td>@if($docs && $docs->idPicture)<a href="{{ asset('storage/'.$docs->idPicture) }}" target="_blank">View</a>@else - @endif</td>
                    <td>@if($docs && $docs->gradeReport)<a href="{{ asset('storage/'.$docs->gradeReport) }}" target="_blank">View</a>@else - @endif</td>
                    <td>@if($docs && $docs->birthCert)<a href="{{ asset('storage/'.$docs->birthCert) }}" target="_blank">View</a>@else - @endif</td>
                    <td>@if($docs && $docs->brgyCert)<a href="{{ asset('storage/'.$docs->brgyCert) }}" target="_blank">View</a>@else - @endif</td>

                    {{-- Scholarship status --}}
                    <td>{{ $member->scholarship_status ?? 'Not Set' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">No members found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="w-full text-center py-4">
        <div class="inline-block">
            {{ $members->appends(['search' => request('search')])->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
