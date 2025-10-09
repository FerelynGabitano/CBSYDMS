<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Batang Surigaonon Youth - Registration</title>
<style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: rgb(176, 190, 241);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #1C0BA3;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header img {
            height: 80px;
            margin-bottom: 15px;
        }

        .header a {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-decoration: none;
        }

        .header a:hover {
            color: #d1d5db;
        }

        .header a svg {
            width: 2rem;
            height: 2rem;
            margin-bottom: 5px;
        }
  .progress-bar {
    display: flex; 
    justify-content: space-between; 
    margin: 20px 30px; 
    position: relative;
  }
  .progress-bar::before {
    content: ''; 
    position: absolute; 
    top: 50%; 
    left: 0; 
    width: 100%; 
    height: 4px;
    background: #ddd; 
    transform: translateY(-50%);
  }
  .step {
    z-index: 1; 
    background: #f1c40f; 
    color: #555; 
    width: 35px; 
    height: 35px;
    border-radius: 50%;
    display: flex; 
    align-items: center; 
    justify-content: center;
    font-weight: bold; 
    transition: 0.3s;
  }
  .step.active { 
    background: #1C0BA3; 
    color: white; 
}
  .form-section { 
    display: none; 
    padding: 30px;
    margin-top: -30px; 
}
  .form-section.active { 
    display: block; 
    animation: fadeIn 0.3s ease-in; 
}
  .form-section.active h2{
    color: #1C0BA3;
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1c40f;
}
          .form-section i {
            font-size: 0.9rem;
            color: #666;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            gap: 20px;
        }

        .form-group {
            flex: 1 1 300px;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #1C0BA3;
            outline: none;
            box-shadow: 0 0 0 2px rgba(28, 11, 163, 0.2);
        }

        .file-upload {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .file-upload:hover {
            border-color: #1C0BA3;
        }

        .file-upload input {
            display: none;
        }

        .file-upload label {
            display: block;
            cursor: pointer;
            color: #1C0BA3;
            font-weight: bold;
        }

        .file-upload .file-info {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }

        .btn-next {
            background-color: #1C0BA3;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s;
            display: block;
            margin: 30px auto 0;
        }

        .btn-next:hover {
            background-color: #12067a;
            transform: translateY(-2px);
        }

        .btn-prev {
            background-color: #1C0BA3;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s;
            display: block;
            margin: 30px auto 0;
        }

        .btn-prev:hover {
            background-color: #12067a;
            transform: translateY(-2px);
        }
        .btn {
            background-color: #1C0BA3;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s;
            display: block;
            margin: 30px auto 0;
        }

        .btn:hover {
            background-color: #12067a;
            transform: translateY(-2px);
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .button-group .btn {
            margin: 0;
        }


        .required:after {
            content: " *";
            color: red;
        }

 .terms-container {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.terms-checkbox {
    appearance: none;
    width: 10px; 
    height: 10px;
    border: 2px solid #1C0BA3;
    border-radius: 3px;
    cursor: pointer;
    position: relative;
    display: inline-block;
}

.terms-checkbox:checked {
    background-color: #1C0BA3;
}

.terms-checkbox:checked::after {
    content: "✓";
    color: white;
    font-size: 10px;
    position: absolute;
    top: -1px;
    left: 2px;
}

.terms-label {
    margin: 0;
    font-size: 0.95rem;
    color: #333;
    cursor: pointer;
}

.terms-container i {
    display: block;
    margin-top: 5px;
    color: gray;
    font-size: 0.85rem;
}



        
</style>
</head>

<body>
    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="header">
                <a href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <img src="{{ asset('images/BSYLogo.png') }}" alt="BSY Logo">
                <h1>Batang Surigaonon Youth Registration</h1>
                <p>Join our Batang Surigaonon Youth and be Part of the Change!</p>
            </div>

    <div class="progress-bar">
      <div class="step active">1</div>
      <div class="step">2</div>
      <div class="step">3</div>
      <div class="step">4</div>
    </div>

    <!-- Step 1 -->
    <div class="form-section active">
      <h2>Personal Information</h2>
      <div class="form-group">
        <label for="first_name" class="required">First Name</label>
        <input type="text" id="first_name" name="first_name" required>
      </div>
      <div class="form-group">
        <label for="middle_name">Middle Name</label>
        <input type="text" id="middle_name" name="middle_name" >
      </div>
      <div class="form-group">
        <label for="last_name" class="required">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>
     </div>
      <div class="form-group">
        <label for="date_of_birth" class="required">Date of Birth</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required>
     </div>
     <div class="form-group">
        <label for="gender" class="required">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
     </div>
     <div class="form-group">
        <label for="contact_number" class="required">Contact Number</label> <input type="tel" name="contact_number" id="contact_number" class="form-control" pattern="[0-9]{11}" maxlength="11" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"> </div>
      <div class="form-group">
        <label for="email" class="required">Email Address</label>
        <input type="email" id="email" name="email" required>
     </div>
        <div class="button-group">
            <button type="button" class="btn next">Next</button>
        </div>
    </div>

    <!-- Step 2 -->
    <div class="form-section">
      <h2>Address Information</h2>
      <div class="form-group"><label for="street_address" class="required">Street Address</label>
                        <input type="text" id="street_address" name="street_address" required>
                    </div>
      <div class="form-group"><label for="barangay" class="required">Barangay</label>
                        <input type="text" id="barangay" name="barangay" required>
                    </div>
      <div class="form-group"><label for="city_municipality" class="required">City/Municipality</label>
                        <input type="text" id="city_municipality" name="city_municipality" required>
                    </div>
      <div class="form-group"><label for="province" class="required">Province</label>
                        <input type="text" id="province" name="province" required>
                    </div>
      <div class="form-group"><label for="zip_code" class="required">Zip Code</label>
                        <input type="text" id="zip_code" name="zip_code" required>
                    </div>
        <div class="button-group">
            <button type="button" class="btn prev">Previous</button>
            <button type="button" class="btn next">Next</button>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="form-section">
      <h2>Educational Background</h2>
      <div class="form-group"><label for="school" class="required">School Name</label>
                                <input type="text" id="school" name="school" required>
                            </div>
      <div class="form-group">
        <label for="gradeLevel" class="required">Grade Level</label>
                                <select id="gradeLevel" name="gradeLevel" required>
                                    <option value="">Select Grade Level</option>
                                    <option value="grade 7">Grade 7</option>
                                    <option value="grade 8">Grade 8</option>
                                    <option value="grade 9">Grade 9</option>
                                    <option value="grade 10">Grade 10</option>
                                    <option value="grade 11">Grade 11</option>
                                    <option value="grade 12">Grade 12</option>
                                    <option value="1st Yr. College">1st Yr. College</option>
                                    <option value="2nd Yr. College">2nd Yr. College</option>
                                    <option value="3rd Yr. College">3rd Yr. College</option>
                                    <option value="4th Yr. College">4th Yr. College</option>
                                </select>
                            </div>
        <div class="button-group">
            <button type="button" class="btn prev">Previous</button>
            <button type="button" class="btn next">Next</button>
        </div>
    </div>

    <!-- Step 4 -->
    <div class="form-section">
      <h2>Upload Documents</h2>
      <div class="form-group"><label class="required">Barangay Certificate</label>
                                <div class="file-upload">
                                    <input type="file" id="brgyCert" name="brgyCert" accept=".pdf,.jpg,.jpeg,.png"
                                        required>
                                    <label for="brgyCert">Click to upload file</label>
                                    <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                                </div>
      <div class="form-group"><label class="required">Birth Certificate</label>
                                <div class="file-upload">
                                    <input type="file" id="birthCert" name="birthCert" accept=".pdf,.jpg,.jpeg,.png"
                                        required>
                                    <label for="birthCert">Click to upload file</label>
                                    <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                                </div>
      <div class="form-group"><label class="required">Latest Grade Report</label>
                                <div class="file-upload">
                                    <input type="file" id="gradeReport" name="gradeReport" accept=".pdf,.jpg,.jpeg,.png"
                                        required>
                                    <label for="gradeReport">Click to upload file</label>
                                    <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                                </div>
      <div class="form-group"><label class="required">2x2 ID Picture</label>
                                <div class="file-upload">
                                    <input type="file" id="idPicture" name="idPicture" accept=".jpg,.jpeg,.png"
                                        required>
                                    <label for="idPicture">Click to upload file</label>
                                    <div class="file-info">(JPG or PNG, max 2MB)</div>
                                </div>

                        <div class="terms-container">
                            <input type="checkbox" id="terms" name="terms" class="terms-checkbox" required>
                            <label for="terms" class="terms-label">
                                <span class="required"></span> I certify that all information provided is true and
                                correct.
                            </label>
                        </div>
                        <i>Note: Hardcopy of All Documents Must Be Submitted Upon Request</i>

      <div class="button-group">
        <button type="button" class="btn prev">Previous</button>
        <button type="submit" class="btn">Submit</button>
      </div>
    </div>
    </div>
</form>

<script>
  const sections = document.querySelectorAll('.form-section');
  const nextBtns = document.querySelectorAll('.next');
  const prevBtns = document.querySelectorAll('.prev');
  const steps = document.querySelectorAll('.step');
  let currentStep = 0;

  function showStep(index) {
    sections.forEach((s, i) => s.classList.toggle('active', i === index));
    steps.forEach((step, i) => step.classList.toggle('active', i <= index));
  }

  nextBtns.forEach(btn => btn.addEventListener('click', () => {
    if (currentStep < sections.length - 1) currentStep++;
    showStep(currentStep);
  }));

  prevBtns.forEach(btn => btn.addEventListener('click', () => {
    if (currentStep > 0) currentStep--;
    showStep(currentStep);
  }));
</script>
</body>
</html>
