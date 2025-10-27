@extends('mem_dashboard')

@section('title', 'Scholarships')

@section('content')
  <div id="scholarships-section" class="content-section">
        <div class="section-title">
          <h2><i class="fa-solid fa-graduation-cap"></i> Scholarships</h2>
        </div>
        <form action="{{ route('upload.scholarship') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="detail-group">
            <label>Barangay Certificate:</label>
            <input type="file" name="brgyCert">
            @if(Auth::user()->brgyCert)
              <a href="{{ asset('storage/' . Auth::user()->brgyCert) }}" target="_blank">View File</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Birth Certificate:</label>
            <input type="file" name="birthCert">
            @if(Auth::user()->birthCert)
              <a href="{{ asset('storage/' . Auth::user()->birthCert) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Grade Report:</label>
            <input type="file" name="gradeReport">
            @if(Auth::user()->gradeReport)
              <a href="{{ asset('storage/' . Auth::user()->gradeReport) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>ID Picture:</label>
            <input type="file" name="idPicture">
            @if(Auth::user()->idPicture)
              <a href="{{ asset('storage/' . Auth::user()->idPicture) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Certificate of Registration (COR):</label>
            <input type="file" name="cor">
            @if(Auth::user()->cor)
              <a href="{{ asset('storage/' . Auth::user()->cor) }}" target="_blank">View</a>
            @endif
          </div>

          <div class="detail-group">
            <label>Voter's Certificate:</label>
            <input type="file" name="votersCert">
            @if(Auth::user()->votersCert)
              <a href="{{ asset('storage/' . Auth::user()->votersCert) }}" target="_blank">View</a>
            @endif
          </div>
          <button type="submit" class="btn-submit">Submit Requirements</button>
        </form>
      </div>
    </main>
  </div>
@endsection
