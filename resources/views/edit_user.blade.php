<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User - Batang Surigaonon Youth</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f5f7fa;
      color: #333;
      padding: 2rem;
    }

    h1 {
      color: #1C0BA3;
      margin-bottom: 1.5rem;
    }

    form {
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      max-width: 500px;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
      color: #1C0BA3;
    }

    input {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
    }

    .btn {
      background-color: #1C0BA3;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #150882;
    }

    .back-link {
      display: inline-block;
      margin-top: 1rem;
      color: #1C0BA3;
      text-decoration: none;
      font-weight: bold;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .alert-success {
      background-color: #e6f4ea;
      color: #256029;
      padding: 0.75rem 1rem;
      border-radius: 5px;
      margin-top: 1rem;
      margin-bottom: 1rem;
    }

    .alert-error {
      background-color: #fdecea;
      color: #b71c1c;
      padding: 0.75rem 1rem;
      border-radius: 5px;
      margin-top: 1rem;
      margin-bottom: 1rem;
    }

    ul.error-list {
      list-style-type: disc;
      padding-left: 1.2rem;
    }
  </style>
</head>
<body>

  <h1>Edit User</h1>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
  @endif

  @if($errors->any())
    <div class="alert-error">
      <ul class="error-list">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('users.update', $user->user_id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Credential Email:</label>
    <input type="email" name="credential_email" value="{{ old('credential_email', $user->credential_email) }}" required>

    <label>New Password (leave blank to keep current):</label>
    <input type="password" name="password" placeholder="Enter new password">

    <label>Confirm Password:</label>
    <input type="password" name="password_confirmation" placeholder="Confirm new password">

    <button type="submit" class="btn">Update</button>
  </form>

  <a href="{{ route('admin_dashboard') }}" class="back-link">← Back to Dashboard</a>

</body>
</html>
