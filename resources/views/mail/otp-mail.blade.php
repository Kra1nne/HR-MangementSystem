<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Verification Code – Empthra HRMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f0f2f5;
        }

        .email-wrapper {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #0f1623, #1e3a5f);
            padding: 36px 48px;
            color: #fff;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
        }

        .header-tagline h1 {
            font-size: 24px;
            margin-top: 20px;
        }

        .header-tagline p {
            opacity: 0.7;
        }

        /* Body */
        .email-body {
            padding: 40px;
            color: #374151;
        }

        .otp-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin: 30px 0;
        }

        .otp-label {
            font-size: 12px;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        .otp-value {
            font-family: 'DM Mono', monospace;
            font-size: 28px;
            letter-spacing: 6px;
            padding: 14px 20px;
            border-radius: 8px;
            background: #fff;
            border: 1px dashed #cbd5e1;
            display: inline-block;
        }

        .otp-expiry {
            font-size: 12px;
            color: #ef4444;
            margin-top: 10px;
        }

        /* Button */
        .btn-primary {
            background: #2563eb;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            color: #fff !important;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        /* Footer */
        .email-footer {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 30px;
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .email-body {
                padding: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        <!-- HEADER -->
        <div class="email-header">
            <div class="logo-text">Empthra HRMS</div>

            <div class="header-tagline">
                <h1>Your Verification Code 🔐</h1>
                <p>Use this code to securely continue</p>
            </div>
        </div>

        <!-- BODY -->
        <div class="email-body">

            <p>
                Hello <strong>{{ $name }}</strong>,
            </p>

            <p style="margin-top:10px;">
                We received a request to access your <strong>Empthra HRMS</strong> account.
                Use the verification code below to proceed:
            </p>

            <!-- OTP CARD -->
            <div class="otp-card">
                <div class="otp-label">ONE-TIME PASSWORD</div>
                <div class="otp-value">{{ $otp }}</div>
                <div class="otp-expiry">
                    Valid for {{ $expiryMinutes }} minutes
                </div>
            </div>

            <!-- Security Notice -->
            <div style="margin-top:25px; background:#fff7ed; padding:12px; border-left:4px solid #f59e0b;">
                ⚠️ Never share this code with anyone. Empthra will never ask for your OTP.
            </div>

            <!-- Support -->
            <p style="margin-top:20px; font-size:14px;">
                If you didn’t request this, please ignore this email or contact support at
                <strong>{{ $supportEmail ?? 'hr@company.com' }}</strong>.
            </p>

            <p style="margin-top:20px;">
                — Empthra HRMS Team
            </p>

        </div>

        <!-- FOOTER -->
        <div class="email-footer">

            <hr class="footer-divider">

            <p class="footer-copy">
                This is an automated message from <strong style="color:rgba(255,255,255,0.45);">Empthra HRMS</strong>.
                Please do not reply directly to this email.<br>
                © {{ date('Y') }} Empthra. All rights reserved.<br>
            </p>

        </div>

    </div>

</body>

</html>
