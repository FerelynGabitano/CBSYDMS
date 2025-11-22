@extends('mem_dashboard')

@section('title', 'Scholarships')

@section('content')
<div id="scholarships-section" class="content-section">
  <div class="section-title">
    <h2><i class="fa-solid fa-graduation-cap"></i> Scholarships</h2>
  </div>

  <form action="{{ route('upload.scholarship') }}" method="POST" enctype="multipart/form-data" style="margin-top: 1rem;">
    @csrf

    <div class="scholarship-grid" 
         style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">

      @php
        $files = [
          'brgyCert' => 'Barangay Certificate',
          'birthCert' => 'Birth Certificate',
          'gradeReport' => 'Grade Report',
          'idPicture' => 'ID Picture',
          'cor' => 'Certificate of Registration (COR)',
          'votersCert' => "Voter's Certificate"
        ];
        $userDocuments = Auth::user()->documents;
      @endphp

      @foreach ($files as $field => $label)
          <div class="detail-group" 
              style="background: #fff; padding: 1rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
              <label style="font-weight: bold; color: #1C0BA3;">{{ $label }}:</label>
              <input type="file" name="{{ $field }}" accept=".jpg,.jpeg,.png,.pdf" 
                    style="display: block; margin-top: 0.5rem; margin-bottom: 0.5rem;">

              @if ($userDocuments && $userDocuments->$field)
                  @php
                      $filePath = $userDocuments->$field;
                      $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                  @endphp

                  @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                      <div style="margin-top: 0.5rem;">
                          <img src="{{ asset('storage/' . $filePath) }}" 
                              alt="{{ $label }}" 
                              style="width: 100%; max-width: 250px; height: auto; border-radius: 8px; border: 1px solid #ddd;">
                      </div>
                  @else
                      <div style="margin-top: 0.5rem;">
                          <a href="{{ asset('storage/' . $filePath) }}" target="_blank" 
                            style="color: #1C0BA3; text-decoration: underline;">
                              View File
                          </a>
                      </div>
                  @endif
              @endif
          </div>
      @endforeach 
    </div>

    <button type="submit" class="btn" 
            style="margin-top: 2rem; background-color: #1C0BA3; color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 5px; cursor: pointer;">
      Submit Requirements
    </button>
  </form>
</div>
@endsection
