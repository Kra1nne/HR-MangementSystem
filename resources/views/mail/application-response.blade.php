<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status – VoxSync HRMS</title>

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

        .email-body {
            padding: 40px;
            color: #374151;
        }

        .email-footer {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 30px;
            font-size: 12px;
        }

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
            <div class="logo-text">VoxSync HRMS</div>
            <div class="header-tagline">
                <h1>Application Update 📢</h1>
                <p>Your application status has been reviewed</p>
            </div>
        </div>

        <!-- BODY -->
        <div class="email-body">

            <p>Dear Mr./Mrs. <strong>{{ $name }}</strong>,</p>

            <p style="margin-top:10px;">Greetings from the Human Resources Department.</p>

            <p style="margin-top:10px;">
                We appreciate your interest in applying for the position of
                <strong>{{ $position }}</strong> using the email <strong>{{ $email }}</strong>.
            </p>

            @if ($response === 'accepted')
                <p style="margin-top:15px;">
                    We are pleased to inform you that your application has been
                    <strong style="color:green;">accepted</strong>.
                </p>

                <p style="margin-top:10px;">
                    Our team will contact you soon regarding the next steps, including onboarding details and further
                    instructions.
                </p>
            @else
                <p style="margin-top:15px;">
                    We regret to inform you that your application has been
                    <strong style="color:red;">not selected</strong> at this time.
                </p>

                <p style="margin-top:10px;">
                    We encourage you to apply again in the future as new opportunities become available that match your
                    qualifications.
                </p>
            @endif

            <p style="margin-top:20px;">
                Thank you again for your time and interest in joining our organization.
            </p>

            <p style="margin-top:20px;">
                Sincerely,<br>
                <strong>Human Resources Department</strong><br>
                VoxSync HRMS
            </p>

        </div>

        <!-- FOOTER -->
        <div class="email-footer">
            <p>
                This is an automated message from <strong style="color:rgba(255,255,255,0.45);">VoxSync HRMS</strong>.
                Please do not reply directly to this email.<br>
                © {{ date('Y') }} VoxSync. All rights reserved.
            </p>
        </div>

    </div>
</body>

</html>
