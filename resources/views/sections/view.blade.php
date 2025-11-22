@extends('faci_dashboard')

@section('title', 'Activity View')

@section('content')
<div class="container" style="max-width: 800px; margin: 20px auto;">
    <h2>{{ $activity->title }}</h2>
    <p>{{ $activity->description }}</p>

    <p><strong>Location:</strong> {{ $activity->location }}</p>
    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($activity->start_datetime)->format('M d, Y h:i A') }}</p>
    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($activity->end_datetime)->format('M d, Y h:i A') }}</p>

    <h3 style="margin-top: 30px;">Participants</h3>

    @if($activity->participants->count() > 0)
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #ccc; padding: 8px;">Name</th>
                    <th style="border-bottom: 1px solid #ccc; padding: 8px; text-align:center;">Attendance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activity->participants as $p)
                <tr>
                    <td style="padding: 8px;">{{ $p->first_name }} {{ $p->last_name }}</td>
                    <td style="padding: 8px; text-align:center;">
                        <input type="checkbox" 
                               class="attendance-checkbox" 
                               data-user-id="{{ $p->user_id }}" 
                               data-activity-id="{{ $activity->activity_id }}" 
                               data-url="{{ route('faci.attendance.update', $activity->activity_id) }}"
                               {{ optional($p->pivot)->attendance_status === 'attended' ? 'checked' : '' }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No participants yet.</p>
    @endif
</div>

<script>
document.querySelectorAll('.attendance-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const userId = this.dataset.userId;
        const activityId = this.dataset.activityId;
        const url = this.dataset.url;
        const status = this.checked ? 'attended' : 'absent';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ attendance: { [userId]: status } })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                console.log('Attendance updated for user:', userId);
            } else {
                alert('Error updating attendance');
            }
        })
        .catch(err => {
            console.error('Error updating attendance:', err);
            alert('Error updating attendance');
        });
    });
});
</script>
@endsection
