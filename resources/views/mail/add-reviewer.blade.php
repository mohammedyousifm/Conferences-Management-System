<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Invitation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #f7941d;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
            border-top: 1px solid #dddddd;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #f7941d;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <p>Conference Management System</p>
        </div>
        <div class="content">
            <p>Dear {{ $ReviewerName }},</p>
            <p>You have been invited to review papers for the <strong>Conference Management System</strong>. Please
                click the button below to accept the invitation and complete your reviewer registration.</p>
            <p><strong>Controller Name:</strong> {{ $ControllerName }}</p>
            <p><strong>Controller Message:</strong> {{ $ControllerMessage }}</p>
            <p>
                <a href="{{ $invitationLink }}" class="btn">registration</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Conference Management System. All Rights Reserved.
        </div>
    </div>
</body>

</html>