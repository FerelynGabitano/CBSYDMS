@extends('faci_dashboard')

@section('title', 'Sponsors')

@section('content')
<div class="list-section">
          <h3>Sponsors</h3>
          <form action="{{ route('faci.sponsor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Sponsor Name" required>
            <input type="text" name="contact_person" placeholder="Contact Person">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
            <textarea name="address" rows="3" placeholder="Address"></textarea>
            <input type="file" name="logo_path" accept="image/*">
            <button type="submit">Add Sponsor</button>
          </form>
          <ul>
            @foreach($sponsors as $sponsor)
              <li>
                <strong>{{ $sponsor->name }}</strong>
                @if($sponsor->contact_person) - Contact: {{ $sponsor->contact_person }} @endif
                @if($sponsor->email) - Email: {{ $sponsor->email }} @endif
                @if($sponsor->phone) - Phone: {{ $sponsor->phone }} @endif
                @if($sponsor->address) - Address: {{ $sponsor->address }} @endif
                @if($sponsor->logo_path)<br><img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="Logo" width="80">@endif
              </li>
            @endforeach
          </ul>
        </div>
@endsection