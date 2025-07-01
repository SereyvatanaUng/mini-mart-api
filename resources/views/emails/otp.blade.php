<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .otp-box {
            background-color: #f8f9fa;
            border: 2px dashed #007bff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 5px;
            margin: 10px 0;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .warning-icon {
            color: #856404;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🏪 {{ $appName }}</div>
            <h2>Password Reset Request</h2>
        </div>

        <p>Hello <strong>{{ $user->name }}</strong>,</p>

        <p>We received a request to reset your password for your {{ $appName }} account. Use the OTP code below to reset your password:</p>

        <div class="otp-box">
            <p><strong>Your OTP Code:</strong></p>
            <div class="otp-code">{{ $otp }}</div>
            <p style="margin: 5px 0; color: #666;">Enter this code in the app to reset your password</p>
        </div>

        <div class="warning">
            <p><span class="warning-icon">⚠️ Important:</span></p>
            <ul style="margin: 5px 0;">
                <li>This OTP is valid for <strong>15 minutes</strong> only</li>
                <li>Expires at: <strong>{{ $expiresAt->format('M d, Y - H:i') }}</strong></li>
                <li>Do not share this code with anyone</li>
                <li>If you didn't request this, please ignore this email</li>
            </ul>
        </div>

        <p>If you're having trouble, please contact our support team.</p>

        <p>Best regards,<br>
        <strong>{{ $appName }} Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>© {{ date('Y') }} {{ $appName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>