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
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .header img {
            height: 80px;
            margin-bottom: 15px;
        }

        .form-container {
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            color: #1C0BA3;
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1c40f;
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

        .btn-submit {
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

        .btn-submit:hover {
            background-color: #12067a;
            transform: translateY(-2px);
        }

        .required:after {
            content: " *";
            color: red;
        }

        /* Updated Terms Checkbox Styles */
        .terms-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        
        .terms-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #1C0BA3;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .terms-checkbox:checked {
            background-color: #1C0BA3;
        }
        
        .terms-checkbox:checked::after {
            content: "✓";
            color: white;
            font-size: 14px;
            position: absolute;
        }
        
        .terms-label {
            font-size: 0.95rem;
            color: #333;
            cursor: pointer;
        }
        
        .terms-label .required {
            color: red;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/BSYLogo.png') }}" alt="BSY Logo">
            <h1>Batang Surigaonon Youth Registration</h1>
            <p>Join our Batang Surigaonon Youth and be Part of the Change!</p>
        </div>

        <div class="form-container">
            <form id="registrationForm" enctype="multipart/form-data">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h2>Personal Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName" class="required">First Name</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middleName">
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="required">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="birthdate" class="required">Date of Birth</label>
                            <input type="date" id="birthdate" name="birthdate" required>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="required">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contactNumber" class="required">Contact Number</label>
                            <input type="tel" id="contactNumber" name="contactNumber" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="required">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                </div>

                <!-- Address Information Section -->
                <div class="form-section">
                    <h2>Address Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="street" class="required">Street Address</label>
                            <input type="text" id="street" name="street" required>
                        </div>
                        <div class="form-group">
                            <label for="barangay" class="required">Barangay</label>
                            <input type="text" id="barangay" name="barangay" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="required">City/Municipality</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="province" class="required">Province</label>
                            <input type="text" id="province" name="province" required>
                        </div>
                        <div class="form-group">
                            <label for="zipCode" class="required">Zip Code</label>
                            <input type="text" id="zipCode" name="zipCode" required>
                        </div>
                    </div>
                </div>

                <!-- Educational Background Section -->
                <div class="form-section">
                    <h2>Educational Background</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="school" class="required">School Name</label>
                            <input type="text" id="school" name="school" required>
                        </div>
                        <div class="form-group">
                            <label for="gradeLevel" class="required">Grade Level</label>
                            <select id="gradeLevel" name="gradeLevel" required>
                                <option value="">Select Grade Level</option>
                                <option value="grade7">Grade 7</option>
                                <option value="grade8">Grade 8</option>
                                <option value="grade9">Grade 9</option>
                                <option value="grade10">Grade 10</option>
                                <option value="grade11">Grade 11</option>
                                <option value="grade12">Grade 12</option>
                                <option value="1stcollege">1st Yr College</option>
                                <option value="2ndcollege">2nd Yr College</option>
                                <option value="3rdcollege">3rd Yr College</option>
                                <option value="4thcollege">4th Yr College</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="form-section">
                    <h2>Required Documents</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required">Barangay Certificate</label>
                            <div class="file-upload">
                                <input type="file" id="brgyCert" name="brgyCert" accept=".pdf,.jpg,.jpeg,.png" required>
                                <label for="brgyCert">Click to upload file</label>
                                <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="required">Birth Certificate</label>
                            <div class="file-upload">
                                <input type="file" id="birthCert" name="birthCert" accept=".pdf,.jpg,.jpeg,.png" required>
                                <label for="birthCert">Click to upload file</label>
                                <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required">Latest Grade Report</label>
                            <div class="file-upload">
                                <input type="file" id="gradeReport" name="gradeReport" accept=".pdf,.jpg,.jpeg,.png" required>
                                <label for="gradeReport">Click to upload file</label>
                                <div class="file-info">(PDF, JPG, or PNG, max 5MB)</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="required">2x2 ID Picture</label>
                            <div class="file-upload">
                                <input type="file" id="idPicture" name="idPicture" accept=".jpg,.jpeg,.png" required>
                                <label for="idPicture">Click to upload file</label>
                                <div class="file-info">(JPG or PNG, max 2MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-section">
                    <div class="terms-container">
                        <input type="checkbox" id="terms" name="terms" class="terms-checkbox" required>
                        <label for="terms" class="terms-label">
                            <span class="required"></span> I certify that all information provided is true and correct.
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Submit Registration</button>
            </form>
        </div>
    </div>

    <script>
        // Simple file upload feedback
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileInfo = this.parentElement.querySelector('.file-info');
                if (this.files.length > 0) {
                    fileInfo.textContent = this.files[0].name + " (" + 
                        Math.round(this.files[0].size / 1024) + "KB)";
                    fileInfo.style.color = "#1C0BA3";
                } else {
                    fileInfo.textContent = "(PDF, JPG, or PNG)";
                    fileInfo.style.color = "#666";
                }
            });
        });
    </script>
</body>
</html>