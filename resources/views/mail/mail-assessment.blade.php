<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Assessment Invitation – VoxSync HRMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@500&display=swap');
        @media (prefers-color-scheme: dark) {

            .email-header,
            .email-footer {
                background: #0f1623 !important;
            }

            .email-header *,
            .email-footer * {
                color: #ffffff !important;
            }
        }

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
            color: #ffffff !important;
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

        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
        }

        .info-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            color: #fff !important;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }

        .email-footer {
            background: #0f172a;
            color: #ffffff !important;
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
                <h1>Assessment Invitation 📢</h1>
                <p>Please review your scheduled assessment details below</p>
            </div>
        </div>

        <!-- BODY -->
        <div class="email-body">

            <p>
                Dear Mr./Mrs. <strong>{{ $name }}</strong>,
            </p>

            <p style="margin-top:10px;">
                Greetings from the Human Resources Department.
            </p>

            <p style="margin-top:10px;">
                We are pleased to inform you that you have been shortlisted for the position of
                <strong>{{ $position }}</strong>.
            </p>

            <p style="margin-top:10px;">
                As part of our recruitment process, you are invited to complete the following assessment:
            </p>

            <!-- Assessment Details -->
            <div class="info-card">
                <div class="info-label">Assessment Type</div>
                <div class="info-value">{{ $assessmentType }}</div>

                <div class="info-label mt-3">Schedule</div>
                <div class="info-value">{{ $schedule }}</div>

                <div class="info-label mt-3">Location / Platform</div>
                <div class="info-value">{{ $locationOrPlatform }}</div>

                <div class="info-label mt-3">Instructions / Requirements</div>
                <div class="info-value">{{ $instructions }}</div>
            </div>

            <p style="margin-top:10px;">
                Kindly ensure that you are available at the scheduled time and follow the instructions provided above.
            </p>

            <p style="margin-top:20px;">
                If you have any questions or need to reschedule, please contact us in advance.
            </p>

            <p style="margin-top:20px;">
                We look forward to your participation and wish you the best of luck.
            </p>

            <p style="margin-top:20px;">
                Sincerely,<br>
                <strong>Human Resources Department</strong><br>
                VoxSync HRMS
            </p>

        </div>

        <!-- FOOTER -->
        <div class="email-footer">

            <hr class="footer-divider">

            <p class="footer-copy">
                This is an automated message from <strong style="color:rgba(255,255,255,0.45);">VoxSync HRMS</strong>.
                Please do not reply directly to this email.<br>
                © {{ date('Y') }} VoxSync. All rights reserved.
            </p>

        </div>

    </div>

</body>

</html>
