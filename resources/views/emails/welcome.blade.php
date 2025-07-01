<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Mini Mart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #28a745;
      padding-bottom: 20px;
      margin-bottom: 30px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #28a745;
      margin-bottom: 10px;
    }

    .credentials-box {
      background-color: #f8f9fa;
      border-left: 4px solid #28a745;
      padding: 20px;
      margin: 20px 0;
    }

    .footer {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #eee;
      color: #666;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="logo">🏪 {{ config('app.name') }}</div>
      <h2>Welcome to the Team!</h2>
    </div>

    <p>Hello <strong>{{ $user->name }}</strong>,</p>

    <p>Welcome to {{ config('app.name') }}! Your account has been created successfully.</p>

    <div class="credentials-box">
      <h3>Your Account Details:</h3>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Role:</strong> {{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
      @if($password)
      <p><strong>Temporary Password:</strong> {{ $password }}</p>
      <p><em>Please change your password after first login.</em></p>
    @endif
    </div>

    <p>You can now access the system and start working. If you have any questions, please contact your administrator.
    </p>

    <p>Best regards,<br>
      <strong>{{ config('app.name') }} Team</strong>
    </p>

    <div class="footer">
      <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>

</html>