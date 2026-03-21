<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your Temporary Password – Empthra HRMS</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ── Google Font ── */
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');

        /* ── Reset & base ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f0f2f5;
            color: #1a1d23;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Wrapper ── */
        .email-wrapper {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.10);
        }

        /* ── Header / Logo bar ── */
        .email-header {
            background: linear-gradient(135deg, #0f1623 0%, #1b2a44 60%, #1e3a5f 100%);
            padding: 36px 48px 32px;
            position: relative;
            overflow: hidden;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.12);
        }

        .email-header::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(99, 179, 237, 0.07);
        }

        /* Logo mark */
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -1px;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .logo-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.50);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            margin-top: 1px;
        }

        /* ── Hero banner inside header ── */
        .header-tagline {
            margin-top: 28px;
            position: relative;
            z-index: 2;
        }

        .header-tagline h1 {
            font-size: 26px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.25;
            letter-spacing: -0.4px;
        }

        .header-tagline p {
            margin-top: 6px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.60);
            font-weight: 400;
        }

        /* ── Body content ── */
        .email-body {
            padding: 44px 48px 36px;
        }

        .greeting {
            font-size: 16px;
            color: #374151;
            line-height: 1.7;
        }

        .greeting strong {
            color: #0f1623;
            font-weight: 600;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #e5e9f0;
            margin: 28px 0;
        }

        /* ── Password box ── */
        .password-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px 28px;
            margin: 28px 0;
            position: relative;
        }

        .password-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        .password-value {
            font-family: 'DM Mono', monospace;
            font-size: 24px;
            font-weight: 500;
            color: #0f1623;
            background: #ffffff;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px 20px;
            letter-spacing: 3px;
            display: inline-block;
            width: 100%;
            word-break: break-all;
        }

        .password-note {
            margin-top: 12px;
            font-size: 12.5px;
            color: #64748b;
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .password-note .dot {
            color: #f59e0b;
            font-size: 16px;
            line-height: 1.2;
            flex-shrink: 0;
        }

        /* ── CTA button ── */
        .btn-login {
            display: inline-block;
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            color: #ffffff !important;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 36px;
            border-radius: 10px;
            text-decoration: none;
            letter-spacing: 0.2px;
            border: none;
            margin: 24px 0 8px;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.35);
            transition: background 0.2s;
        }

        /* ── Info steps ── */
        .steps {
            margin: 28px 0 0;
            padding: 0;
        }

        .steps li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 10px 0;
            font-size: 14px;
            color: #475569;
            line-height: 1.5;
            border-bottom: 1px solid #f1f5f9;
        }

        .steps li:last-child {
            border-bottom: none;
        }

        .step-num {
            width: 26px;
            height: 26px;
            background: #1d4ed8;
            color: #fff;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Security notice ── */
        .security-notice {
            background: #fff7ed;
            border-left: 4px solid #f59e0b;
            border-radius: 0 8px 8px 0;
            padding: 14px 18px;
            margin: 28px 0 0;
            font-size: 13px;
            color: #92400e;
            line-height: 1.6;
        }

        /* ── Footer ── */
        .email-footer {
            background: #0f1623;
            padding: 32px 48px;
            text-align: center;
        }

        .footer-logo {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }

        .footer-logo span {
            color: #3b82f6;
        }

        .footer-tagline {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.35);
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #60a5fa;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin: 16px 0;
        }

        .footer-copy {
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.25);
            line-height: 1.6;
        }

        .footer-copy a {
            color: rgba(255, 255, 255, 0.40);
            text-decoration: none;
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .email-wrapper {
                margin: 0;
                border-radius: 0;
            }

            .email-header {
                padding: 28px 24px 24px;
            }

            .email-body {
                padding: 32px 24px 28px;
            }

            .email-footer {
                padding: 28px 24px;
            }

            .header-tagline h1 {
                font-size: 21px;
            }

            .password-value {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        {{-- ──────────────── HEADER ──────────────── --}}
        <div class="email-header">

            {{-- Logo --}}
            <div class="logo-wrap">
                <div>
                    <div class="logo-text">Empthra</div>
                    <div class="logo-sub">HRMS Platform</div>
                </div>
            </div>

            {{-- Headline --}}
            <div class="header-tagline">
                <h1>Your Account Is Ready 🎉</h1>
                <p>Secure access to your HR workspace</p>
            </div>

        </div>
        {{-- /HEADER --}}


        {{-- ──────────────── BODY ──────────────── --}}
        <div class="email-body">

            <p class="greeting">
                Hello, <strong>{{ $name }}</strong> 👋
            </p>
            <p class="greeting" style="margin-top: 12px;">
                Welcome to <strong>Empthra HRMS</strong>! Your account has been created by
                your HR administrator. Below is your temporary password to get started.
            </p>

            <hr class="divider">

            {{-- Password Card --}}
            <div class="password-card">
                <div class="password-label">Temporary Password</div>
                <div class="password-value">{{ $temporaryPassword }}</div>
                <p class="password-note">
                    You will be prompted to change it on first login.
                </p>
            </div>

            {{-- CTA --}}
            <div style="text-align:center;">
                <a href="{{ $loginUrl ?? config('app.url') . '/login' }}" class="btn-login">
                    Login to Empthra →
                </a>
                <p style="font-size:12px; color:#94a3b8; margin-top:6px;">
                    or paste this URL in your browser:<br>
                    <a href="{{ $loginUrl ?? config('app.url') . '/login' }}" style="color:#3b82f6; font-size:12px;">
                        {{ $loginUrl ?? config('app.url') . '/login' }}
                    </a>
                </p>
            </div>

            <hr class="divider">

            {{-- Steps --}}
            <p style="font-size:13px; font-weight:600; color:#1e293b; margin-bottom:4px; letter-spacing:0.3px;">
                GETTING STARTED
            </p>
            <ol class="steps">
                <li>
                    <span>1. </span>
                    <span>Click <strong>Login to Empthra</strong> above and enter your
                        email address: <strong>{{ $email }}</strong></span>
                </li>
                <li>
                    <span>2. </span>
                    <span>Paste the temporary password provided and click <strong>Sign In</strong>.</span>
                </li>
                <li>
                    <span>3. </span>
                    <span>You will be redirected to the <strong>Change Password</strong> screen.
                        Create a new strong password to secure your account.</span>
                </li>
                <li>
                    <span>4. </span>
                    <span>Complete your employee profile to unlock full HR features.</span>
                </li>
            </ol>

            {{-- Security notice --}}
            <div class="security-notice">
                ⚠️ <strong>Security Reminder:</strong> Never share your password with anyone,
                including HR personnel or system administrators. Empthra will never ask for your
                password via email, phone, or chat.
            </div>

            <p style="margin-top:28px; font-size:14px; color:#64748b; line-height:1.7;">
                If you did not expect this email or believe this was sent in error, please contact
                your HR department immediately at
                <a href="mailto:{{ $supportEmail ?? 'hr@company.com' }}" style="color:#1d4ed8; font-weight:600;">
                    {{ $supportEmail ?? 'hr@company.com' }}
                </a>.
            </p>

            <p style="margin-top:24px; font-size:14px; color:#374151; line-height:1.7;">
                Warm regards,<br>
                <strong style="color:#0f1623;">The Empthra HRMS Team</strong>
            </p>

        </div>
        {{-- /BODY --}}


        {{-- ──────────────── FOOTER ──────────────── --}}
        <div class="email-footer">

            <hr class="footer-divider">

            <p class="footer-copy">
                This is an automated message from <strong style="color:rgba(255,255,255,0.45);">Empthra HRMS</strong>.
                Please do not reply directly to this email.<br>
                © {{ date('Y') }} Empthra. All rights reserved.<br>
            </p>

        </div>
        {{-- /FOOTER --}}

    </div>

</body>

</html>
