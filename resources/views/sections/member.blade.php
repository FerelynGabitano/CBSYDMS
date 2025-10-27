@extends('faci_dashboard')

@section('title', 'Members')

@section('content')
<div class="list-section">
          <h3>Members & Attendance</h3>
          <form action="{{ route('faci.attendance.update') }}" method="POST">
            @csrf
            <table>
              <thead>
                <tr><th>Member Name</th><th>Status</th><th>Attendance</th></tr>
              </thead>
              <tbody>
                @foreach($members as $member)
                  <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->status }}</td>
                    <td>
                      <input type="checkbox" name="attendance[{{ $member->id }}]" value="1" {{ $member->attendance ? 'checked' : '' }}>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Save Attendance</button>
          </form>
        </div>
@endsection